<div class="transfer-row mb-2">
<<<<<<< HEAD
    @if ($transfer->character)
        <div class="transfer-thumbnail"><a href="{{ $transfer->character->url }}"><img src="{{ $transfer->character->image->thumbnailUrl }}" class="img-thumbnail" alt="Thumbnail for {{ $transfer->character->fullName }}" /></a></div>
    @endif
    <div class="transfer-info card ml-2">
        <div class="card-body">
            <div class="transfer-info-content">
                @if ($transfer->character)
                    <h3 class="mb-0 transfer-info-header"><a href="{{ $transfer->character->url }}">{{ $transfer->character->fullName }}</a></h3>
                @else
                    <h3 class="mb-0 transfer-info-header">Character Deleted</h3>
                @endif
                <div class="transfer-info-body mb-3">
                    <p>Transfer from {!! $transfer->sender->displayName !!} to {!! $transfer->recipient->displayName !!}, {!! format_date($transfer->created_at) !!}</p>
                    <p>Reason stated: {!! $transfer->user_reason !!}</p>
                    @if ($transfer->isActive && $transfersQueue)
                        @if ($transfer->is_approved)
=======
    <div class="transfer-thumbnail"><a href="{{ $transfer->character->url }}"><img src="{{ $transfer->character->image->thumbnailUrl }}" class="img-thumbnail" alt="Thumbnail for {{ $transfer->character->fullName }}" /></a></div>
    <div class="transfer-info card ml-2">
        <div class="card-body">
            <div class="transfer-info-content">
                <h3 class="mb-0 transfer-info-header"><a href="{{ $transfer->character->url }}">{{ $transfer->character->fullName }}</a></h3>
                <div class="transfer-info-body mb-3">
                    <p>Transfer from {!! $transfer->sender->displayName !!} to {!! $transfer->recipient->displayName !!}, {!! format_date($transfer->created_at) !!}</p>
                    <p>Reason stated: {!! $transfer->user_reason !!}</p>
                    @if($transfer->isActive && $transfersQueue)
                        @if($transfer->is_approved)
>>>>>>> Cylunny/extension/polls-and-forms
                            <h5 class="mb-0"><i class="text-success far fa-circle fa-fw mr-2"></i> Transfer approved {!! add_help('This transfer has been approved by a mod and will be processed once accepted.') !!}</h5>
                        @else
                            <h5 class="mb-0"><i class="text-danger fas fa-times fa-fw mr-2"></i> Transfer awaiting approval {!! add_help('This transfer has not been approved by a mod yet. Once approved and accepted by the recipient, it will be processed.') !!}</h5>
                        @endif
                    @elseif(!$transfer->isActive)
<<<<<<< HEAD
                        @if ($transfer->reason)
=======
                        @if($transfer->reason)
>>>>>>> Cylunny/extension/polls-and-forms
                            <div class="alert alert-danger mb-0">{{ $transfer->reason }}</div>
                        @endif
                    @endif
                </div>
                <div class="transfer-info-footer">
<<<<<<< HEAD
                    @if ($transfer->isActive)
                        @if (!$transfer->is_approved)
=======
                    @if($transfer->isActive)
                        @if(!$transfer->is_approved)
>>>>>>> Cylunny/extension/polls-and-forms
                            <div class="text-right">
                                <a href="#" class="btn btn-outline-success transfer-action-button" data-id="{{ $transfer->id }}" data-action="approve">Approve</a>
                                <a href="#" class="btn btn-outline-danger transfer-action-button" data-id="{{ $transfer->id }}" data-action="reject">Reject</a>
                            </div>
                        @else
                            Currently awaiting mod approval
                        @endif
                    @else
                        <h2 class="text-right mb-0">
<<<<<<< HEAD
                            @if ($transfer->status == 'Accepted')
=======
                            @if($transfer->status == 'Accepted')
>>>>>>> Cylunny/extension/polls-and-forms
                                <span class="badge badge-success">Accepted</span>
                            @elseif($transfer->status == 'Rejected')
                                <span class="badge badge-danger">Rejected</span>
                            @elseif($transfer->status == 'Canceled')
                                <span class="badge badge-secondary">Canceled</span>
                            @endif
                        </h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
