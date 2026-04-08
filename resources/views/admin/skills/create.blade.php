@extends('admin.layouts.app')

@section('title', 'New Skill')
@section('page-title', 'New Skill')
@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Admin</a> / <a href="{{ route('admin.skills.index') }}">Skills</a> / New
@endsection

@section('content')
<div class="card" style="max-width:540px">
    <div class="card-header">
        <span class="card-title">Create Skill</span>
        <a href="{{ route('admin.skills.index') }}" class="btn btn-outline btn-sm">← Back</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.skills.store') }}">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label>Name <span class="req">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="e.g. Laravel">
                    @error('name')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Category <span class="req">*</span></label>
                    <select name="category">
                        @foreach(['frontend','backend','database','other'] as $cat)
                            <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                        @endforeach
                    </select>
                    @error('category')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Proficiency Level <span class="req">*</span> — <span style="color:var(--cyan)" id="lvl-display">{{ old('level', 80) }}%</span></label>
                    <input type="range" name="level" id="level-range" min="0" max="100" value="{{ old('level', 80) }}" oninput="document.getElementById('lvl-display').textContent=this.value+'%'" style="accent-color:var(--cyan);width:100%">
                    @error('level')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                </div>
            </div>
            <div style="margin-top:1.5rem;display:flex;gap:.75rem">
                <button type="submit" class="btn btn-primary">Create Skill</button>
                <a href="{{ route('admin.skills.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
