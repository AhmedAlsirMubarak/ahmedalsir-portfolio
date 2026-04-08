@extends('admin.layouts.app')

@section('title', 'Edit Project')
@section('page-title', 'Edit Project')
@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Admin</a> / <a href="{{ route('admin.projects.index') }}">Projects</a> / Edit
@endsection

@section('content')
<div class="card" style="max-width:760px">
    <div class="card-header">
        <span class="card-title">Edit: {{ $project->title }}</span>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-outline btn-sm">← Back</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="form-grid form-grid-2">
                <div class="form-group">
                    <label>Title <span class="req">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $project->title) }}" required>
                    @error('title')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Category <span class="req">*</span></label>
                    <select name="category">
                        @foreach(['web','desktop','other'] as $cat)
                            <option value="{{ $cat }}" {{ old('category', $project->category) == $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                        @endforeach
                    </select>
                    @error('category')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group span-2">
                    <label>Description <span class="req">*</span></label>
                    <textarea name="description" rows="4">{{ old('description', $project->description) }}</textarea>
                    @error('description')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group span-2">
                    <label>Tech Tags</label>
                    <input type="text" name="tech_tags" value="{{ old('tech_tags', is_array($project->tech_tags) ? implode(', ', $project->tech_tags) : $project->tech_tags) }}" placeholder="Laravel, Vue.js, MySQL">
                    <span class="form-hint">Comma-separated list</span>
                </div>
                <div class="form-group">
                    <label>Live URL</label>
                    <input type="url" name="live_url" value="{{ old('live_url', $project->live_url) }}" placeholder="https://...">
                    @error('live_url')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Repository URL</label>
                    <input type="url" name="repo_url" value="{{ old('repo_url', $project->repo_url) }}" placeholder="https://github.com/...">
                    @error('repo_url')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Image</label>
                    @if($project->image_url)
                        <img src="{{ $project->image_url }}" class="img-preview-lg" alt="">
                    @endif
                    <input type="file" name="image" accept="image/*">
                    <span class="form-hint">Leave empty to keep current image</span>
                    @error('image')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $project->sort_order) }}" min="0">
                </div>
                <div class="form-group">
                    <label>Featured</label>
                    <label class="toggle">
                        <input type="checkbox" name="featured" value="1" {{ old('featured', $project->featured) ? 'checked' : '' }}>
                        <span class="toggle-track"></span>
                        <span class="toggle-thumb"></span>
                        <span class="toggle-label">Mark as featured</span>
                    </label>
                </div>
            </div>
            <div style="margin-top:1.5rem;display:flex;gap:.75rem">
                <button type="submit" class="btn btn-primary">Update Project</button>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
