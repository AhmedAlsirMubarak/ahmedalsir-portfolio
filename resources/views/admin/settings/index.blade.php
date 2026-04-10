@extends('admin.layouts.app')

@section('title', 'Settings')
@section('page-title', 'Settings')
@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Admin</a> / Settings
@endsection

@section('content')
<form method="POST" action="{{ route('admin.settings.update') }}">
    @csrf

    {{-- ── Personal ────────────────────────────────────────────────────────── --}}
    <div class="card" style="margin-bottom:1.5rem">
        <div class="card-header"><span class="card-title">Personal Info</span></div>
        <div class="card-body">
            <div class="form-grid form-grid-2">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" value="{{ $settings['name'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label>Title / Headline</label>
                    <input type="text" name="title" value="{{ $settings['title'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label>Email (public)</label>
                    <input type="email" name="email" value="{{ $settings['email'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label>WhatsApp</label>
                    <input type="text" name="whatsapp" value="{{ $settings['whatsapp'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label>LinkedIn URL</label>
                    <input type="url" name="linkedin" value="{{ $settings['linkedin'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label>GitHub URL</label>
                    <input type="url" name="github" value="{{ $settings['github'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label>CV / Resume URL</label>
                    <input type="text" name="cv_url" value="{{ $settings['cv_url'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label>Available for Work</label>
                    <select name="available">
                        <option value="1" {{ ($settings['available'] ?? '1') == '1' ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ ($settings['available'] ?? '1') == '0' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>
            <div class="form-group" style="margin-top:1rem">
                <label>Short Bio</label>
                <textarea name="bio" rows="3">{{ $settings['bio'] ?? '' }}</textarea>
            </div>
            <div class="form-group">
                <label>About Text</label>
                <textarea name="about_text" rows="5">{{ $settings['about_text'] ?? '' }}</textarea>
            </div>
        </div>
    </div>

    {{-- ── Hero Stats ───────────────────────────────────────────────────────── --}}
    <div class="card" style="margin-bottom:1.5rem">
        <div class="card-header"><span class="card-title">Hero Stats</span></div>
        <div class="card-body">
            <div class="form-grid form-grid-2">
                <div class="form-group">
                    <label>Years Experience</label>
                    <input type="text" name="years_exp" value="{{ $settings['years_exp'] ?? '' }}" placeholder="5+">
                </div>
                <div class="form-group">
                    <label>Projects Count</label>
                    <input type="text" name="projects_count" value="{{ $settings['projects_count'] ?? '' }}" placeholder="50+">
                </div>
                <div class="form-group">
                    <label>Client Satisfaction</label>
                    <input type="text" name="satisfaction" value="{{ $settings['satisfaction'] ?? '' }}" placeholder="100%">
                </div>
                <div class="form-group">
                    <label>Sprint Delivery</label>
                    <input type="text" name="sprint_delivery" value="{{ $settings['sprint_delivery'] ?? '' }}" placeholder="95%+">
                </div>
            </div>
        </div>
    </div>

    {{-- ── SEO ──────────────────────────────────────────────────────────────── --}}
    <div class="card" style="margin-bottom:1.5rem">
        <div class="card-header"><span class="card-title">SEO</span></div>
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group">
                    <label>Meta Title</label>
                    <input type="text" name="meta_title" value="{{ $settings['meta_title'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label>Meta Description</label>
                    <textarea name="meta_description" rows="2">{{ $settings['meta_description'] ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label>Footer Text</label>
                    <textarea name="footer_text" rows="2">{{ $settings['footer_text'] ?? '' }}</textarea>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Code Snippets ────────────────────────────────────────────────────── --}}
    <div class="card" style="margin-bottom:1.5rem">
        <div class="card-header"><span class="card-title">Code Snippets</span></div>
        <div class="card-body">
            <div class="form-group" style="margin-bottom:1rem">
                <label>Hero Code Snippet</label>
                <textarea name="code_snippet" rows="8" style="font-family:'JetBrains Mono',monospace;font-size:.8rem">{{ $settings['code_snippet'] ?? '' }}</textarea>
            </div>
            <div class="form-group">
                <label>About Code Snippet</label>
                <textarea name="about_snippet" rows="8" style="font-family:'JetBrains Mono',monospace;font-size:.8rem">{{ $settings['about_snippet'] ?? '' }}</textarea>
            </div>
        </div>
    </div>

    {{-- ── Dynamic Lists ─────────────────────────────────────────────────────── --}}
    <div class="card" style="margin-bottom:1.5rem">
        <div class="card-header"><span class="card-title">Dynamic Lists (JSON arrays)</span></div>
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group">
                    <label>Hero Tags <span style="font-size:.72rem;color:var(--muted)">(JSON array e.g. ["Laravel","Vue.js"])</span></label>
                    <input type="text" name="hero_tags" value="{{ $settings['hero_tags'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label>Typed Phrases <span style="font-size:.72rem;color:var(--muted)">(JSON array)</span></label>
                    <input type="text" name="typed_phrases" value="{{ $settings['typed_phrases'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label>About Badges <span style="font-size:.72rem;color:var(--muted)">(JSON array)</span></label>
                    <input type="text" name="about_badges" value="{{ $settings['about_badges'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label>About Cards <span style="font-size:.72rem;color:var(--muted)">(JSON array of objects)</span></label>
                    <textarea name="about_cards" rows="4">{{ $settings['about_cards'] ?? '' }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Save Settings</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline">Cancel</a>
    </div>
</form>
@endsection
