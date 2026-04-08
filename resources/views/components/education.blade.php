<section id="education" style="padding:6rem 0;position:relative;">
    <div style="max-width:64rem;margin:0 auto;padding:0 1.5rem;">
        <div class="animate-on-scroll" style="text-align:center;margin-bottom:3.5rem;">
            <span class="section-label" style="justify-content:center;">Academic Background</span>
            <h2 class="section-heading"><span class="gradient-text">Education</span></h2>
        </div>
        <div style="display:flex;flex-direction:column;gap:1.5rem;">
            @foreach($educations as $edu)
            <div class="animate-on-scroll card" style="display:flex;gap:1.25rem;transition:border-color .3s,box-shadow .3s;" onmouseover="this.style.borderColor='rgba(34,211,238,.2)';this.style.boxShadow='0 0 20px rgba(34,211,238,.08)'" onmouseout="this.style.borderColor='#1e293b';this.style.boxShadow='none'">
                <div style="flex-shrink:0;">
                    @if($edu->logo_url)
                    <img src="{{ $edu->logo_url }}" alt="{{ $edu->institution }}" style="width:3.5rem;height:3.5rem;border-radius:.75rem;object-fit:cover;border:1px solid #334155;"/>
                    @else
                    <div style="width:3.5rem;height:3.5rem;border-radius:.75rem;background:linear-gradient(135deg,rgba(34,211,238,.15),rgba(139,92,246,.15));border:1px solid rgba(34,211,238,.2);display:flex;align-items:center;justify-content:center;">
                        <svg width="24" height="24" fill="none" stroke="rgba(34,211,238,.5)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5z M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                    </div>
                    @endif
                </div>
                <div style="flex:1;">
                    <div style="display:flex;flex-wrap:wrap;align-items:flex-start;justify-content:space-between;gap:.5rem;">
                        <div>
                            <h3 style="color:white;font-weight:700;margin:0 0 .25rem;font-size:1rem;">{{ $edu->degree }}</h3>
                            <p style="color:#22d3ee;font-weight:600;font-size:.875rem;margin:0;">{{ $edu->institution }}</p>
                        </div>
                        <div style="text-align:right;">
                            <span style="color:#64748b;font-size:.75rem;font-family:'JetBrains Mono',monospace;">{{ $edu->year }}</span>
                            @if($edu->location)<p style="color:#475569;font-size:.7rem;margin:.125rem 0 0;">{{ $edu->location }}</p>@endif
                        </div>
                    </div>
                    @if($edu->description)<p style="color:#64748b;font-size:.85rem;margin:.75rem 0 0;line-height:1.65;">{{ $edu->description }}</p>@endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
