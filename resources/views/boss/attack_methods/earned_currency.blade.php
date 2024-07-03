@if (!$boss->getAttackMethodInformation('earned_currency'))
    <div class="alert alert-danger">Attack method not available.</div>
@else
    @php
        $data = $boss->getAttackMethodInformation('earned_currency');
        $currency = \App\Models\Currency\Currency::find($data['currency_id']);
    @endphp
    <p>
        Earn: {!! $currency->displayName !!}
    </p>
@endif