<section id="experience" style="padding:6rem 0;background:rgba(10,10,18,.4);position:relative;">
    <div style="max-width:64rem;margin:0 auto;padding:0 1.5rem;">
        <div class="animate-on-scroll" style="text-align:center;margin-bottom:3.5rem;">
            <span class="section-label" style="justify-content:center;">Career Journey</span>
            <h2 class="section-heading">Professional <span class="gradient-text">Experience</span></h2>
        </div>
        <div style="position:relative;">
            <div style="position:absolute;left:1.5rem;top:0;bottom:0;width:1px;background:linear-gradient(to bottom,rgba(34,211,238,.4),rgba(30,41,59,.3),transparent);"></div>
            <div style="display:flex;flex-direction:column;gap:2rem;">
                @foreach($experiences as $i => $exp)
                <div class="animate-on-scroll" style="position:relative;padding-left:4rem;" @if($i<5) style="position:relative;padding-left:4rem;transition-delay:{{ $i*0.1 }}s" @endif>
                    <div class="timeline-dot" style="position:absolute;left:.75rem;top:.375rem;"></div>
                    <div class="card" style="transition:border-color .3s,box-shadow .3s;" onmouseover="this.style.borderColor='rgba(34,211,238,.2)';this.style.boxShadow='0 0 20px rgba(34,211,238,.08)'" onmouseout="this.style.borderColor='#1e293b';this.style.boxShadow='none'">
                        <div style="display:flex;flex-wrap:wrap;align-items:flex-start;justify-content:space-between;gap:.75rem;margin-bottom:1rem;">
                            <div>
                                <h3 style="color:white;font-weight:700;font-size:1.1rem;margin:0 0 .25rem;">{{ $exp->role }}</h3>
                                <div style="display:flex;align-items:center;gap:.5rem;flex-wrap:wrap;">
                                    <span style="color:#22d3ee;font-weight:600;font-size:.875rem;">{{ $exp->company }}</span>
                                    @if($exp->location)<span style="color:#334155;font-size:.75rem;">•</span><span style="color:#64748b;font-size:.75rem;">{{ $exp->location }}</span>@endif
                                </div>
                            </div>
                            <span style="padding:.25rem .875rem;border-radius:9999px;font-size:.75rem;font-family:'JetBrains Mono',monospace;background:rgba(167,139,250,.1);color:#a78bfa;border:1px solid rgba(167,139,250,.2);white-space:nowrap;">{{ $exp->duration }}</span>
                        </div>
                        @if($exp->description)<p style="color:#94a3b8;font-size:.875rem;line-height:1.7;margin-bottom:1rem;">{{ $exp->description }}</p>@endif
                        @if(is_array($exp->responsibilities) && count($exp->responsibilities))
                        <ul style="list-style:none;padding:0;margin:0 0 1rem;display:flex;flex-direction:column;gap:.5rem;">
                            @foreach($exp->responsibilities as $r)
                            <li style="display:flex;align-items:flex-start;gap:.5rem;color:#94a3b8;font-size:.875rem;">
                                <span style="color:#22d3ee;margin-top:.1rem;flex-shrink:0;font-size:1rem;">›</span><span>{{ $r }}</span>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                        @if(is_array($exp->tech_tags) && count($exp->tech_tags))
                        <div style="display:flex;flex-wrap:wrap;gap:.375rem;padding-top:.75rem;border-top:1px solid #1e293b;">
                            <span style="color:#475569;font-size:.7rem;font-family:'JetBrains Mono',monospace;align-self:center;margin-right:.25rem;">Technologies:</span>
                            @foreach($exp->tech_tags as $tag)<span class="tech-tag">{{ $tag }}</span>@endforeach
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
