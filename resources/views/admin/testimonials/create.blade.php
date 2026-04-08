@extends('admin.layouts.app')

@section('title', 'New Testimonial')
@section('page-title', 'New Testimonial')
@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Admin</a> / <a href="{{ route('admin.testimonials.index') }}">Testimonials</a> / New
@endsection

@section('content')
<div class="card" style="max-width:640px">
    <div class="card-header">
        <span class="card-title">Create Testimonial</span>
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline btn-sm">← Back</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.testimonials.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-grid form-grid-2">
                <div class="form-group">
                    <label>Name <span class="req">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required>
                    @error('name')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Role <span class="req">*</span></label>
                    <input type="text" name="role" value="{{ old('role') }}" required placeholder="CTO">
                    @error('role')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Company</label>
                    <input type="text" name="company" value="{{ old('company') }}" placeholder="Acme Inc.">
                </div>
                <div class="form-group">
                    <label>Avatar</label>
                    <input type="file" name="avatar" accept="image/*">
                    @error('avatar')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group span-2">
                    <label>Quote <span class="req">*</span></label>
                    <textarea name="quote" rows="4" required>{{ old('quote') }}</textarea>
                    @error('quote')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                </div>
            </div>
            <div style="margin-top:1.5rem;display:flex;gap:.75rem">
                <button type="submit" class="btn btn-primary">Create Testimonial</button>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
