@extends('admin.layouts.app')

@section('title', 'Edit Project')
@section('page-title', 'Edit Project')
@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Admin</a> / <a href="{{ route('admin.projects.index') }}">Projects</a> / Edit
@endsection

@section('content')
<div class="card" style="max-width:760px">
    <div class="card-header">
        <span class="card-title">Edit: <span style="color:var(--cyan)">{{ $project->title }}</span></span>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-outline btn-sm">← Back</a>
    </div>
    <div class="card-body">

        @if($errors->any())
        <div style="padding:.75rem 1rem;background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.2);border-radius:.5rem;margin-bottom:1.25rem;">
            <p style="font-size:.8rem;font-weight:600;color:var(--red);margin:0 0 .4rem">Please fix the following errors:</p>
            <ul style="margin:0;padding-left:1.2rem;font-size:.78rem;color:var(--red);display:flex;flex-direction:column;gap:.15rem;">
                @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data">
            @csrf @method('PUT')

            {{-- Section: Basic Info --}}
            <p class="form-section-title">Basic Information</p>
            <div class="form-grid form-grid-2">
                <div class="form-group">
                    <label>Title <span class="req">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $project->title) }}" required placeholder="e.g. Laravel Portfolio CMS">
                    @error('title')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Category <span class="req">*</span></label>
                    <select name="category">
                        @foreach(['web' => 'Web Application','desktop' => 'Desktop App','mobile' => 'Mobile App','other' => 'Other'] as $val => $label)
                            <option value="{{ $val }}" {{ old('category', $project->category) == $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('category')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group span-2">
                    <label>Description <span class="req">*</span></label>
                    <textarea name="description" rows="5" placeholder="Describe the project, what it does, the problem it solves…">{{ old('description', $project->description) }}</textarea>
                    @error('description')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group span-2">
                    <label>Tech Stack</label>
                    <input type="text" name="tech_tags" value="{{ old('tech_tags', is_array($project->tech_tags) ? implode(', ', $project->tech_tags) : $project->tech_tags) }}" placeholder="Laravel, Vue.js, MySQL, Tailwind CSS">
                    <span class="form-hint">Comma-separated — displayed as badges on the public portfolio</span>
                </div>
            </div>

            <hr class="form-divider">

            {{-- Section: Links --}}
            <p class="form-section-title">Links</p>
            <div class="form-grid form-grid-2">
                <div class="form-group">
                    <label>Live URL</label>
                    <input type="url" name="live_url" id="live_url" value="{{ old('live_url', $project->live_url) }}" placeholder="https://yourapp.com">
                    @if($project->live_url)
                    <a href="{{ $project->live_url }}" target="_blank" class="url-preview" id="live_url_preview">
                        <svg width="10" height="10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        {{ $project->live_url }}
                    </a>
                    @else
                    <span id="live_url_preview" style="display:none" class="url-preview"></span>
                    @endif
                    @error('live_url')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Repository URL</label>
                    <input type="url" name="repo_url" id="repo_url" value="{{ old('repo_url', $project->repo_url) }}" placeholder="https://github.com/user/repo">
                    @if($project->repo_url)
                    <a href="{{ $project->repo_url }}" target="_blank" class="url-preview" id="repo_url_preview">
                        <svg width="10" height="10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        {{ $project->repo_url }}
                    </a>
                    @else
                    <span id="repo_url_preview" style="display:none" class="url-preview"></span>
                    @endif
                    @error('repo_url')<span class="form-error">{{ $message }}</span>@enderror
                </div>
            </div>

            <hr class="form-divider">

            {{-- Section: Media --}}
            <p class="form-section-title">Cover Image</p>
            <div class="form-group">
                @if($project->image_url)
                <div class="img-preview-wrap">
                    <img src="{{ $project->image_url }}" class="img-preview-lg" id="img_preview" alt="Current cover">
                    <span class="img-change-hint">Click below to replace</span>
                </div>
                @else
                <img id="img_preview" class="img-preview-lg" style="display:none" alt="">
                @endif
                <input type="file" name="image" id="img_input" accept="image/*">
                <span class="form-hint">Supported: JPG, PNG, WebP · Max 2 MB · Leave empty to keep current</span>
                @error('image')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <hr class="form-divider">

            {{-- Section: Options --}}
            <p class="form-section-title">Options</p>
            <div class="form-grid form-grid-2">
                <div class="form-group">
                    <label>Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $project->sort_order) }}" min="0" placeholder="0">
                    <span class="form-hint">Lower numbers appear first</span>
                </div>
                <div class="form-group" style="justify-content:flex-end;padding-bottom:.2rem">
                    <label>Featured</label>
                    <label class="toggle" style="margin-top:.25rem">
                        <input type="checkbox" name="featured" value="1" {{ old('featured', $project->featured) ? 'checked' : '' }}>
                        <span class="toggle-track"><span class="toggle-thumb"></span></span>
                        <span class="toggle-label">Show in featured section</span>
                    </label>
                </div>
            </div>

            <hr class="form-divider">

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
// Live image preview
document.getElementById('img_input').addEventListener('change', function() {
    const preview = document.getElementById('img_preview');
    if (this.files && this.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { preview.src = e.target.result; preview.style.display = 'block'; };
        reader.readAsDataURL(this.files[0]);
    }
});
// URL preview links
['live_url','repo_url'].forEach(function(id) {
    const input = document.getElementById(id);
    const preview = document.getElementById(id + '_preview');
    if (!input || !preview) return;
    input.addEventListener('input', function() {
        const val = this.value.trim();
        if (val && val.startsWith('http')) {
            preview.href = val;
            preview.textContent = val;
            preview.style.display = 'inline-flex';
        } else {
            preview.style.display = 'none';
        }
    });
});
</script>
@endsection
