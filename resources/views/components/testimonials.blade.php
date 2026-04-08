<section id="endorsements" style="padding:6rem 0;position:relative;">
    <div style="max-width:80rem;margin:0 auto;padding:0 1.5rem;">
        <div class="animate-on-scroll" style="text-align:center;margin-bottom:3.5rem;">
            <span class="section-label" style="justify-content:center;">Professional Endorsements</span>
            <h2 class="section-heading">What <span class="gradient-text">People Say</span></h2>
            <p style="color:#64748b;margin-top:.75rem;font-size:.9rem;">Feedback from clients and colleagues I've had the pleasure to work with</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:1.5rem;" class="animate-on-scroll delay-100">
            @forelse($testimonials as $t)
            <div class="card" style="display:flex;flex-direction:column;transition:border-color .3s,box-shadow .3s;" onmouseover="this.style.borderColor='rgba(34,211,238,.2)';this.style.boxShadow='0 0 20px rgba(34,211,238,.08)'" onmouseout="this.style.borderColor='#1e293b';this.style.boxShadow='none'">
                <svg width="32" height="32" fill="rgba(34,211,238,.25)" viewBox="0 0 24 24" style="margin-bottom:1rem;flex-shrink:0;">
                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                </svg>
                <blockquote style="color:#94a3b8;font-size:.875rem;line-height:1.8;font-style:italic;flex:1;margin:0;">"{{ $t->quote }}"</blockquote>
                <div style="display:flex;align-items:center;gap:.875rem;margin-top:1.5rem;padding-top:1rem;border-top:1px solid #1e293b;">
                    @if($t->avatar_url)
                    <img src="{{ $t->avatar_url }}" alt="{{ $t->name }}" style="width:2.75rem;height:2.75rem;border-radius:50%;object-fit:cover;border:1px solid #334155;flex-shrink:0;"/>
                    @else
                    <div style="width:2.75rem;height:2.75rem;border-radius:50%;background:linear-gradient(135deg,rgba(34,211,238,.25),rgba(139,92,246,.25));border:1px solid rgba(34,211,238,.2);display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:.875rem;flex-shrink:0;">{{ strtoupper(substr($t->name,0,1)) }}</div>
                    @endif
                    <div>
                        <p style="color:white;font-weight:600;font-size:.875rem;margin:0;">{{ $t->name }}</p>
                        <p style="color:#64748b;font-size:.75rem;margin:.125rem 0 0;">{{ $t->role }}@if($t->company) at {{ $t->company }}@endif</p>
                    </div>
                </div>
            </div>
            @empty
            <div style="grid-column:1/-1;text-align:center;padding:3rem 0;">
                <p style="color:#334155;font-family:'JetBrains Mono',monospace;font-size:.875rem;">No testimonials added yet.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
