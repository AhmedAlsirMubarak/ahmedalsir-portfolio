<nav id="navbar" x-data="{ open: false, scrolled: false, darkMode: localStorage.getItem('theme') !== 'light' }"
     x-init="
         scrolled = window.scrollY > 20;
         window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 });
         window.addEventListener('theme-changed', e => { darkMode = e.detail === 'dark'; });
     "
     :style="scrolled ? (darkMode
         ? 'background:rgba(5,5,8,0.95);backdrop-filter:blur(12px);border-bottom:1px solid rgba(30,41,59,0.6);box-shadow:0 4px 30px rgba(0,0,0,0.4)'
         : 'background:rgba(248,250,252,0.97);backdrop-filter:blur(12px);border-bottom:1px solid rgba(203,213,225,.7);box-shadow:0 4px 30px rgba(100,116,139,.12)') : ''"
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

        {{-- CTA + Theme Toggle --}}
        <div class="hidden-mobile" style="display:flex;align-items:center;gap:.75rem;">
            {{-- Theme toggle --}}
            <button onclick="toggleTheme()"
                    :title="darkMode ? 'Switch to Light Mode' : 'Switch to Dark Mode'"
                    style="background:none;border:none;cursor:pointer;line-height:0;padding:.4rem;border-radius:.5rem;transition:color .2s,background .2s;"
                    :style="darkMode ? 'color:#94a3b8' : 'color:#475569'"
                    onmouseover="this.style.color='#22d3ee'" onmouseout="this.style.color=''"
                    aria-label="Toggle theme">
                <svg x-show="darkMode" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M12 17a5 5 0 100-10 5 5 0 000 10z"/></svg>
                <svg x-show="!darkMode" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
            </button>
            @if(!empty($settings['email']))
            <a href="mailto:{{ $settings['email'] }}" class="btn-primary" style="font-size:.8rem;padding:.6rem 1.25rem;">Hire Me</a>
            @endif
        </div>

        {{-- Hamburger + mobile theme toggle --}}
        <div style="display:none;align-items:center;gap:.5rem;" class="show-mobile">
            <button onclick="toggleTheme()"
                    :title="darkMode ? 'Switch to Light Mode' : 'Switch to Dark Mode'"
                    style="background:none;border:none;cursor:pointer;line-height:0;padding:.4rem;"
                    :style="darkMode ? 'color:#94a3b8' : 'color:#475569'"
                    aria-label="Toggle theme">
                <svg x-show="darkMode" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M12 17a5 5 0 100-10 5 5 0 000 10z"/></svg>
                <svg x-show="!darkMode" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
            </button>
            <button @click="open=!open" style="background:none;border:none;cursor:pointer;" :style="darkMode ? 'color:#94a3b8' : 'color:#475569'">
                <svg x-show="!open" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-show="open"  width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </div>

    {{-- Mobile menu — x-show on wrapper, :style on inner div to avoid display:none conflict --}}
    <div x-show="open" x-transition>
        <div :style="darkMode
                 ? 'background:rgba(10,10,18,0.98);backdrop-filter:blur(12px);border-top:1px solid #1e293b;padding:1rem 1.5rem;'
                 : 'background:rgba(248,250,252,0.98);backdrop-filter:blur(12px);border-top:1px solid #e2e8f0;padding:1rem 1.5rem;'">
        @foreach(['#about'=>'About','#skills'=>'Skills','#projects'=>'Projects','#experience'=>'Experience','#education'=>'Education','#endorsements'=>'Endorsements','#contact'=>'Contact'] as $href=>$label)
        <a href="{{ $href }}" @click="open=false"
           style="display:block;padding:.6rem 0;text-decoration:none;font-weight:500;transition:color .2s;"
           :style="darkMode ? 'color:#cbd5e1' : 'color:#334155'"
           @mouseover="$el.style.color='#22d3ee'"
           @mouseout="$el.style.color = darkMode ? '#cbd5e1' : '#334155'">{{ $label }}</a>
        @endforeach
        @if(!empty($settings['email']))
        <a href="mailto:{{ $settings['email'] }}" class="btn-primary" style="margin-top:.75rem;display:inline-flex;">Hire Me</a>
        @endif
    </div>
</nav>

<style>
@media(max-width:768px){
    .hidden-mobile{display:none!important;}
    .show-mobile{display:flex!important;}
}
</style>
