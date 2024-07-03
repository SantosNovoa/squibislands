@php
    $items = ['any' => 'Any Item'] + \App\Models\Item\Item::pluck('name', 'id')->toArray();
    $itemCategories = ['any' => 'Any Category'] + \App\Models\Item\ItemCategory::pluck('name', 'id')->toArray();
@endphp

<div class="card mb-3">
    <div class="card-header h4">Donate Item to Boss Attack Method</div>
    <div class="card-body">
        <div class="form-group">
            {!! Form::label('Donate Category') !!}
            {!! Form::select('attack_methods_info[donate_item_item_category]', $itemCategories, null, ['class' => 'form-control', 'placeholder' => 'Category to Donate']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Donate Item') !!} {!! add_help('The item that will be donated to the boss.') !!}
            {!! Form::select('attack_methods_info[donate_item_item]', $items, null, ['class' => 'form-control', 'placeholder' => 'Item to Donate']) !!}
        </div>
    </div>
</div>