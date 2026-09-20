@extends('character.layout', ['isMyo' => $character->is_myo_slot])

@section('profile-title')
    {{ $character->fullName }}
@endsection

@section('meta-img')
    {{ $character->image->thumbnailUrl }}
@endsection

@section('profile-content')
    @if ($character->is_myo_slot)
        {!! breadcrumbs(['MYO Slot Masterlist' => 'myos', $character->fullName => $character->url]) !!}
    @else
        {!! breadcrumbs([
            $character->category->masterlist_sub_id ? $character->category->sublist->name . ' Masterlist' : 'Character masterlist' => $character->category->masterlist_sub_id ? 'sublist/' . $character->category->sublist->key : 'masterlist',
            $character->fullName => $character->url,
        ]) !!}
    @endif

    @include('character._header', ['character' => $character])

    @if ($character->images()->where('is_valid', 1)->whereNotNull('transformation_id')->exists())
        <div class="card-header mb-2" style="background: none; background-color: rgba(0, 0, 0, 0) !important; border-bottom: none !important;">
            <ul class="nav nav-tabs card-header-tabs">
                @foreach ($character->images()->where('is_valid', 1)->get() as $image)
                    <li class="nav-item" style="margin: 0 5px 0 0;">
                        <a class="nav-link form-data-button {{ $image->id == $character->image->id ? 'active' : '' }}" data-toggle="tab" role="tab" data-id="{{ $image->id }}"
                            style="border-bottom-right-radius: .45rem; border-bottom-left-radius: .45rem; border-bottom: .5px solid rgba(255, 255, 255, 0.39);">
                            {{ $image->transformation_id ? $image->transformation->name : 'Main' }} {{ $image->transformation_info ? ' (' . $image->transformation_info . ')' : '' }}
                        </a>
                    </li>
                @endforeach
                <li>
                    <h3>{!! add_help('Click on a ' . __('transformations.transformation') . ' to view the image. If you don\'t see the ' . __('transformations.transformation') . ' you\'re looking for, it may not have been uploaded yet.') !!}</h3>
                </li>

                {{-- Right-aligned actions --}}
                <li class="ml-auto d-flex align-items-center">
                    @if ($character->is_visible && Auth::check() && $character->user_id != Auth::user()->id)
                        <?php $bookmark = Auth::user()->hasBookmarked($character); ?>
                        <a href="#" class="btn btn-info bookmark-button ml-2" data-id="{{ $bookmark ? $bookmark->id : 0 }}" data-character-id="{{ $character->id }}" style="color: #fff !important;">
                            <i class="fas fa-bookmark"></i> {{ $bookmark ? 'Edit Bookmark' : '' }}
                        </a>
                    @endif

                    @if (config('lorekeeper.extensions.character_TH_profile_link') && $character->profile->link)
                        <a class="btn btn-info ml-2" data-character-id="{{ $character->id }}" href="{{ $character->profile->link }}" style="color: #fff !important;"><i class="fas fa-home"></i></a>
                    @endif
                    @if (config('lorekeeper.extensions.character_status_badges'))
                        @if (!$character->is_myo_slot)
                            <span class="btn {{ $character->is_gift_art_allowed == 1 ? 'badge-success' : ($character->is_gift_art_allowed == 2 ? 'badge-warning text-light' : 'badge-danger') }} ml-2" data-toggle="tooltip"
                                title="{{ $character->is_gift_art_allowed == 1 ? 'OPEN for gift art.' : ($character->is_gift_art_allowed == 2 ? 'PLEASE ASK before gift art.' : 'CLOSED for gift art.') }}"><i class="fas fa-pencil-ruler"></i></span>
                            <span class="btn {{ $character->is_gift_writing_allowed == 1 ? 'badge-success' : ($character->is_gift_writing_allowed == 2 ? 'badge-warning text-light' : 'badge-danger') }} ml-2" data-toggle="tooltip"
                                title="{{ $character->is_gift_writing_allowed == 1 ? 'OPEN for gift writing.' : ($character->is_gift_writing_allowed == 2 ? 'PLEASE ASK before gift writing.' : 'CLOSED for gift writing.') }}"><i
                                    class="fas fa-file-alt"></i></span>
                        @endif
                        <span class="btn {{ $character->is_trading ? 'badge-success' : 'badge-danger' }} ml-2" data-toggle="tooltip" title="{{ $character->is_trading ? 'OPEN for sale and trade offers.' : 'CLOSED for sale and trade offers.' }}"><i
                                class="fas fa-comments-dollar"></i></span>
                    @endif
                </li>
            </ul>
        </div>
    @endif

    {{-- Main Image --}}
    <div class="row mb-3" id="main-tab">
        <div class="col-md-7">
            <div class="text-center">
                <a href="{{ $character->image->canViewFull(Auth::user() ?? null) && file_exists(public_path($character->image->imageDirectory . '/' . $character->image->fullsizeFileName)) ? $character->image->fullsizeUrl : $character->image->imageUrl }}"
                    data-lightbox="entry" data-title="{{ $character->fullName }}">
                    <img src="{{ $character->image->canViewFull(Auth::user() ?? null) && file_exists(public_path($character->image->imageDirectory . '/' . $character->image->fullsizeFileName)) ? $character->image->fullsizeUrl : $character->image->imageUrl }}"
                        class="image" alt="{{ $character->fullName }}" />
                </a>
            </div>
            @if ($character->image->canViewFull(Auth::user() ?? null) && file_exists(public_path($character->image->imageDirectory . '/' . $character->image->fullsizeFileName)))
                <div class="text-right">You are viewing the full-size image. <a href="{{ $character->image->imageUrl }}">View watermarked image</a>?</div>
            @endif
        </div>
        @include('character._image_info', ['image' => $character->image])
    </div>


    {{-- Character Items --}}
    <?php
        $defaultItems = ['pets', 'items', 'awards'];
        $defaultInfo  = ['profile', 'charInfo', 'skills'];
        $itemsOrder   = $character->profile->items_tab_order ?? $defaultItems;
        $infoOrder    = $character->profile->info_tab_order  ?? $defaultInfo;
        $itemsOrder   = array_values(array_unique(array_merge($itemsOrder, $defaultItems)));
        $infoOrder    = array_values(array_unique(array_merge($infoOrder,  $defaultInfo)));
        $itemLabels   = ['pets' => 'Pets', 'items' => 'Inventory', 'awards' => 'Badges'];
        $infoLabels   = ['profile' => 'Profile', 'charInfo' => 'Character Info', 'skills' => 'Skills'];
    ?>

    <div class="card character-bio mb-4">
        <div class="card-header" style="background: none;">
            <ul class="nav nav-tabs card-header-tabs">
                @foreach ($itemsOrder as $i => $key)
                    <li class="nav-item" style="margin: 0 5px 0 0;">
                        <a class="nav-link {{ $i === 0 ? 'active' : '' }}"
                        id="{{ $key }}Tab" data-toggle="tab" href="#{{ $key }}" role="tab">
                            {{ $itemLabels[$key] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="card-body tab-content">
            @foreach ($itemsOrder as $i => $key)
                <div class="tab-pane fade {{ $i === 0 ? 'show active' : '' }}" id="{{ $key }}">
                    @if ($key === 'pets')
                        @include('character._tab_pets', ['character' => $character, 'pets' => $pets])
                    @elseif ($key === 'items')
                        @include('character._tab_items', ['character' => $character, 'items' => $items])
                    @elseif ($key === 'awards')
                        @include('character._tab_awards', ['character' => $character, 'awards' => $awards])
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    {{-- Info+ --}}
    <div class="card character-bio mb-4">
        <div class="card-header" style="background: none;">
            <ul class="nav nav-tabs card-header-tabs">
                @foreach ($infoOrder as $i => $key)
                    <li class="nav-item" style="margin: 0 5px 0 0;">
                        <a class="nav-link {{ $i === 0 ? 'active' : '' }}"
                        id="{{ $key }}Tab" data-toggle="tab" href="#{{ $key }}" role="tab">
                            {{ $infoLabels[$key] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="card-body tab-content">
            @foreach ($infoOrder as $i => $key)
                <div class="tab-pane fade {{ $i === 0 ? 'show active' : '' }}" id="{{ $key }}">
                    @if ($key === 'profile')
                        @include('character._tab_profile', ['character' => $character, 'profile' => $profile])
                    @elseif ($key === 'charInfo')
                        @include('character._tab_charInfo', ['character' => $character, 'image' => $character->image, 'weapons' => $weapons, 'gear' => $gear])
                    @elseif ($key === 'skills')
                        @include('character._tab_skills', ['character' => $character, 'skills' => $skills])
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    {{-- Info --}}
    <div class="card character-bio">
        <div class="card-header" style="background: none;">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item" style="margin: 0 5px 0 0;">
                    <a class="nav-link active" id="statsTab" data-toggle="tab" href="#stats" role="tab">Stats</a>
                </li>
                <li class="nav-item" style="margin: 0 5px 0 0;">
                    <a class="nav-link" id="notesTab" data-toggle="tab" href="#notes" role="tab">Description</a>
                </li>
                @if (Auth::check() && Auth::user()->hasPower('manage_characters'))
                    <li class="nav-item" style="margin: 0 5px 0 0;">
                        <a class="nav-link" id="settingsTab" data-toggle="tab" href="#settings-{{ $character->slug }}" role="tab"><i class="fas fa-cog"></i></a>
                    </li>
                @endif
            </ul>
        </div>
        <div class="card-body tab-content">
            <div class="tab-pane fade show active" id="stats">
                @include('character._tab_stats', ['character' => $character])
            </div>
            <div class="tab-pane fade" id="notes">
                @include('character._tab_notes', ['character' => $character])
            </div>
            @if (Auth::check() && Auth::user()->hasPower('manage_characters'))
                <div class="tab-pane fade" id="settings-{{ $character->slug }}">
                    {!! Form::open(['url' => $character->is_myo_slot ? 'admin/myo/' . $character->id . '/settings' : 'admin/character/' . $character->slug . '/settings']) !!}
                    <div class="form-group">
                        {!! Form::checkbox('is_visible', 1, $character->is_visible, ['class' => 'form-check-input', 'data-toggle' => 'toggle']) !!}
                        {!! Form::label('is_visible', 'Is Visible', ['class' => 'form-check-label ml-3']) !!} {!! add_help('Turn this off to hide the character. Only mods with the Manage Masterlist power (that\'s you!) can view it - the owner will also not be able to see the character\'s page.') !!}
                    </div>
                    <div class="text-right">
                        {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                    <hr />
                    <div class="text-right">
                        <a href="#" class="btn btn-outline-danger btn-sm delete-character" data-slug="{{ $character->slug }}">Delete</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    @include('character._image_js', ['character' => $character])
    @include('character._transformation_js')
@endsection
