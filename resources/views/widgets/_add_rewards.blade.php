@php
    $rewards = \App\Models\Reward\Reward::hasRewards($object) ? \App\Models\Reward\Reward::getRewards($object) : null;

    // Set this to false to not use a form (for example, if the form is already open outside of this include)
    // Useful for objects that have reward creation as part of their own creation, like prompts
    if (!isset($useForm)) {
        $useForm = true;
    }
    if (!isset($type)) {
        $type = 'Reward';
    }

    // View options
    if (!isset($showRecipient)) {
        $showRecipient = false;
    }
    if (!isset($showRaffles)) {
        $showRaffles = false;
    }
    if (!isset($showLootTables)) {
        $showLootTables = false;
    }
    if (!isset($loots)) {
        $loots = getRewards($object);
    }
@endphp

<div class="card p-4 mb-3 mt-3" id="{{ $prefix ?? '' }}reward-card">
    <h3>{{ $title ?? ucfirst($type) . 's' }}</h3>

    <p>Click "Add {{ ucfirst($type) }}" and select a {{ strtolower($type) }} from the dropdowns below.</p>
    {!! isset($info) ? '<div class="alert alert-info">' . $info . '</div>' : '' !!}

    @if ($useForm)
        {!! Form::open(['url' => 'admin/rewards']) !!}
        {!! Form::hidden('object_model', get_class($object)) !!}
        {!! Form::hidden('object_id', $object->id) !!}

        @include('widgets._reward_loot_select', [
            'prefix' => $prefix ?? '',
            'loots' => $loots,
            'showRecipient' => $showRecipient,
            'showRaffles' => $showRaffles,
            'showLootTables' => $showLootTables,
            'type' => $type,
        ])

        <div>
            @if ($rewards)
                <i class="fas fa-trash text-danger float-right mt-2 mx-2 fa-2x" data-toggle="tooltip" title="To delete rewards, simply remove all existing rewards and click 'Edit Rewards'"></i>
            @endif
            {!! Form::submit(($rewards ? 'Edit' : 'Create') . ' Rewards', ['class' => 'btn btn-primary float-right']) !!}
        </div>

        {!! Form::close() !!}
    @else
        @include('widgets._reward_loot_select', [
            'prefix' => $prefix ?? '',
            'loots' => $loots,
            'showRecipient' => $showRecipient,
            'showRaffles' => $showRaffles,
            'showLootTables' => $showLootTables,
            'type' => $type,
        ])
    @endif
</div>

<fieldset disabled>
    @include('widgets._reward_loot_select_row', [
        'prefix' => $prefix ?? '',
        'showRecipient' => $showRecipient,
        'showRaffles' => $showRaffles,
        'showLootTables' => $showLootTables,
        'type' => $type,
    ])
    @include('js._reward_loot_js', [
        'prefix' => $prefix ?? '',
        'showRaffles' => $showRaffles,
        'showLootTables' => $showLootTables,
    ])
</fieldset>