<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'Admin') — Portfolio CMS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet"/>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg:      #050508;
            --surface: #0d0d1a;
            --surface2:#12121f;
            --border:  #1e293b;
            --border2: #334155;
            --text:    #e2e8f0;
            --muted:   #64748b;
            --cyan:    #22d3ee;
            --cyan-dim:rgba(34,211,238,.1);
            --purple:  #a78bfa;
            --red:     #f43f5e;
            --green:   #22c55e;
            --yellow:  #eab308;
            --sidebar-w: 240px;
        }
        html, body { height: 100%; font-family: 'Inter', system-ui, sans-serif; background: var(--bg); color: var(--text); font-size: 14px; }

        /* ── Sidebar ── */
        .sidebar {
            position: fixed; top: 0; left: 0; bottom: 0;
            width: var(--sidebar-w);
            background: var(--surface);
            border-right: 1px solid var(--border);
            display: flex; flex-direction: column;
            z-index: 40; overflow-y: auto;
        }
        .sidebar-logo {
            display: flex; align-items: center; gap: .7rem;
            padding: 1.25rem 1.25rem 1rem;
            border-bottom: 1px solid var(--border);
            text-decoration: none;
        }
        .sidebar-logo-icon {
            width: 36px; height: 36px; border-radius: 9px; flex-shrink: 0;
            background: linear-gradient(135deg, var(--cyan), var(--purple));
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: .95rem; color: #050508;
        }
        .sidebar-logo-text { font-weight: 600; font-size: .9rem; color: var(--text); }
        .sidebar-logo-sub  { font-size: .7rem; color: var(--muted); margin-top: .1rem; }

        .sidebar-section { padding: 1rem 0 .5rem; }
        .sidebar-section-label {
            padding: .25rem 1.25rem .5rem;
            font-size: .65rem; font-weight: 600; letter-spacing: .1em;
            text-transform: uppercase; color: var(--muted);
        }
        .sidebar-link {
            display: flex; align-items: center; gap: .6rem;
            padding: .5rem 1.25rem; border-radius: 0;
            color: var(--muted); text-decoration: none;
            font-size: .82rem; font-weight: 500;
            transition: color .15s, background .15s;
            position: relative;
        }
        .sidebar-link:hover { color: var(--text); background: rgba(255,255,255,.04); }
        .sidebar-link.active {
            color: var(--cyan);
            background: var(--cyan-dim);
        }
        .sidebar-link.active::before {
            content: ''; position: absolute; left: 0; top: 0; bottom: 0;
            width: 3px; background: var(--cyan); border-radius: 0 3px 3px 0;
        }
        .sidebar-link svg { width: 16px; height: 16px; flex-shrink: 0; }

        .sidebar-footer {
            margin-top: auto;
            padding: 1rem 1.25rem;
            border-top: 1px solid var(--border);
        }
        .sidebar-user {
            display: flex; align-items: center; gap: .7rem;
            padding: .5rem 0; margin-bottom: .5rem;
        }
        .sidebar-avatar {
            width: 30px; height: 30px; border-radius: 50%;
            background: linear-gradient(135deg, var(--cyan), var(--purple));
            display: flex; align-items: center; justify-content: center;
            font-size: .75rem; font-weight: 700; color: #050508; flex-shrink: 0;
        }
        .sidebar-username { font-size: .82rem; font-weight: 500; color: var(--text); }
        .sidebar-useremail { font-size: .7rem; color: var(--muted); }
        .sidebar-logout {
            display: flex; align-items: center; gap: .5rem;
            width: 100%; padding: .45rem .75rem;
            background: rgba(244,63,94,.08); border: 1px solid rgba(244,63,94,.2);
            border-radius: .4rem; color: var(--red); font-size: .78rem;
            cursor: pointer; transition: background .15s;
        }
        .sidebar-logout:hover { background: rgba(244,63,94,.15); }
        .sidebar-logout svg { width: 14px; height: 14px; }

        /* ── Main area ── */
        .admin-main { margin-left: var(--sidebar-w); min-height: 100vh; display: flex; flex-direction: column; }

        /* ── Topbar ── */
        .topbar {
            position: sticky; top: 0; z-index: 30;
            background: rgba(5,5,8,.85); backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            padding: .75rem 1.75rem;
            display: flex; align-items: center; justify-content: space-between; gap: 1rem;
        }
        .topbar-left { display: flex; flex-direction: column; gap: .15rem; }
        .topbar-title { font-size: 1.1rem; font-weight: 700; color: var(--text); }
        .topbar-breadcrumb { font-size: .75rem; color: var(--muted); }
        .topbar-breadcrumb a { color: var(--muted); text-decoration: none; }
        .topbar-breadcrumb a:hover { color: var(--cyan); }
        .topbar-right { display: flex; align-items: center; gap: .75rem; }
        .topbar-view-site {
            display: inline-flex; align-items: center; gap: .4rem;
            padding: .4rem .85rem;
            border: 1px solid var(--border2); border-radius: .4rem;
            color: var(--muted); font-size: .78rem; text-decoration: none;
            transition: color .15s, border-color .15s;
        }
        .topbar-view-site:hover { color: var(--cyan); border-color: var(--cyan); }
        .topbar-view-site svg { width: 13px; height: 13px; }

        /* ── Content ── */
        .admin-content { padding: 1.75rem; flex: 1; }

        /* ── Alert ── */
        .alert { padding: .75rem 1rem; border-radius: .5rem; font-size: .82rem; margin-bottom: 1.25rem; }
        .alert-success { background: rgba(34,197,94,.1); border: 1px solid rgba(34,197,94,.25); color: var(--green); }
        .alert-error   { background: rgba(244,63,94,.1); border: 1px solid rgba(244,63,94,.25); color: var(--red); }

        /* ── Card ── */
        .card { background: var(--surface); border: 1px solid var(--border); border-radius: .75rem; overflow: hidden; margin-bottom: 1.25rem; }
        .card-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1rem 1.25rem; border-bottom: 1px solid var(--border);
        }
        .card-title { font-weight: 600; font-size: .9rem; }
        .card-body { padding: 1.25rem; }

        /* ── Stats grid ── */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(160px,1fr)); gap: 1rem; margin-bottom: 1.5rem; }
        .stat-card {
            background: var(--surface); border: 1px solid var(--border); border-radius: .75rem;
            padding: 1.25rem; display: flex; flex-direction: column; gap: .4rem;
        }
        .stat-icon { font-size: 1.4rem; }
        .stat-value { font-size: 1.75rem; font-weight: 700; color: var(--cyan); }
        .stat-label { font-size: .75rem; color: var(--muted); }

        /* ── Table ── */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        thead th { padding: .6rem 1rem; text-align: left; font-size: .72rem; font-weight: 600; letter-spacing: .05em; text-transform: uppercase; color: var(--muted); border-bottom: 1px solid var(--border); }
        tbody td { padding: .75rem 1rem; border-bottom: 1px solid var(--border); font-size: .82rem; color: var(--text); vertical-align: middle; }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover td { background: rgba(255,255,255,.02); }
        td.truncate { max-width: 180px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: var(--muted); }
        td.actions  { text-align: right; white-space: nowrap; }

        /* ── Buttons ── */
        .btn {
            display: inline-flex; align-items: center; gap: .4rem;
            padding: .5rem 1rem; border-radius: .4rem;
            font-size: .8rem; font-weight: 500; cursor: pointer;
            text-decoration: none; border: none; transition: background .15s, opacity .15s;
        }
        .btn svg { width: 14px; height: 14px; }
        .btn-primary  { background: var(--cyan); color: #050508; }
        .btn-primary:hover { background: #67e8f9; }
        .btn-outline  { background: transparent; border: 1px solid var(--border2); color: var(--text); }
        .btn-outline:hover { border-color: var(--cyan); color: var(--cyan); }
        .btn-danger   { background: rgba(244,63,94,.12); border: 1px solid rgba(244,63,94,.25); color: var(--red); }
        .btn-danger:hover { background: rgba(244,63,94,.2); }
        .btn-sm { padding: .35rem .7rem; font-size: .75rem; }

        /* ── Badge ── */
        .badge { display: inline-flex; align-items: center; padding: .2rem .55rem; border-radius: 9999px; font-size: .68rem; font-weight: 500; }
        .badge-cyan   { background: var(--cyan-dim); color: var(--cyan); }
        .badge-green  { background: rgba(34,197,94,.1); color: var(--green); }
        .badge-purple { background: rgba(167,139,250,.1); color: var(--purple); }
        .badge-muted  { background: rgba(100,116,139,.1); color: var(--muted); }
        .badge-gray   { background: rgba(100,116,139,.1); color: var(--muted); }
        .badge-yellow { background: rgba(234,179,8,.1); color: var(--yellow); }

        /* ── Forms ── */
        .form-grid   { display: grid; gap: 1rem; }
        .form-grid-2 { grid-template-columns: 1fr 1fr; }
        .form-grid-2 .span-2 { grid-column: 1 / -1; }
        .form-group  { display: flex; flex-direction: column; gap: .4rem; }
        .form-group label { font-size: .8rem; font-weight: 500; color: var(--text); }
        .form-group .req { color: var(--red); }
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%; padding: .55rem .85rem;
            background: var(--bg); border: 1px solid var(--border2);
            border-radius: .4rem; color: var(--text); font-size: .85rem;
            outline: none; transition: border-color .15s; font-family: inherit;
        }
        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus { border-color: var(--cyan); outline: 0; box-shadow: 0 0 0 2px rgba(34,211,238,.12); }
        .form-group textarea { resize: vertical; min-height: 90px; }
        .form-group .hint,
        .form-group .form-hint { font-size: .72rem; color: var(--muted); }
        .form-error { font-size: .75rem; color: var(--red); margin-top: .1rem; }
        .form-actions { display: flex; gap: .75rem; padding-top: .5rem; }
        .form-divider { border: none; border-top: 1px solid var(--border); margin: 1.5rem 0 1rem; }
        .form-section-title { font-size: .7rem; font-weight: 600; text-transform: uppercase; letter-spacing: .08em; color: var(--muted); margin-bottom: .25rem; }

        /* ── Toggle checkbox ── */
        .toggle { display: inline-flex; align-items: center; gap: .6rem; cursor: pointer; user-select: none; }
        .toggle input { position: absolute; opacity: 0; width: 0; height: 0; }
        .toggle-track {
            width: 2.6rem; height: 1.4rem; border-radius: 9999px;
            background: var(--border2); transition: background .2s;
            flex-shrink: 0; position: relative;
        }
        .toggle input:checked ~ .toggle-track { background: var(--cyan); }
        .toggle-thumb {
            position: absolute; top: .2rem; left: .2rem;
            width: 1rem; height: 1rem; border-radius: 50%;
            background: #fff; transition: transform .2s; pointer-events: none;
        }
        .toggle input:checked ~ .toggle-track .toggle-thumb { transform: translateX(1.2rem); }
        .toggle-label { font-size: .83rem; color: var(--text-muted); }

        /* ── Image preview ── */
        .img-preview    { width: 48px;  height: 48px;  border-radius: .4rem; object-fit: cover; }
        .img-preview-lg { width: 100%;  max-height: 200px; border-radius: .5rem; object-fit: cover; border: 1px solid var(--border2); margin-bottom: .4rem; }
        .img-preview-wrap { position: relative; }
        .img-preview-wrap .img-change-hint { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; background: rgba(0,0,0,.4); border-radius: .5rem; color: #fff; font-size: .75rem; opacity: 0; transition: opacity .2s; pointer-events: none; }
        .img-preview-wrap:hover .img-change-hint { opacity: 1; }

        /* ── URL preview link ── */
        .url-preview { display: inline-flex; align-items: center; gap: .35rem; font-size: .72rem; color: var(--cyan); text-decoration: none; margin-top: .15rem; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 100%; }
        .url-preview:hover { text-decoration: underline; }

        /* ── Delete form inline ── */
        .delete-form { display: inline; }

        /* ── Hamburger (mobile only) ── */
        .topbar-hamburger {
            display: none; background: none; border: none; cursor: pointer;
            color: var(--text); padding: .3rem; border-radius: .35rem; line-height: 0;
            transition: background .15s; flex-shrink: 0;
        }
        .topbar-hamburger:hover { background: rgba(255,255,255,.06); }
        .topbar-hamburger svg { width: 22px; height: 22px; }

        /* ── Mobile overlay ── */
        .admin-overlay {
            display: none; position: fixed; inset: 0; z-index: 55;
            background: rgba(0,0,0,.55); backdrop-filter: blur(2px); cursor: pointer;
        }
        .admin-overlay.active { display: block; }

        /* ── Mobile responsive (<=768px) ── */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-250px); transition: transform .25s ease; z-index: 60; }
            .sidebar.open { transform: translateX(0); }
            .admin-main { margin-left: 0 !important; }
            .topbar { padding: .6rem 1rem; }
            .topbar-hamburger { display: inline-flex !important; align-items: center; justify-content: center; }
            .topbar-title { font-size: .9rem; }
            .topbar-breadcrumb { display: none; }
            .admin-content { padding: 1rem; }
            .form-grid-2 { grid-template-columns: 1fr !important; }
            .card-header { flex-wrap: wrap; gap: .5rem; }
            .stats-grid { grid-template-columns: repeat(2, 1fr) !important; }
            .table-wrap table { min-width: 500px; }
        }
    </style>
