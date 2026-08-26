@extends('admin.layout')

@section('admin-title') {{ $product->id ? 'Edit' : 'Create' }} Product @endsection

@section('admin-content')
    {!! breadcrumbs(['Admin Panel' => 'admin', 'Premium Shop' => 'admin/data/premium-shop', ($product->id ? 'Edit' : 'Create') . ' Product' => $product->id ? 'admin/data/premium-shop/edit/' . $product->id : 'admin/data/premium-shop/create']) !!}

    <h1>{{ $product->id ? 'Edit' : 'Create' }} Product</h1>

    {!! Form::open(['url' => $product->id ? 'admin/data/premium-shop/edit/' . $product->id : 'admin/data/premium-shop/create', 'files' => true]) !!}

    <div class="form-group">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', $product->name, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('description', 'Description') !!}
        {!! Form::textarea('description', $product->description, ['class' => 'form-control', 'rows' => 3]) !!}
    </div>

    <div class="form-group">
        {!! Form::label('price', 'Price (USD)') !!}
        <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text">$</span></div>
            {!! Form::text('price', $product->id ? number_format($product->price / 100, 2) : null, ['class' => 'form-control', 'placeholder' => '5.00']) !!}
        </div>
        <small class="form-text text-muted">Minimum $0.50.</small>
    </div>

    <div class="form-group">
        {!! Form::label('rewardable_type', 'Reward Type') !!}
        {!! Form::select('rewardable_type', ['Currency' => 'Currency', 'Item' => 'Item'], $product->rewardable_type, ['class' => 'form-control', 'id' => 'rewardableType']) !!}
    </div>

    <div class="form-group" id="currencySelect" style="{{ $product->rewardable_type === 'Item' ? 'display:none' : '' }}">
        {!! Form::label('rewardable_id', 'Currency') !!}
        {!! Form::select('rewardable_id', $currencies, $product->rewardable_type === 'Currency' ? $product->rewardable_id : null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group" id="itemSelect" style="{{ $product->rewardable_type !== 'Item' ? 'display:none' : '' }}">
        {!! Form::label('rewardable_id', 'Item') !!}
        {!! Form::select('rewardable_id', $items, $product->rewardable_type === 'Item' ? $product->rewardable_id : null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('quantity', 'Quantity') !!}
        {!! Form::number('quantity', $product->quantity ?? 1, ['class' => 'form-control', 'min' => 1]) !!}
    </div>

    <div class="form-group">
        {!! Form::label('sort', 'Sort Order') !!}
        {!! Form::number('sort', $product->sort ?? 0, ['class' => 'form-control', 'min' => 0]) !!}
        <small class="form-text text-muted">Higher numbers appear first.</small>
    </div>

    <div class="form-group">
        {!! Form::label('image', 'Image') !!}
        @if ($product->imageUrl)
            <div class="mb-2"><img src="{{ $product->imageUrl }}" style="max-height: 100px;" /></div>
        @endif
        {!! Form::file('image', ['class' => 'form-control-file']) !!}
    </div>

    <div class="form-group">
        <div class="form-check">
            {!! Form::checkbox('is_active', 1, $product->is_active ?? true, ['class' => 'form-check-input', 'id' => 'isActive']) !!}
            {!! Form::label('isActive', 'Active', ['class' => 'form-check-label']) !!}
        </div>
    </div>

    <div class="text-right">
        {!! Form::submit($product->id ? 'Save Changes' : 'Create Product', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@endsection

@section('scripts')
    @parent
    <script>
        $('#rewardableType').on('change', function() {
            if ($(this).val() === 'Currency') {
                $('#currencySelect').show();
                $('#itemSelect').hide();
            } else {
                $('#currencySelect').hide();
                $('#itemSelect').show();
            }
        });
    </script>
@endsection