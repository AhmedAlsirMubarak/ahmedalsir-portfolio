@extends('admin.layouts.app')

@section('title', 'Education')
@section('page-title', 'Education')
@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Admin</a> / Education
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <span class="card-title">All Education</span>
        <a href="{{ route('admin.education.create') }}" class="btn btn-primary btn-sm">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            New Entry
        </a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Degree</th>
                    <th>Institution</th>
                    <th>Year</th>
                    <th>Location</th>
                    <th>Order</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($educations as $edu)
                <tr>
                    <td>
                        <div style="display:flex;align-items:center;gap:.65rem">
                            @if($edu->logo_url)
                                <img src="{{ $edu->logo_url }}" class="img-preview" alt="">
                            @endif
                            <span style="font-weight:500;color:var(--text)">{{ $edu->degree }}</span>
                        </div>
                    </td>
                    <td>{{ $edu->institution }}</td>
                    <td style="color:var(--muted)">{{ $edu->year }}</td>
                    <td style="color:var(--muted)">{{ $edu->location ?? '—' }}</td>
                    <td>{{ $edu->sort_order ?? '—' }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.education.edit', $edu) }}" class="btn btn-outline btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.education.destroy', $edu) }}" onsubmit="return confirm('Delete this entry?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center;color:var(--muted);padding:2rem">No education entries yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($educations->hasPages())
        <div class="pagination">{{ $educations->links('vendor.pagination.admin') }}</div>
    @endif
</div>
@endsection
