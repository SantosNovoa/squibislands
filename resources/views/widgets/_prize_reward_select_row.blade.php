<div id="rewardRowData" class="hide">
    <table class="table table-sm">
        <tbody id="rewardRow">
            <tr class="reward-row">
                <td>{!! Form::select('rewardable_type[]', [
                    'Item' => 'Item',
                    'Currency' => 'Currency',
                    'LootTable' => 'Loot Table',
                    'Raffle' => 'Raffle',
                    'Pet' => 'Pet',
                    'Award' => 'Badge',
                    'Gear' => 'Gear',
                    'Weapon' => 'Weapon',
                    'Recipe' => 'Recipe',
                ], null, ['class' => 'form-control reward-type selectize', 'placeholder' => 'Select Reward Type']) !!}</td>
                <td class="reward-row-select"></td>
                <td>{!! Form::text('reward_quantity[]', 1, ['class' => 'form-control']) !!}</td>
                <td class="text-right"><a href="#" class="btn btn-danger remove-reward-button">Remove</a></td>
            </tr>
        </tbody>
    </table>
    {!! Form::select('rewardable_id[]', $items, null, ['class' => 'form-control item-select', 'placeholder' => 'Select Item']) !!}
    {!! Form::select('rewardable_id[]', $currencies, null, ['class' => 'form-control currency-select', 'placeholder' => 'Select Currency']) !!}
    {!! Form::select('rewardable_id[]', $tables, null, ['class' => 'form-control table-select', 'placeholder' => 'Select Loot Table']) !!}
    {!! Form::select('rewardable_id[]', $raffles, null, ['class' => 'form-control raffle-select', 'placeholder' => 'Select Raffle']) !!}
    {!! Form::select('rewardable_id[]', $pets, null, ['class' => 'form-control pet-select', 'placeholder' => 'Select Pet']) !!}
    {!! Form::select('rewardable_id[]', $awards, null, ['class' => 'form-control award-select', 'placeholder' => 'Select Badge']) !!}
    {!! Form::select('rewardable_id[]', $gear, null, ['class' => 'form-control gear-select', 'placeholder' => 'Select Gear']) !!}
    {!! Form::select('rewardable_id[]', $weapons, null, ['class' => 'form-control weapon-select', 'placeholder' => 'Select Weapon']) !!}
    {!! Form::select('rewardable_id[]', $recipes, null, ['class' => 'form-control recipe-select', 'placeholder' => 'Select Recipe']) !!}
</div>