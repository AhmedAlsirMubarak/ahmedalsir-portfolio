@extends('admin.layouts.app')

@section('title', 'New Setting')
@section('page-title', 'New Setting')
@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Admin</a> / <a href="{{ route('admin.settings.index') }}">Settings</a> / New
@endsection

@section('content')
<div class="card" style="max-width:480px">
    <div class="card-header">
        <span class="card-title">Add Setting</span>
        <a href="{{ route('admin.settings.index') }}" class="btn btn-outline btn-sm">← Back</a>
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
            <div style="margin-top:1.5rem;display:flex;gap:.75rem">
                <button type="submit" class="btn btn-primary">Add Setting</button>
                <a href="{{ route('admin.settings.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
