@extends('admin.layout')

@section('admin-title')
    {{ $boss->id ? 'Edit' : 'Create' }} Boss
@endsection

@section('admin-content')
    {!! breadcrumbs(['Admin Panel' => 'admin', 'Bosses' => 'admin/data/bosses', ($boss->id ? 'Edit' : 'Create') . ' Boss' => $boss->id ? 'admin/data/bosses/edit/' . $boss->id : 'admin/data/bosses/create']) !!}

    <h1>{{ $boss->id ? 'Edit' : 'Create' }} Boss
        @if ($boss->id)
            <a href="#" class="btn btn-outline-danger float-right delete-boss-button">Delete Boss</a>
        @endif
    </h1>

    {!! Form::open(['url' => $boss->id ? 'admin/data/bosses/edit/' . $boss->id : 'admin/data/bosses/create', 'files' => true]) !!}

    <h3>Basic Information</h3>

    <div class="form-group">
        {!! Form::label('Name') !!}
        {!! Form::text('name', $boss->name, ['class' => 'form-control']) !!}
    </div>

    <div class="row">
        <div class="col-md-6 form-group">
            @if ($boss->has_image)
                <img src="{{ $boss->imageUrl }}" class="img-thumbnail mb-2" style="max-width: 100px; max-height: 100px;">
            @endif
            {!! Form::label('World Page Image (Optional)') !!} {!! add_help('This image is used only on the world information pages.') !!}
            <div>{!! Form::file('image') !!}</div>
            <p class="mb-0">The world page image is the image that will be used for 100% HP & for encyclopedic purposes.</p>
            <div class="text-muted">Recommended size: 100px x 100px</div>
            @if ($boss->has_image)
                <div class="form-check">
                    {!! Form::checkbox('remove_image', 1, false, ['class' => 'form-check-input']) !!}
                    {!! Form::label('remove_image', 'Remove current image', ['class' => 'form-check-label']) !!}
                </div>
            @endif
        </div>
        <div class="col-md-6">
            <div class="row mb-3">
                {!! Form::label('Stage Images (Optional)') !!} {!! add_help('These images are used to show the boss at different stages of health.') !!}
                <div class="text-info">
                    To change an image's health percent, you'll need to delete it and add it again.
                </div>
                <div class="btn btn-primary add-stage-image ml-auto mr-3">Add Stage Image</div>
            </div>
            <div class="stage-images">
                @foreach ($boss->getStageImages() as $key => $stageImage)
                    <div class="form-group d-flex">
                        <img src="{{ $stageImage['image'] }}" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
                        {!! Form::hidden('old_stage_images[' . $key . ']', $stageImage['image']) !!}
                        <div class="form-control my-auto mx-2 text-center">
                            {{ $key }}
                        </div>
                        <div class="btn btn-danger remove-stage-image my-auto ml-2">Remove</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row col-12">
        <div class="col form-group">
            {!! Form::label('Total Health') !!} {!! add_help('This is the total health of the boss.') !!}
            {!! Form::number('total_health', $boss->total_health, ['class' => 'form-control', 'placeholder' => 'Total Health']) !!}
        </div>
        @if ($boss->id)
            <div class="col form-group">
                {!! Form::label('Current Health') !!} {!! add_help('This is the current health of the boss.') !!}
                {!! Form::number('current_health', $boss->current_health, ['class' => 'form-control', 'placeholder' => 'Current Health']) !!}
            </div>
        @endif
        <div class="col form-group">
            {!! Form::label('Type') !!} {!! add_help('This is the type of boss.') !!}
            {!! Form::select('type', ['User' => 'Per-User', 'Global' => 'Global'], $boss->type ?? 'Global', ['class' => 'form-control method-selectize']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('Description (Optional)') !!}
        {!! Form::textarea('description', $boss->description, ['class' => 'form-control wysiwyg']) !!}
    </div>

    <div class="row">
        <div class="col-md-6 form-group">
            {!! Form::label('start_at', 'Start Time (Optional)') !!} {!! add_help('Prompts cannot be submitted to the queue before the starting time.') !!}
            {!! Form::text('start_at', $boss->start_at, ['class' => 'form-control datepicker']) !!}
        </div>
        <div class="col-md-6 form-group">
            {!! Form::label('end_at', 'End Time (Optional)') !!} {!! add_help('Prompts cannot be submitted to the queue after the ending time.') !!}
            {!! Form::text('end_at', $boss->end_at, ['class' => 'form-control datepicker']) !!}
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 form-group">
            {!! Form::checkbox('is_active', 1, $boss->id ? $boss->is_active : 1, ['class' => 'form-check-input', 'data-toggle' => 'toggle']) !!}
            {!! Form::label('is_active', 'Is Active', ['class' => 'form-check-label ml-3']) !!}
        </div>
        <div class="col-md-3 form-group">
            {!! Form::checkbox('is_staff_only', 1, $boss->id ? $boss->is_staff_only : 0, ['class' => 'form-check-input', 'data-toggle' => 'toggle']) !!}
            {!! Form::label('is_staff_only', 'Is Staff Only', ['class' => 'form-check-label ml-3']) !!}
        </div>
        <div class="col-md-3 form-group">
            {!! Form::checkbox('can_attack_after_defeat', 1, $boss->can_attack_after_defeat, ['class' => 'form-check-input', 'data-toggle' => 'toggle']) !!}
            {!! Form::label('can_attack_after_defeat', 'Can Attack After Defeat', ['class' => 'form-check-label ml-3']) !!} {!! add_help('If this is checked, users can attack the boss after it has been defeated.') !!}
        </div>
        <div class="col-md-3 form-group">
            {!! Form::checkbox('is_rewards_only_for_participants', 1, $boss->is_rewards_only_for_participants, ['class' => 'form-check-input', 'data-toggle' => 'toggle']) !!}
            {!! Form::label('is_rewards_only_for_participants', 'Rewards Only for Participants', ['class' => 'form-check-label ml-3']) !!} {!! add_help('If this is checked, only users who have attacked the boss will receive rewards.') !!}
        </div>
    </div>

    <hr />

    <h3>Rewards</h3>
    <p>Rewards are credited on a per-user basis. Mods are able to modify the specific rewards granted at approval time.</p>
    <p>You can add loot tables containing any kind of currencies (both user- and character-attached), but be sure to keep track of which are being distributed! Character-only currencies cannot be given to users.</p>
    @include('widgets._boss_loot_select', ['loots' => $boss->rewards, 'showLootTables' => true, 'showRaffles' => true])

    <hr />
    @if ($boss->id)
        <h3>Boss Attack Methods</h3>
        <p>Here you can set the methods that can be used to attack the boss. If no methods are selected, the boss will be unattackable.</p>
        <div class="form-group">
            {!! Form::label('Attack Methods') !!}
            {!! Form::select('attack_methods[]', $attackMethods, isset($boss->attack_methods['methods']) ? $boss->attack_methods['methods'] : null, ['class' => 'form-control method-selectize', 'multiple']) !!}
        </div>

        @if ($boss->attack_methods && isset($boss->attack_methods['methods']))
            @foreach ($boss->attack_methods['methods'] as $method)
                @include('admin.bosses.attack_methods.' . $method)
            @endforeach
        @endif
    @else
        <div class="alert alert-info">
            You can add attack methods after creating the boss.
        </div>
    @endif

    <div class="text-right">
        {!! Form::submit($boss->id ? 'Edit' : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}

    @if ($boss->id)
        <h3>Preview</h3>
        <div class="card mb-3">
            <div class="card-body">
                @include('world._boss_entry', ['imageUrl' => $boss->imageUrl, 'name' => $boss->displayName, 'description' => $boss->parsed_description, 'searchUrl' => $boss->searchUrl, 'boss' => $boss])
            </div>
        </div>
    @endif

    @include('widgets._boss_loot_select_row', ['showLootTables' => true, 'showRaffles' => true])

    <div class="stage-image-row hide">
        <div class="form-group d-flex">
            {!! Form::file('stage_images[]') !!}
            {!! Form::number('stage_image_health[]', null, ['class' => 'form-control mx-2 col-6', 'placeholder' => 'Health %', 'max' => 100, 'min' => 0]) !!}
            <div class="btn btn-danger remove-stage-image">Remove</div>
        </div>
    </div>

@endsection

@section('scripts')
    @parent
    @include('js._boss_loot_js', ['showLootTables' => true, 'showRaffles' => true])
    @include('widgets._datetimepicker_js')
    <script>
        $(document).ready(function() {
            $('.method-selectize').selectize();

            $('.delete-boss-button').on('click', function(e) {
                e.preventDefault();
                loadModal("{{ url('admin/data/bosses/delete') }}/{{ $boss->id }}", 'Delete Boss');
            });

            // attach remove listener to existing stage images
            $('.remove-stage-image').each(function() {
                attachRemoveListener($(this));
            });

            $('.add-stage-image').on('click', function() {
                let stageImageRow = $('.stage-image-row').clone();
                stageImageRow.removeClass('hide');
                stageImageRow.removeClass('stage-image-row');
                $('.stage-images').append(stageImageRow);
                attachRemoveListener(stageImageRow.find('.remove-stage-image'));
            });

            function attachRemoveListener(node) {
                node.on('click', function(e) {
                    e.preventDefault();
                    $(this).parent().remove();
                });
            }
        });
    </script>
@endsection
