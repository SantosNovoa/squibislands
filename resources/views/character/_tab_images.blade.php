<div class="row">
<<<<<<< HEAD
    @foreach ($character->images as $image)
        <div class="col-md-3 col-4">
            <a href="#" class="d-block"><img src="{{ $image->thumbnailUrl }}" class="image-thumb img-thumbnail" alt="Thumbnail for {{ $image->character->fullName }}" /></a>
=======
    @foreach($character->images as $image)
        <div class="col-md-3 col-4">
            <a href="#" class="d-block"><img src="{{ $image->thumbnailUrl }}" class="image-thumb img-thumbnail" alt="Thumbnail for {{ $image->character->fullName }}"/></a>
>>>>>>> Cylunny/extension/polls-and-forms
        </div>
    @endforeach
</div>
