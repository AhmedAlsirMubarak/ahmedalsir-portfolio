@extends('admin.layouts.app')

@section('title', 'New Experience')
@section('page-title', 'New Experience')
@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Admin</a> / <a href="{{ route('admin.experiences.index') }}">Experience</a> / New
@endsection

@section('content')
<div class="card" style="max-width:760px">
    <div class="card-header">
        <span class="card-title">Create Experience</span>
        <a href="{{ route('admin.experiences.index') }}" class="btn btn-outline btn-sm">← Back</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.experiences.store') }}">
            @csrf
            <div class="form-grid form-grid-2">
                <div class="form-group">
                    <label>Role / Position <span class="req">*</span></label>
                    <input type="text" name="role" value="{{ old('role') }}" required>
                    @error('role')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Company <span class="req">*</span></label>
                    <input type="text" name="company" value="{{ old('company') }}" required>
                    @error('company')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Duration <span class="req">*</span></label>
                    <input type="text" name="duration" value="{{ old('duration') }}" placeholder="Jan 2022 – Present" required>
                    @error('duration')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Location</label>
                    <input type="text" name="location" value="{{ old('location') }}" placeholder="Remote / City, Country">
                </div>
                <div class="form-group">
                    <label>Type <span class="req">*</span></label>
                    <select name="type">
                        @foreach(['full-time','freelance','remote','part-time'] as $t)
                            <option value="{{ $t }}" {{ old('type') == $t ? 'selected' : '' }}>{{ ucwords(str_replace('-',' ',$t)) }}</option>
                        @endforeach
                    </select>
                    @error('type')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                </div>
                <div class="form-group span-2">
                    <label>Description</label>
                    <textarea name="description" rows="3">{{ old('description') }}</textarea>
                </div>
                <div class="form-group span-2">
                    <label>Responsibilities</label>
                    <textarea name="responsibilities" rows="4" placeholder="One responsibility per line">{{ old('responsibilities') }}</textarea>
                    <span class="form-hint">One item per line</span>
                </div>
                <div class="form-group span-2">
                    <label>Tech Tags</label>
                    <input type="text" name="tech_tags" value="{{ old('tech_tags') }}" placeholder="Laravel, Docker, AWS">
                    <span class="form-hint">Comma-separated</span>
                </div>
            </div>
            <div style="margin-top:1.5rem;display:flex;gap:.75rem">
                <button type="submit" class="btn btn-primary">Create Experience</button>
                <a href="{{ route('admin.experiences.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
