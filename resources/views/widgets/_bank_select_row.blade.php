<div id="bankRowData" class="hide">
    <table class="table table-sm">
<<<<<<< HEAD
        @foreach ($owners as $owner)
            @if ($owner)
                <tbody id="{{ strtolower($owner->logType) }}Row-{{ $owner->id }}">
                    <tr class="bank-row">
                        <td>{!! Form::select('currency_id[' . strtolower($owner->logType) . '-' . $owner->id . '][]', $owner->getCurrencySelect(isset($isTransferrable) ? $isTransferrable : false), null, [
                            'class' => 'form-control selectize',
                            'placeholder' => 'Select Currency    ',
                        ]) !!}</td>
                        <td>{!! Form::text('currency_quantity[' . strtolower($owner->logType) . '-' . $owner->id . '][]', 0, ['class' => 'form-control']) !!}</td>
=======
        @foreach($owners as $owner)
            @if($owner)
                <tbody id="{{ strtolower($owner->logType) }}Row-{{ $owner->id }}">
                    <tr class="bank-row">
                        <td>{!! Form::select('currency_id['.strtolower($owner->logType).'-'.$owner->id.'][]', $owner->getCurrencySelect(isset($isTransferrable) ? $isTransferrable : false), null, ['class' => 'form-control selectize', 'placeholder' => 'Select Currency    ']) !!}</td>
                        <td>{!! Form::text('currency_quantity['.strtolower($owner->logType).'-'.$owner->id.'][]', 0, ['class' => 'form-control']) !!}</td>
>>>>>>> Cylunny/extension/polls-and-forms
                        <td class="text-right"><a href="#" class="btn btn-danger remove-currency-button">Remove</a></td>
                    </tr>
                </tbody>
            @endif
        @endforeach
    </table>
<<<<<<< HEAD
</div>
=======
</div>
>>>>>>> Cylunny/extension/polls-and-forms
