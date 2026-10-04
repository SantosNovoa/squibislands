<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteLink;
use Illuminate\Http\Request;

class DiscordLinkController extends Controller
{
    /**
     * Shows the Discord link edit page.
     */
    public function getIndex()
    {
        return view('admin.discord_link', [
            'url' => SiteLink::url('discord'),
        ]);
    }

    /**
     * Updates the Discord link.
     */
    public function postEdit(Request $request)
    {
        $data = $request->validate([
            'url' => 'required|url|starts_with:https://discord.gg/,https://discord.com/invite/',
        ]);

        SiteLink::setUrl('discord', $data['url']);
        flash('Discord link updated successfully.')->success();

        return redirect()->back();
    }
}