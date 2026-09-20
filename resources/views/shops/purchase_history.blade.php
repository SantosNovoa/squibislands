@extends('shops.layout')

<<<<<<< HEAD
@section('shops-title')
    My Purchase History
@endsection

@section('shops-content')
    {!! breadcrumbs(['Shops' => 'shops', 'My Purchase History' => 'history']) !!}

    <h1>
        My Purchase History
    </h1>

    {!! $logs->render() !!}

    <div class="mb-4 logs-table">
        <div class="logs-table-header">
            <div class="row">
                <div class="col-12 col-md-2">
                    <div class="logs-table-cell">Item</div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="logs-table-cell">Quantity</div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="logs-table-cell">Shop</div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="logs-table-cell">Character</div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="logs-table-cell">Cost</div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="logs-table-cell">Date</div>
                </div>
            </div>
        </div>
        <div class="logs-table-body">
            @foreach ($logs as $log)
                <div class="logs-table-row">
                    @include('shops._purchase_history_row', ['log' => $log])
                </div>
            @endforeach
        </div>
    </div>
    {!! $logs->render() !!}
=======
@section('shops-title') My Purchase History @endsection

@section('shops-content')
{!! breadcrumbs(['Shops' => 'shops', 'My Purchase History' => 'history']) !!}

<h1>
    My Purchase History
</h1>

{!! $logs->render() !!}


<div class="row ml-md-2">
  <div class="d-flex row flex-wrap col-12 mt-1 pt-1 px-0 ubt-bottom">
    <div class="col-12 col-md-2 font-weight-bold">Item</div>
    <div class="col-6 col-md-2 font-weight-bold">Quantity</div>
    <div class="col-6 col-md-2 font-weight-bold">Shop</div>
    <div class="col-6 col-md-2 font-weight-bold">Character</div>
    <div class="col-6 col-md-2 font-weight-bold">Cost</div>
    <div class="col-6 col-md-2 font-weight-bold">Date</div>
  </div>
    @foreach($logs as $log)
        @include('shops._purchase_history_row', ['log' => $log])
    @endforeach
</div>
{!! $logs->render() !!}

>>>>>>> Cylunny/extension/polls-and-forms
@endsection
