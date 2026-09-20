<script>
    $(document).ready(function() {
        var $addCharacter = $('#addCharacter');
        var $components = $('#characterComponents');
        var $characters = $('#characters');
        var count = 0;

        $('#characters .submission-character').each(function(index) {
            attachListeners($(this));
        });

        $addCharacter.on('click', function(e) {
            e.preventDefault();
            $clone = $components.find('.submission-character').clone();
            attachListeners($clone);
            $characters.append($clone);
<<<<<<< HEAD
            $clone.find('.character-code').selectize();
=======
>>>>>>> Cylunny/extension/polls-and-forms
            count++;
        });

        function attachListeners(node) {
<<<<<<< HEAD
            node.find('.character-code').on('input', function(e) {
                var $parent = $(this).parent().parent().parent().parent();
                $parent.find('.character-image-loaded').load('{{ url('gallery/submit/character') }}/' + $(this).val(), function(response, status, xhr) {
=======
            node.find('.character-code').on('change', function(e) {
                var $parent = $(this).parent().parent().parent().parent();
                $parent.find('.character-image-loaded').load('{{ url('gallery/submit/character') }}/'+$(this).val(), function(response, status, xhr) {
>>>>>>> Cylunny/extension/polls-and-forms
                    $parent.find('.character-image-blank').addClass('hide');
                    $parent.find('.character-image-loaded').removeClass('hide');
                    $parent.find('.character-rewards').removeClass('hide');
                });
            });
            node.find('.remove-character').on('click', function(e) {
                e.preventDefault();
                $(this).parent().parent().parent().remove();
            });
        }

    });
<<<<<<< HEAD
</script>
=======
</script>
>>>>>>> Cylunny/extension/polls-and-forms
