@extends('user.layout')

@section('profile-title')
    {{ $user->name }}'s {{ ucfirst(__('awards.awardcase')) }}
@endsection

@section('profile-content')
    {!! breadcrumbs(['Users' => 'users', $user->name => $user->url, ucfirst(__('awards.awardcase')) => $user->url . '/awardcase']) !!}

    <h1>
        {!! $user->displayName !!}'s {{ ucfirst(__('awards.awardcase')) }}
    </h1>

    @foreach ($awards as $categoryId => $categoryAwards)
        <div class="card mb-3 awardcase-category">
            <h5 class="card-header awardcase-header">
                {!! isset($categories[$categoryId]) ? '<a href="' . $categories[$categoryId]->searchUrl . '">' . $categories[$categoryId]->name . '</a>' : 'Miscellaneous' !!}
                <a class="small awardcase-collapse-toggle collapse-toggle " href="#{!! isset($categories[$categoryId]) ? str_replace(' ', '', $categories[$categoryId]->name) : 'miscellaneous' !!}" data-toggle="collapse">Show</a></h3>
            </h5>
            <div class="card-body awardcase-body collapse show" id="{!! isset($categories[$categoryId]) ? str_replace(' ', '', $categories[$categoryId]->name) : 'miscellaneous' !!}">
                @foreach ($categoryAwards->chunk(4) as $chunk)
                    <div class="row mb-3">
                        @foreach ($chunk as $awardId => $stack)
                            <div class="col-sm-3 col-6 text-center case-award" data-id="{{ $stack->first()->pivot->id }}" data-name="{{ $user->name }}'s {{ $stack->first()->name }}">
                                <div class="mb-1">
                                    <a href="#" class="awardcase-stack {{ $stack->first()->is_featured ? 'alert alert-success' : '' }}"><img src="{{ $stack->first()->imageUrl }}" alt="{{ $stack->first()->name }}" /></a>
                                </div>
                                <div>
                                    <a href="#" class="awardcase-stack awardcase-stack-name">{{ $stack->first()->name }}@if ($stack->first()->user_limit != 1)
                                            x{{ $stack->sum('pivot.count') }}
                                        @endif
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach


    <h3>Latest Activity</h3>
    <div class="mb-4 logs-table">
        <div class="logs-table-header">
            <div class="row">
                <div class="col-6 col-md-2">
                    <div class="logs-table-cell">Sender</div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="logs-table-cell">Recipient</div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="logs-table-cell">{{ ucfirst(__('awards.award')) }}</div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="logs-table-cell">Log</div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="logs-table-cell">Date</div>
                </div>
            </div>
        </div>
        <div class="logs-table-body">
            @foreach ($logs as $log)
                <div class="logs-table-row">
                    @include('user._award_log_row', ['log' => $log, 'owner' => $user])
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.awardcase-stack').on('click', function(e) {
                e.preventDefault();
                var $parent = $(this).parent().parent();
                loadModal("{{ url(__('awards.awardcase')) }}/" + $parent.data('id'), $parent.data('name'));
            });
        });
    </script>
@endsection
