<section style="position:relative;min-height:100vh;display:flex;align-items:center;padding:5rem 0 4rem;" class="hero-grid">
    {{-- Orbs --}}
    <div class="orb" style="width:24rem;height:24rem;background:var(--orb-purple);top:-5rem;left:-5rem;"></div>
    <div class="orb" style="width:20rem;height:20rem;background:var(--orb-cyan);top:33%;right:0;animation-delay:3s"></div>
    <div class="orb" style="width:16rem;height:16rem;background:var(--orb-purple-sm);bottom:0;left:33%;animation-delay:1.5s"></div>

    <div style="position:relative;z-index:10;max-width:80rem;margin:0 auto;padding:0 1.5rem;width:100%;">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:3rem;align-items:center;" class="hero-grid-cols">

            {{-- Left --}}
            <div style="display:flex;flex-direction:column;gap:1.5rem;">
                @if(!empty($settings['available']))
                <div style="display:inline-flex;align-items:center;gap:.5rem;padding:.5rem 1rem;background:rgb(74 222 128/0.1);border:1px solid rgb(74 222 128/0.2);border-radius:9999px;width:fit-content;">
                    <span class="available-dot"></span>
                    <span style="color:#4ade80;font-size:.75rem;font-family:'JetBrains Mono',monospace;font-weight:500;">Available for opportunities</span>
                </div>
                @endif

                <div>
                    <p style="color:var(--c-secondary);font-family:'JetBrains Mono',monospace;font-size:.8rem;letter-spacing:.15em;text-transform:uppercase;margin-bottom:.5rem;">Hello, I'm</p>
                    <h1 style="font-size:clamp(2.5rem,5vw,3.75rem);font-weight:700;color:var(--c-heading);line-height:1.1;margin:0 0 .75rem;">{{ $settings['name'] ?? 'Your Name' }}</h1>
                    <h2 style="font-size:clamp(1.25rem,2.5vw,1.875rem);font-weight:600;margin:0;">
                        <span class="gradient-text">
                            <span id="typed-text" data-phrases="{{ htmlspecialchars($settings['typed_phrases'] ?? '[]') }}">{{ $settings['title'] ?? 'Senior Software Engineer' }}</span><span class="cursor"></span>
                        </span>
                    </h2>
                </div>

                <p style="color:var(--c-body);font-size:1.05rem;line-height:1.75;max-width:36rem;">{{ $settings['bio'] ?? '' }}</p>

                @php $heroTags = json_decode($settings['hero_tags'] ?? '[]', true) ?? []; @endphp
                @if(count($heroTags))
                <div style="display:flex;flex-wrap:wrap;gap:.5rem;">
                    @foreach($heroTags as $tag)<span class="tech-tag">{{ $tag }}</span>@endforeach
                </div>
                @endif

                <div style="display:flex;flex-wrap:wrap;gap:.75rem;padding-top:.5rem;">
                    @if(!empty($settings['email']))
                    <a href="mailto:{{ $settings['email'] }}" class="btn-primary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Get In Touch
                    </a>
                    @endif
                    @if(!empty($settings['cv_url']))
                    <a href="{{ $settings['cv_url'] }}" target="_blank" class="btn-outline">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        Download CV
                    </a>
                    @endif
                </div>

                <div style="display:flex;align-items:center;gap:1rem;">
                    <span style="color:var(--c-muted);font-size:.75rem;font-family:'JetBrains Mono',monospace;">Find me on:</span>
                    @if(!empty($settings['github']))
                    <a href="{{ $settings['github'] }}" target="_blank" style="color:var(--c-secondary);transition:color .2s;line-height:0;" onmouseover="this.style.color='var(--c-heading)'" onmouseout="this.style.color=''">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/></svg>
                    </a>
                    @endif
                    @if(!empty($settings['linkedin']))
                    <a href="{{ $settings['linkedin'] }}" target="_blank" style="color:var(--c-secondary);transition:color .2s;line-height:0;" onmouseover="this.style.color='#22d3ee'" onmouseout="this.style.color=''">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    @endif
                </div>
            </div>

            {{-- Right: Code block with floating cards --}}
            <div class="animate-on-scroll delay-200 hero-right-wrap">
                <div class="hero-right">
                    {{-- Code block (center) --}}
                    <div class="code-block hero-code" style="overflow:hidden;position:relative;z-index:1;">
                        <div style="display:flex;align-items:center;gap:.5rem;padding:.75rem 1.25rem;border-bottom:1px solid var(--border);background:var(--bg-code-bar);">
                            <div style="display:flex;gap:.375rem;">
                                <div style="width:.75rem;height:.75rem;border-radius:50%;background:rgba(239,68,68,.7);"></div>
                                <div style="width:.75rem;height:.75rem;border-radius:50%;background:rgba(234,179,8,.7);"></div>
                                <div style="width:.75rem;height:.75rem;border-radius:50%;background:rgba(34,197,94,.7);"></div>
                            </div>
                            <span style="color:var(--c-muted);font-size:.75rem;margin-left:.5rem;">developer.ts</span>
                        </div>
                        <div style="padding:1.25rem;display:flex;flex-direction:column;gap:.125rem;">
                            @php $lines = explode("\n", $settings['code_snippet'] ?? ''); @endphp
                            @foreach($lines as $i => $line)
                            <div class="code-line">
                                <span class="code-number">{{ $i + 1 }}</span>
                                <span>{!! \App\Helpers\CodeHighlighter::highlight($line) !!}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Floating: Years Exp (top-right) --}}
                    <div class="hero-float hero-float-years">
                        <div style="background:var(--bg-card);border:1px solid var(--border);border-radius:.875rem;padding:.75rem 1.25rem;box-shadow:0 8px 30px rgb(0 0 0 / 0.1);text-align:center;min-width:5.5rem;">
                            <span style="font-size:1.5rem;font-weight:700;color:var(--c-heading);display:block;">{{ $settings['years_exp'] ?? '5+' }}</span>
                            <span style="font-size:.65rem;color:var(--c-muted);font-family:'JetBrains Mono',monospace;">Years Exp.</span>
                        </div>
                    </div>

                    {{-- Floating: Backend (purple, left-center) --}}
                    <div class="hero-float hero-float-backend">
                        <div style="background:linear-gradient(135deg,#8b5cf6,#6d28d9);border-radius:.875rem;padding:1rem 1.25rem;color:#fff;display:flex;flex-direction:column;align-items:center;gap:.25rem;box-shadow:0 8px 30px rgb(139 92 246 / 0.4);min-width:7rem;">
                            <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"/></svg>
                            <span style="font-weight:700;font-size:.8rem;">Backend</span>
                            <span style="font-size:.6rem;opacity:.85;">Laravel</span>
                        </div>
                    </div>

                    {{-- Floating: Frontend (red, right-center) --}}
                    <div class="hero-float hero-float-frontend">
                        <div style="background:linear-gradient(135deg,#ef4444,#dc2626);border-radius:.875rem;padding:1rem 1.25rem;color:#fff;display:flex;flex-direction:column;align-items:center;gap:.25rem;box-shadow:0 8px 30px rgb(239 68 68 / 0.4);min-width:7rem;">
                            <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                            <span style="font-weight:700;font-size:.8rem;">Frontend</span>
                            <span style="font-size:.6rem;opacity:.85;">Vue.js</span>
                        </div>
                    </div>

                    {{-- Floating: Projects (bottom-left) --}}
                    <div class="hero-float hero-float-projects">
                        <div style="background:var(--bg-card);border:1px solid var(--border);border-radius:.875rem;padding:.75rem 1.25rem;box-shadow:0 8px 30px rgb(0 0 0 / 0.1);text-align:center;min-width:5.5rem;">
                            <span style="font-size:1.5rem;font-weight:700;color:var(--c-heading);display:block;">{{ $settings['projects_count'] ?? '50+' }}</span>
                            <span style="font-size:.65rem;color:var(--c-muted);font-family:'JetBrains Mono',monospace;">Projects</span>
                        </div>
                    </div>

                    {{-- Floating: Database (teal, bottom-right) --}}
                    <div class="hero-float hero-float-database">
                        <div style="background:linear-gradient(135deg,#06b6d4,#0891b2);border-radius:.875rem;padding:1rem 1.25rem;color:#fff;display:flex;flex-direction:column;align-items:center;gap:.25rem;box-shadow:0 8px 30px rgb(6 182 212 / 0.4);min-width:7rem;">
                            <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/></svg>
                            <span style="font-weight:700;font-size:.8rem;">Database</span>
                            <span style="font-size:.6rem;opacity:.85;">MySQL</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Scroll cue --}}
        <div style="position:absolute;bottom:2rem;left:50%;transform:translateX(-50%);display:flex;flex-direction:column;align-items:center;gap:.5rem;animation:float 3s ease-in-out infinite;">
            <span style="color:var(--c-faint);font-size:.7rem;font-family:'JetBrains Mono',monospace;text-transform:uppercase;letter-spacing:.15em;">Scroll Down</span>
            <svg width="20" height="20" fill="none" stroke="currentColor" style="color:var(--c-faint)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </div>
    </div>
