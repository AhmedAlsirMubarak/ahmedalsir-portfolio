@extends('admin.layouts.app')

@section('title', 'Edit Setting')
@section('page-title', 'Edit Setting')
@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Admin</a> / <a href="{{ route('admin.settings.index') }}">Settings</a> / Edit
@endsection

@section('content')
<div class="card" style="max-width:480px">
    <div class="card-header">
        <span class="card-title">Edit: <span style="color:var(--cyan)">{{ $setting->key }}</span></span>
        <a href="{{ route('admin.settings.index') }}" class="btn btn-outline btn-sm">← Back</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.settings.update', $setting) }}">
            @csrf @method('PUT')
            <div class="form-grid">
                <div class="form-group">
                    <label>Key</label>
                    <input type="text" value="{{ $setting->key }}" disabled style="opacity:.5;cursor:not-allowed">
                </div>
                <div class="form-group">
                    <label>Value</label>
                    <input type="text" name="value" value="{{ old('value', $setting->value) }}">
                </div>
            </div>
            <div style="margin-top:1.5rem;display:flex;gap:.75rem">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.settings.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
