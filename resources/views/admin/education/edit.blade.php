@extends('admin.layouts.app')

@section('title', 'Edit Education')
@section('page-title', 'Edit Education')
@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Admin</a> / <a href="{{ route('admin.education.index') }}">Education</a> / Edit
@endsection

@section('content')
<div class="card" style="max-width:640px">
    <div class="card-header">
        <span class="card-title">Edit: {{ $education->degree }}</span>
        <a href="{{ route('admin.education.index') }}" class="btn btn-outline btn-sm">← Back</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.education.update', $education) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="form-grid form-grid-2">
                <div class="form-group">
                    <label>Degree / Qualification <span class="req">*</span></label>
                    <input type="text" name="degree" value="{{ old('degree', $education->degree) }}" required>
                    @error('degree')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Institution <span class="req">*</span></label>
                    <input type="text" name="institution" value="{{ old('institution', $education->institution) }}" required>
                    @error('institution')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Year <span class="req">*</span></label>
                    <input type="text" name="year" value="{{ old('year', $education->year) }}" required>
                </div>
                <div class="form-group">
                    <label>Location</label>
                    <input type="text" name="location" value="{{ old('location', $education->location) }}">
                </div>
                <div class="form-group span-2">
                    <label>Description</label>
                    <textarea name="description" rows="3">{{ old('description', $education->description) }}</textarea>
                </div>
                <div class="form-group">
                    <label>Logo / Icon</label>
                    @if($education->logo_url)
                        <img src="{{ $education->logo_url }}" class="img-preview-lg" alt="">
                    @endif
                    <input type="file" name="logo" accept="image/*">
                    <span class="form-hint">Leave empty to keep current</span>
                </div>
                <div class="form-group">
                    <label>Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $education->sort_order) }}" min="0">
                </div>
            </div>
            <div style="margin-top:1.5rem;display:flex;gap:.75rem">
                <button type="submit" class="btn btn-primary">Update Entry</button>
                <a href="{{ route('admin.education.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
