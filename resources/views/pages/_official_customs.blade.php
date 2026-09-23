@php
    $customArtists = \App\Models\CustomArtist\CustomArtistProfile::visibleOnPage();
@endphp

@if ($customArtists->count())
    <div class="official-customs mt-4">
        @foreach ($customArtists as $profile)
            <div class="card mb-4">
                <div class="card-header">
                    <h2 class="mb-0">{!! $profile->user->displayName !!}</h2>
                </div>
                <div class="card-body">
                    @foreach ($profile->openTypes() as $key => $label)
                        <h4>{{ $label }}s <span class="badge badge-success">Open</span></h4>
                        <table class="table table-sm mb-3">
                            <tbody>
                                @foreach ($profile->activeOptions($key) as $option)
                                    <tr>
                                        <td>{{ $option->name }}</td>
                                        <td class="text-right">{!! $option->displayPrice !!}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach

                    @if (!empty($profile->contacts))
                        <h4>Contact Me</h4>
                        <ul class="mb-3">
                            @foreach ($profile->contacts as $contact)
                                <li>
                                    <strong>{{ $contact['site'] }}:</strong>
                                    <a href="{{ $contact['url'] }}" target="_blank" rel="noopener noreferrer">{{ $contact['url'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    @if ($profile->parsed_notes)
                        <h5>Important Notes</h5>
                        <div>{!! $profile->parsed_notes !!}</div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endif