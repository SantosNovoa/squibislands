<script>
    $(document).ready(function() {
        $('#userSelect').selectize();
<<<<<<< HEAD
=======
        $( "#datepicker" ).datetimepicker({
            dateFormat: "yy-mm-dd",
            timeFormat: 'HH:mm:ss',
        });
>>>>>>> Cylunny/extension/polls-and-forms
        // Resell options /////////////////////////////////////////////////////////////////////////////

        var $resellable = $('#resellable');
        var $resellOptions = $('#resellOptions');

        var resellable = $resellable.is(':checked');

        updateOptions();

        $resellable.on('change', function(e) {
            resellable = $resellable.is(':checked');

            updateOptions();
        });

        function updateOptions() {
<<<<<<< HEAD
            if (resellable) $resellOptions.removeClass('hide');
            else $resellOptions.addClass('hide');
        }
    });
</script>
=======
            if(resellable) $resellOptions.removeClass('hide');
            else $resellOptions.addClass('hide');
        }
    });
</script>
>>>>>>> Cylunny/extension/polls-and-forms
