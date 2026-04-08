<section id="projects" style="padding:6rem 0;position:relative;">
    <div style="max-width:80rem;margin:0 auto;padding:0 1.5rem;">
        <div class="animate-on-scroll" style="text-align:center;margin-bottom:3.5rem;">
            <span class="section-label" style="justify-content:center;">Case Studies</span>
            <h2 class="section-heading">Featured <span class="gradient-text">Projects</span></h2>
            <p style="color:#64748b;margin-top:.75rem;max-width:36rem;margin-left:auto;margin-right:auto;font-size:.9rem;">A deep dive into the architecture and implementation of my most complex enterprise systems.</p>
        </div>

        <div x-data="{ tab: 'all' }" class="animate-on-scroll delay-100">
            <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:.5rem;margin-bottom:2.5rem;">
                @foreach(['all'=>'All','web'=>'Web Platforms','desktop'=>'Desktop Solutions','other'=>'Other'] as $key=>$label)
                <button @click="tab='{{ $key }}'" :class="tab==='{{ $key }}' ? 'active' : ''" class="filter-tab">{{ $label }}</button>
                @endforeach
            </div>

            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:1.5rem;">
                @foreach($projects->take(6) as $project)
                <div class="project-card card" style="padding:0;overflow:hidden;display:flex;flex-direction:column;transition:border-color .3s,box-shadow .3s;"
                     x-show="tab==='all'||tab==='{{ $project->category }}'"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     onmouseover="this.style.borderColor='rgba(34,211,238,.2)';this.style.boxShadow='0 0 30px rgba(34,211,238,.1)'"
                     onmouseout="this.style.borderColor='#1e293b';this.style.boxShadow='none'">

                    <div style="position:relative;height:12rem;background:#141428;overflow:hidden;">
                        @if($project->image_url)
                        <img src="{{ $project->image_url }}" alt="{{ $project->title }}" style="width:100%;height:100%;object-fit:cover;transition:transform .5s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'"/>
                        @else
                        <div style="width:100%;height:100%;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:.5rem;">
                            <div style="width:4rem;height:4rem;border-radius:1rem;background:linear-gradient(135deg,rgba(34,211,238,.15),rgba(139,92,246,.15));border:1px solid rgba(34,211,238,.2);display:flex;align-items:center;justify-content:center;">
                                <svg width="28" height="28" fill="none" stroke="rgba(34,211,238,.5)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                            </div>
                            <span style="color:#334155;font-size:.7rem;font-family:'JetBrains Mono',monospace;">Upload via CMS</span>
                        </div>
                        @endif

                        <div style="position:absolute;top:.75rem;left:.75rem;">
                            <span style="padding:.2rem .6rem;border-radius:.375rem;font-size:.7rem;font-family:'JetBrains Mono',monospace;font-weight:500;
                                @if($project->category==='web') background:rgba(34,211,238,.15);color:#22d3ee;border:1px solid rgba(34,211,238,.3);
                                @elseif($project->category==='desktop') background:rgba(167,139,250,.15);color:#a78bfa;border:1px solid rgba(167,139,250,.3);
                                @else background:rgba(100,116,139,.15);color:#94a3b8;border:1px solid rgba(100,116,139,.3); @endif">
                                {{ ucfirst($project->category) }}
                            </span>
                        </div>

                        @if($project->live_url || $project->repo_url)
                        <div class="project-overlay" style="position:absolute;inset:0;background:rgba(5,5,8,.85);display:flex;align-items:center;justify-content:center;gap:.75rem;">
                            @if($project->live_url)<a href="{{ $project->live_url }}" target="_blank" class="btn-primary" style="font-size:.75rem;padding:.5rem 1rem;">Live Demo</a>@endif
                            @if($project->repo_url)<a href="{{ $project->repo_url }}" target="_blank" class="btn-outline" style="font-size:.75rem;padding:.5rem 1rem;">Source</a>@endif
                        </div>
                        @endif
                    </div>

                    <div style="padding:1.25rem;display:flex;flex-direction:column;flex:1;gap:.75rem;">
                        <h3 style="color:white;font-weight:700;font-size:1rem;margin:0;line-height:1.3;transition:color .2s;" onmouseover="this.style.color='#22d3ee'" onmouseout="this.style.color='white'">{{ $project->title }}</h3>
                        <p style="color:#475569;font-size:.85rem;line-height:1.65;margin:0;flex:1;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;">{{ $project->description }}</p>
                        @if(is_array($project->tech_tags) && count($project->tech_tags))
                        <div style="display:flex;flex-wrap:wrap;gap:.375rem;">
                            @foreach(array_slice($project->tech_tags,0,5) as $tag)<span class="tech-tag">{{ $tag }}</span>@endforeach
                            @if(count($project->tech_tags)>5)<span class="tech-tag">+{{ count($project->tech_tags)-5 }}</span>@endif
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            @if($projects->count() > 6)
            <div style="text-align:center;margin-top:2.5rem;">
                <a href="{{ route('projects') }}" class="btn-outline">
                    View All Projects
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            @endif
        </div>
    </div>
</section>
