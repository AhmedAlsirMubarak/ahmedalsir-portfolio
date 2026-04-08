@extends('admin.layouts.app')

@section('title', 'Projects')
@section('page-title', 'Projects')
@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Admin</a> / Projects
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <span class="card-title">All Projects</span>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary btn-sm">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            New Project
        </a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Project</th>
                    <th>Category</th>
                    <th>Featured</th>
                    <th>Tags</th>
                    <th>Order</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                <tr>
                    <td>
                        <div style="display:flex;align-items:center;gap:.75rem">
                            @if($project->image_url)
                                <img src="{{ $project->image_url }}" class="img-preview" alt="">
                            @else
                                <div style="width:48px;height:48px;border-radius:.4rem;background:var(--border);display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:1.2rem;">🚀</div>
                            @endif
                            <div>
                                <div style="font-weight:500;color:var(--text)">{{ $project->title }}</div>
                                <div style="font-size:.75rem;color:var(--muted)" class="truncate">{{ Str::limit($project->description, 60) }}</div>
                            </div>
                        </div>
                    </td>
                    <td><span class="badge badge-cyan">{{ $project->category }}</span></td>
                    <td>
                        @if($project->featured)
                            <span class="badge badge-green">Featured</span>
                        @else
                            <span class="badge badge-gray">No</span>
                        @endif
                    </td>
                    <td class="truncate">{{ is_array($project->tech_tags) ? implode(', ', $project->tech_tags) : '' }}</td>
                    <td>{{ $project->sort_order ?? '—' }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-outline btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" onsubmit="return confirm('Delete this project?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center;color:var(--muted);padding:2rem">No projects yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($projects->hasPages())
        <div class="pagination">
            {{ $projects->links() }}
        </div>
    @endif
</div>
@endsection