</section>

<style>
/* Hero right: positioned container for floating cards */
.hero-right-wrap{display:flex;align-items:center;justify-content:center;}
.hero-right{position:relative;width:100%;max-width:30rem;aspect-ratio:4/3.5;}
.hero-code{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:80%;z-index:1;}

/* Floating cards — absolutely positioned around code block */
.hero-float{position:absolute;z-index:2;transition:transform .3s;}
.hero-float:hover{transform:scale(1.05);}

.hero-float-years{top:-0.5rem;right:-0.5rem;animation:heroFloat 5s ease-in-out infinite;animation-delay:0s;}
.hero-float-backend{top:18%;left:-2rem;animation:heroFloat 6s ease-in-out infinite;animation-delay:1s;transform:rotate(-3deg);}
.hero-float-frontend{top:42%;right:-2.5rem;animation:heroFloat 5.5s ease-in-out infinite;animation-delay:2s;transform:rotate(3deg);}
.hero-float-projects{bottom:22%;left:-0.5rem;animation:heroFloat 6s ease-in-out infinite;animation-delay:.5s;}
.hero-float-database{bottom:5%;right:12%;animation:heroFloat 5s ease-in-out infinite;animation-delay:1.5s;transform:rotate(-2deg);}

@keyframes heroFloat{
    0%,100%{transform:translateY(0) rotate(var(--r,0deg));}
    50%{transform:translateY(-10px) rotate(var(--r,0deg));}
}
.hero-float-backend{--r:-3deg;}
.hero-float-frontend{--r:3deg;}
.hero-float-database{--r:-2deg;}

/* Mobile: stack everything */
@media(max-width:768px){
    .hero-grid-cols{grid-template-columns:1fr!important;}
    .hero-right{aspect-ratio:auto;display:flex;flex-direction:column;align-items:center;gap:1rem;max-width:100%;}
    .hero-code{position:relative!important;top:auto!important;left:auto!important;transform:none!important;width:100%!important;}
    .hero-float{position:relative!important;top:auto!important;left:auto!important;right:auto!important;bottom:auto!important;transform:none!important;}
}
</style>
