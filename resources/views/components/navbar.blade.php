<nav id="navbar" x-data="{ open: false, scrolled: false }"
     x-init="scrolled = window.scrollY > 20; window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })"
     :style="scrolled ? 'background:rgba(5,5,8,0.95);backdrop-filter:blur(12px);border-bottom:1px solid rgba(30,41,59,0.6);box-shadow:0 4px 30px rgba(0,0,0,0.4)' : ''"
     style="position:fixed;top:0;left:0;right:0;z-index:50;transition:all .3s">

    <div style="max-width:80rem;margin:0 auto;padding:1rem 1.5rem;display:flex;align-items:center;justify-content:space-between;">

        {{-- Logo --}}
        <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:.5rem;text-decoration:none;">
            <div style="width:2.25rem;height:2.25rem;border-radius:.5rem;background:linear-gradient(135deg,#06b6d4,#8b5cf6);display:flex;align-items:center;justify-content:center;font-weight:700;color:#050508;font-size:.875rem;">
                {{ strtoupper(substr($settings['name'] ?? 'P', 0, 1)) }}
            </div>
            <span style="font-weight:700;color:white;font-family:'JetBrains Mono',monospace;">
                {{ explode(' ', $settings['name'] ?? 'Portfolio')[0] }}<span style="color:#22d3ee;">.</span>
            </span>
        </a>

        {{-- Desktop links --}}
        <div class="hidden-mobile" style="display:flex;align-items:center;gap:1.75rem;">
            @foreach(['#about'=>'About','#skills'=>'Skills','#projects'=>'Projects','#experience'=>'Experience','#education'=>'Education','#endorsements'=>'Endorsements','#contact'=>'Contact'] as $href=>$label)
            <a href="{{ $href }}" class="nav-link">{{ $label }}</a>
            @endforeach
        </div>

        {{-- CTA + theme toggle --}}
        <div class="hidden-mobile" style="display:flex;align-items:center;gap:.75rem;">
            <button onclick="toggleTheme()" title="Toggle theme" style="display:inline-flex;align-items:center;justify-content:center;width:2.25rem;height:2.25rem;border-radius:.5rem;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);cursor:pointer;color:#94a3b8;transition:color .2s,background .2s;" onmouseover="this.style.background='rgba(34,211,238,.12)';this.style.color='#22d3ee'" onmouseout="this.style.background='rgba(255,255,255,.06)';this.style.color='#94a3b8'" aria-label="Toggle theme">
                <svg class="theme-moon" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/></svg>
                <svg class="theme-sun" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="5"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg>
            </button>
            @if(!empty($settings['email']))
            <a href="mailto:{{ $settings['email'] }}" class="btn-primary" style="font-size:.8rem;padding:.6rem 1.25rem;">Hire Me</a>
            @endif
        </div>

        {{-- Hamburger --}}
        <button @click="open=!open" style="display:none;background:none;border:none;cursor:pointer;color:#94a3b8;" class="show-mobile">
            <svg x-show="!open" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            <svg x-show="open"  width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>

    {{-- Mobile menu --}}
    <div x-show="open" x-transition style="background:rgba(10,10,18,0.98);backdrop-filter:blur(12px);border-top:1px solid #1e293b;padding:1rem 1.5rem;">
        @foreach(['#about'=>'About','#skills'=>'Skills','#projects'=>'Projects','#experience'=>'Experience','#education'=>'Education','#endorsements'=>'Endorsements','#contact'=>'Contact'] as $href=>$label)
        <a href="{{ $href }}" @click="open=false" style="display:block;padding:.6rem 0;color:#cbd5e1;text-decoration:none;font-weight:500;transition:color .2s;"
           onmouseover="this.style.color='#22d3ee'" onmouseout="this.style.color='#cbd5e1'">{{ $label }}</a>
        @endforeach
        @if(!empty($settings['email']))
        <a href="mailto:{{ $settings['email'] }}" class="btn-primary" style="margin-top:.75rem;display:inline-flex;">Hire Me</a>
        @endif
        <button onclick="toggleTheme()" style="display:flex;align-items:center;gap:.5rem;margin-top:.75rem;background:none;border:1px solid rgba(255,255,255,.1);border-radius:.5rem;padding:.5rem .75rem;color:#94a3b8;cursor:pointer;font-size:.8rem;width:100%;" aria-label="Toggle theme">
            <svg class="theme-moon" width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/></svg>
            <svg class="theme-sun" width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="5"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg>
            <span class="theme-moon">Switch to Light</span>
            <span class="theme-sun">Switch to Dark</span>
        </button>
    </div>
</nav>

<style>
@media(max-width:768px){
    .hidden-mobile{display:none!important;}
    .show-mobile{display:block!important;}
}
</style>
