tinymce.init({
<<<<<<< HEAD
selector: '#modal .wysiwyg',
height: 500,
menubar: false,
plugins: [
'advlist autolink lists link image charmap print preview anchor',
'searchreplace visualblocks code fullscreen',
'insertdatetime media table paste code help wordcount'
],
toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | code',
content_css: [
    'https://fonts.googleapis.com/css2?family=Cherry+Bomb+One&family=DynaPuff:wdth,wght@75..100,400..700&family=Lato:wght@400;700&family=Roboto+Condensed:wght@400;700&display=swap',
    '//www.tiny.cloud/css/codepen.min.css',
    '{{ asset('css/app.css') }}',
    '{{ asset('css/lorekeeper.css?v=' . filemtime(public_path('css/lorekeeper.css'))) }}',
    {!! file_exists(public_path() . '/css/custom.css') ? "'" . asset('css/custom.css?v=') . filemtime(public_path('css/custom.css')) . "'," : '' !!}
    {!! $theme?->cssUrl ? "'" . asset($theme?->cssUrl) . "'," : '' !!}
    {!! $conditionalTheme?->cssUrl ? "'" . asset($conditionalTheme?->cssUrl) . "'," : '' !!}
    {!! $decoratorTheme?->cssUrl ? "'" . asset($decoratorTheme?->cssUrl) . "'," : '' !!}
    '{{ asset('css/all.min.css') }}' //fontawesome
],
content_style: `
{!! str_replace(['<style>', '</style>'], '', view('layouts.editable_theme', ['theme' => $theme])) !!}
{!! isset($conditionalTheme) && $conditionalTheme ? str_replace(['<style>', '</style>'], '', view('layouts.editable_theme', ['theme' => $conditionalTheme])) : '' !!}
{!! isset($decoratorTheme) && $decoratorTheme ? str_replace(['<style>', '</style>'], '', view('layouts.editable_theme', ['theme' => $decoratorTheme])) : '' !!}
`,
});
=======
    selector: '#modal .wysiwyg',
    height: 500,
    menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code help wordcount'
    ],
    toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | code',
    content_css: [
        '//www.tiny.cloud/css/codepen.min.css',
        '{{ asset('css/app.css') }}',
        '{{ asset('css/lorekeeper.css') }}'
    ]
});
>>>>>>> Cylunny/extension/polls-and-forms
