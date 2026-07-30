<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Character\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Settings;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FeaturedCharacterController extends Controller {
    
    public function getIndex() {
        $currentId = Settings::get('featured_character');
        $character = $currentId ? Character::find($currentId) : null;
        
        return view('admin.featured_character', [
            'character' => $character,
            'characters' => Character::myo(0)->visible()->orderBy('slug')->pluck('slug', 'id'),
        ]);
    }

    public function notifyDiscordFeaturedCharacter($character) {
        $webhookUrl = config('app.discord_webhook_url');
        if (!$webhookUrl) return;

        try {
            Http::post($webhookUrl, [
                'embeds' => [[
                    'title'       => 'Weekly Wavemaker Updated',
                    'url'         => $character->url,
                    'description' => '**' . ($character->fullName ?? $character->slug) . '** is now the weekly wavemaker!',
                    'color'       => 0x2179e0,
                    'image'       => [
                        'url' => asset($character->image->thumbnailUrl),
                    ],
                    'timestamp'   => now()->toIso8601String(),
                ]],
            ]);
        } catch (\Exception $e) {
            Log::warning('Discord featured character webhook failed: ' . $e->getMessage());
        }
    }

    public function postChange() {
        $currentId = Settings::get('featured_character');
        
        $newCharacter = Character::myo(0)->visible()
            ->where('id', '!=', $currentId)
            ->inRandomOrder()
            ->first();
        
        if ($newCharacter) {
            DB::table('site_settings')->where('key', 'featured_character')->update(['value' => $newCharacter->id]);
            $this->notifyDiscordFeaturedCharacter($newCharacter);
            flash('Featured character changed to ' . $newCharacter->fullName)->success();
        } else {
            flash('No other characters available.')->error();
        }
        
        return redirect()->back();
    }

    public function postSet(Request $request) {
        $request->validate(['character_id' => 'required|exists:characters,id']);
        
        DB::table('site_settings')->where('key', 'featured_character')->update(['value' => $request->get('character_id')]);
        $character = Character::find($request->get('character_id'));

        $this->notifyDiscordFeaturedCharacter($character);
        flash('Featured character set to ' . $character->fullName)->success();
        return redirect()->back();
    }
}