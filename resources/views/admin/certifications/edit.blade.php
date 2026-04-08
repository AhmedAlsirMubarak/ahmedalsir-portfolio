@extends('admin.layouts.app')

@section('title', 'Edit Certification')
@section('page-title', 'Edit Certification')
@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Admin</a> / <a href="{{ route('admin.certifications.index') }}">Certifications</a> / Edit
@endsection

@section('content')
<div class="card" style="max-width:600px">
    <div class="card-header">
        <span class="card-title">Edit: {{ $certification->title }}</span>
        <a href="{{ route('admin.certifications.index') }}" class="btn btn-outline btn-sm">← Back</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.certifications.update', $certification) }}">
            @csrf @method('PUT')
            <div class="form-grid form-grid-2">
                <div class="form-group span-2">
                    <label>Title <span class="req">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $certification->title) }}" required>
                    @error('title')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Issuer <span class="req">*</span></label>
                    <input type="text" name="issuer" value="{{ old('issuer', $certification->issuer) }}" required>
                    @error('issuer')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Date <span class="req">*</span></label>
                    <input type="text" name="date" value="{{ old('date', $certification->date) }}" required>
                    @error('date')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group span-2">
                    <label>Certificate URL</label>
                    <input type="url" name="url" value="{{ old('url', $certification->url) }}">
                    @error('url')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $certification->sort_order) }}" min="0">
                </div>
            </div>
            <div style="margin-top:1.5rem;display:flex;gap:.75rem">
                <button type="submit" class="btn btn-primary">Update Certification</button>
                <a href="{{ route('admin.certifications.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
