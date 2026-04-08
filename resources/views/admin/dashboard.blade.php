@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('breadcrumb', 'Overview')

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon">🚀</div>
        <div class="stat-value">{{ $stats['projects'] }}</div>
        <div class="stat-label">Projects</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">💼</div>
        <div class="stat-value">{{ $stats['experiences'] }}</div>
        <div class="stat-label">Experiences</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">⚡</div>
        <div class="stat-value">{{ $stats['skills'] }}</div>
        <div class="stat-label">Skills</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">🎓</div>
        <div class="stat-value">{{ $stats['educations'] }}</div>
        <div class="stat-label">Educations</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">🏆</div>
        <div class="stat-value">{{ $stats['certifications'] }}</div>
        <div class="stat-label">Certifications</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">💬</div>
        <div class="stat-value">{{ $stats['testimonials'] }}</div>
        <div class="stat-label">Testimonials</div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <span class="card-title">Recent Projects</span>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary btn-sm">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            New Project
        </a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Featured</th>
                    <th>Tags</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentProjects as $project)
                <tr>
                    <td>
                        <div style="display:flex;align-items:center;gap:.75rem">
                            @if($project->image_url)
                                <img src="{{ $project->image_url }}" class="img-preview" alt="">
                            @else
                                <div style="width:48px;height:48px;border-radius:.4rem;background:var(--border);display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:1.2rem;">🚀</div>
                            @endif
                            <span>{{ $project->title }}</span>
                        </div>
                    </td>
                    <td><span class="badge badge-cyan">{{ $project->category }}</span></td>
                    <td>
                        @if($project->featured)
                            <span class="badge badge-green">Yes</span>
                        @else
                            <span class="badge badge-gray">No</span>
                        @endif
                    </td>
                    <td class="truncate">{{ is_array($project->tech_tags) ? implode(', ', $project->tech_tags) : $project->tech_tags }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-outline btn-sm">Edit</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" style="text-align:center;color:var(--muted);padding:2rem">No projects yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
