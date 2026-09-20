<<<<<<< HEAD
@if (!$stack)
    <div class="text-center">Invalid stack selected.</div>
@else
    <div class="text-center">
        <div class="mb-1"><a href="{{ $item->url }}"><img src="{{ $item->imageUrl }}" alt="{{ $item->name }}" /></a></div>
        <div @if (count($item->tags)) class="mb-1" @endif><a href="{{ $item->url }}">{{ $item->name }}</a></div>
    </div>

    <h5>Item Variations</h5>
    @if ($user && $user->hasPower('edit_inventories'))
        <p class="alert alert-warning my-2">Note: Your rank allows you to transfer character-bound items.</p>
    @endif

    {!! Form::open(['url' => 'character/' . $character->slug . '/inventory/edit']) !!}
=======
@if(!$stack)
    <div class="text-center">Invalid stack selected.</div>
@else
    <div class="text-center">
        <div class="mb-1"><a href="{{ $item->url }}"><img src="{{ $item->imageUrl }}" alt="{{ $item->name }}"/></a></div>
        <div @if(count($item->tags)) class="mb-1" @endif><a href="{{ $item->url }}">{{ $item->name }}</a></div>
    </div>

    <h5>Item Variations</h5>
    @if($user && $user->hasPower('edit_inventories'))
        <p class="alert alert-warning my-2">Note: Your rank allows you to transfer character-bound items.</p>
    @endif

    {!! Form::open(['url' => 'character/'.$character->slug.'/inventory/edit']) !!}
>>>>>>> Cylunny/extension/polls-and-forms
    <div class="card" style="border: 0px">
        <table class="table table-sm">
            <thead class="thead">
                <tr class="d-flex">
<<<<<<< HEAD
                    @if ($user && !$readOnly && ($owner_id == $user->id || $has_power == true))
                        <th class="col-1"><input id="toggle-checks" type="checkbox" onclick="toggleChecks(this)"></th>
                    @endif
                    @if ($item->category->can_name)
=======
                    @if($user && !$readOnly &&
                    ($owner_id == $user->id || $has_power == TRUE))
                        <th class="col-1"><input id="toggle-checks" type="checkbox" onclick="toggleChecks(this)"></th>
                    @endif
                    @if($item->category->can_name)
>>>>>>> Cylunny/extension/polls-and-forms
                        <th class="col-2">Name</th>
                    @endif
                    <th class="col">Source</th>
                    <th class="col">Notes</th>
                    <th class="col-2">Quantity</th>
                    <th class="col-1"><i class="fas fa-lock invisible"></i></th>
                </tr>
            </thead>
            <tbody>
<<<<<<< HEAD
                @foreach ($stack as $itemRow)
                    <tr id="itemRow{{ $itemRow->id }}" class="d-flex {{ $itemRow->isTransferrable ? '' : 'accountbound' }}">
                        @if ($user && !$readOnly && ($owner_id == $user->id || $has_power == true))
                            <td class="col-1">{!! Form::checkbox('ids[]', $itemRow->id, false, ['class' => 'item-check', 'onclick' => 'updateQuantities(this)']) !!}</td>
                        @endif
                        @if ($item->category->can_name)
                            <td class="col-2">{!! htmlentities($itemRow->stack_name) ?: 'N/A' !!}</td>
                        @endif
                        <td class="col">{!! array_key_exists('data', $itemRow->data) ? ($itemRow->data['data'] ? $itemRow->data['data'] : 'N/A') : 'N/A' !!}</td>
                        <td class="col">{!! array_key_exists('notes', $itemRow->data) ? ($itemRow->data['notes'] ? $itemRow->data['notes'] : 'N/A') : 'N/A' !!}</td>
                        @if ($user && !$readOnly && ($owner_id == $user->id || $has_power == true))
                            @if ($itemRow->availableQuantity)
