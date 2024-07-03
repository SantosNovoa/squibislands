@php
    $prompts = ['any' => 'Any Prompt'] + \App\Models\Prompt\Prompt::pluck('name', 'id')->toArray();
    $promptCategories = ['any' => 'Any Category'] + \App\Models\Prompt\PromptCategory::pluck('name', 'id')->toArray();
@endphp

<div class="card mb-3">
    <div class="card-header h4">Prompt Attack Method</div>
    <div class="card-body">
        <P>You can choose both a category and a specific prompt, but it's recommended to choose one or the other.</p>
        <div class="form-group">
            {!! Form::label('Category') !!}
            {!! Form::select('attack_methods_info[prompt_prompt_category]', $promptCategories, null, ['class' => 'form-control', 'placeholder' => 'Designated Category']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Prompt') !!}
            {!! Form::select('attack_methods_info[prompt_prompt]', $prompts, null, ['class' => 'form-control', 'placeholder' => 'Designated Prompt']) !!}
        </div>

        <h5>Damage Range</h5>
        <p>Damage is determined randomly, if you want to set a specific number only fill in the minimum field.</p>
        <p>If you want the damage to be determined by, for example, a specific currency rewarded during prompts, use the earned_currency attack method.</p>
        <div class="row">
            <div class="col-md-6 form-group">
                {!! Form::label('attack_methods_info[prompt_min_damage]', 'Min Damage') !!}
                {!! Form::number('attack_methods_info[prompt_min_damage]', null, ['class' => 'form-control', 'placeholder' => 'Minimum Damage', 'min' => 1]) !!}
            </div>
            <div class="col-md-6 form-group">
                {!! Form::label('attack_methods_info[prompt_max_damage]', 'Max Damage (Optional)') !!}
                {!! Form::number('attack_methods_info[prompt_max_damage]', null, ['class' => 'form-control', 'placeholder' => 'Maximum Damage', 'min' => 1]) !!}
            </div>
        </div>
    </div>
</div>