</head>
<body>
<div class="admin-overlay" id="admin-overlay" onclick="closeSidebar()"></div>

{{-- ── Sidebar ─────────────────────────────────────────────────────────────── --}}
<aside class="sidebar" id="admin-sidebar">
    <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">
        <div class="sidebar-logo-icon">P</div>
        <div>
            <div class="sidebar-logo-text">Portfolio CMS</div>
            <div class="sidebar-logo-sub">Admin Panel</div>
        </div>
    </a>

    <nav>
        <div class="sidebar-section">
            <div class="sidebar-section-label">Overview</div>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                Dashboard
            </a>
        </div>
        <div class="sidebar-section">
            <div class="sidebar-section-label">Content</div>
            <a href="{{ route('admin.projects.index') }}" class="sidebar-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                Projects
            </a>
            <a href="{{ route('admin.skills.index') }}" class="sidebar-link {{ request()->routeIs('admin.skills.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                Skills
            </a>
            <a href="{{ route('admin.experiences.index') }}" class="sidebar-link {{ request()->routeIs('admin.experiences.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Experience
            </a>
            <a href="{{ route('admin.education.index') }}" class="sidebar-link {{ request()->routeIs('admin.education.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                Education
            </a>
            <a href="{{ route('admin.certifications.index') }}" class="sidebar-link {{ request()->routeIs('admin.certifications.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                Certifications
            </a>
            <a href="{{ route('admin.testimonials.index') }}" class="sidebar-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                Testimonials
            </a>
        </div>
        <div class="sidebar-section">
            <div class="sidebar-section-label">System</div>
            <a href="{{ route('admin.settings.index') }}" class="sidebar-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/></svg>
                Settings
            </a>
        </div>
    </nav>

    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="sidebar-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
            <div>
                <div class="sidebar-username">{{ auth()->user()->name ?? 'Admin' }}</div>
                <div class="sidebar-useremail">{{ auth()->user()->email ?? '' }}</div>
            </div>
        </div>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="sidebar-logout">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Sign out
            </button>
        </form>
    </div>