=======
                @foreach($stack as $itemRow)
                    <tr id ="itemRow{{ $itemRow->id }}" class="d-flex {{ $itemRow->isTransferrable ? '' : 'accountbound' }}">
                        @if($user && !$readOnly && ($owner_id == $user->id || $has_power == TRUE))
                            <td class="col-1">{!! Form::checkbox('ids[]', $itemRow->id, false, ['class' => 'item-check', 'onclick' => 'updateQuantities(this)']) !!}</td>
                        @endif
                        @if($item->category->can_name)
                            <td class="col-2">{!! htmlentities($itemRow->stack_name) ? : 'N/A' !!}</td>
                        @endif
                        <td class="col">{!! array_key_exists('data', $itemRow->data) ? ($itemRow->data['data'] ? $itemRow->data['data'] : 'N/A') : 'N/A' !!}</td>
                        <td class="col">{!! array_key_exists('notes', $itemRow->data) ? ($itemRow->data['notes'] ? $itemRow->data['notes'] : 'N/A') : 'N/A' !!}</td>
                        @if($user && !$readOnly && ($owner_id == $user->id || $has_power == TRUE))
                            @if($itemRow->availableQuantity)
>>>>>>> Cylunny/extension/polls-and-forms
                                <td class="col-2">{!! Form::selectRange('', 1, $itemRow->availableQuantity, 1, ['class' => 'quantity-select', 'type' => 'number', 'style' => 'min-width:40px;']) !!} /{{ $itemRow->availableQuantity }}</td>
                            @else
                                <td class="col-2">{!! Form::selectRange('', 0, 0, 0, ['class' => 'quantity-select', 'type' => 'number', 'style' => 'min-width:40px;', 'disabled']) !!} /{{ $itemRow->availableQuantity }}</td>
                            @endif
                        @else
                            <td class="col-3">{!! $itemRow->count !!}</td>
                        @endif
                        <td class="col-1">
<<<<<<< HEAD
                            @if (!$itemRow->isTransferrable)
=======
                            @if(!$itemRow->isTransferrable)
>>>>>>> Cylunny/extension/polls-and-forms
                                <i class="fas fa-lock" data-toggle="tooltip" title="Character-bound items cannot be transferred but can be deleted."></i>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

<<<<<<< HEAD
    @if ($user && !$readOnly && ($owner_id == $user->id || $has_power == true))
        <div class="card mt-3">
            <ul class="list-group list-group-flush">
                @if ($item->category->can_name)
                    <li class="list-group-item">
                        <a class="card-title h5 collapse-title" data-toggle="collapse" href="#nameForm">
                            @if ($owner_id != $user->id)
                                [ADMIN]
                            @endif Name Item
                        </a>
                        <div id="nameForm" class="collapse">
                            <p>Enter a name to display for the selected stack(s)! Note that only one of the stacks' names will display on the inventory page and title of this panel, while other stacks' names will appear in the list above.</p>
                            {!! Form::open() !!}
=======
    @if($user && !$readOnly &&
        ($owner_id == $user->id || $has_power == TRUE))
        <div class="card mt-3">
            <ul class="list-group list-group-flush">
                @if($item->category->can_name)
                <li class="list-group-item">
                    <a class="card-title h5 collapse-title" data-toggle="collapse" href="#nameForm">@if($owner_id != $user->id) [ADMIN] @endif Name Item</a>
                    <div id="nameForm" class="collapse">
                        <p>Enter a name to display for the selected stack(s)! Note that only one of the stacks' names will display on the inventory page and title of this panel, while other stacks' names will appear in the list above.</p>
                        {!! Form::open() !!}
>>>>>>> Cylunny/extension/polls-and-forms
                            <div class="form-group">
                                {!! Form::text('stack_name', null, ['class' => 'form-control stock-field', 'data-name' => 'stack_name']) !!}
                            </div>
                            <div class="text-right">
                                {!! Form::button('Submit', ['class' => 'btn btn-primary', 'name' => 'action', 'value' => 'name', 'type' => 'submit']) !!}
                            </div>
