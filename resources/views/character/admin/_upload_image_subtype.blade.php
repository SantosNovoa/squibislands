{!! Form::label('Subtype (Optional)') !!}
<<<<<<< HEAD
{!! Form::select('subtype_id', $subtypes, old('subtype_id') ?: $subtype, ['class' => 'form-control', 'id' => 'subtype']) !!}
=======
{!! Form::select('subtype_id', $subtypes, old('subtype_id') ? : $subtype, ['class' => 'form-control', 'id' => 'subtype']) !!}
>>>>>>> Cylunny/extension/polls-and-forms
