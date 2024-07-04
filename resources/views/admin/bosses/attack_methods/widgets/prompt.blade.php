<div class="card mb-3">
    <div class="card-header h3">
        @if (!$boss->is_active)
            <i class="fas fa-eye-slash mr-1" data-toggle="tooltip" title="Inactive"></i>
        @endif
        @if ($boss->is_staff_only)
            <i class="fas fa-crown mr-1" data-toggle="tooltip" title="Staff Only"></i>
        @endif
        {!! $boss->displayName !!}
    </div>
    <div class="card-body">
        <div class="row mb-3">
            @if ($boss->has_image)
                <div class="col-md-3">
                    <img src="{{ $boss->imageUrl }}" class="img-thumbnail mb-3" style="max-width: 250px; max-height: 250px;">
                </div>
            @endif
            <div class="{{ $boss->has_image ? 'col-md-9' : 'col-12' }}">
                <div class="progress h5">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: {{ ($boss->current_health / $boss->total_health) * 100 }}%" aria-valuenow="{{ $boss->current_health }}"
                        aria-valuemin="0" aria-valuemax="{{ $boss->total_health }}">
                        {{ $boss->current_health }} / {{ $boss->total_health }}
                    </div>
                </div>
                <a class="btn btn-block btn-primary my-3" href="{{ $boss->idUrl }}">View Boss</a>
                @php 
                    $data = $boss->getAttackMethodInformation('prompt');
                @endphp
                @if ($data['damage_calculation_method'] == 'input')
                    <p>This bosses damage is calculated independently of the currency system. Please enter the damage you would like to do to this boss.</p>
                    {!! Form::number('boss_damage['.$boss->id.']', null, ['class' => 'form-control', 'placeholder' => 'Enter Damage']) !!}
                @elseif ($data['damage_calculation_method'] == 'currency')
                    @if ($data['currency_id'] != 'any')
                        <p>The damage done to this boss will be determined by the amount of {!! \App\Models\Currency\Currency::find($data['currency_id'])->displyName !!} this prompt earns.</p>
                    @else
                        <p>The damage done to this boss will be determined by the amount of currency this prompt earns.</p>
                    @endif
                @else
                    <div class="alert alert-danger">
                        This boss has an invalid or missing damage calculation method.
                        <br />Approving this prompt as is will not damage.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>