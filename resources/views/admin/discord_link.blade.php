@extends('admin.layout')

@section('admin-title')
    Discord Link
@endsection

@section('admin-content')
    {!! breadcrumbs(['Admin Panel' => 'admin', 'Discord Link' => 'admin/discord']) !!}

    <h1>Discord Link</h1>
    <p>This is the invite link used by the Discord button in the site navbar. If the invite expires, paste the new one here.</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    {!! Form::open(['url' => 'admin/discord']) !!}
        <div class="form-group">
            {!! Form::label('url', 'Invite URL') !!}
            {!! Form::text('url', old('url', $url), ['class' => 'form-control', 'placeholder' => 'https://discord.gg/...']) !!}
        </div>

        <div class="text-right">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}

    @if ($url)
        <p class="mt-3">Current link: <a href="{{ $url }}" target="_blank" rel="noopener">{{ $url }}</a></p>
    @endif
@endsection