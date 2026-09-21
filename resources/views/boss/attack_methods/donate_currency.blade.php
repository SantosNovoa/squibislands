@php
    $data = $boss->getAttackMethodInformation('donate_currency');
    if (isset($data['currency_ids'])) {
        $donateableCurrencies = in_array('any', $data['currency_ids'])
            ? \App\Models\Currency\Currency::pluck('name', 'id')->toArray()
            : \App\Models\Currency\Currency::whereIn('id', $data['currency_ids'])
                ->pluck('name', 'id')
                ->toArray();
    } else {
        $donateableCurrencies = [];
    }
@endphp

@if (!$boss->getAttackMethodInformation('donate_currency'))
    <div class="alert alert-danger">Attack method not available.</div>
@else
    {!! Form::open(['url' => 'boss/' . $boss->id . '/attack/' . $attackMethod]) !!}
    <p class="mb-0" id="damage-ratio"></p>

    <div class="row">
        <div class="col-md-6 form-group">
            {!! Form::label('Currency') !!}
            {!! Form::select('currency_id', $donateableCurrencies, null, ['class' => 'form-control currency', 'placeholder' => 'Choose Currency']) !!}
        </div>
        <div class="col-md-6 form-group">
            {!! Form::label('Quantity') !!}
            {!! Form::number('currency_quantity', 1, ['class' => 'form-control quantity', 'min' => 1]) !!}
        </div>
    </div>

    <p class="damage-ratio"></p>

    <div class="text-center">
        {!! Form::submit('Attack', ['class' => 'btn btn-primary btn-block btn-sm']) !!}
    </div>
    {!! Form::close() !!}
@endif

<script>
    let ratios = {!! json_encode($data['damage_ratio'] ?? []) !!};

    $(document).ready(function() {
        $('.currency').change(function() {
            let currencyId = $(this).val();
            let ratio = findRatio(ratios[currencyId]);
            $('#damage-ratio').text(`For every ${ratio[0]} currency donated, ${ratio[1]} damage will be done to the boss`);
        });
    });

    function findRatio(ratio) {
        let numerator = ratio * 100;
        let denominator = 100;
        let divisor = gcd(numerator, denominator);

        numerator /= divisor;
        denominator /= divisor;

        return [numerator, denominator];
    }

    function gcd(a, b) {
        // return $b ? $this->gcd($b, $a % $b) : $a;
        return b ? gcd(b, a % b) : a;
    }
</script>
