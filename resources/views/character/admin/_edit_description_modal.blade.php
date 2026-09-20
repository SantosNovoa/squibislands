<<<<<<< HEAD
{!! Form::open(['url' => $isMyo ? 'admin/myo/' . $character->id . '/description' : 'admin/character/' . $character->slug . '/description']) !!}
<div class="form-group">
    {!! Form::label('Character Description') !!}
    {!! Form::textarea('description', $character->description, ['class' => 'form-control wysiwyg']) !!}
</div>

<div class="text-right">
    {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
</div>
=======
{!! Form::open(['url' => $isMyo ? 'admin/myo/'.$character->id.'/description' : 'admin/character/'.$character->slug.'/description']) !!}
    <div class="form-group">
        {!! Form::label('Character Description') !!}
        {!! Form::textarea('description', $character->description, ['class' => 'form-control wysiwyg']) !!}
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
