@extends('layouts.app')

<<<<<<< HEAD
@section('title')
    Character{!! View::hasSection('profile-title') ? ' :: ' . trim(View::getSection('profile-title')) : '' !!}
@endsection

@section('sidebar')
    @include('character.' . ($isMyo ? 'myo.' : '') . '_sidebar')
=======
@section('title') Character ::@yield('profile-title')@endsection

@section('sidebar')
    @include('character.'.($isMyo ? 'myo.' : '').'_sidebar')
>>>>>>> Cylunny/extension/polls-and-forms
@endsection

@section('content')
    @yield('profile-content')
@endsection

@section('scripts')
<<<<<<< HEAD
    @parent
    <script>
        $(document).ready(function() {
            $('.bookmark-button').on('click', function(e) {
                e.preventDefault();
                var $this = $(this);
                loadModal($this.data('id') ? "{{ url('account/bookmarks/edit') }}" + '/' + $this.data('id') : "{{ url('account/bookmarks/create') }}?character_id=" + $this.data('character-id'), $this.data('id') ? 'Edit Bookmark' :
                    'Bookmark Character');
            });
        });
    </script>
@endsection
=======
@parent
<script>
    $( document ).ready(function(){
        $('.bookmark-button').on('click', function(e) {
            e.preventDefault();
            var $this = $(this);
            loadModal($this.data('id') ? "{{ url('account/bookmarks/edit') }}" + '/' + $this.data('id') : "{{ url('account/bookmarks/create') }}?character_id=" + $this.data('character-id'), $this.data('id') ? 'Edit Bookmark' : 'Bookmark Character');
        });
    });
</script>
@endsection
>>>>>>> Cylunny/extension/polls-and-forms
