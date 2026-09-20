<<<<<<< HEAD
=======

>>>>>>> Cylunny/extension/polls-and-forms
<script>
$( document ).ready(function() {    
    var $lootTable  = $('#lootTableBody');
    var $lootRow = $('#lootRow').find('.loot-row');
    var $itemSelect = $('#lootRowData').find('.item-select');
<<<<<<< HEAD
    var $PetSelect = $('#lootRowData').find('.pet-select');
    var $WeaponSelect = $('#lootRowData').find('.weapon-select');
    var $GearSelect = $('#lootRowData').find('.gear-select');
    var $currencySelect = $('#lootRowData').find('.currency-select');
    var $statSelect = $('#lootRowData').find('.stat-select');
    var $claymoreSelect = $('#lootRowData').find('.claymore-select');
    var $awardSelect = $('#lootRowData').find('.award-select');
=======
    var $currencySelect = $('#lootRowData').find('.currency-select');
>>>>>>> Cylunny/extension/polls-and-forms
    @if($showLootTables)
        var $tableSelect = $('#lootRowData').find('.table-select');
    @endif
    @if($showRaffles)
        var $raffleSelect = $('#lootRowData').find('.raffle-select');
    @endif
<<<<<<< HEAD
    @if($showRecipes)
        var $recipeSelect = $('#lootRowData').find('.recipe-select');
    @endif
    @if (isset($showThemes) && $showThemes)
            var $themeSelect = $('#lootRowData').find('.theme-select');
    @endif
=======
>>>>>>> Cylunny/extension/polls-and-forms

    $('#lootTableBody .selectize').selectize();
    attachRemoveListener($('#lootTableBody .remove-loot-button'));

    $('#addLoot').on('click', function(e) {
        e.preventDefault();
        var $clone = $lootRow.clone();
        $lootTable.append($clone);
        attachRewardTypeListener($clone.find('.reward-type'));
        attachRemoveListener($clone.find('.remove-loot-button'));
    });

    $('.reward-type').on('change', function(e) {
<<<<<<< HEAD
=======
        var val = $(this).val();
        var $cell = $(this).parent().find('.loot-row-select');

        var $clone = null;
        if(val == 'Item') $clone = $itemSelect.clone();
        else if (val == 'Currency') $clone = $currencySelect.clone();
        @if($showLootTables)
            else if (val == 'LootTable') $clone = $tableSelect.clone();
        @endif
        @if($showRaffles)
            else if (val == 'Raffle') $clone = $raffleSelect.clone();
        @endif

        $cell.html('');
        $cell.append($clone);
    });

    function attachRewardTypeListener(node) {
        node.on('change', function(e) {
>>>>>>> Cylunny/extension/polls-and-forms
            var val = $(this).val();
            var $cell = $(this).parent().parent().find('.loot-row-select');

            var $clone = null;
<<<<<<< HEAD
            if (val == 'Item') $clone = $itemSelect.clone();
            else if (val == 'Currency') $clone = $currencySelect.clone();
            else if (val == 'Award') $clone = $awardSelect.clone();
            else if (val == 'Pet') $clone = $PetSelect.clone();
            else if (val == 'Weapon') $clone = $WeaponSelect.clone();
            else if (val == 'Gear') $clone = $GearSelect.clone();
            else if (val == 'Points') $clone = $statSelect.clone();
            else if (val == 'Exp') $clone = $claymoreSelect.clone();
            @if ($showLootTables)
                else if (val == 'LootTable') $clone = $tableSelect.clone();
            @endif
            @if ($showRaffles)
                else if (val == 'Raffle') $clone = $raffleSelect.clone();
            @endif
            @if($showRecipes)
                else if (val == 'Recipe') $clone = $recipeSelect.clone();
            @endif
            @if (isset($showThemes) && $showThemes)
                else if (val == 'Theme') $clone = $themeSelect.clone();
            @endif

            $cell.html('');
            $cell.append($clone);
        });

        function attachRewardTypeListener(node) {
            node.on('change', function(e) {
                var val = $(this).val();
                var $cell = $(this).parent().parent().find('.loot-row-select');

                var $clone = null;
                if (val == 'Item') $clone = $itemSelect.clone();
                else if (val == 'Pet') $clone = $PetSelect.clone();
                else if (val == 'Currency') $clone = $currencySelect.clone();
                else if (val == 'Award') $clone = $awardSelect.clone();
                else if (val == 'Weapon') $clone = $WeaponSelect.clone();
                else if (val == 'Gear') $clone = $GearSelect.clone();
                else if (val == 'Points') $clone = $statSelect.clone();
                else if (val == 'Exp') $clone = $claymoreSelect.clone();
                @if ($showLootTables)
                    else if (val == 'LootTable') $clone = $tableSelect.clone();
                @endif
                @if ($showRaffles)
                    else if (val == 'Raffle') $clone = $raffleSelect.clone();
                @endif
                @if($showRecipes)
                    else if (val == 'Recipe') $clone = $recipeSelect.clone();
                @endif
                @if (isset($showThemes) && $showThemes)
                    else if (val == 'Theme') $clone = $themeSelect.clone();
                @endif

                $cell.html('');
                $cell.append($clone);
                $clone.selectize();
            });
        }

        function attachRemoveListener(node) {
            node.on('click', function(e) {
                e.preventDefault();
                $(this).parent().parent().remove();
            });
        }

    });
</script>
=======
            if(val == 'Item') $clone = $itemSelect.clone();
            else if (val == 'Currency') $clone = $currencySelect.clone();
            @if($showLootTables)
                else if (val == 'LootTable') $clone = $tableSelect.clone();
            @endif
            @if($showRaffles)
                else if (val == 'Raffle') $clone = $raffleSelect.clone();
            @endif

            $cell.html('');
            $cell.append($clone);
            $clone.selectize();
        });
    }

    function attachRemoveListener(node) {
        node.on('click', function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });
    }

});
    
</script>
>>>>>>> Cylunny/extension/polls-and-forms
