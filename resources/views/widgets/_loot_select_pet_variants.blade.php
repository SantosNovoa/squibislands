{{-- Pet Variant support for the loot select on box/choicebox tags.
     Include after widgets._loot_select (with 'showPetVariants' => true). --}}
@php
    // Options for the "Pet Variant" reward select on newly added rows
    $petVariantOptions = \App\Models\Pet\PetVariant::with('pet')
        ->get()
        ->filter(fn($v) => $v->pet)
        ->sortBy(fn($v) => $v->pet->name.' '.$v->variant_name)
        ->map(fn($v) => ['id' => $v->id, 'name' => $v->pet->name.' - '.$v->variant_name])
        ->values();
@endphp

<script>
    // Pet Variant support for box/choicebox tags.
    // The shared loot row template/JS don't know about variants, so this adds the
    // "Pet Variant" type to new rows and swaps in the variant select when chosen.
    // Runs on window load so the shared loot JS has already bound its handlers.
    window.addEventListener('load', function() {
        const petVariantOptions = @json($petVariantOptions);

        // Add the type option to the hidden row template used by "Add Reward"
        $('#lootRow .reward-type').each(function() {
            if (!$(this).find('option[value="PetVariant"]').length) {
                $(this).append('<option value="PetVariant">Pet Variant</option>');
            }
        });

        function buildVariantSelect() {
            const $select = $('<select name="rewardable_id[]" class="form-control pet-variant-select"></select>');
            $select.append('<option value="">Select Pet Variant</option>');
            petVariantOptions.forEach(function(v) {
                $select.append($('<option></option>').val(v.id).text(v.name));
            });
            return $select;
        }

        $(document).on('change', '#lootTableBody .reward-type', function() {
            if ($(this).val() !== 'PetVariant') return;
            const $cell = $(this).closest('tr').find('.loot-row-select');
            // Defer so this runs after the shared handler has cleared/filled the cell
            setTimeout(function() {
                const $select = buildVariantSelect();
                $cell.html('').append($select);
                if ($.fn.selectize) $select.selectize();
            }, 0);
        });
    });
</script>