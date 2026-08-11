@extends('admin.layout')
@section('admin-title') Expedition @endsection
@section('admin-content')
{!! breadcrumbs(['Admin Panel' => 'admin', 'Expeditions' => 'admin/data/expeditions', ($expedition->id ? 'Edit ' : 'Create ').'Expedition' => $expedition->id ? 'admin/data/expeditions/edit/'.$expedition->id : 'admin/data/expeditions/create']) !!}
<h1>{{ $expedition->id ? 'Edit' : 'Create' }} Expedition
    @if($expedition->id)
    ({{ $expedition->name }})
    <a href="#" class="btn btn-danger float-right delete-expedition-button">Delete Expedition</a>
    @endif
</h1>
{!! Form::open(['url' => $expedition->id ? 'admin/data/expeditions/edit/'.$expedition->id : 'admin/data/expeditions/create', 'files' => true]) !!}
<h3>Basic Information</h3>
<div class="row">
    <div class="form-group col">
        {!! Form::label('Name') !!}
        {!! Form::text('name', $expedition->name, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col">
        {!! Form::label('difficulty', 'Difficulty') !!}
        {!! Form::select('difficulty', ['Easy' => 'Easy', 'Medium' => 'Medium', 'Hard' => 'Hard', 'Extreme' => 'Extreme'], $expedition->difficulty, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('Description (Optional)') !!}
    {!! Form::textarea('description', $expedition->description, ['class' => 'form-control wysiwyg']) !!}
</div>
<div class="row">
    <div class="form-group col">
        {!! Form::label('duration_hours', 'Duration (Hours)') !!}
        {!! Form::text('duration_hours', $expedition->duration_hours, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col">
        {!! Form::label('success_rate', 'Success Rate per Character (%)') !!} {!! add_help('The chance of success added per character sent. E.g. 9 characters at 5% each = 45% total chance, capped at 100%.') !!}
        {!! Form::text('success_rate', $expedition->success_rate, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col">
        {!! Form::label('max_characters', 'Max Characters') !!}
        {!! Form::text('max_characters', $expedition->max_characters, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::checkbox('is_active', 1, $expedition->id ? $expedition->is_active : 1, ['class' => 'form-check-input', 'data-toggle' => 'toggle']) !!}
    {!! Form::label('is_active', 'Set Active', ['class' => 'form-check-label ml-3']) !!} {!! add_help('If turned off, the expedition will not be visible to regular users.') !!}
</div>

<hr>

<h3>Image</h3>
<div class="form-group">
    {!! Form::label('Expedition Image (Optional)') !!}
    <div>{!! Form::file('image') !!}</div>
    <div class="text-muted">File type: png.</div>
    @if($expedition->has_image)
    <div class="form-check">
        {!! Form::checkbox('remove_image', 1, false, ['class' => 'form-check-input']) !!}
        {!! Form::label('remove_image', 'Remove current image', ['class' => 'form-check-label']) !!}
    </div>
    @endif
</div>

<hr>

<h3>Rewards</h3>
<p>Rewards are only granted if the expedition succeeds. If you want an element of chance, linking a loot table here is recommended.</p>
@include('expeditions._loot_select', ['loots' => $expedition->rewards, 'items' => $items, 'currencies' => $currencies, 'tables' => $tables, 'showLootTables' => true])

<div class="text-right">
    {!! Form::submit($expedition->id ? 'Edit' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
{!! Form::close() !!}
@include('dailies._loot_select_row', ['items' => $items, 'currencies' => $currencies, 'tables' => $tables, 'showLootTables' => true, 'showRaffles' => false])
@endsection
@section('scripts')
@parent
@include('js._loot_js', ['showLootTables' => true, 'showRaffles' => false, 'showRecipes' => false])
<script>
$(document).ready(function() {
    $('.delete-expedition-button').on('click', function(e) {
        e.preventDefault();
        loadModal("{{ url('admin/data/expeditions/delete') }}/{{ $expedition->id }}", 'Delete Expedition');
    });
});
</script>
@endsection