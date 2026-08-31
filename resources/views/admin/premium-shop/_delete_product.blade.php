@extends('admin.layout')

@section('admin-title') Delete Product @endsection

@section('admin-content')
    {!! breadcrumbs(['Admin Panel' => 'admin', 'Premium Shop' => 'admin/premium-shop', 'Delete Product' => 'admin/premium-shop/delete/' . $product->id]) !!}

    <h1>Delete Product</h1>

    <p>Are you sure you want to delete <strong>{{ $product->name }}</strong>? This cannot be undone.</p>

    {!! Form::open(['url' => 'admin/data/premium-shop/delete/' . $product->id]) !!}
    <div class="text-right">
        <a href="{{ url('admin/data/premium-shop') }}" class="btn btn-secondary mr-2">Cancel</a>
        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    </div>
    {!! Form::close() !!}
@endsection