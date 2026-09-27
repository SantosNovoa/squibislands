<li class="list-group-item">
    <a class="card-title h5 collapse-title"  data-toggle="collapse" href="#openChoiceBoxForm"> Open Choice Box</a>
    <div id="openChoiceBoxForm" class="collapse">
        {!! Form::hidden('tag', $tag->tag) !!}
        <p>This item has a selection of prizes inside, but you can only choose one! Please note that you can only select one choice each time you open this box, so if you have multiple and want different choices, you should open them one at a time. This action is not reversible. Are you sure you want to open this box?</p>
        @php
            // Format information for reward selection.
            // Option values are "{asset key}-{id}" (e.g. "pet_variants-1"), which is what
            // ChoiceboxService::act() expects. Any asset type the asset helpers know about
            // is listed, so new reward types show up here without editing this file.
            $groupLabels = [
                'items'          => 'Items',
                'currencies'     => 'Currencies',
                'pets'           => 'Pets',
                'pet_variants'   => 'Pet Variants',
                'awards'         => ucfirst(__('awards.award')).'s',
                'gears'          => 'Gear',
                'weapons'        => 'Weapons',
                'raffle_tickets' => 'Raffle Tickets',
                'loot_tables'    => 'Loot Tables',
                'recipes'        => 'Recipes',
                'themes'         => 'Themes',
                'borders'        => 'Borders',
            ];

            $rewardOptions = [];
            foreach ($tag->data as $type => $group) {
                $model = getAssetModelString($type);
                if (!$model || !class_exists($model) || !is_array($group)) {
                    continue; // e.g. exp/points, which can't be offered as a choice
                }

                $label = $groupLabels[$type] ?? ucwords(str_replace('_', ' ', $type));
                foreach ($group as $id => $quantity) {
                    $asset = $model::find($id);
                    if (!$asset) {
                        continue; // reward was deleted since the box was set up
                    }

                    switch ($type) {
                        case 'raffle_tickets':
                            $name = nl2br(htmlentities($asset->displayName));
                            break;
                        case 'loot_tables':
                            $name = $asset->getRawOriginal('display_name');
                            break;
                        default:
                            $name = $asset->name;
                    }

                    $rewardOptions[$label][$type.'-'.$id] = $name.' x'.$quantity.($type == 'loot_tables' ? ' (This reward is random)' : '');
                }
            }
        @endphp

        <div class="form-group">
            {!! Form::select('choicebox_reward', $rewardOptions, null, ['class' => 'form-control choiceBox', 'placeholder' => 'Select a Reward']) !!}
        </div>
        <script>
            $(document).ready(function() {
                $('.choiceBox').selectize({
                    sortField: "text",
                });
            });
        </script>
        <div class="text-right">
            {!! Form::button('Open', ['class' => 'btn btn-primary', 'name' => 'action', 'value' => 'act', 'type' => 'submit']) !!}
        </div>
    </div>
</li>