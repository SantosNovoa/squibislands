<<<<<<< HEAD
@if (!$user->is_banned)
=======
@if(!$user->is_banned)
>>>>>>> Cylunny/extension/polls-and-forms
    <p>Are you sure you want to ban {!! $user->displayName !!}?</p>
    <div class="text-right"><a href="#" class="btn btn-danger ban-confirm-button">Ban</a></div>

    <script>
        $('.ban-confirm-button').on('click', function(e) {
            e.preventDefault();
            $('#banForm').submit();
        });
    </script>
<<<<<<< HEAD
@else
    <p>This user is already banned.</p>
@endif
=======
@else 
    <p>This user is already banned.</p>
@endif
>>>>>>> Cylunny/extension/polls-and-forms
