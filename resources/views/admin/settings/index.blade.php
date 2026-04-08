@extends('admin.layouts.app')

@section('title', 'Settings')
@section('page-title', 'Settings')
@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Admin</a> / Settings
@endsection

@section('content')
<div style="display:grid;gap:1.5rem;grid-template-columns:1fr 340px;align-items:start">

    {{-- Bulk edit card --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">Site Settings</span>
        </div>
        <div class="card-body">
            @if($settings->isEmpty())
                <p style="color:var(--muted);text-align:center;padding:1rem 0">No settings yet. Add one using the form →</p>
            @else
                {{-- Delete forms live OUTSIDE the bulk-save form to avoid nested-form HTML violations --}}
                @foreach($settings as $setting)
                <form id="del-setting-{{ $setting->id }}" method="POST" action="{{ route('admin.settings.destroy', $setting) }}" style="display:none">
                    @csrf @method('DELETE')
                </form>
                @endforeach

                <form method="POST" action="{{ route('admin.settings.bulk') }}">
                    @csrf
                    <div class="form-grid" style="gap:1rem">
                        @foreach($settings as $setting)
                        <div class="form-group">
                            <label style="display:flex;justify-content:space-between">
                                <span>{{ $setting->key }}</span>
                                <span style="font-size:.75rem;color:var(--muted)">#{{ $setting->id }}</span>
                            </label>
                            <div style="display:flex;gap:.5rem">
                                <input type="text" name="settings[{{ $setting->id }}]" value="{{ $setting->value }}" style="flex:1">
                                <a href="{{ route('admin.settings.edit', $setting) }}" class="btn btn-outline btn-sm">✎</a>
                                <button type="button" class="btn btn-danger btn-sm"
                                    onclick="if(confirm('Delete this setting?')) document.getElementById('del-setting-{{ $setting->id }}').submit()">✕</button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div style="margin-top:1.25rem">
                        <button type="submit" class="btn btn-primary">Save All Settings</button>
                    </div>
                </form>
            @endif
        </div>
    </div>

    {{-- Add new setting --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">Add New Setting</span>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.settings.store') }}">
                @csrf
                <div class="form-grid">
                    <div class="form-group">
                        <label>Key <span class="req">*</span></label>
                        <input type="text" name="key" value="{{ old('key') }}" required placeholder="site_name">
                        @error('key')<span class="form-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Value</label>
                        <input type="text" name="value" value="{{ old('value') }}">
                    </div>
                </div>
                <div style="margin-top:1rem">
                    <button type="submit" class="btn btn-primary" style="width:100%">Add Setting</button>
                </div>
            </form>
        </div>
    </div>

</div>

@media (max-width: 768px) {
    /* stack on mobile */
}
@endsection
