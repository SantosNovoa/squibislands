<<<<<<< HEAD
{!! Form::label(ucfirst(__('lorekeeper.subtype')) . ' (Optional)') !!}
=======
{!! Form::label('Subtype (Optional)') !!}
>>>>>>> Cylunny/extension/polls-and-forms
{!! Form::select('subtype_id', $subtypes, $image->subtype_id, ['class' => 'form-control', 'id' => 'subtype']) !!}
