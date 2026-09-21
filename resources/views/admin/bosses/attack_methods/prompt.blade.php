@php
    $prompts = ['any' => 'Any Prompt'] + \App\Models\Prompt\Prompt::pluck('name', 'id')->toArray();
    $promptCategories = \App\Models\Prompt\PromptCategory::pluck('name', 'id')->toArray();
    $currencies =
        ['any' => 'Any Currency'] +
        \App\Models\Currency\Currency::where('is_user_owned', 1)
            ->pluck('name', 'id')
            ->toArray();

    $data = $boss->getAttackMethodInformation('prompt');
@endphp

<div class="card mb-3">
    <div class="card-header h4">Prompt Attack Method</div>
    <div class="card-body">
        <P>You can choose both a category and a specific prompt, but it's recommended to choose one or the other.</p>
        <p>Damage from prompts is determined by staff on approval.</p>
        <div class="form-group">
            {!! Form::label('Category') !!}
            {!! Form::select('attack_methods_info[prompt][prompt_category_ids][]', $promptCategories, $data['prompt_category_ids'] ?? null, ['class' => 'form-control method-selectize', 'placeholder' => 'Designated Category', 'multiple']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Prompt') !!}
            {!! Form::select('attack_methods_info[prompt][prompt_ids][]', $prompts, $data['prompt_ids'] ?? null, ['class' => 'form-control method-selectize', 'placeholder' => 'Designated Prompt', 'multiple']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Damage Calculation Method') !!}
            {!! Form::select('attack_methods_info[prompt][damage_calculation_method]', ['currency' => 'Based on Currency', 'input' => 'Staff Input'], $data['damage_calculation_method'] ?? null, [
                'class' => 'form-control prompt-damage-calculation',
                'placeholder' => 'None (No Prompt Damage)',
            ]) !!}
        </div>

        <div class="form-group prompt-currency {{ isset($data['currency_id']) ? '' : 'hide' }}">
            {!! Form::label('Currency') !!}
            {!! Form::select('attack_methods_info[prompt][currency_id]', $currencies, $data['currency_id'] ?? null, ['class' => 'form-control', 'placeholder' => 'Choose a Currency']) !!}
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.prompt-damage-calculation').change(function() {
            if ($(this).val() == 'currency') {
                $('.prompt-currency').removeClass('hide');
            } else {
                $('.prompt-currency').addClass('hide');
            }
        });
    });
</script>
