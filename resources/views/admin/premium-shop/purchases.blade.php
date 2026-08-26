@extends('admin.layout')

@section('admin-title') Premium Shop Purchases @endsection

@section('admin-content')
    {!! breadcrumbs(['Admin Panel' => 'admin', 'Premium Shop' => 'admin/data/premium-shop', 'Purchases' => 'admin/data/premium-shop/purchases']) !!}

    <h1>Purchase History</h1>

    <table class="table table-sm">
        <thead>
            <tr>
                <th>Date</th>
                <th>User</th>
                <th>Product</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Stripe ID</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($purchases as $purchase)
                <tr>
                    <td>{{ $purchase->created_at ? $purchase->created_at->format('Y-m-d H:i') : 'N/A' }}</td>
                    <td><a href="{{ $purchase->user->url }}">{{ $purchase->user->name }}</a></td>
                    <td>{{ $purchase->product->name }}</td>
                    <td>{{ $purchase->product->price_display }}</td>
                    <td>
                        @if ($purchase->status === 'completed')
                            <span class="badge badge-success">Completed</span>
                        @elseif ($purchase->status === 'pending')
                            <span class="badge badge-warning">Pending</span>
                        @else
                            <span class="badge badge-danger">Failed</span>
                        @endif
                    </td>
                    <td><small class="text-muted">{{ $purchase->stripe_payment_intent_id }}</small></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $purchases->links() }}
@endsection