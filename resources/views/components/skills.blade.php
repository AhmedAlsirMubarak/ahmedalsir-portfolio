<section id="skills" style="padding:6rem 0;background:rgba(10,10,18,.4);position:relative;">
    <div style="max-width:80rem;margin:0 auto;padding:0 1.5rem;">
        <div class="animate-on-scroll" style="text-align:center;margin-bottom:3.5rem;">
            <span class="section-label" style="justify-content:center;">My Expertise</span>
            <h2 class="section-heading">Technical <span class="gradient-text">Skills</span></h2>
        </div>

        <div x-data="{ tab: 'frontend' }" class="animate-on-scroll delay-100">
            <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:.5rem;margin-bottom:2.5rem;">
                @foreach(['frontend'=>'Frontend','backend'=>'Backend','database'=>'Database','other'=>'Other Skills'] as $key=>$label)
                <button @click="tab='{{ $key }}'" :class="tab==='{{ $key }}' ? 'active' : ''" class="filter-tab">{{ $label }}</button>
                @endforeach
            </div>

            @foreach(['frontend','backend','database','other'] as $cat)
            <div x-show="tab==='{{ $cat }}'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:1rem;">
                    @foreach($skills[$cat] ?? [] as $skill)
                    <div class="card" style="transition:border-color .3s,box-shadow .3s;" onmouseover="this.style.borderColor='rgba(34,211,238,.2)';this.style.boxShadow='0 0 20px rgba(34,211,238,.1)'" onmouseout="this.style.borderColor='#1e293b';this.style.boxShadow='none'">
                        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.75rem;">
                            <span style="color:white;font-weight:500;font-size:.875rem;">{{ $skill->name }}</span>
                            <span style="color:#22d3ee;font-size:.75rem;font-family:'JetBrains Mono',monospace;font-weight:600;">{{ $skill->level }}%</span>
                        </div>
                        <div class="skill-bar-track">
                            <div class="skill-bar-fill" data-width="{{ $skill->level }}%" style="width:0%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @if(($skills[$cat] ?? collect())->isEmpty())
                <p style="text-align:center;color:#334155;font-family:'JetBrains Mono',monospace;font-size:.875rem;padding:3rem 0;">No skills added yet.</p>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
