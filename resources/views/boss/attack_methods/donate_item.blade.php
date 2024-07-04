@php
    $data = $boss->getAttackMethodInformation('donate_item');
    // any means all items pretty much
    $donateableItems = in_array('any', $data['item_ids']) ? \App\Models\Item\Item::all() : (isset($data['item_category_ids']) ? \App\Models\Item\Item::whereIn('item_category_id', $data['item_category_ids'])->whereIn('id', $data['item_ids'] ?? []) : \App\Models\Item\Item::with('rarity')->whereIn('id', $data['item_ids'] ?? []));
    $donateableItems = $donateableItems
        ->get()
        ->groupBy(function ($item) {
            return $item->rarity?->name ?? 'No Rarity';
        })
        ->map(function ($group) {
            return $group->pluck('name', 'id')->toArray();
        })
        ->toArray();
    $rarities = \App\Models\Rarity::all();
@endphp

@if (!$boss->getAttackMethodInformation('donate_item'))
    <div class="alert alert-danger">Attack method not available.</div>
@else
    {!! Form::open(['url' => 'boss/' . $boss->id . '/attack/' . $attackMethod]) !!}

    <div class="text-center">
        <a class="btn btn-primary mb-2" data-toggle="collapse" href="#rarity-info" role="button" aria-expanded="false" aria-controls="rarity-info">
            Damage Information
        </a>
    </div>

    <div class="collapse" id="rarity-info">
        <div class="card card-body mb-2">
            <span>Items with no rarity will do {{ $data['damage_per_item']['no_rarity'] }} damage per item donated.</span>
            @foreach ($rarities as $rarity)
                <span>{!! $rarity->displayName !!} items will do {{ isset($data['damage_per_item'][$rarity->id]) ? $data['damage_per_item'][$rarity->id] : $data['damage_per_item']['no_rarity'] }} damage per item donated.</span>
            @endforeach
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 form-group">
            {!! Form::label('Item') !!}
            {!! Form::select('item_id', $donateableItems, null, ['class' => 'form-control', 'placeholder' => 'Choose Item']) !!}
        </div>
        <div class="col-md-6 form-group">
            {!! Form::label('Quantity') !!}
            {!! Form::number('item_quantity', 1, ['class' => 'form-control quantity', 'min' => 1]) !!}
        </div>
    </div>

    <p class="damage-ratio"></p>

    <div class="text-center">
        {!! Form::submit('Attack', ['class' => 'btn btn-primary btn-block btn-sm']) !!}
    </div>
    {!! Form::close() !!}
@endif
