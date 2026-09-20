function loadModal(url, title) {
    $('#modal').find('.modal-body').html('');
    $('#modal').find('.modal-title').html(title);
    $('#modal').find('.modal-body').load(url, function( response, status, xhr ) {
        if ( status == "error" ) {
            var msg = "Error: ";
            $( "#modal" ).find('.modal-body').html( msg + xhr.status + " " + xhr.statusText );
        }
        else {
            $('#modal [data-toggle=tooltip]').tooltip({html: true});
            $('#modal [data-toggle=toggle]').bootstrapToggle();
<<<<<<< HEAD
            $('#modal .cp').colorpicker({
                'autoInputFallback': false,
                'autoHexInputFallback': false,
                'format': 'auto',
                'useAlpha': true,
                extensions: [{
                    name: 'blurValid'
                }]
            });
=======
            $('#modal .cp').colorpicker();
>>>>>>> Cylunny/extension/polls-and-forms
        }
    });
    $('#modal').modal('show');
}