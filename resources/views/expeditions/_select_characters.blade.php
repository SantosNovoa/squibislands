<p>Select which characters to send. Sending more characters increases your success chance, up to a maximum of {{ $expedition->max_characters }}.</p>

{!! Form::open(['url' => 'expeditions/' . $expedition->id . '/send']) !!}

@if (!count($characters))
    <p>You have no available characters to send (they may already be on an expedition).</p>
@else
    <div class="character-select-list mb-3" style="max-height: 300px; overflow-y: auto;">
        @foreach ($characters as $character)
            <label class="image-option-card expedition-select-image">
                {!! Form::checkbox('character_ids[]', $character->id, false, ['class' => 'form-check-input character-select-checkbox']) !!}
                <img src="{{ $character->image->thumbnailUrl }}" class="img-thumbnail" style="max-height: 100px;" alt="Thumbnail for {{ $character->fullName }}" />
            </label>
        @endforeach

    </div>

    <div class="alert alert-info">
        Characters selected: <span id="selectedCount">0</span> / {{ $expedition->max_characters }}<br>
        Success chance: <span id="successChance">0</span>%
    </div>
    <div class="form-check mb-2">
        {!! Form::checkbox('select_all', 1, false, ['class' => 'form-check-input', 'id' => 'selectAllCharacters']) !!}
        {!! Form::label('selectAllCharacters', 'Select All', ['class' => 'form-check-label']) !!}
    </div>
    {!! Form::submit('Send Expedition', ['class' => 'btn btn-primary', 'id' => 'sendExpeditionBtn', 'disabled' => true]) !!}
@endif

{!! Form::close() !!}

<script>
$(document).ready(function() {
    var successRate = {{ $expedition->success_rate }};
    var maxCharacters = {{ $expedition->max_characters }};

    function updateCounts() {
        var checked = $('.character-select-checkbox:checked');
        var count = checked.length;
        var chance = Math.min(count * successRate, 100);

        $('#selectedCount').text(count);
        $('#successChance').text(chance.toFixed(2));
        $('#sendExpeditionBtn').prop('disabled', count === 0);
    }

    $('.character-select-checkbox').on('change', function() {
        var checked = $('.character-select-checkbox:checked');

        if (checked.length > maxCharacters) {
            $(this).prop('checked', false);
        }

        updateCounts();
    });

    $('#selectAllCharacters').on('change', function() {
        var isChecked = $(this).is(':checked');
        var allCheckboxes = $('.character-select-checkbox');

        if (isChecked) {
            // Only check up to maxCharacters, in DOM order
            allCheckboxes.each(function(index) {
                $(this).prop('checked', index < maxCharacters);
            });
        } else {
            allCheckboxes.prop('checked', false);
        }

        updateCounts();
    });
});
</script>
