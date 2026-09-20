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
<div class="submission-character mb-3">
    <div class="row">
        <div class="col-md-4">
            <div>
                <div class="character-image-blank hide">Enter character code.</div>
                <div class="character-image-loaded">
<<<<<<< HEAD
                    @include('galleries._character', ['character' => $character->character ? $character->character : $character])
=======
                    @include('galleries._character', ['character' => $character->character])
>>>>>>> Cylunny/extension/polls-and-forms
                </div>
            </div>
        </div>
        <div class="col-md-7">
<<<<<<< HEAD
            <div class="form-group">
                {!! Form::select('slug[]', $characters, $character->character ? $character->character->slug : $character->slug, ['class' => 'form-control character-code', 'placeholder' => 'Select Character']) !!}
            </div>
=======
            <a href="#" class="float-right fas fa-close"></a>
                <div class="form-group">
                    {!! Form::text('slug[]', $character->character->slug, ['class' => 'form-control character-code']) !!}
                </div>
>>>>>>> Cylunny/extension/polls-and-forms
        </div>
        <div class="col-md-1 text-right">
            <a href="#" class="remove-character text-muted"><i class="fas fa-times"></i></a>
        </div>
    </div>
<<<<<<< HEAD
</div>
=======
</div>
>>>>>>> Cylunny/extension/polls-and-forms
