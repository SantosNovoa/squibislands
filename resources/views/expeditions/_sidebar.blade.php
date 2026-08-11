<ul>
    <li class="sidebar-header"><a href="{{ url('expeditions') }}" class="card-link">Expeditions</a></li>

    <li class="sidebar-section">
        <div class="sidebar-item"><a href="{{ url('expeditions/my') }}" class="{{ set_active('expeditions/my') }}">My Expeditions</a></div>
        @foreach($expeditions as $expedition)
        <div class="sidebar-item"><a href="{{ $expedition->url }}" class="{{ set_active('expeditions/'.$expedition->id) }}">{{ $expedition->name }}</a></div>
        @endforeach
    </li>
</ul>