<<<<<<< HEAD
                            {!! Form::close() !!}
                        </div>
                    </li>
                @endif
                @if ($owner_id != null)
                    <li class="list-group-item">
                        <a class="card-title h5 collapse-title" data-toggle="collapse" href="#transferForm">
                            @if ($owner_id != $user->id)
                                [ADMIN]
                            @endif Transfer Item
                        </a>
                        <div id="transferForm" class="collapse">
                            <p>This will transfer this item back to @if ($owner_id != $user->id)
                                    this user's
                                @else
                                    your
                                @endif inventory.</p>
                            <div class="text-right">
                                {!! Form::button('Transfer', ['class' => 'btn btn-primary', 'name' => 'action', 'value' => 'take', 'type' => 'submit']) !!}
                            </div>
                        </div>
                    </li>
                @endif
                @if ($item->is_deletable || $user->hasPower('edit_inventories'))
                    <li class="list-group-item">
                        <a class="card-title h5 collapse-title" data-toggle="collapse" href="#deleteForm">
                            @if ($owner_id != $user->id || !$item->is_deletable)
                                [ADMIN]
                            @endif Delete Item
                        </a>
                        <div id="deleteForm" class="collapse">
                            <p>This action is not reversible. Are you sure you want to delete this item?</p>
                            <div class="text-right">
                                {!! Form::button('Delete', ['class' => 'btn btn-danger', 'name' => 'action', 'value' => 'delete', 'type' => 'submit']) !!}
                            </div>
                        </div>
                    </li>
                @endif
=======
                        {!! Form::close() !!}
                </div>
                </li>
                @endif
                @if($owner_id != null)
                <li class="list-group-item">
                    <a class="card-title h5 collapse-title" data-toggle="collapse" href="#transferForm">@if($owner_id != $user->id) [ADMIN] @endif Transfer Item</a>
                    <div id="transferForm" class="collapse">
                        <p>This will transfer this item back to @if($owner_id != $user->id) this user's @else your @endif inventory.</p>
                        <div class="text-right">
                            {!! Form::button('Transfer', ['class' => 'btn btn-primary', 'name' => 'action', 'value' => 'take', 'type' => 'submit']) !!}
                        </div>
                </div>
                </li>
                @endif
                <li class="list-group-item">
                    <a class="card-title h5 collapse-title" data-toggle="collapse" href="#deleteForm">@if($owner_id != $user->id) [ADMIN] @endif Delete Item</a>
                    <div id="deleteForm" class="collapse">
                        <p>This action is not reversible. Are you sure you want to delete this item?</p>
                        <div class="text-right">
                            {!! Form::button('Delete', ['class' => 'btn btn-danger', 'name' => 'action', 'value' => 'delete', 'type' => 'submit']) !!}
                        </div>
                    </div>
                </li>
>>>>>>> Cylunny/extension/polls-and-forms
            </ul>
        </div>
    @endif
    {!! Form::close() !!}
@endif

<script>
    $(document).keydown(function(e) {
<<<<<<< HEAD
        var code = e.keyCode || e.which;
        if (code == 13)
            return false;
    });

=======
    var code = e.keyCode || e.which;
    if(code == 13)
        return false;
    });
>>>>>>> Cylunny/extension/polls-and-forms
    function toggleChecks($toggle) {
        $.each($('.item-check'), function(index, checkbox) {
            $toggle.checked ? checkbox.setAttribute('checked', 'checked') : checkbox.removeAttribute('checked');
            updateQuantities(checkbox);
        });
    }
<<<<<<< HEAD

=======
>>>>>>> Cylunny/extension/polls-and-forms
    function updateQuantities($checkbox) {
        var $rowId = "#itemRow" + $checkbox.value
        $($rowId).find('.quantity-select').prop('name', $checkbox.checked ? 'quantities[]' : '')
    }
</script>
<<<<<<< HEAD
=======

>>>>>>> Cylunny/extension/polls-and-forms
