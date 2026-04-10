@extends('admin.layouts.app')

@section('title', 'Testimonials')
@section('page-title', 'Testimonials')
@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Admin</a> / Testimonials
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <span class="card-title">All Testimonials</span>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary btn-sm">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            New Testimonial
        </a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Person</th>
                    <th>Role / Company</th>
                    <th>Quote</th>
                    <th>Order</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($testimonials as $t)
                <tr>
                    <td>
                        <div style="display:flex;align-items:center;gap:.65rem">
                            @if($t->avatar_url)
                                <img src="{{ $t->avatar_url }}" class="img-preview" alt="" style="border-radius:50%">
                            @else
                                <div style="width:40px;height:40px;border-radius:50%;background:linear-gradient(135deg,var(--cyan),var(--purple));display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.9rem;color:#050508">{{ strtoupper(substr($t->name,0,1)) }}</div>
                            @endif
                            <span style="font-weight:500;color:var(--text)">{{ $t->name }}</span>
                        </div>
                    </td>
                    <td style="color:var(--muted)">{{ $t->role }}{{ $t->company ? ' · '.$t->company : '' }}</td>
                    <td class="truncate" style="max-width:260px;color:var(--muted);font-style:italic">"{{ Str::limit($t->quote, 70) }}"</td>
                    <td>{{ $t->sort_order ?? '—' }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.testimonials.edit', $t) }}" class="btn btn-outline btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.testimonials.destroy', $t) }}" onsubmit="return confirm('Delete this testimonial?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" style="text-align:center;color:var(--muted);padding:2rem">No testimonials yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($testimonials->hasPages())
        <div class="pagination">{{ $testimonials->links('vendor.pagination.admin') }}</div>
    @endif
</div>
@endsection
