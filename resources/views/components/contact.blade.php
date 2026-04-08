<section id="contact" style="padding:6rem 0;background:rgba(10,10,18,.4);position:relative;">
    <div style="max-width:64rem;margin:0 auto;padding:0 1.5rem;">
        <div class="animate-on-scroll" style="text-align:center;margin-bottom:3.5rem;">
            <span class="section-label" style="justify-content:center;">Get In Touch</span>
            <h2 class="section-heading">Let's <span class="gradient-text">Work Together</span></h2>
            <p style="color:#64748b;margin-top:.75rem;max-width:36rem;margin-left:auto;margin-right:auto;font-size:.9rem;">Have a project in mind? I'd love to hear about it. Let's discuss how we can bring your ideas to life.</p>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:2rem;" class="section-grid animate-on-scroll delay-100">

            {{-- Availability card --}}
            <div class="card" style="background:linear-gradient(135deg,rgba(34,211,238,.04),rgba(139,92,246,.04));border-color:rgba(34,211,238,.15);display:flex;flex-direction:column;gap:1.5rem;">
                <div style="display:flex;align-items:center;gap:.5rem;">
                    <span class="available-dot"></span>
                    <span style="color:#4ade80;font-size:.7rem;font-family:'JetBrains Mono',monospace;font-weight:500;letter-spacing:.1em;text-transform:uppercase;">Currently Available</span>
                </div>
                <div>
                    <h3 style="color:white;font-weight:700;font-size:1.25rem;margin:0 0 .5rem;">Open for New Projects</h3>
                    <p style="color:#94a3b8;font-size:.875rem;line-height:1.7;margin:0;">I'm currently looking for new opportunities and freelance projects. Let's build something amazing together!</p>
                </div>
                <div style="display:flex;flex-direction:column;gap:.875rem;">
                    @if(!empty($settings['email']))
                    <a href="mailto:{{ $settings['email'] }}" style="display:flex;align-items:center;gap:.875rem;color:#cbd5e1;text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#22d3ee'" onmouseout="this.style.color='#cbd5e1'">
                        <div style="width:2.25rem;height:2.25rem;border-radius:.5rem;background:#141428;border:1px solid #334155;display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:border-color .2s;">
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <span style="font-size:.875rem;font-weight:500;">{{ $settings['email'] }}</span>
                    </a>
                    @endif
                    @if(!empty($settings['linkedin']))
                    <a href="{{ $settings['linkedin'] }}" target="_blank" style="display:flex;align-items:center;gap:.875rem;color:#cbd5e1;text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#22d3ee'" onmouseout="this.style.color='#cbd5e1'">
                        <div style="width:2.25rem;height:2.25rem;border-radius:.5rem;background:#141428;border:1px solid #334155;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </div>
                        <span style="font-size:.875rem;font-weight:500;">LinkedIn Profile</span>
                    </a>
                    @endif
                    @if(!empty($settings['github']))
                    <a href="{{ $settings['github'] }}" target="_blank" style="display:flex;align-items:center;gap:.875rem;color:#cbd5e1;text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#22d3ee'" onmouseout="this.style.color='#cbd5e1'">
                        <div style="width:2.25rem;height:2.25rem;border-radius:.5rem;background:#141428;border:1px solid #334155;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/></svg>
                        </div>
                        <span style="font-size:.875rem;font-weight:500;">GitHub Profile</span>
                    </a>
                    @endif
                </div>
                <div style="display:flex;gap:.75rem;flex-wrap:wrap;">
                    @if(!empty($settings['email']))<a href="mailto:{{ $settings['email'] }}" class="btn-primary" style="flex:1;justify-content:center;">Send Email</a>@endif
                    @if(!empty($settings['linkedin']))<a href="{{ $settings['linkedin'] }}" target="_blank" class="btn-outline" style="flex:1;justify-content:center;">LinkedIn</a>@endif
                </div>
            </div>

            {{-- Info cards --}}
            <div style="display:flex;flex-direction:column;gap:.875rem;">
                @foreach([['⚡','Quick Response','I typically respond within 24 hours to all inquiries.'],['🌍','Remote Friendly','Available for remote work worldwide, any timezone.'],['📋','Project Based','Open to freelance, contract, and full-time roles.'],['🚀','Fast Delivery','Committed to delivering quality work on schedule.']] as [$icon,$title,$desc])
                <div class="card" style="display:flex;align-items:flex-start;gap:1rem;padding:1rem;transition:border-color .3s;" onmouseover="this.style.borderColor='rgba(34,211,238,.2)'" onmouseout="this.style.borderColor='#1e293b'">
                    <span style="font-size:1.5rem;flex-shrink:0;">{{ $icon }}</span>
                    <div>
                        <h4 style="color:white;font-weight:600;font-size:.875rem;margin:0 0 .25rem;">{{ $title }}</h4>
                        <p style="color:#64748b;font-size:.8rem;margin:0;line-height:1.6;">{{ $desc }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
