<<<<<<< HEAD
{!! Form::open(['url' => 'admin/character/image/' . $image->id . '/notes']) !!}
<div class="form-group">
    {!! Form::label('Image Notes') !!}
    {!! Form::textarea('description', $image->description, ['class' => 'form-control wysiwyg']) !!}
</div>

<div class="text-right">
    {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
</div>
=======
{!! Form::open(['url' => 'admin/character/image/'.$image->id.'/notes']) !!}
    <div class="form-group">
        {!! Form::label('Image Notes') !!}
        {!! Form::textarea('description', $image->description, ['class' => 'form-control wysiwyg']) !!}
    </div>

    <div class="text-right">
        {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
    </div>
>>>>>>> Cylunny/extension/polls-and-forms
{!! Form::close() !!}

<script>
    $(document).ready(function() {
        @include('js._modal_wysiwyg')
    });
<<<<<<< HEAD
</script>
=======
</script>
>>>>>>> Cylunny/extension/polls-and-forms
