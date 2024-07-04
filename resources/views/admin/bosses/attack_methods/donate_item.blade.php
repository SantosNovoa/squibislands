@php
    $data = $boss->getAttackMethodInformation('donate_item');
    $items = ['any' => 'Any Item'] + \App\Models\Item\Item::pluck('name', 'id')->toArray();
    $itemCategories = \App\Models\Item\ItemCategory::pluck('name', 'id')->toArray();

    $rarities = \App\Models\Rarity::all();
@endphp

<div class="card mb-3">
    <div class="card-header h4">Donate Item to Boss Attack Method</div>
    <div class="card-body">
        <div class="form-group">
            {!! Form::label('Donate Category') !!}
            {!! Form::select('attack_methods_info[donate_item][item_category_ids][]', $itemCategories, $data['item_category_ids'] ?? null, ['class' => 'form-control method-selectize', 'placeholder' => 'Category to Donate', 'multiple']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Donate Item') !!} {!! add_help('The item that will be donated to the boss.') !!}
            {!! Form::select('attack_methods_info[donate_item][item_ids][]', $items, $data['item_ids'] ?? null, ['class' => 'form-control method-selectize', 'placeholder' => 'Item to Donate', 'multiple']) !!}
        </div>

        {{-- no rarity damage --}}
        <div class="form-group">
            {!! Form::label('Damage Per Item With No Rarity') !!}
            {!! Form::number('attack_methods_info[donate_item][damage_per_item][no_rarity]', $data['damage_per_item']['no_rarity'] ?? 1, ['class' => 'form-control', 'placeholder' => 'Damage Per Item of No Rarity', 'min' => 1]) !!}
        </div>

        @foreach ($rarities as $rarity)
            <div class="form-group">
                {!! Form::label('Damage Per Item of Rarity ') !!} {!! $rarity->displayName !!}
                {!! Form::number('attack_methods_info[donate_item][damage_per_item][' . $rarity->id . ']', $data['damage_per_item'][$rarity->id] ?? 1, ['class' => 'form-control', 'placeholder' => 'Damage Per Item of Rarity ' . $rarity->name, 'min' => 1]) !!}
            </div>
        @endforeach
    </div>
</div>
