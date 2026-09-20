<<<<<<< HEAD
@php
    $characters = \App\Models\Character\Character::visible(Auth::user() ?? null)
        ->myo(0)
        ->orderBy('slug', 'DESC')
        ->get()
        ->pluck('fullName', 'slug')
        ->toArray();
@endphp

=======
>>>>>>> Cylunny/extension/polls-and-forms
<div id="characterComponents" class="hide">
    <div class="submission-character mb-3">
        <div class="row">
            <div class="col-md-4">
                <div>
                    <div class="character-image-blank">Enter character code.</div>
                    <div class="character-image-loaded hide"></div>
                </div>
            </div>
            <div class="col-md-7">
<<<<<<< HEAD
                <div class="form-group">
                    {!! Form::select('slug[]', $characters, null, ['class' => 'form-control character-code', 'placeholder' => 'Character Code (EX-001, for example)']) !!}
                </div>
=======
                <a href="#" class="float-right fas fa-close"></a>
                    <div class="form-group">
                        {!! Form::text('slug[]', null, ['class' => 'form-control character-code', 'placeholder' => 'Character Code (EX-001, for example)']) !!}
                    </div>
>>>>>>> Cylunny/extension/polls-and-forms
            </div>
            <div class="col-md-1 text-right">
                <a href="#" class="remove-character text-muted"><i class="fas fa-times"></i></a>
            </div>
        </div>
    </div>
<<<<<<< HEAD
</div>
=======
</div>
>>>>>>> Cylunny/extension/polls-and-forms
