<tr>
<<<<<<< HEAD
    @if ($submission->prompt_id)
=======
    @if($submission->prompt_id)
>>>>>>> Cylunny/extension/polls-and-forms
        <td>{!! $submission->prompt->displayName !!}</td>
    @endif
    <td class="text-break"><a href="{{ $submission->url }}">{{ $submission->url }}</a></td>
    <td>{!! format_date($submission->created_at) !!}</td>
    <td>
        <span class="badge badge-{{ $submission->status == 'Pending' ? 'secondary' : ($submission->status == 'Approved' ? 'success' : 'danger') }}">{{ $submission->status }}</span>
    </td>
    <td class="text-right"><a href="{{ $submission->viewUrl }}" class="btn btn-primary btn-sm">Details</a></td>
<<<<<<< HEAD
</tr>
=======
</tr>
>>>>>>> Cylunny/extension/polls-and-forms
