{!! Form::open(['url' => 'admin/data/expeditions/delete/'.$expedition->id]) !!}
<p>You are about to delete the expedition <strong>{{ $expedition->name }}</strong>. This is not reversible. If any users have unclaimed trips on this expedition, deletion will be blocked.</p>
<div class="text-right">
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
</div>
{!! Form::close() !!}