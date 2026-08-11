@extends('admin.layout')

@section('admin-title')
    Themes
@endsection

@section('admin-content')
    {!! breadcrumbs(['Admin Panel' => 'admin', 'Themes' => 'admin/theme']) !!}

    <h1>Themes</h1>

    <p>You can create new Themes here for your users to be able to select from to view the site. </p>

    <div class="text-right mb-3"><a class="btn btn-primary" href="{{ url('admin/themes/create') }}"><i class="fas fa-plus"></i> Create New Theme</a></div>
    @if (!count($themes))
        <p>No themes found.</p>
    @else
        {!! $themes->render() !!}

        <div class="mb-4 logs-table">
            <div class="logs-table-header">
                <div class="row">
                    <div class="col-5 col-md-5">
                        <div class="logs-table-cell">Name</div>
                    </div>
                    <div class="col-5 col-md-5">
                        <div class="logs-table-cell">Creators</div>
                    </div>
                    <div class="col-2 col-md-2">
                        <div class="logs-table-cell">&nbsp;</div>
                    </div>
                </div>
            </div>
            <div class="logs-table-body">
                @foreach ($themes as $theme)
                    <div class="logs-table-row">
                        <div class="row flex-wrap">
                            <div class="col-5 col-md-5">
                                <div class="logs-table-cell">
                                    {!! $theme->is_default ? '<i class="fas fa-star mr-2" data-toggle="tooltip" title="This is the default theme."></i>' : '' !!}{!! $theme->is_active ? '' : '<i class="fas fa-eye-slash mr-2"></i>' !!}{{ $theme->name }}
                                    {!! $theme->userCount ? '<small class="text-muted">In use by ' . $theme->userCount . ' user' . ($theme->userCount == 1 ? '' : 's') . '</small>' : '<small class="text-muted">Not in use</small>' !!}
                                </div>
                            </div>
                            <div class="col-5 col-md-5">
                                <div class="logs-table-cell">
                                    {!! $theme->creators ? $theme->creatorDisplayName : 'N/A' !!}
                                </div>
                            </div>
                            <div class="col-2 col-md-2">
                                <div class="logs-table-cell d-flex justify-content-end">
                                    <a href="{{ url('admin/themes/edit/' . $theme->id) }}" class="btn btn-primary py-0 px-2">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {!! $themes->render() !!}
    @endif

@endsection
