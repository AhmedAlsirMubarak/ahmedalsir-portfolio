@extends('admin.layouts.app')

@section('title', 'Experience')
@section('page-title', 'Experience')
@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Admin</a> / Experience
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <span class="card-title">All Experience</span>
        <a href="{{ route('admin.experiences.create') }}" class="btn btn-primary btn-sm">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            New Experience
        </a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Role</th>
                    <th>Company</th>
                    <th>Duration</th>
                    <th>Type</th>
                    <th>Tags</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($experiences as $exp)
                <tr>
                    <td style="font-weight:500;color:var(--text)">{{ $exp->role }}</td>
                    <td>{{ $exp->company }}</td>
                    <td style="color:var(--muted)">{{ $exp->duration }}</td>
                    <td>
                        @php $colors = ['full-time'=>'badge-green','freelance'=>'badge-purple','remote'=>'badge-cyan','part-time'=>'badge-yellow']; @endphp
                        <span class="badge {{ $colors[$exp->type] ?? 'badge-gray' }}">{{ $exp->type }}</span>
                    </td>
                    <td class="truncate">{{ is_array($exp->tech_tags) ? implode(', ', $exp->tech_tags) : '' }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.experiences.edit', $exp) }}" class="btn btn-outline btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.experiences.destroy', $exp) }}" onsubmit="return confirm('Delete this experience?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center;color:var(--muted);padding:2rem">No experiences yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($experiences->hasPages())
        <div class="pagination">{{ $experiences->links() }}</div>
    @endif
</div>
@endsection
