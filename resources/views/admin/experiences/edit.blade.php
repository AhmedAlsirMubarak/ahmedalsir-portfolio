@extends('admin.layouts.app')

@section('title', 'Edit Experience')
@section('page-title', 'Edit Experience')
@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Admin</a> / <a href="{{ route('admin.experiences.index') }}">Experience</a> / Edit
@endsection

@section('content')
<div class="card" style="max-width:760px">
    <div class="card-header">
        <span class="card-title">Edit: {{ $experience->role }} @ {{ $experience->company }}</span>
        <a href="{{ route('admin.experiences.index') }}" class="btn btn-outline btn-sm">← Back</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.experiences.update', $experience) }}">
            @csrf @method('PUT')
            <div class="form-grid form-grid-2">
                <div class="form-group">
                    <label>Role / Position <span class="req">*</span></label>
                    <input type="text" name="role" value="{{ old('role', $experience->role) }}" required>
                    @error('role')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Company <span class="req">*</span></label>
                    <input type="text" name="company" value="{{ old('company', $experience->company) }}" required>
                    @error('company')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Duration <span class="req">*</span></label>
                    <input type="text" name="duration" value="{{ old('duration', $experience->duration) }}" required>
                    @error('duration')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Location</label>
                    <input type="text" name="location" value="{{ old('location', $experience->location) }}">
                </div>
                <div class="form-group">
                    <label>Type <span class="req">*</span></label>
                    <select name="type">
                        @foreach(['full-time','freelance','remote','part-time'] as $t)
                            <option value="{{ $t }}" {{ old('type', $experience->type) == $t ? 'selected' : '' }}>{{ ucwords(str_replace('-',' ',$t)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $experience->sort_order) }}" min="0">
                </div>
                <div class="form-group span-2">
                    <label>Description</label>
                    <textarea name="description" rows="3">{{ old('description', $experience->description) }}</textarea>
                </div>
                <div class="form-group span-2">
                    <label>Responsibilities</label>
                    <textarea name="responsibilities" rows="4">{{ old('responsibilities', is_array($experience->responsibilities) ? implode("\n", $experience->responsibilities) : $experience->responsibilities) }}</textarea>
                    <span class="form-hint">One item per line</span>
                </div>
                <div class="form-group span-2">
                    <label>Tech Tags</label>
                    <input type="text" name="tech_tags" value="{{ old('tech_tags', is_array($experience->tech_tags) ? implode(', ', $experience->tech_tags) : $experience->tech_tags) }}">
                    <span class="form-hint">Comma-separated</span>
                </div>
            </div>
            <div style="margin-top:1.5rem;display:flex;gap:.75rem">
                <button type="submit" class="btn btn-primary">Update Experience</button>
                <a href="{{ route('admin.experiences.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
