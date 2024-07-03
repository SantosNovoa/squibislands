{{-- General template for attack methods --}}
<div class="card mb-3">
    <div class="card-header h5">
        {{ config('lorekeeper.boss_settings.methods.' . $attackMethod . '.name') }}
    </div>
    <div class="card-body">
        <div class="mb-2">{{ config('lorekeeper.boss_settings.methods.' . $attackMethod . '.description') }}</div>
        @include('boss.attack_methods.' . $attackMethod, ['boss' => $boss])
    </div>
</div>
