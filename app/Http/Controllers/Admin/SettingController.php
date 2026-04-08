<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::orderBy('key')->get();
        return view('admin.settings.index', compact('settings'));
    }

    public function create()
    {
        return view('admin.settings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'key'   => ['required', 'unique:settings,key'],
            'value' => ['nullable'],
        ]);

        Setting::create(['key' => $request->key, 'value' => $request->value]);
        return redirect()->route('admin.settings.index')->with('success', 'Setting created.');
    }

    public function edit(Setting $setting)
    {
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request, Setting $setting)
    {
        $request->validate(['value' => ['nullable']]);
        $setting->update(['value' => $request->value]);
        return redirect()->route('admin.settings.index')->with('success', 'Setting updated.');
    }

    public function destroy(Setting $setting)
    {
        $setting->delete();
        return redirect()->route('admin.settings.index')->with('success', 'Setting deleted.');
    }

    public function bulkUpdate(Request $request)
    {
        foreach ($request->settings ?? [] as $id => $value) {
            Setting::where('id', $id)->update(['value' => $value]);
        }
        return redirect()->route('admin.settings.index')->with('success', 'Settings saved.');
    }
}
