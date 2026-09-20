<script>
    $(document).ready(function() {
        // Code generation ////////////////////////////////////////////////////////////////////////////

<<<<<<< HEAD
        var codeFormat = "{{ config('lorekeeper.settings.character_codes') }}";
=======
        var codeFormat = "{{ Config::get('lorekeeper.settings.character_codes') }}";
>>>>>>> Cylunny/extension/polls-and-forms
        var $code = $('#code');
        var $number = $('#number');
        var $category = $('#category');

        $number.on('keyup', function() {
            updateCode();
        });
        $category.on('change', function() {
            updateCode();
        });

        function updateCode() {
            var str = codeFormat;
            str = str.replace('{category}', $category.find(':selected').data('code'));
            str = str.replace('{number}', $number.val());
<<<<<<< HEAD
            str = str.replace('{year}', (new Date()).getFullYear());
=======
>>>>>>> Cylunny/extension/polls-and-forms
            $code.val(str);
        }

        // Pull number ////////////////////////////////////////////////////////////////////////////////

        var $pullNumber = $('#pull-number');
        $pullNumber.on('click', function(e) {
            e.preventDefault();
            $pullNumber.prop('disabled', true);
<<<<<<< HEAD
            $.get("{{ url('admin/masterlist/get-number') }}?category=" + $category.val(), function(data) {
                $number.val(data);
=======
            $.get( "{{ url('admin/masterlist/get-number') }}?category=" + $category.val(), function( data ) {
                $number.val( data );
>>>>>>> Cylunny/extension/polls-and-forms
                $pullNumber.prop('disabled', false);
                updateCode();
            });
        });
    });
<<<<<<< HEAD
</script>
=======
</script>
>>>>>>> Cylunny/extension/polls-and-forms
