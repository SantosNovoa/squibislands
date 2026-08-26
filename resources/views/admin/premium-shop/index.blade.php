@extends('admin.layout')

@section('admin-title') Premium Shop @endsection

@section('admin-content')
    {!! breadcrumbs(['Admin Panel' => 'admin', 'Premium Shop' => 'admin/data/premium-shop']) !!}

    <h1>Premium Shop</h1>

    <div class="text-right mb-3">
        <a href="{{ url('admin/data/premium-shop/create') }}" class="btn btn-primary">Add Product</a>
        <a href="{{ url('admin/data/premium-shop/purchases') }}" class="btn btn-outline-primary">View Purchases</a>
    </div>

    <table class="table table-sm">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Reward</th>
                <th>Active</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price_display }}</td>
                    <td>
                        {{ $product->quantity }}x
                        {{ $product->rewardable_type === 'Currency'
                            ? \App\Models\Currency\Currency::find($product->rewardable_id)->name ?? 'Unknown'
                            : \App\Models\Item\Item::find($product->rewardable_id)->name ?? 'Unknown' }}
                    </td>
                    <td>{!! $product->is_active ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-danger">No</span>' !!}</td>
                    <td class="text-right">
                        <a href="{{ url('admin/data/premium-shop/edit/' . $product->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <a href="{{ url('admin/data/premium-shop/delete/' . $product->id) }}" class="btn btn-sm btn-outline-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection