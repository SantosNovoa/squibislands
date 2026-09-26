@if (!isset($tinymceScript) || $tinymceScript)
<script>
    $(document).ready(function() {
@endif
        tinymce.init({
            selector: '{{ $tinymceSelector ?? ".wysiwyg" }}',
            height: {{ $tinymceHeight ?? 500 }},
            menubar: false,
            convert_urls: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks fullscreen spoiler',
                'insertdatetime media table paste {{ config('lorekeeper.extensions.tinymce_code_editor') ? 'codeeditor' : 'code' }} help wordcount'
            ],
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | spoiler-add spoiler-remove | removeformat | {{ config('lorekeeper.extensions.tinymce_code_editor') ? 'codeeditor' : 'code' }}',
            content_css: [
                'https://fonts.googleapis.com/css2?family=Cherry+Bomb+One&family=DynaPuff:wdth,wght@75..100,400..700&family=Lato:wght@400;700&family=Roboto+Condensed:wght@400;700&display=swap',
                '{{ asset('css/app.css') }}',
                '{{ asset('css/lorekeeper.css?v=' . filemtime(public_path('css/lorekeeper.css'))) }}'
            ],
            spoiler_caption: 'Toggle Spoiler',
            extended_valid_elements: '#i[class],#em[class]', // # <- sets autopadding with &nbsp;
            target_list: false
        });
@if (!isset($tinymceScript) || $tinymceScript)
    });
</script>
@endif