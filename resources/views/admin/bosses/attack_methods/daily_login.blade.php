<div class="card mb-3">
    <div class="card-header h4">Daily Login Attack Method</div>
    <div class="card-body">
        <p>The daily login attack method only requires the user to challenge the boss.</p>
        <h5>Damage Range</h5>
        <p>Damage is determined randomly, if you want to set a specific number only fill in the minimum field.</p>
        <p>If you want the damage to be determined by, for example, a specific currency rewarded during prompts, use the earned_currency attack method.</p>
        <div class="row">
            <div class="col-md-6 form-group">
                {!! Form::label('attack_methods_info[daily_login_min_damage]', 'Min Damage') !!}
                {!! Form::number('attack_methods_info[daily_login_min_damage]', null, ['class' => 'form-control', 'placeholder' => 'Minimum Damage', 'required', 'min' => 1]) !!}
            </div>
            <div class="col-md-6 form-group">
                {!! Form::label('attack_methods_info[daily_login_max_damage]', 'Max Damage (Optional)') !!}
                {!! Form::number('attack_methods_info[daily_login_max_damage]', null, ['class' => 'form-control', 'placeholder' => 'Maximum Damage', 'min' => 1]) !!}
            </div>
        </div>
    </div>
</div>