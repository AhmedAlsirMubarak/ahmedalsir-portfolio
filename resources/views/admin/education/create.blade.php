@extends('admin.layouts.app')

@section('title', 'New Education')
@section('page-title', 'New Education')
@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Admin</a> / <a href="{{ route('admin.education.index') }}">Education</a> / New
@endsection

@section('content')
<div class="card" style="max-width:640px">
    <div class="card-header">
        <span class="card-title">Create Education Entry</span>
        <a href="{{ route('admin.education.index') }}" class="btn btn-outline btn-sm">← Back</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.education.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-grid form-grid-2">
                <div class="form-group">
                    <label>Degree / Qualification <span class="req">*</span></label>
                    <input type="text" name="degree" value="{{ old('degree') }}" required placeholder="B.Sc. Computer Science">
                    @error('degree')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Institution <span class="req">*</span></label>
                    <input type="text" name="institution" value="{{ old('institution') }}" required>
                    @error('institution')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Year <span class="req">*</span></label>
                    <input type="text" name="year" value="{{ old('year') }}" required placeholder="2018 – 2022">
                    @error('year')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Location</label>
                    <input type="text" name="location" value="{{ old('location') }}" placeholder="City, Country">
                </div>
                <div class="form-group span-2">
                    <label>Description</label>
                    <textarea name="description" rows="3">{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <label>Logo / Icon</label>
                    <input type="file" name="logo" accept="image/*">
                    @error('logo')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                </div>
            </div>
            <div style="margin-top:1.5rem;display:flex;gap:.75rem">
                <button type="submit" class="btn btn-primary">Create Entry</button>
                <a href="{{ route('admin.education.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