</aside>

{{-- ── Main ─────────────────────────────────────────────────────────────────── --}}
<div class="admin-main">
    <header class="topbar">
        <div style="display:flex;align-items:center;gap:.75rem;">
            <button class="topbar-hamburger" onclick="toggleSidebar()" aria-label="Toggle menu">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <div class="topbar-left">
                <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
                <div class="topbar-breadcrumb">@yield('breadcrumb', 'Admin')</div>
            </div>
        </div>
        <div class="topbar-right">
            <a href="{{ route('home') }}" target="_blank" class="topbar-view-site">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                View Site
            </a>
        </div>
    </header>

    <main class="admin-content">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-error">{{ $errors->first() }}</div>
        @endif

        @yield('content')
    </main>
</div>

<script>
function toggleSidebar() {
    document.getElementById('admin-sidebar').classList.toggle('open');
    document.getElementById('admin-overlay').classList.toggle('active');
}
function closeSidebar() {
    document.getElementById('admin-sidebar').classList.remove('open');
    document.getElementById('admin-overlay').classList.remove('active');
}
</script>

@if(!empty($settings['whatsapp']))
<a href="https://wa.me/{{ preg_replace('/[^0-9]/','', $settings['whatsapp']) }}"
   target="_blank" rel="noopener"
   style="position:fixed;bottom:1.5rem;right:1.5rem;z-index:50;width:3.25rem;height:3.25rem;background:#22c55e;border-radius:9999px;display:flex;align-items:center;justify-content:center;color:white;box-shadow:0 4px 14px rgba(34,197,94,0.4);transition:transform .2s,background .2s;"
   onmouseover="this.style.transform='scale(1.1)';this.style.background='#16a34a'"
   onmouseout="this.style.transform='scale(1)';this.style.background='#22c55e'"
   aria-label="WhatsApp">
    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 24 24">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
    </svg>
</a>
@endif

</body>
</html>
