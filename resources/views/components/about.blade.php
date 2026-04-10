<section id="about" style="padding:6rem 0;position:relative;">
    <div style="max-width:80rem;margin:0 auto;padding:0 1.5rem;">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:center;" class="section-grid">

            <div class="animate-on-scroll">
                <div class="code-block" style="overflow:hidden;">
                    <div style="display:flex;align-items:center;gap:.5rem;padding:.75rem 1.25rem;border-bottom:1px solid #1e293b;background:rgba(20,20,40,.5);">
                        <div style="display:flex;gap:.375rem;"><div style="width:.75rem;height:.75rem;border-radius:50%;background:rgba(239,68,68,.7)"></div><div style="width:.75rem;height:.75rem;border-radius:50%;background:rgba(234,179,8,.7)"></div><div style="width:.75rem;height:.75rem;border-radius:50%;background:rgba(34,197,94,.7)"></div></div>
                        <span style="color:#475569;font-size:.75rem;margin-left:.5rem;">AboutMe.ts</span>
                    </div>
                    <div style="padding:1.25rem;display:flex;flex-direction:column;gap:.125rem;">
                        @foreach(explode("\n", $settings['about_snippet'] ?? '') as $i => $line)
                        <div class="code-line"><span class="code-number">{{ $i+1 }}</span><span>{!! \App\Helpers\CodeHighlighter::highlight($line) !!}</span></div>
                        @endforeach
                    </div>
                </div>

                <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:.75rem;margin-top:1.5rem;" class="about-stats-grid">
                    @foreach([['years_exp','Years Experience'],['projects_count','Projects Delivered'],['satisfaction','Client Satisfaction'],['sprint_delivery','Sprint Delivery']] as [$key,$lab])
                    <div class="card" style="text-align:center;padding:1.25rem .75rem;">
                        <span class="stat-number" style="font-size:1.5rem;">{{ $settings[$key] ?? '-' }}</span>
                        <span class="stat-label" style="font-size:.65rem;">{{ $lab }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="animate-on-scroll delay-200" style="display:flex;flex-direction:column;gap:1.5rem;">
                <div>
                    <span class="section-label">About Me</span>
                    <h2 class="section-heading">Passionate About Building<br><span class="gradient-text">Exceptional & Scalable Software</span></h2>
                </div>
                @foreach(explode("\n\n", $settings['about_text'] ?? '') as $para)
                <p style="color:#94a3b8;line-height:1.8;">{{ $para }}</p>
                @endforeach

                @php $badges = json_decode($settings['about_badges'] ?? '[]', true) ?? []; @endphp
                @if(count($badges))
                <div style="display:flex;flex-wrap:wrap;gap:.5rem;">
                    @foreach($badges as $b)
                    <span style="display:inline-flex;align-items:center;gap:.375rem;padding:.375rem .875rem;border-radius:9999px;font-size:.75rem;font-weight:500;background:#141428;border:1px solid #334155;color:#cbd5e1;">
                        <span style="width:.375rem;height:.375rem;border-radius:50%;background:#22d3ee;display:inline-block;"></span>{{ $b }}
                    </span>
                    @endforeach
                </div>
                @endif

                @php $cards = json_decode($settings['about_cards'] ?? '[]', true) ?? []; @endphp
                @if(count($cards))
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem;" class="about-cards-grid">
                    @foreach($cards as $c)
                    <div class="card" style="padding:1rem;transition:border-color .3s,box-shadow .3s;" onmouseover="this.style.borderColor='rgba(34,211,238,.2)';this.style.boxShadow='0 0 30px rgba(34,211,238,.1)'" onmouseout="this.style.borderColor='#1e293b';this.style.boxShadow='none'">
                        <h4 style="color:white;font-weight:600;font-size:.875rem;margin:0 0 .25rem;">{{ $c['title'] }}</h4>
                        <p style="color:#475569;font-size:.75rem;line-height:1.6;margin:0;">{{ $c['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
