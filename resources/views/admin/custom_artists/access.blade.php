@extends('admin.layout')

@section('admin-title')
    Custom Artist Access
@endsection

@section('admin-content')
    {!! breadcrumbs(['Admin Panel' => 'admin', 'Custom Artist Access' => 'admin/custom-artists']) !!}

    <h1>Custom Artist Access</h1>

    <p>
        Ranks with the <strong>Manage Custom Artist Profile</strong> power can always post an entry on the
        <a href="{{ url('info/official_customs') }}">Official Customs</a> page. Set that on each rank's edit page.
    </p>
    <p>
        Use this list for specific staff members whose rank doesn't have that power. They need a staff rank to reach the admin panel.
        Removing someone here hides their entry but keeps it saved.
    </p>

    <div class="card mb-4">
        <div class="card-body">
            {!! Form::open(['url' => 'admin/custom-artists/grant', 'class' => 'd-flex']) !!}
            <div class="flex-grow-1 mr-2">
                {!! Form::select('user_id', $users, null, ['class' => 'form-control', 'id' => 'userSelect', 'placeholder' => 'Select a staff member']) !!}
            </div>
            {!! Form::submit('Grant Access', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>

    @if (!$accesses->count())
        <p>No individual users have been granted access.</p>
    @else
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Rank</th>
                    <th>Granted By</th>
                    <th>Granted</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($accesses as $access)
                    <tr>
                        <td>{!! $access->user ? $access->user->displayName : 'Deleted user #' . $access->user_id !!}</td>
                        <td>{{ $access->user && $access->user->rank ? $access->user->rank->name : '' }}</td>
                        <td>{!! $access->grantedBy ? $access->grantedBy->displayName : '' !!}</td>
                        <td>{!! pretty_date($access->created_at) !!}</td>
                        <td class="text-right">
                            {!! Form::open(['url' => 'admin/custom-artists/revoke/' . $access->id]) !!}
                            {!! Form::submit('Remove', ['class' => 'btn btn-sm btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection

@section('scripts')
    @parent
    <script>
        $(function() {
            $('#userSelect').selectize();
        });
    </script>
@endsection
