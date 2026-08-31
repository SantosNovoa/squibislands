<div class="row flex-wrap">
    <div class="col-12 col-md-3">
        <div class="logs-table-cell">{!! $purchase->product->name !!}</div>
    </div>
    <div class="col-12 col-md-3">
        <div class="logs-table-cell">{!! $purchase->product->price_display !!}</div>
    </div>
    <div class="col-12 col-md-3">
        <div class="logs-table-cell">{!! $purchase->created_at ? pretty_date($purchase->created_at) : 'N/A' !!}</div>
    </div>
    <div class="col-12 col-md-3">
        <div class="logs-table-cell">
            @if ($purchase->status === 'completed')
                <span class="badge badge-success">Completed</span>
            @elseif ($purchase->status === 'pending')
                <span class="badge badge-warning">Pending</span>
            @else
                <span class="badge badge-danger">Failed</span>
            @endif
        </div>
    </div>
</div>
