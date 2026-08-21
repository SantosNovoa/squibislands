@extends('character.layout', ['isMyo' => $character->is_myo_slot])

@section('profile-title')
    Editing {{ $character->fullName }}'s Tab Order
@endsection

@section('meta-img')
    {{ $character->image->thumbnailUrl }}
@endsection

@section('profile-content')
    @if ($character->is_myo_slot)
        {!! breadcrumbs(['MYO Slot Masterlist' => 'myos', $character->fullName => $character->url, 'Tab Order' => $character->url . '/tab-order']) !!}
    @else
        {!! breadcrumbs([
            $character->category->masterlist_sub_id ? $character->category->sublist->name . ' Masterlist' : 'Character masterlist' => $character->category->masterlist_sub_id ? 'sublist/' . $character->category->sublist->key : 'masterlist',
            $character->fullName => $character->url,
            'Tab Order' => $character->url . '/tab-order',
        ]) !!}
    @endif

    @include('character._header', ['character' => $character])

    <h5>Items Tab Order</h5>
    <p>Drag to reorder the tabs in the Items card.</p>
    <table class="table table-sm">
        <tbody id="itemsSortable" class="sortable">
            @foreach ($itemsOrder as $key)
                <tr class="sort-item" data-id="{{ $key }}">
                    <td>
                        <a class="fas fa-arrows-alt-v handle mr-3" href="#"></a>
                        {{ $itemLabels[$key] }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mb-4">
        {!! Form::open(['url' => $character->url . '/tab-order']) !!}
        {!! Form::hidden('type', 'items') !!}
        {!! Form::hidden('items_tab_order', implode(',', $itemsOrder), ['id' => 'itemsSortableOrder']) !!}
        {!! Form::submit('Save Items Order', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>

    <h5>Information Tab Order</h5>
    <p>Drag to reorder the tabs in the Info card.</p>
    <table class="table table-sm">
        <tbody id="infoSortable" class="sortable">
            @foreach ($infoOrder as $key)
                <tr class="sort-item" data-id="{{ $key }}">
                    <td>
                        <a class="fas fa-arrows-alt-v handle mr-3" href="#"></a>
                        {{ $infoLabels[$key] }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mb-4">
        {!! Form::open(['url' => $character->url . '/tab-order']) !!}
        {!! Form::hidden('type', 'info') !!}
        {!! Form::hidden('info_tab_order', implode(',', $infoOrder), ['id' => 'infoSortableOrder']) !!}
        {!! Form::submit('Save Info Order', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            $('.handle').on('click', function(e) {
                e.preventDefault();
            });

            $("#itemsSortable").sortable({
                items: '.sort-item',
                handle: '.handle',
                placeholder: 'sortable-placeholder',
                stop: function(event, ui) {
                    $('#itemsSortableOrder').val(
                        $(this).sortable('toArray', { attribute: 'data-id' }).join(',')
                    );
                }
            });
            $("#itemsSortable").disableSelection();

            $("#infoSortable").sortable({
                items: '.sort-item',
                handle: '.handle',
                placeholder: 'sortable-placeholder',
                stop: function(event, ui) {
                    $('#infoSortableOrder').val(
                        $(this).sortable('toArray', { attribute: 'data-id' }).join(',')
                    );
                }
            });
            $("#infoSortable").disableSelection();
        });
    </script>
@endsection