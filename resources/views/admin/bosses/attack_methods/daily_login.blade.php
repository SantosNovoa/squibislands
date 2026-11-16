@php
    $data = $boss->getAttackMethodInformation('daily_login');
@endphp

<div class="card mb-3">
    <div class="card-header h4">Daily Login Attack Method</div>
    <div class="card-body">
        <p>The daily login attack method only requires the user to challenge the boss.</p>
        <h5>Damage Range</h5>
        <p>Damage is determined randomly, if you want to set a specific number only fill in the minimum field.</p>
        <p>If you want the damage to be determined by, for example, a specific currency rewarded during prompts, use the earned_currency attack method.</p>
        <div class="row">
            <div class="col-md-6 form-group">
                {!! Form::label('attack_methods_info[daily_login][min_damage]', 'Min Damage') !!}
                {!! Form::number('attack_methods_info[daily_login][min_damage]', $data['min_damage'] ?? null, ['class' => 'form-control', 'placeholder' => 'Minimum Damage', 'min' => 1]) !!}
            </div>
            <div class="col-md-6 form-group">
                {!! Form::label('attack_methods_info[daily_login][max_damage]', 'Max Damage (Optional)') !!}
                {!! Form::number('attack_methods_info[daily_login][max_damage]', $data['max_damage'] ?? null, ['class' => 'form-control', 'placeholder' => 'Maximum Damage', 'min' => 1]) !!}
            </div>
        </div>
        <h5>Featured Button Graphic (Optional)</h5>
        <p>The daily attack is shown as a featured button on the boss page. Upload a graphic to use as the button instead of the default one. PNG, GIF, JPG or WEBP; animated GIFs stay animated.</p>
        <div class="d-flex align-items-center">
            @if ($boss->dailyButtonImageUrl)
                <img src="{{ $boss->dailyButtonImageUrl }}" class="img-thumbnail mr-3" style="max-width: 150px; max-height: 100px; object-fit: contain;" alt="Daily attack button" />
            @endif
            <div>
                {!! Form::file('daily_button_image') !!}
                @if ($boss->dailyButtonImageUrl)
                    <div class="form-check mt-2">
                        {!! Form::checkbox('remove_daily_button_image', 1, false, ['class' => 'form-check-input', 'id' => 'remove_daily_button_image']) !!}
                        {!! Form::label('remove_daily_button_image', 'Remove current graphic', ['class' => 'form-check-label']) !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
