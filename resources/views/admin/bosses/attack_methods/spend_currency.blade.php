@php
    $currencies = ['any' => 'Any Currency'] + \App\Models\Currency\Currency::pluck('name', 'id')->toArray();
@endphp

<div class="card mb-3">
    <div class="card-header h4">Spend Currency Attack Method</div>
    <div class="card-body">
        <div class="form-group">
            {!! Form::label('Currency') !!}
            {!! Form::select('attack_methods_info[spend_currency_currency]', $currencies, null, ['class' => 'form-control', 'placeholder' => 'Designated Currency']) !!}
        </div>
    </div>
</div>
