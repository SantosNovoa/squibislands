@extends('admin.layout')

@section('admin-title')
    Event Banners
@endsection

@section('admin-content')
    {!! breadcrumbs(['Admin Panel' => 'admin', 'Event Banners' => 'admin/event-banners']) !!}

    <h1>Event Banners</h1>

    <p>
        Banners shown at the top of the dashboard. With one active banner it shows as a static image;
        with two or more it becomes a carousel with arrows. Higher sort numbers show first.
    </p>

    <div class="card mb-4">
        <div class="card-body d-flex flex-wrap align-items-center justify-content-between">
            <div class="mb-2 mb-md-0">
                <strong>Dashboard banner:</strong>
                @if ($enabled)
                    <span class="badge badge-success">Shown</span>
                @else
                    <span class="badge badge-secondary">Hidden</span>
                @endif
                <div class="small text-muted">
                    This hides the whole banner area without changing individual banners.
                </div>
            </div>
            <form method="POST" action="{{ url('admin/event-banners/toggle') }}">
                @csrf
                <button type="submit" class="btn {{ $enabled ? 'btn-outline-danger' : 'btn-success' }}">
                    {{ $enabled ? 'Hide banner' : 'Show banner' }}
                </button>
            </form>
        </div>
    </div>

    <h3>Dashboard Shortcuts</h3>
    <div class="card mb-4">
        <div class="card-body">
            <p class="mb-3">
                The icon shortcuts beside Recent News. Turn off any you don't want shown.
                If every shortcut is off, Recent News takes the full width. Icons are changed in
                <a href="{{ url('admin/images') }}">Site Images</a>.
            </p>
            <form method="POST" action="{{ url('admin/event-banners/shortcuts') }}">
                @csrf
                <div class="d-flex flex-wrap mb-3">
                    @foreach ($shortcuts as $key => $shortcut)
                        <div class="form-check mr-4 mb-2">
                            <input type="checkbox" class="form-check-input" name="shortcuts[{{ $key }}]" value="1" id="shortcut-{{ $key }}" {{ $shortcut['is_active'] ? 'checked' : '' }}>
                            <label class="form-check-label" for="shortcut-{{ $key }}">
                                <i class="{{ $shortcut['icon'] }} mr-1"></i> {{ $shortcut['label'] }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary">Save shortcuts</button>
            </form>
        </div>
    </div>

    <h3>Banners</h3>
    <div class="text-right mb-3">
        <a class="btn btn-primary" href="{{ url('admin/event-banners/create') }}"><i class="fas fa-plus"></i> Create Banner</a>
    </div>

    @if (!$banners->count())
        <p>No event banners yet.</p>
    @else
        <div class="table-responsive">
            <table class="table table-sm align-middle">
                <thead>
                    <tr>
                        <th style="width: 180px;">Image</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Sort</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($banners as $banner)
                        <tr>
                            <td>
                                @if ($banner->imageUrl)
                                    <img src="{{ $banner->imageUrl }}" alt="{{ $banner->name }}" class="img-fluid rounded" style="max-height: 60px;">
                                @else
                                    <span class="text-muted small">No image</span>
                                @endif
                            </td>
                            <td>
                                {{ $banner->name }}
                                @if ($banner->link)
                                    <div class="small text-muted"><i class="fas fa-link"></i> {{ $banner->link }}</div>
                                @endif
                            </td>
                            <td>
                                @if ($banner->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $banner->sort }}</td>
                            <td class="text-right">
                                <a href="{{ url('admin/event-banners/edit/' . $banner->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
