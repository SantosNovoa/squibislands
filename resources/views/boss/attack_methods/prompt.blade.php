
@if (!$boss->getAttackMethodInformation('prompt'))
    <div class="alert alert-danger">Attack method not available.</div>
@else
    @php
        $data = $boss->getAttackMethodInformation('prompt');
    @endphp

    <p class="mb-0">The following prompts are available for you to complete:</p>
    @if (isset($data['prompt_ids']) && in_array('any', $data['prompt_ids']))
        <p class="mb-0 text-info">Complete any prompt to attack this boss.</p>
    @else
        @php $prompts = \App\Models\Prompt\Prompt::whereIn('id', $data['prompt_ids'] ?? [])->orWhere('prompt_category_id', $data['prompt_category_ids'])->get(); @endphp
        <ul class="mb-0">
            @foreach ($prompts as $prompt)
                <li>
                    <a href="{{ url('prompt/' . $prompt->id) }}">{!! $prompt->displayName !!}</a>
                </li>
            @endforeach
        </ul>
    @endif
@endif