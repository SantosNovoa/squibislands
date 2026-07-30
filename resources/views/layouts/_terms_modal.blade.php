@if(Config::get('lorekeeper.settings.show_terms_popup') == 1)
<div class="modal fade d-none" id="termsModal" role="dialog" style="display:inline;overflow:auto;" data-backdrop="static"
    data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h2>{{ Config::get('lorekeeper.settings.terms_popup')['title'] }}</h2>
            </div>
            <div class="modal-body text-center">
                {!! Config::get('lorekeeper.settings.terms_popup')['text'] !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="termsButton">               
                    {{ Config::get('lorekeeper.settings.terms_popup')['button'] }}
                </button>
            </div>
        </div>
    </div>
</div>
<div class="fade modal-backdrop d-none" id="termsBackdrop"></div>


<script>
    $( document ).ready(function(){
        var termsButton = $('#termsButton');
        let termsAccepted = localStorage.getItem("terms_accepted");
        let user = "{{ Auth::user() != null }}" 
        let userAccepted = "{{ Auth::user()?->has_accepted_terms > 0 }}"

        if(user){
            if(!userAccepted){
                showPopup();
            }
        } else {
            if(!termsAccepted){
                showPopup();
            }
        }

        termsButton.on('click', function(e) {
            e.preventDefault();
            
            if(user == "1") {
                $.post('{{ url("terms/accept") }}', {
                    _token: '{{ csrf_token() }}'
                }).done(function() {
                    $('#termsModal').removeClass("show").addClass("d-none");
                    $('#termsBackdrop').removeClass("show").addClass("d-none");
                }).fail(function(xhr) {
                    console.error('Error:', xhr.responseText);
                    alert('Error accepting terms. Please try again.');
                });
            } else {
                localStorage.setItem("terms_accepted", true);
                $('#termsModal').removeClass("show").addClass("d-none");
                $('#termsBackdrop').removeClass("show").addClass("d-none");
            }
        });

        function showPopup(){
            $('#termsModal').addClass("show");
            $('#termsModal').removeClass("d-none");
            $('#termsBackdrop').addClass("show");
            $('#termsBackdrop').removeClass("d-none");
        }

    });

</script>
@endif