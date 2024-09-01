@php
    $data = $boss->getAttackMethodInformation('donate_currency');
    $currencies =
        ['any' => 'Any Currency'] +
        \App\Models\Currency\Currency::where('is_user_owned', 1)
            ->pluck('name', 'id')
            ->toArray();
@endphp

<div class="card mb-3">
    <div class="card-header h4">Donate Currency to Boss Attack Method</div>
    <div class="card-body">
        <div class="form-group">
            {!! Form::label('Currency') !!}
            <p>You can add ratios after the currencies are selected.</p>
            {!! Form::select('attack_methods_info[donate_currency][currency_ids][]', $currencies, isset($data['currency_ids']) ? $data['currency_ids'] : null, [
                'class' => 'form-control method-selectize',
                'placeholder' => 'Designated Currency',
                'multiple',
            ]) !!}
        </div>

        @if (isset($data['currency_ids']))
            @if (!in_array('any', $data['currency_ids']))
                @foreach ($data['currency_ids'] as $currencyId)
                    @php $currency = \App\Models\Currency\Currency::find($currencyId); @endphp
                    <div class="form-group">
                        {!! Form::label('Damage Ratio For ' . $currency->name) !!} {!! add_help('The ratio of damage done to the boss per currency donated.') !!}
                        {!! Form::number('attack_methods_info[donate_currency][damage_ratio][' . $currencyId . ']', $data['damage_ratio'][$currencyId] ?? 1, ['class' => 'form-control damage-ratio', 'min' => 0.1, 'step' => 0.01]) !!}
                    </div>

                    <p class="mb-1 damage-ratio" data-id="{{ $currencyId }}"></p>
                @endforeach
            @else
                @foreach ($currencies as $currencyId => $currencyName)
                    @if ($loop->first)
                        @continue
                    @endif
                    <div class="form-group">
                        {!! Form::label('Damage Ratio For ' . $currencyName) !!} {!! add_help('The ratio of damage done to the boss per currency donated.') !!}
                        {!! Form::number('attack_methods_info[donate_currency][damage_ratio][' . $currencyId . ']', $data['damage_ratio'][$currencyId] ?? 1, ['class' => 'form-control damage-ratio', 'min' => 0.1, 'step' => 0.01]) !!}
                    </div>

                    <p class="mb-1 damage-ratio" data-id="{{ $currencyId }}"></p>
                @endforeach
            @endif
        @else
            <div class="alert alert-info">Select currencies to add damage ratio(s).</div>
        @endif
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.damage-ratio').change(function() {
            let ratio = findRatio($(this).val());
            let damageRatio = $(this).parent().next('.damage-ratio');
            damageRatio.text(`For every ${ratio[0]} currency donated, ${ratio[1]} damage will be done to the boss`);
        });


        $('.damage-ratio').each(function() {
            let ratio = findRatio($(this).val());
            let damageRatio = $(this).parent().next('.damage-ratio');
            damageRatio.text(`For every ${ratio[0]} currency donated, ${ratio[1]} damage will be done to the boss`);
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
