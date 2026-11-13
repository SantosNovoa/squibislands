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
