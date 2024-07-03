@php
    $currencies = ['any' => 'Any Currency'] + \App\Models\Currency\Currency::pluck('name', 'id')->toArray();
    
    $data = $boss->getAttackMethodInformation('earned_currency');
@endphp

<div class="card mb-3">
    <div class="card-header h4">Earned Currency Attack Method</div>
    <div class="card-body">
        <p>Currency can be earned from any number of sources, such as prompts, donations, or other methods.</p>
        <p>Transfers do not, of course, count as earning currency.</p>
        <p>Damage is based on currency earned.</p>
        <div class="form-group">
            {!! Form::label('Currency') !!}
            {!! Form::select('attack_methods_info[earned_currency][currency_id]', $currencies, $data['currency_id'] ?? null, ['class' => 'form-control', 'placeholder' => 'Designated Currency']) !!}
        </div>
    </div>
</div>
