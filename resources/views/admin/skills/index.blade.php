@extends('admin.layouts.app')

@section('title', 'Skills')
@section('page-title', 'Skills')
@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Admin</a> / Skills
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <span class="card-title">All Skills</span>
        <a href="{{ route('admin.skills.create') }}" class="btn btn-primary btn-sm">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            New Skill
        </a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Level</th>
                    <th>Order</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($skills as $skill)
                <tr>
                    <td style="font-weight:500;color:var(--text)">{{ $skill->name }}</td>
                    <td>
                        @php $colors = ['frontend'=>'badge-cyan','backend'=>'badge-purple','database'=>'badge-yellow','other'=>'badge-gray']; @endphp
                        <span class="badge {{ $colors[$skill->category] ?? 'badge-gray' }}">{{ $skill->category }}</span>
                    </td>
                    <td>
                        <div style="display:flex;align-items:center;gap:.6rem">
                            <div style="flex:1;height:6px;background:var(--border);border-radius:999px;overflow:hidden;max-width:100px">
                                <div style="height:100%;width:{{ $skill->level }}%;background:var(--cyan);border-radius:999px"></div>
                            </div>
                            <span style="font-size:.78rem;color:var(--muted)">{{ $skill->level }}%</span>
                        </div>
                    </td>
                    <td>{{ $skill->sort_order ?? '—' }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.skills.edit', $skill) }}" class="btn btn-outline btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.skills.destroy', $skill) }}" onsubmit="return confirm('Delete this skill?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" style="text-align:center;color:var(--muted);padding:2rem">No skills yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($skills->hasPages())
        <div class="pagination">{{ $skills->links() }}</div>
    @endif
</div>
@endsection
