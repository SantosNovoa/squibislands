<tr>
    <td>
        {!! Form::text('options[' . $type . '][' . $index . '][name]', $option->name ?? null, ['class' => 'form-control form-control-sm', 'placeholder' => 'e.g. Mystery Custom']) !!}
    </td>
    <td>
        {!! Form::number('options[' . $type . '][' . $index . '][price]', $option->price ?? null, ['class' => 'form-control form-control-sm', 'min' => 0, 'step' => '0.01']) !!}
    </td>
    <td>
        {!! Form::select('options[' . $type . '][' . $index . '][currency_id]', $currencies, $option->currency_id ?? null, ['class' => 'form-control form-control-sm']) !!}
    </td>
    <td class="text-center align-middle">
        {!! Form::checkbox('options[' . $type . '][' . $index . '][is_active]', 1, $option ? $option->is_active : true) !!}
    </td>
    <td class="text-right">
        <button type="button" class="btn btn-sm btn-danger remove-option" title="Remove option">&times;</button>
    </td>
</tr>
