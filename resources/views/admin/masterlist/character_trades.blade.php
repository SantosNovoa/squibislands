@extends('admin.layout')

<<<<<<< HEAD
@section('admin-title')
    Character Trades
@endsection

@section('admin-content')
    {!! breadcrumbs(['Admin Panel' => 'admin', 'Character Trade Queue' => 'admin/masterlist/trades/incoming']) !!}

    <h1>
        Character Trades
    </h1>

    @include('admin.masterlist._header', ['tradeCount' => $tradeCount, 'transferCount' => $transferCount])

    {!! $trades->render() !!}
    @foreach ($trades as $trade)
        @include('home.trades._trade', ['trade' => $trade, 'queueView' => true])
    @endforeach
    {!! $trades->render() !!}
=======
@section('admin-title') Character Trades @endsection

@section('admin-content')
{!! breadcrumbs(['Admin Panel' => 'admin', 'Character Trade Queue' => 'admin/masterlist/trades/incoming']) !!}

<h1>
    Character Trades
</h1>

@include('admin.masterlist._header', ['tradeCount' => $tradeCount, 'transferCount' => $transferCount])

{!! $trades->render() !!}
@foreach($trades as $trade)
    @include('home.trades._trade', ['trade' => $trade, 'queueView' => true])
@endforeach
{!! $trades->render() !!}


>>>>>>> Cylunny/extension/polls-and-forms
@endsection


@section('scripts')
<<<<<<< HEAD
    @parent
    <script>
        $(document).ready(function() {
            $('.trade-action-button').on('click', function(e) {
                e.preventDefault();
                console.log("{{ url('admin/masterlist/trade/act') }}/" + $(this).data('id') + "/" + $(this).data('action'));
                loadModal("{{ url('admin/masterlist/trade/act') }}/" + $(this).data('id') + "/" + $(this).data('action'), 'Process Trade');
            });
        });
    </script>
@endsection
=======
@parent
<script>
$( document ).ready(function() {    
    $('.trade-action-button').on('click', function(e) {
        e.preventDefault();
        console.log("{{ url('admin/masterlist/trade/act') }}/" + $(this).data('id') + "/" + $(this).data('action'));
        loadModal("{{ url('admin/masterlist/trade/act') }}/" + $(this).data('id') + "/" + $(this).data('action') , 'Process Trade');
    });
});
    
</script>
@endsection
>>>>>>> Cylunny/extension/polls-and-forms
