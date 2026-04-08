<section id="certifications" style="padding:6rem 0;background:rgba(10,10,18,.4);position:relative;">
    <div style="max-width:80rem;margin:0 auto;padding:0 1.5rem;">
        <div class="animate-on-scroll" style="text-align:center;margin-bottom:3.5rem;">
            <span class="section-label" style="justify-content:center;">Professional Growth</span>
            <h2 class="section-heading">Certifications & <span class="gradient-text">Achievements</span></h2>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:2rem;" class="section-grid">
            <div>
                <h3 style="color:white;font-weight:700;font-size:1.1rem;margin-bottom:1.25rem;display:flex;align-items:center;gap:.75rem;">
                    <span style="width:2rem;height:2rem;border-radius:.5rem;background:rgba(34,211,238,.1);border:1px solid rgba(34,211,238,.2);display:flex;align-items:center;justify-content:center;">
                        <svg width="14" height="14" fill="none" stroke="#22d3ee" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                    </span>Certifications
                </h3>
                <div style="display:flex;flex-direction:column;gap:.75rem;">
                    @foreach($certifications as $cert)
                    <div class="card" style="padding:1rem;transition:border-color .3s;" onmouseover="this.style.borderColor='rgba(34,211,238,.2)'" onmouseout="this.style.borderColor='#1e293b'">
                        <div style="display:flex;align-items:center;justify-content:space-between;gap:.75rem;">
                            <div style="min-width:0;">
                                @if($cert->url && $cert->url!=='#')
                                <a href="{{ $cert->url }}" target="_blank" style="color:white;font-weight:600;font-size:.875rem;text-decoration:none;display:block;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;transition:color .2s;" onmouseover="this.style.color='#22d3ee'" onmouseout="this.style.color='white'">{{ $cert->title }}</a>
                                @else
                                <h4 style="color:white;font-weight:600;font-size:.875rem;margin:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $cert->title }}</h4>
                                @endif
                                <p style="color:#64748b;font-size:.75rem;margin:.25rem 0 0;">{{ $cert->issuer }} • {{ $cert->date }}</p>
                            </div>
                            @if($cert->url && $cert->url!=='#')
                            <a href="{{ $cert->url }}" target="_blank" style="color:#334155;transition:color .2s;flex-shrink:0;line-height:0;" onmouseover="this.style.color='#22d3ee'" onmouseout="this.style.color='#334155'">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div>
                <h3 style="color:white;font-weight:700;font-size:1.1rem;margin-bottom:1.25rem;display:flex;align-items:center;gap:.75rem;">
                    <span style="width:2rem;height:2rem;border-radius:.5rem;background:rgba(167,139,250,.1);border:1px solid rgba(167,139,250,.2);display:flex;align-items:center;justify-content:center;">
                        <svg width="14" height="14" fill="none" stroke="#a78bfa" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                    </span>Achievements
                </h3>
                <div class="card" style="display:flex;flex-direction:column;gap:1.25rem;">
                    @foreach([['🥇','Top Rated Freelancer','Ranked as top freelancer with 100% job success score and 5-star ratings across all completed projects.'],['🏆','Sprint Champion','Consistently delivered 95%+ of committed sprint tasks, recognized for exceptional Agile delivery.'],['⭐','100% Client Satisfaction','Maintained a perfect client satisfaction rate across 50+ delivered projects.']] as [$icon,$title,$desc])
                    <div style="display:flex;gap:.875rem;align-items:flex-start;">
                        <span style="font-size:1.375rem;flex-shrink:0;">{{ $icon }}</span>
                        <div>
                            <h4 style="color:white;font-weight:600;font-size:.875rem;margin:0 0 .25rem;">{{ $title }}</h4>
                            <p style="color:#64748b;font-size:.8rem;margin:0;line-height:1.6;">{{ $desc }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
