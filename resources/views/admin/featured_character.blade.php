@extends('admin.layout')

@section('admin-title') Featured Character @endsection

@section('admin-content')
{!! breadcrumbs(['Admin Panel' => 'admin', 'Featured Character' => 'admin/featured-character']) !!}

<h1>Featured Character</h1>

<div class="card mb-4">
    <div class="card-header">
        <h3>Current Featured Character</h3>
    </div>
    <div class="card-body">
        @if($character)
            <div class="row">
                <div class="col-md-3">
                    <img src="{{ $character->image->thumbnailUrl }}" class="img-fluid" />
                </div>
                <div class="col-md-9">
                    <h4>{{ $character->fullName }}</h4>
                    <p><strong>Owner:</strong> {!! $character->displayOwner !!}</p>
                    <p><strong>Character Code:</strong> {{ $character->slug }}</p>
                </div>
            </div>
        @else
            <p>No featured character set.</p>
        @endif
        
        {!! Form::open(['url' => 'admin/featured-character/change', 'class' => 'mt-3']) !!}
            {!! Form::submit('Change to Random Character', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3>Set Specific Character</h3>
    </div>
    <div class="card-body">
        {!! Form::open(['url' => 'admin/featured-character/set']) !!}
            <div class="form-group">
                {!! Form::label('character_id', 'Select Character') !!}
                {!! Form::select('character_id', $characters, $character ? $character->id : null, ['class' => 'form-control selectize', 'placeholder' => 'Choose a character...']) !!}
            </div>
            {!! Form::submit('Set Featured Character', ['class' => 'btn btn-success']) !!}
        {!! Form::close() !!}
    </div>
</div>

@endsection

@section('scripts')
@parent
<script>
$(document).ready(function() {
    $('.selectize').selectize();
});
</script>
@endsection