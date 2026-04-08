<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Portfolio CMS</title>
    <script>(function(){var t=localStorage.getItem('theme')||'dark';document.documentElement.setAttribute('data-theme',t);})();</script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg:       #050508;
            --surface:  #0d0d1a;
            --border:   #1e293b;
            --border2:  #334155;
            --text:     #cbd5e1;
            --muted:    #64748b;
            --cyan:     #22d3ee;
            --cyan-dim: rgba(34,211,238,.12);
            --purple:   #a78bfa;
            --green:    #4ade80;
            --yellow:   #eab308;
            --red:      #f43f5e;
            --sidebar-w: 260px;
        }
        html, body { height: 100%; font-family: 'Segoe UI', system-ui, sans-serif; background: var(--bg); color: var(--text); font-size: 14px; }

        /* Sidebar */
        .sidebar {
            position: fixed; inset: 0 auto 0 0;
            width: var(--sidebar-w);
            background: var(--surface);
            border-right: 1px solid var(--border);
            display: flex; flex-direction: column;
            z-index: 100; overflow-y: auto;
            transition: transform .25s ease;
        }
        .sidebar-logo {
            padding: 1.5rem 1.25rem;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; gap: .75rem;
        }
        .sidebar-logo-icon {
            width: 36px; height: 36px; border-radius: 8px;
            background: linear-gradient(135deg, var(--cyan), var(--purple));
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 1rem; color: #050508;
        }
        .sidebar-logo-text { font-weight: 600; font-size: .95rem; color: var(--text); line-height: 1.2; }
        .sidebar-logo-sub { font-size: .72rem; color: var(--muted); }

        .sidebar-nav { padding: 1rem 0; flex: 1; }
        .nav-section { padding: .25rem 1.25rem .5rem; font-size: .68rem; text-transform: uppercase; letter-spacing: .08em; color: var(--muted); }
        .nav-item {
            display: flex; align-items: center; gap: .65rem;
            padding: .6rem 1.25rem;
            color: var(--muted);
            text-decoration: none;
            transition: all .15s;
            border-left: 2px solid transparent;
            font-size: .875rem;
        }
        .nav-item:hover { color: var(--text); background: rgba(255,255,255,.04); }
        .nav-item.active { color: var(--cyan); background: var(--cyan-dim); border-left-color: var(--cyan); }
        .nav-item svg { width: 16px; height: 16px; flex-shrink: 0; }

        .sidebar-footer {
            padding: 1rem 1.25rem;
            border-top: 1px solid var(--border);
            display: flex; flex-direction: column; gap: .5rem;
        }
        .sidebar-footer a {
            display: flex; align-items: center; gap: .6rem;
            font-size: .8rem; color: var(--muted); text-decoration: none;
            padding: .4rem .5rem; border-radius: 6px; transition: all .15s;
        }
        .sidebar-footer a:hover { color: var(--text); background: rgba(255,255,255,.05); }
        .sidebar-footer a svg { width: 14px; height: 14px; }

        /* Main */
        .main { margin-left: var(--sidebar-w); min-height: 100vh; display: flex; flex-direction: column; }
        .topbar {
            position: sticky; top: 0; z-index: 50;
            background: rgba(5,5,8,.9); backdrop-filter: blur(8px);
            border-bottom: 1px solid var(--border);
            padding: .85rem 1.75rem;
            display: flex; align-items: center; justify-content: space-between;
        }
        .topbar-title { font-size: 1rem; font-weight: 600; color: var(--text); }
        .topbar-breadcrumb { font-size: .8rem; color: var(--muted); }
        .topbar-breadcrumb a { color: var(--muted); text-decoration: none; }
        .topbar-breadcrumb a:hover { color: var(--cyan); }
        .topbar-user { display: flex; align-items: center; gap: .6rem; font-size: .8rem; color: var(--muted); }
        .topbar-avatar {
            width: 30px; height: 30px; border-radius: 50%;
            background: linear-gradient(135deg, var(--cyan), var(--purple));
            display: flex; align-items: center; justify-content: center;
            font-size: .75rem; font-weight: 700; color: #050508;
        }

        .content { padding: 2rem 1.75rem; flex: 1; }

        /* Cards */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: .75rem;
            overflow: hidden;
        }
        .card-header {
            padding: 1.1rem 1.4rem;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
            gap: 1rem;
        }
        .card-title { font-size: .95rem; font-weight: 600; color: var(--text); }
        .card-body { padding: 1.4rem; }

        /* Stat cards */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 1rem; margin-bottom: 1.5rem; }
        .stat-card {
            background: var(--surface); border: 1px solid var(--border); border-radius: .75rem;
            padding: 1.25rem; display: flex; flex-direction: column; gap: .4rem;
        }
        .stat-icon { font-size: 1.4rem; }
        .stat-value { font-size: 1.75rem; font-weight: 700; color: var(--cyan); }
        .stat-label { font-size: .78rem; color: var(--muted); }

        /* Buttons */
        .btn {
            display: inline-flex; align-items: center; gap: .4rem;
            padding: .5rem 1rem; border-radius: .5rem; font-size: .8rem; font-weight: 500;
            border: none; cursor: pointer; text-decoration: none; transition: all .15s; white-space: nowrap;
        }
        .btn svg { width: 14px; height: 14px; }
        .btn-primary { background: var(--cyan); color: #050508; }
        .btn-primary:hover { background: #67e8f9; }
        .btn-outline { background: transparent; color: var(--text); border: 1px solid var(--border2); }
        .btn-outline:hover { border-color: var(--cyan); color: var(--cyan); }
        .btn-danger { background: rgba(244,63,94,.15); color: var(--red); border: 1px solid rgba(244,63,94,.3); }
        .btn-danger:hover { background: rgba(244,63,94,.25); }
        .btn-sm { padding: .35rem .75rem; font-size: .75rem; }

        /* Forms */
        .form-grid { display: grid; gap: 1.25rem; }
        .form-grid-2 { grid-template-columns: 1fr 1fr; }
        @media (max-width: 640px) { .form-grid-2 { grid-template-columns: 1fr; } }
        .form-group { display: flex; flex-direction: column; gap: .4rem; }
        .form-group.span-2 { grid-column: span 2; }
        @media (max-width: 640px) { .form-group.span-2 { grid-column: span 1; } }
        label { font-size: .8rem; font-weight: 500; color: var(--text); }
        label .req { color: var(--red); margin-left: 2px; }
        input[type=text], input[type=email], input[type=url], input[type=number], input[type=password],
        textarea, select {
            width: 100%; padding: .55rem .85rem;
            background: var(--bg); border: 1px solid var(--border2);
            border-radius: .4rem; color: var(--text); font-size: .875rem;
            outline: none; transition: border-color .15s; font-family: inherit;
        }
        input:focus, textarea:focus, select:focus { border-color: var(--cyan); }
        input[type=file] {
            width: 100%; padding: .55rem .85rem;
            background: var(--bg); border: 1px solid var(--border2);
            border-radius: .4rem; color: var(--muted); font-size: .8rem;
        }
        textarea { resize: vertical; min-height: 90px; }
        select option { background: var(--surface); }
        .form-hint { font-size: .75rem; color: var(--muted); }
        .form-error { font-size: .75rem; color: var(--red); }
        .checkbox-wrap { display: flex; align-items: center; gap: .5rem; }
        .checkbox-wrap input[type=checkbox] { width: 16px; height: 16px; accent-color: var(--cyan); }

        /* Toggle switch */
        .toggle { position: relative; display: inline-flex; align-items: center; gap: .5rem; cursor: pointer; }
        .toggle input { display: none; }
        .toggle-track {
            width: 40px; height: 22px; background: var(--border2); border-radius: 999px; transition: background .2s;
        }
        .toggle input:checked ~ .toggle-track { background: var(--cyan); }
        .toggle-thumb {
            position: absolute; left: 3px; width: 16px; height: 16px;
            background: #fff; border-radius: 50%; transition: transform .2s; pointer-events: none;
        }
        .toggle input:checked ~ .toggle-track ~ .toggle-thumb { transform: translateX(18px); }
        .toggle-label { font-size: .875rem; color: var(--text); }

        /* Table */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; font-size: .72rem; text-transform: uppercase; letter-spacing: .06em; color: var(--muted); padding: .75rem 1rem; border-bottom: 1px solid var(--border); white-space: nowrap; }
        td { padding: .8rem 1rem; border-bottom: 1px solid var(--border); color: var(--text); font-size: .85rem; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: rgba(255,255,255,.02); }

        /* Badges */
        .badge { display: inline-flex; align-items: center; padding: .2rem .6rem; border-radius: 999px; font-size: .7rem; font-weight: 500; }
        .badge-cyan { background: rgba(34,211,238,.12); color: var(--cyan); border: 1px solid rgba(34,211,238,.25); }
        .badge-purple { background: rgba(167,139,250,.12); color: var(--purple); border: 1px solid rgba(167,139,250,.25); }
        .badge-green { background: rgba(74,222,128,.12); color: var(--green); border: 1px solid rgba(74,222,128,.25); }
        .badge-yellow { background: rgba(234,179,8,.12); color: var(--yellow); border: 1px solid rgba(234,179,8,.25); }
        .badge-red { background: rgba(244,63,94,.12); color: var(--red); border: 1px solid rgba(244,63,94,.25); }
        .badge-gray { background: rgba(100,116,139,.12); color: var(--muted); border: 1px solid rgba(100,116,139,.25); }

        /* Alert */
        .alert { padding: .85rem 1.1rem; border-radius: .5rem; font-size: .85rem; margin-bottom: 1.25rem; }
        .alert-success { background: rgba(74,222,128,.1); color: var(--green); border: 1px solid rgba(74,222,128,.25); }
        .alert-error { background: rgba(244,63,94,.1); color: var(--red); border: 1px solid rgba(244,63,94,.25); }

        /* Pagination */
        .pagination { display: flex; gap: .35rem; flex-wrap: wrap; align-items: center; padding: 1rem 1.4rem; border-top: 1px solid var(--border); }
        .pagination a, .pagination span {
            display: inline-flex; align-items: center; justify-content: center;
            min-width: 32px; height: 32px; padding: 0 .5rem;
            border-radius: .35rem; font-size: .8rem; text-decoration: none;
            border: 1px solid var(--border); color: var(--muted); transition: all .15s;
        }
        .pagination a:hover { border-color: var(--cyan); color: var(--cyan); }
        .pagination .active { background: var(--cyan); color: #050508; border-color: var(--cyan); font-weight: 600; }
        .pagination .disabled { opacity: .4; pointer-events: none; }

        /* Image preview */
        .img-preview { width: 48px; height: 48px; object-fit: cover; border-radius: .4rem; border: 1px solid var(--border); }
        .img-preview-lg { width: 80px; height: 80px; object-fit: cover; border-radius: .5rem; border: 1px solid var(--border); display: block; margin-bottom: .5rem; }

        /* Mobile overlay */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main { margin-left: 0; }
            .overlay { position: fixed; inset: 0; background: rgba(0,0,0,.6); z-index: 90; display: none; }
            .overlay.show { display: block; }
        }
        .mobile-toggle {
            display: none; background: none; border: none; color: var(--text); cursor: pointer; padding: .3rem;
        }
        @media (max-width: 768px) { .mobile-toggle { display: flex; } }

        .flex { display: flex; }
        .items-center { align-items: center; }
        .gap-2 { gap: .5rem; }
        .gap-3 { gap: .75rem; }
        .ml-auto { margin-left: auto; }
        .text-muted { color: var(--muted); }
        .font-mono { font-family: 'JetBrains Mono', 'Courier New', monospace; }
        .truncate { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 280px; }
        .actions { display: flex; gap: .4rem; }
        .mt-4 { margin-top: 1rem; }
        .mb-4 { margin-bottom: 1rem; }

        /* ── Light theme ───────────────────────────────────────────────── */
        [data-theme="light"] {
            --bg:       #f8fafc;
            --surface:  #ffffff;
            --border:   #e2e8f0;
            --border2:  #cbd5e1;
            --text:     #1e293b;
            --muted:    #64748b;
            --cyan-dim: rgba(6,182,212,.1);
        }
        [data-theme="light"] html,
        [data-theme="light"] body { background: var(--bg); color: var(--text); }
        [data-theme="light"] .topbar { background: rgba(248,250,252,.95); }
        [data-theme="light"] .sidebar { background: var(--surface); }
        [data-theme="light"] input[type=text],[data-theme="light"] input[type=email],
        [data-theme="light"] input[type=url],[data-theme="light"] input[type=number],
        [data-theme="light"] input[type=password],[data-theme="light"] textarea,
        [data-theme="light"] select { background: #f8fafc; color: var(--text); }
        [data-theme="light"] select option { background: #ffffff; color: #1e293b; }
        [data-theme="light"] tr:hover td { background: rgba(0,0,0,.015); }
        [data-theme="light"] .btn-primary { color: #0f172a; }
        [data-theme="light"] .btn-danger { background: rgba(244,63,94,.08); }
        [data-theme="light"] .alert-success { background: rgba(74,222,128,.08); }
        [data-theme="light"] .alert-error { background: rgba(244,63,94,.08); }
        [data-theme="light"] .img-preview,
        [data-theme="light"] .img-preview-lg { border-color: var(--border); }
    </style>
</head>
<body x-data="{
        sidebarOpen: false,
        darkMode: localStorage.getItem('theme') !== 'light',
        toggleTheme() {
            this.darkMode = !this.darkMode;
            const t = this.darkMode ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', t);
            localStorage.setItem('theme', t);
        }
    }">

<div class="overlay" :class="{ show: sidebarOpen }" @click="sidebarOpen = false"></div>

<!-- Sidebar -->
<aside class="sidebar" :class="{ open: sidebarOpen }">
    <div class="sidebar-logo">
        <div class="sidebar-logo-icon">P</div>
        <div>
            <div class="sidebar-logo-text">Portfolio CMS</div>
            <div class="sidebar-logo-sub">Admin Dashboard</div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section">Overview</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Dashboard
        </a>

        <div class="nav-section" style="margin-top:.5rem">Content</div>
        <a href="{{ route('admin.projects.index') }}" class="nav-item {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
            Projects
        </a>
        <a href="{{ route('admin.experiences.index') }}" class="nav-item {{ request()->routeIs('admin.experiences.*') ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            Experience
        </a>
        <a href="{{ route('admin.skills.index') }}" class="nav-item {{ request()->routeIs('admin.skills.*') ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/></svg>
            Skills
        </a>
        <a href="{{ route('admin.education.index') }}" class="nav-item {{ request()->routeIs('admin.education.*') ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
            Education
        </a>
        <a href="{{ route('admin.certifications.index') }}" class="nav-item {{ request()->routeIs('admin.certifications.*') ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
            Certifications
        </a>
        <a href="{{ route('admin.testimonials.index') }}" class="nav-item {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
            Testimonials
        </a>

        <div class="nav-section" style="margin-top:.5rem">System</div>
        <a href="{{ route('admin.settings.index') }}" class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            Settings
        </a>
    </nav>

    <div class="sidebar-footer">
        <a href="{{ url('/') }}" target="_blank">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            View Site
        </a>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" style="background:none;border:none;width:100%;text-align:left;cursor:pointer;display:flex;align-items:center;gap:.6rem;font-size:.8rem;color:var(--muted);padding:.4rem .5rem;border-radius:6px;transition:all .15s;" onmouseover="this.style.color='var(--red)';this.style.background='rgba(244,63,94,.08)'" onmouseout="this.style.color='var(--muted)';this.style.background='none'">
                <svg style="width:14px;height:14px" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Logout
            </button>
        </form>
    </div>
</aside>

<!-- Main -->
<div class="main">
    <header class="topbar">
        <div class="flex items-center gap-3">
            <button class="mobile-toggle" @click="sidebarOpen = !sidebarOpen">
                <svg style="width:20px;height:20px" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <div>
                <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
                <div class="topbar-breadcrumb">@yield('breadcrumb', '<a href="'.route('admin.dashboard').'">Admin</a>')</div>
            </div>
        </div>
        <div class="topbar-user">
            <button @click="toggleTheme()"
                    :title="darkMode ? 'Switch to Light Mode' : 'Switch to Dark Mode'"
                    style="background:none;border:1px solid var(--border2);color:var(--muted);border-radius:.45rem;width:30px;height:30px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .15s;flex-shrink:0;"
                    onmouseover="this.style.borderColor='var(--cyan)';this.style.color='var(--cyan)'"
                    onmouseout="this.style.borderColor='var(--border2)';this.style.color='var(--muted)'">
                <svg x-show="darkMode" style="width:14px;height:14px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M12 17a5 5 0 100-10 5 5 0 000 10z"/></svg>
                <svg x-show="!darkMode" style="width:14px;height:14px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
            </button>
            <span>{{ auth()->user()->name }}</span>
            <div class="topbar-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
        </div>
    </header>

    <main class="content">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-error">
                <ul style="margin:0;padding-left:1rem">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</div>

</body>
</html>
