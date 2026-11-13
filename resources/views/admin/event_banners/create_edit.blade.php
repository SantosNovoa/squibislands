@extends('admin.layout')

@section('admin-title')
    {{ $banner->id ? 'Edit' : 'Create' }} Event Banner
@endsection

@section('admin-content')
    {!! breadcrumbs([
        'Admin Panel' => 'admin',
        'Event Banners' => 'admin/event-banners',
        ($banner->id ? 'Edit' : 'Create') . ' Banner' => $banner->id ? 'admin/event-banners/edit/' . $banner->id : 'admin/event-banners/create',
    ]) !!}

    <h1>{{ $banner->id ? 'Edit' : 'Create' }} Event Banner</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ $banner->id ? url('admin/event-banners/edit/' . $banner->id) : url('admin/event-banners/create') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Event Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $banner->name) }}" required>
        </div>

        <div class="form-group">
            <label for="image">Banner Image {!! $banner->id ? '<span class="text-muted small">(leave empty to keep the current image)</span>' : '' !!}</label>
            @if ($banner->imageUrl)
                <div class="mb-2">
                    <img src="{{ $banner->imageUrl }}" alt="{{ $banner->name }}" class="img-fluid rounded" style="max-height: 200px;">
                </div>
            @endif
            <input type="file" class="form-control-file" id="image" name="image" accept=".png,.jpg,.jpeg,.gif,.webp" {{ $banner->id ? '' : 'required' }}>
            <small class="form-text text-muted">PNG, JPG, GIF or WEBP, up to 4MB. Wide images work best, around 1200×360 (10:3). The image is cropped to fill the banner.</small>
        </div>

        <div class="form-group">
            <label for="link">Link (optional)</label>
            <input type="text" class="form-control" id="link" name="link" value="{{ old('link', $banner->link) }}" placeholder="e.g. prompts/prompts or https://toyhou.se/...">
            <small class="form-text text-muted">Clicking the banner goes here. Site paths (no leading domain) or full URLs both work.</small>
        </div>

        <div class="form-group">
            <label for="sort">Sort</label>
            <input type="number" min="0" class="form-control" id="sort" name="sort" value="{{ old('sort', $banner->sort ?? 0) }}" style="max-width: 120px;">
            <small class="form-text text-muted">Higher numbers show first in the carousel.</small>
        </div>

        <h3>Options</h3>

        @php
            // After a failed validation, an unchecked toggle isn't in the old input at all,
            // so only fall back to the saved value when there's no old input.
            $showName = session()->hasOldInput() ? old('show_name') : $banner->show_name;
            $isActive = session()->hasOldInput() ? old('is_active') : $banner->is_active;
        @endphp

        <div class="row">
            <div class="col-md-6 form-group">
                <input type="checkbox" class="form-check-input" id="show_name" name="show_name" value="1" data-toggle="toggle" {{ $showName ? 'checked' : '' }}>
                <label class="form-check-label ml-3" for="show_name">Show Event Name</label>
                {!! add_help('Shows the event name over the banner image. Turn off if the name is already part of the artwork.') !!}
            </div>
            <div class="col-md-6 form-group">
                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" data-toggle="toggle" {{ $isActive ? 'checked' : '' }}>
                <label class="form-check-label ml-3" for="is_active">Set Active</label>
                {!! add_help('Inactive banners stay saved but don\'t appear on the dashboard.') !!}
            </div>
        </div>

        <div class="text-right">
            <button type="submit" class="btn btn-primary">{{ $banner->id ? 'Save' : 'Create' }}</button>
        </div>
    </form>

    @if ($banner->id)
        <hr>
        <form method="POST" action="{{ url('admin/event-banners/delete/' . $banner->id) }}" onsubmit="return confirm('Delete this banner? This also removes its image.');" class="text-right">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm">Delete Banner</button>
        </form>
    @endif
@endsection