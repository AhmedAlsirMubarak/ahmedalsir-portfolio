<footer style="background:#050508;border-top:1px solid rgba(30,41,59,.6);padding:3rem 0;">
    <div style="max-width:80rem;margin:0 auto;padding:0 1.5rem;">
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:2rem;margin-bottom:2.5rem;" class="footer-grid">

            <div style="display:flex;flex-direction:column;gap:.875rem;">
                <div style="display:flex;align-items:center;gap:.5rem;">
                    <div style="width:2rem;height:2rem;border-radius:.5rem;background:linear-gradient(135deg,#06b6d4,#8b5cf6);display:flex;align-items:center;justify-content:center;font-weight:700;color:#050508;font-size:.8rem;">{{ strtoupper(substr($settings['name']??'P',0,1)) }}</div>
                    <span style="font-weight:700;color:white;font-family:'JetBrains Mono',monospace;">{{ explode(' ',$settings['name']??'Portfolio')[0] }}<span style="color:#22d3ee;">.</span></span>
                </div>
                <p style="color:#475569;font-size:.8rem;line-height:1.7;max-width:20rem;margin:0;">{{ $settings['footer_text']??'' }}</p>
            </div>

            <div>
                <h4 style="color:#64748b;font-size:.7rem;font-family:'JetBrains Mono',monospace;text-transform:uppercase;letter-spacing:.1em;margin:0 0 .875rem;">Tech Stack Built with</h4>
                @foreach(['Laravel 12','Filament v5','Tailwind CSS v4','Alpine.js 3','Livewire v4'] as $tech)
                <div style="display:flex;align-items:center;gap:.5rem;color:#475569;font-size:.8rem;margin-bottom:.375rem;">
                    <span style="width:.375rem;height:.375rem;border-radius:50%;background:#22d3ee;display:inline-block;flex-shrink:0;"></span>{{ $tech }}
                </div>
                @endforeach
            </div>

            <div>
                <h4 style="color:#64748b;font-size:.7rem;font-family:'JetBrains Mono',monospace;text-transform:uppercase;letter-spacing:.1em;margin:0 0 .875rem;">Experience Highlights</h4>
                @foreach(['Senior Software Engineer | Open to Opportunities', ($settings['years_exp']??'5+').' Years of Professional Experience', ($settings['projects_count']??'50+').' Projects Delivered'] as $item)
                <div style="display:flex;align-items:center;gap:.5rem;color:#475569;font-size:.8rem;margin-bottom:.375rem;">
                    <span style="width:.375rem;height:.375rem;border-radius:50%;background:#a78bfa;display:inline-block;flex-shrink:0;"></span>{{ $item }}
                </div>
                @endforeach
            </div>
        </div>

        <div style="border-top:1px solid #1e293b;padding-top:1.5rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;">
            <p style="color:#334155;font-size:.75rem;font-family:'JetBrains Mono',monospace;margin:0;">
                © {{ date('Y') }} All rights reserved. Made with ❤ by <span style="color:#64748b;">{{ $settings['name']??'Developer' }}</span>
            </p>
            <div style="display:flex;align-items:center;gap:1.25rem;">
                @if(!empty($settings['github']))<a href="{{ $settings['github'] }}" target="_blank" style="color:#334155;font-size:.75rem;font-family:'JetBrains Mono',monospace;text-decoration:none;transition:color .2s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='#334155'">GitHub</a>@endif
                @if(!empty($settings['linkedin']))<a href="{{ $settings['linkedin'] }}" target="_blank" style="color:#334155;font-size:.75rem;font-family:'JetBrains Mono',monospace;text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#22d3ee'" onmouseout="this.style.color='#334155'">LinkedIn</a>@endif
                @if(!empty($settings['email']))<a href="mailto:{{ $settings['email'] }}" style="color:#334155;font-size:.75rem;font-family:'JetBrains Mono',monospace;text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#22d3ee'" onmouseout="this.style.color='#334155'">Email</a>@endif
            </div>
        </div>
    </div>
</footer>

<style>
@media(max-width:768px){
    .footer-grid{grid-template-columns:1fr!important;}
    .section-grid{grid-template-columns:1fr!important;}
}
</style>
