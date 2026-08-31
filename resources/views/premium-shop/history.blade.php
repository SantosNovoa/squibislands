@extends('premium-shop.layout')

@section('title')
    My Purchase History
@endsection

@section('content')
    {!! breadcrumbs(['Premium Shop' => 'premium-shop', 'My Purchase History' => 'history']) !!}

    <h1>
        My Purchase History
    </h1>

    {!! $purchases->render() !!}

    <div class="mb-4 logs-table">
        <div class="logs-table-header">
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="logs-table-cell">Item</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="logs-table-cell">Cost</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="logs-table-cell">Date</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="logs-table-cell">Status</div>
                </div>
            </div>
        </div>
        <div class="logs-table-body">
            @foreach ($purchases as $purchase)
                <div class="logs-table-row">
                    @include('premium-shop._purchase_history_row', ['purchase' => $purchase])
                </div>
            @endforeach
        </div>
    </div>
    {!! $purchases->render() !!}
@endsection
