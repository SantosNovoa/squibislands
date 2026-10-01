@if (!$boss->getAttackMethodInformation('prompt'))
    <div class="alert alert-danger">Attack method not available.</div>
@else
    @php
        $data = $boss->getAttackMethodInformation('prompt');

        // Strip 'any' and blank placeholder values before querying
        $promptIds = array_filter((array) ($data['prompt_ids'] ?? []), function ($id) {
            return $id !== 'any' && $id !== '' && $id !== null;
        });
        $categoryIds = array_filter((array) ($data['prompt_category_ids'] ?? []), function ($id) {
            return $id !== '' && $id !== null;
        });
    @endphp

    <p class="mb-0">The following prompts are available for you to complete:</p>
    @if (isset($data['prompt_ids']) && in_array('any', (array) $data['prompt_ids']))
        <p class="mb-0 text-info">Complete any prompt to attack this boss.</p>
    @else
        @php
            $prompts = \App\Models\Prompt\Prompt::active()
                ->staffOnly(Auth::user())
                ->where(function ($query) use ($promptIds, $categoryIds) {
                    // grouped so the OR doesn't bypass the active() filter
                    $query->whereIn('id', $promptIds)
                        ->orWhereIn('prompt_category_id', $categoryIds);
                })
                ->orderBy('name')
                ->get();
        @endphp
        @if ($prompts->isEmpty())
            <p class="mb-0 text-muted">There are no prompts available for this boss right now.</p>
        @else
            <ul class="mb-0">
                @foreach ($prompts as $prompt)
                    <li>
                        <a href="{{ url('prompt/' . $prompt->id) }}">{!! $prompt->displayName !!}</a>
                    </li>
                @endforeach
            </ul>
        @endif
    @endif
@endif