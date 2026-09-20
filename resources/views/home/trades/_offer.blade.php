<<<<<<< HEAD
<h2>
    {!! $user->displayName !!}'s Offer
    <span class="float-right">
        @if (Auth::user()->id == $user->id && $trade->status == 'Open')
            @if ($trade->{'is_' . $type . '_confirmed'})
                <a href="#" class="btn btn-sm btn-outline-danger" id="confirmOfferButton" data-toggle="tooltip"
                    title="This will unconfirm your offer and allow you to edit it. You will need to reconfirm your offer after you have edited it to proceed.">Unconfirm</a>
            @else
                <a href="{{ url('trades/' . $trade->id . '/edit') }}" class="btn btn-sm btn-primary">Edit</a> <a href="#" class="btn btn-sm btn-outline-primary" id="confirmOfferButton">Confirm</a>
            @endif
        @else
            @if ($trade->{'is_' . $type . '_confirmed'})
                @if ($trade->{'is_' . $type . '_trade_confirmed'})
                    <small class="text-success">{!! add_help($user->name . ' has reviewed your offer and confirmed the trade.') !!} Trade Confirmed</small>
=======

<h2>
    {!! $user->displayName !!}'s Offer
    <span class="float-right">
        @if(Auth::user()->id == $user->id && $trade->status == 'Open')
            @if($trade->{'is_'.$type.'_confirmed'})
                <a href="#" class="btn btn-sm btn-outline-danger" id="confirmOfferButton" data-toggle="tooltip" title="This will unconfirm your offer and allow you to edit it. You will need to reconfirm your offer after you have edited it to proceed.">Unconfirm</a>
            @else
                <a href="{{ url('trades/'.$trade->id.'/edit') }}" class="btn btn-sm btn-primary">Edit</a> <a href="#" class="btn btn-sm btn-outline-primary" id="confirmOfferButton">Confirm</a>
            @endif
        @else
            @if($trade->{'is_'.$type.'_confirmed'})
                @if($trade->{'is_'.$type.'_trade_confirmed'})
                    <small class="text-success">{!! add_help($user->name.' has reviewed your offer and confirmed the trade.') !!} Trade Confirmed</small>
>>>>>>> Cylunny/extension/polls-and-forms
                @else
                    <small class="text-primary">{!! add_help('This offer has been confirmed.') !!} Offer Confirmed</small>
                @endif
            @else
                <small class="text-muted">{!! add_help('This offer has yet to be confirmed.') !!} Pending</small>
            @endif
        @endif
    </span>
</h2>
<div class="card mb-3 trade-offer
<<<<<<< HEAD
        @if ($trade->{'is_' . $type . '_confirmed'}) @if ($trade->{'is_' . $type . '_trade_confirmed'})
                border-success
            @else
                border-primary @endif
        @endif
">
    @if ($data)
        @if ($data['user_items'])
=======
        @if($trade->{'is_'.$type.'_confirmed'})
            @if($trade->{'is_'.$type.'_trade_confirmed'})
                border-success
            @else
                border-primary
            @endif
        @endif
">  @if($data)
        @if($data['user_items'])
>>>>>>> Cylunny/extension/polls-and-forms
            <div class="card-header">
                Items
            </div>
            <div class="card-body user-items">
                <table class="table table-sm">
                    <thead class="thead-light">
                        <tr class="d-flex">
                            <th class="col-2">Item</th>
                            <th class="col-4">Source</th>
                            <th class="col-4">Notes</th>
                            <th class="col-2">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
<<<<<<< HEAD
                        @foreach ($data['user_items'] as $itemRow)
                            <tr class="d-flex">
                                <td class="col-2">
                                    @if (isset($items[$itemRow['asset']->item_id]->image_url))
                                        <img class="small-icon" src="{{ $items[$itemRow['asset']->item_id]->image_url }}" alt="{{ $items[$itemRow['asset']->item_id]->name }}">
                                    @endif {!! $items[$itemRow['asset']->item_id]->name !!}
=======
                        @foreach($data['user_items'] as $itemRow)
                            <tr class="d-flex">
                                <td class="col-2">@if(isset($items[$itemRow['asset']->item_id]->image_url)) <img class="small-icon" src="{{ $items[$itemRow['asset']->item_id]->image_url }}" alt="{{ $items[$itemRow['asset']->item_id]->name }}" > @endif {!! $items[$itemRow['asset']->item_id]->name !!}
>>>>>>> Cylunny/extension/polls-and-forms
                                <td class="col-4">{!! array_key_exists('data', $itemRow['asset']->data) ? ($itemRow['asset']->data['data'] ? $itemRow['asset']->data['data'] : 'N/A') : 'N/A' !!}</td>
                                <td class="col-4">{!! array_key_exists('notes', $itemRow['asset']->data) ? ($itemRow['asset']->data['notes'] ? $itemRow['asset']->data['notes'] : 'N/A') : 'N/A' !!}</td>
                                <td class="col-2">{!! $itemRow['quantity'] !!}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
<<<<<<< HEAD
        @if ($data['characters'])
=======
        @if($data['characters'])
>>>>>>> Cylunny/extension/polls-and-forms
            <div class="card-header border-top">
                Characters
            </div>
            <div class="card-body">
                <div class="row">
<<<<<<< HEAD
                    @foreach ($data['characters'] as $character)
=======
                    @foreach($data['characters'] as $character)
>>>>>>> Cylunny/extension/polls-and-forms
                        <div class="col-lg-2 col-sm-3 col-6 mb-3">
                            <div class="text-center inventory-item">
                                <div class="mb-1">
                                    <a class="inventory-stack"><img src="{{ $character['asset']->image->thumbnailUrl }}" class="img-thumbnail" alt="Thumbnail for {{ $character['asset']->fullName }}" /></a>
                                </div>
                                <div>
                                    <a class="inventory-stack inventory-stack-name">{!! $character['asset']->displayName !!}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
<<<<<<< HEAD
        @if ($data['currencies'])
=======
        @if($data['currencies'])
>>>>>>> Cylunny/extension/polls-and-forms
            <div class="card-header border-top border-bottom-0">
                Currencies
            </div>
            <ul class="list-group list-group-flush">
<<<<<<< HEAD
                @foreach ($data['currencies'] as $currency)
=======
                @foreach($data['currencies'] as $currency)
>>>>>>> Cylunny/extension/polls-and-forms
                    <li class="list-group-item border-bottom-0 border-top currency-item">
                        {!! $currency['asset']->display($currency['quantity']) !!}
                    </li>
                @endforeach
            </ul>
        @endif
<<<<<<< HEAD
        @if (!$data['user_items'] && !$data['currencies'] && !$data['characters'])
=======
        @if(!$data['user_items'] && !$data['currencies'] && !$data['characters'])
>>>>>>> Cylunny/extension/polls-and-forms
            <div class="card-body">{!! $user->displayName !!} has not added anything to their offer.</div>
        @endif
    @else
        <div class="card-body">{!! $user->displayName !!} has not added anything to their offer.</div>
    @endif
</div>
