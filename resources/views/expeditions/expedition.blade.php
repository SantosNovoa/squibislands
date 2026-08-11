@extends('expeditions.layout')

@section('expeditions-title') {{ $expedition->name }} @endsection

@section('expeditions-content')
{!! breadcrumbs(['Expeditions' => 'expeditions', $expedition->name => $expedition->url]) !!}

<h1>{{ $expedition->name }}</h1>

@if($expedition->has_image)
<div class="mb-3">
    <img src="{{ $expedition->expeditionImageUrl }}" alt="{{ $expedition->name }}" class="img-fluid rounded">
</div>
@endif

<div class="mb-3">
    {!! $expedition->description !!}
</div>

<div class="row mb-3">
    <div class="col-md-3 col-6">
        <strong>Difficulty:</strong> {{ $expedition->difficulty }}
    </div>
    <div class="col-md-3 col-6">
        <strong>Duration:</strong> {{ $expedition->duration_hours }} hours
    </div>
    <div class="col-md-3 col-6">
        <strong>Success Rate:</strong> {{ $expedition->success_rate }}% per character
    </div>
    <div class="col-md-3 col-6">
        <strong>Max Characters:</strong> {{ $expedition->max_characters }}
    </div>
</div>

@auth
    @if($userLog && !$userLog->is_processed)
        <div class="alert alert-info">In progress — returns {{ $userLog->completes_at->diffForHumans(['parts' => 2]) }}</div>
    @elseif($userLog && $userLog->is_processed && !$userLog->is_claimed)
        <a href="#" class="btn btn-success" id="claimExpeditionBtn" data-log-id="{{ $userLog->id }}">Claim Rewards</a>
    @else
        <a href="#" class="btn btn-primary send-expedition-button" data-id="{{ $expedition->id }}">Send Characters</a>
    @endif
@else
    <a href="#" class="btn btn-primary send-expedition-button" data-id="{{ $expedition->id }}">Send Characters</a>
@endauth

<div class="modal fade" id="expeditionResultModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="expeditionResultTitle"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="expeditionResultBody"></div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@parent
<script>
$('.send-expedition-button').on('click', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    loadModal("{{ url('expeditions') }}/" + id + "/select", 'Send Characters on Expedition');
});

$('#claimExpeditionBtn').on('click', function(e) {
    e.preventDefault();
    var logId = $(this).data('log-id');

    $.ajax({
        url: "{{ url('expeditions') }}/" + logId + "/claim",
        method: 'POST',
        data: { _token: '{{ csrf_token() }}' },
        success: function(response) {
            var title = response.expedition_success ? 'Success!' : 'Expedition Failed';
            var body = '';

            if (response.expedition_success && response.rewards.length) {
                body = '<ul>' + response.rewards.map(function(r) {
                    return '<li>' + r.quantity + 'x ' + r.name + '</li>';
                }).join('') + '</ul>';
            } else if (response.expedition_success) {
                body = '<p>No rewards were configured for this expedition.</p>';
            } else {
                body = '<p>Better luck next time!</p>';
            }

            $('#expeditionResultTitle').text(title);
            $('#expeditionResultBody').html(body);
            $('#expeditionResultModal').modal('show');
        },
        error: function(xhr) {
            var errors = xhr.responseJSON && xhr.responseJSON.errors ? xhr.responseJSON.errors.join(', ') : 'Something went wrong.';
            alert(errors);
        }
    });
});

$('#expeditionResultModal').on('hidden.bs.modal', function() {
    location.reload();
});
</script>
@endsection