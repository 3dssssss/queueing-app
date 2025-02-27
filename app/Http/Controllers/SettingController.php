<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function settings()
{
    $settings = Setting::first();
    return view('admin.queue.create.config', compact('settings'));
}

public function updateSettings(Request $request)
{
    $request->validate([
        'ticket_expiration_minutes' => 'required|integer|min:1',
    ]);

    $settings = Setting::first();

    if ($settings) {
        $settings->update(['ticket_expiration_minutes' => $request->ticket_expiration_minutes]);
    } else {
        Setting::create(['ticket_expiration_minutes' => $request->ticket_expiration_minutes]);
    }

    return back()->with('success', 'Settings updated successfully!');
}

}
