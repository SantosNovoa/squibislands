{{--
    Builds the First Completion Bonus rows by reusing the hidden templates from widgets._loot_select_row
    (#lootRow / #lootRowData), renaming the inputs to bonus_* so they don't mix with the normal rewards.
    Must be included after js._loot_js.
--}}
<script>
    $(document).ready(function() {
        var $bonusBody = $('#bonusLootTableBody');
        var existingBonus = @json($bonusRewards ?? []);

        // Reward type => class of the matching template select in #lootRowData
        var bonusSelectClasses = {
            'Item': 'item-select',
            'Currency': 'currency-select',
            'Award': 'award-select',
            'Pet': 'pet-select',
            'Weapon': 'weapon-select',
            'Gear': 'gear-select',
            'Points': 'stat-select',
            'Exp': 'claymore-select',
            'LootTable': 'table-select',
            'Raffle': 'raffle-select',
            'Recipe': 'recipe-select',
            'Theme': 'theme-select',
            'Border': 'border-select',
        };

        function setBonusRewardSelect($row, type, value) {
            var $cell = $row.find('.loot-row-select');
            $cell.html('');
            var cls = bonusSelectClasses[type];
            if (!cls) return;

            var $template = $('#lootRowData').children('select.' + cls).first();
            if (!$template.length) return;

            var $clone = $template.clone();
            $clone.attr('name', 'bonus_rewardable_id[]').removeAttr('id');
            if (value !== undefined && value !== null) $clone.val(String(value));
            else if (type == 'Points') $clone.val('none');
            $cell.append($clone);
            if (!$clone.hasClass('hide')) $clone.selectize();
        }

        function addBonusRow(type, id, quantity) {
            var $row = $('#lootRow').find('.loot-row').first().clone();

            // Rename inputs so they are submitted separately from the normal rewards
            var $type = $row.find('select[name="rewardable_type[]"]');
            $type.attr('name', 'bonus_rewardable_type[]').removeClass('reward-type').addClass('bonus-reward-type');
            $row.find('input[name="quantity[]"]').attr('name', 'bonus_quantity[]').val(quantity || 1);

            $type.on('change', function() {
                setBonusRewardSelect($row, $(this).val());
            });
            $row.find('.remove-loot-button').on('click', function(e) {
                e.preventDefault();
                $row.remove();
            });

            $bonusBody.append($row);

            if (type) {
                $type.val(type);
                setBonusRewardSelect($row, type, id);
            }
        }

        existingBonus.forEach(function(reward) {
            addBonusRow(reward.type, reward.id, reward.quantity);
        });

        $('#addBonusLoot').on('click', function(e) {
            e.preventDefault();
            addBonusRow();
        });
    });
</script>
