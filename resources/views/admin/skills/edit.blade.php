@extends('admin.layouts.app')

@section('title', 'Edit Skill')
@section('page-title', 'Edit Skill')
@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Admin</a> / <a href="{{ route('admin.skills.index') }}">Skills</a> / Edit
@endsection

@section('content')
<div class="card" style="max-width:540px">
    <div class="card-header">
        <span class="card-title">Edit: {{ $skill->name }}</span>
        <a href="{{ route('admin.skills.index') }}" class="btn btn-outline btn-sm">← Back</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.skills.update', $skill) }}">
            @csrf @method('PUT')
            <div class="form-grid">
                <div class="form-group">
                    <label>Name <span class="req">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $skill->name) }}" required>
                    @error('name')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Category <span class="req">*</span></label>
                    <select name="category">
                        @foreach(['frontend','backend','database','other'] as $cat)
                            <option value="{{ $cat }}" {{ old('category', $skill->category) == $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Proficiency Level <span class="req">*</span> — <span style="color:var(--cyan)" id="lvl-display">{{ old('level', $skill->level) }}%</span></label>
                    <input type="range" name="level" id="level-range" min="0" max="100" value="{{ old('level', $skill->level) }}" oninput="document.getElementById('lvl-display').textContent=this.value+'%'" style="accent-color:var(--cyan);width:100%">
                    @error('level')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $skill->sort_order) }}" min="0">
                </div>
            </div>
            <div style="margin-top:1.5rem;display:flex;gap:.75rem">
                <button type="submit" class="btn btn-primary">Update Skill</button>
                <a href="{{ route('admin.skills.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
