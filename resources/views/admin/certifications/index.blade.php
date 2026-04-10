@extends('admin.layouts.app')

@section('title', 'Certifications')
@section('page-title', 'Certifications')
@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Admin</a> / Certifications
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <span class="card-title">All Certifications</span>
        <a href="{{ route('admin.certifications.create') }}" class="btn btn-primary btn-sm">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            New Certification
        </a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Issuer</th>
                    <th>Date</th>
                    <th>URL</th>
                    <th>Order</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($certifications as $cert)
                <tr>
                    <td style="font-weight:500;color:var(--text)">{{ $cert->title }}</td>
                    <td>{{ $cert->issuer }}</td>
                    <td style="color:var(--muted)">{{ $cert->date }}</td>
                    <td>
                        @if($cert->url)
                            <a href="{{ $cert->url }}" target="_blank" style="color:var(--cyan);font-size:.8rem">View ↗</a>
                        @else
                            <span style="color:var(--muted)">—</span>
                        @endif
                    </td>
                    <td>{{ $cert->sort_order ?? '—' }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.certifications.edit', $cert) }}" class="btn btn-outline btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.certifications.destroy', $cert) }}" onsubmit="return confirm('Delete this certification?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center;color:var(--muted);padding:2rem">No certifications yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($certifications->hasPages())
        <div class="pagination">{{ $certifications->links('vendor.pagination.admin') }}</div>
    @endif
</div>
@endsection
