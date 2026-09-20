<<<<<<< HEAD
@if ($request->user_id == Auth::user()->id)
    @if ($request->status == 'Draft')
        <p>This will delete the request and return all attached items/currency to you. </p>
        <p>Are you sure you want to delete this request?</p>
        {!! Form::open(['url' => 'designs/' . $request->id . '/delete', 'class' => 'text-right']) !!}
        {!! Form::submit('Delete Request', ['class' => 'btn btn-danger']) !!}
=======
@if($request->user_id == Auth::user()->id)
    @if($request->status == 'Draft')
        <p>This will delete the request and return all attached items/currency to you. </p>
        <p>Are you sure you want to delete this request?</p>
        {!! Form::open(['url' => 'designs/'.$request->id.'/delete', 'class' => 'text-right']) !!}
            {!! Form::submit('Delete Request', ['class' => 'btn btn-danger']) !!}
>>>>>>> Cylunny/extension/polls-and-forms
        {!! Form::close() !!}
    @else
        <p class="text-danger">This request has already been submitted to the queue and cannot be deleted.</p>
    @endif
<<<<<<< HEAD
@else
    <div>You cannot delete this request.</div>
@endif
=======
@else 
    <div>You cannot delete this request.</div>
@endif
>>>>>>> Cylunny/extension/polls-and-forms
