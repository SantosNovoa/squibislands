<div class="card mb-3">
    <div class="card-header">
<<<<<<< HEAD
        <x-admin-edit title="Sale" :object="$sales" />
=======
>>>>>>> Cylunny/extension/polls-and-forms
        <h2 class="card-title mb-0">{!! $sales->displayName !!}</h2>
        <small>
            Posted {!! $sales->post_at ? pretty_date($sales->post_at) : pretty_date($sales->created_at) !!} :: Last edited {!! pretty_date($sales->updated_at) !!} by {!! $sales->user->displayName !!}
        </small>
    </div>


<<<<<<< HEAD
    @if ($sales->characters()->count())
</div>

<div class="row mb-2">
    @foreach ($sales->characters as $character)
        @if ($character->character->deleted_at)
            <div class="col-lg mb-2">
                <div class="card h-100">
                    <div class="alert alert-warning my-auto mx-2">
                        <i class="fas fa-exclamation-triangle"></i> This character has been deleted.
                    </div>
                </div>
            </div>
        @else
            <div class="col-lg mb-2">
                @include('sales._character', ['character' => $character, 'loop' => $loop])
            </div>
        @endif
        {!! $loop->even ? '<div class="w-100"></div>' : '' !!}
    @endforeach
</div>

<div class="card mb-3">
    @endif
=======
@if($sales->characters()->count())
</div>

    <div class="row mb-2">
        @foreach($sales->characters as $character)
            <div class="col-lg mb-2">
                @include('sales._character', ['character' => $character, 'loop' => $loop])
            </div>
            {!! $loop->even ? '<div class="w-100"></div>' : '' !!}
        @endforeach
    </div>

<div class="card mb-3">
@endif
>>>>>>> Cylunny/extension/polls-and-forms

    <div class="card-body">
        <div class="parsed-text">
            {!! $sales->parsed_text !!}
        </div>
    </div>

<<<<<<< HEAD
    @if ((isset($sales->comments_open_at) && $sales->comments_open_at < Carbon\Carbon::now()) || (Auth::check() && (Auth::user()->hasPower('manage_sales') || Auth::user()->hasPower('comment_on_sales'))) || !isset($sales->comments_open_at))
        <?php $commentCount = App\Models\Comment\Comment::where('commentable_type', 'App\Models\Sales\Sales')
            ->where('commentable_id', $sales->id)
            ->count(); ?>
        @if (!$page)
            <div class="text-right mb-2 mr-2">
                <a class="btn" href="{{ $sales->url }}#commentsSection"><i class="fas fa-comment"></i> {{ $commentCount }} Comment{{ $commentCount != 1 ? 's' : '' }}</a>
            </div>
        @else
            <div class="text-right mb-2 mr-2">
                <a class="btn" href="#commentsSection"><i class="fas fa-comment"></i> {{ $commentCount }} Comment{{ $commentCount != 1 ? 's' : '' }}</a>
=======
    @if((isset($sales->comments_open_at) && $sales->comments_open_at < Carbon\Carbon::now() ||
    (Auth::check() && Auth::user()->hasPower('edit_pages'))) ||
    !isset($sales->comments_open_at))
        <?php $commentCount = App\Models\Comment::where('commentable_type', 'App\Models\Sales\Sales')->where('commentable_id', $sales->id)->count(); ?>
        @if(!$page)
            <div class="text-right mb-2 mr-2">
                <a class="btn" href="{{ $sales->url }}"><i class="fas fa-comment"></i> {{ $commentCount }} Comment{{ $commentCount != 1 ? 's' : ''}}</a>
            </div>
        @else
            <div class="text-right mb-2 mr-2">
                <span class="btn"><i class="fas fa-comment"></i> {{ $commentCount }} Comment{{ $commentCount != 1 ? 's' : ''}}</span>
>>>>>>> Cylunny/extension/polls-and-forms
            </div>
        @endif
    @endif
</div>
