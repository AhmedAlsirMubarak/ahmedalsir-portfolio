@extends('admin.layouts.app')

@section('title', 'Edit Testimonial')
@section('page-title', 'Edit Testimonial')
@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Admin</a> / <a href="{{ route('admin.testimonials.index') }}">Testimonials</a> / Edit
@endsection

@section('content')
<div class="card" style="max-width:640px">
    <div class="card-header">
        <span class="card-title">Edit: {{ $testimonial->name }}</span>
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline btn-sm">← Back</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.testimonials.update', $testimonial) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="form-grid form-grid-2">
                <div class="form-group">
                    <label>Name <span class="req">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $testimonial->name) }}" required>
                    @error('name')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Role <span class="req">*</span></label>
                    <input type="text" name="role" value="{{ old('role', $testimonial->role) }}" required>
                </div>
                <div class="form-group">
                    <label>Company</label>
                    <input type="text" name="company" value="{{ old('company', $testimonial->company) }}">
                </div>
                <div class="form-group">
                    <label>Avatar</label>
                    @if($testimonial->avatar_url)
                        <img src="{{ $testimonial->avatar_url }}" class="img-preview-lg" alt="" style="border-radius:50%">
                    @endif
                    <input type="file" name="avatar" accept="image/*">
                    <span class="form-hint">Leave empty to keep current</span>
                </div>
                <div class="form-group span-2">
                    <label>Quote <span class="req">*</span></label>
                    <textarea name="quote" rows="4" required>{{ old('quote', $testimonial->quote) }}</textarea>
                </div>
                <div class="form-group">
                    <label>Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $testimonial->sort_order) }}" min="0">
                </div>
            </div>
            <div style="margin-top:1.5rem;display:flex;gap:.75rem">
                <button type="submit" class="btn btn-primary">Update Testimonial</button>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
