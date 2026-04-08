@extends('layouts.app')

@section('content')
<div style="min-height:100vh;padding:7rem 0 6rem;">
    <div style="max-width:80rem;margin:0 auto;padding:0 1.5rem;">

        <div class="animate-on-scroll" style="text-align:center;margin-bottom:3.5rem;">
            <span class="section-label" style="justify-content:center;">Case Studies</span>
            <h1 class="section-heading">Featured <span class="gradient-text">Projects</span></h1>
            <p style="color:#64748b;margin-top:.75rem;max-width:36rem;margin-left:auto;margin-right:auto;font-size:.9rem;">A deep dive into the architecture and implementation of my most complex enterprise systems.</p>
        </div>

        {{-- Filter tabs --}}
        <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:.5rem;margin-bottom:2.5rem;" class="animate-on-scroll delay-100">
            @foreach(['all'=>'All','web'=>'Web Platforms','desktop'=>'Desktop Solutions','other'=>'Other'] as $key=>$label)
            <a href="{{ route('projects', $key!=='all' ? ['category'=>$key] : []) }}"
               class="filter-tab {{ ($category===$key||($key==='all'&&$category==='all')) ? 'active' : '' }}"
               style="text-decoration:none;">{{ $label }}</a>
            @endforeach
        </div>

        {{-- Grid --}}
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:1.5rem;">
            @forelse($projects as $project)
            <div class="project-card card animate-on-scroll" style="padding:0;overflow:hidden;display:flex;flex-direction:column;transition:border-color .3s,box-shadow .3s;"
                 onmouseover="this.style.borderColor='rgba(34,211,238,.2)';this.style.boxShadow='0 0 30px rgba(34,211,238,.1)'"
                 onmouseout="this.style.borderColor='#1e293b';this.style.boxShadow='none'">

                <div style="position:relative;height:13rem;background:#141428;overflow:hidden;">
                    @if($project->image_url)
                    <img src="{{ $project->image_url }}" alt="{{ $project->title }}" style="width:100%;height:100%;object-fit:cover;transition:transform .5s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'"/>
                    @else
                    <div style="width:100%;height:100%;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:.75rem;">
                        <div style="width:4rem;height:4rem;border-radius:1rem;background:linear-gradient(135deg,rgba(34,211,238,.15),rgba(139,92,246,.15));border:1px solid rgba(34,211,238,.2);display:flex;align-items:center;justify-content:center;">
                            <svg width="28" height="28" fill="none" stroke="rgba(34,211,238,.5)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                        </div>
                        <span style="color:#334155;font-size:.7rem;font-family:'JetBrains Mono',monospace;">Upload image from CMS</span>
                    </div>
                    @endif

                    <div style="position:absolute;top:.75rem;left:.75rem;display:flex;gap:.375rem;">
                        <span style="padding:.2rem .6rem;border-radius:.375rem;font-size:.7rem;font-family:'JetBrains Mono',monospace;font-weight:500;
                            @if($project->category==='web') background:rgba(34,211,238,.15);color:#22d3ee;border:1px solid rgba(34,211,238,.3);
                            @elseif($project->category==='desktop') background:rgba(167,139,250,.15);color:#a78bfa;border:1px solid rgba(167,139,250,.3);
                            @else background:rgba(100,116,139,.15);color:#94a3b8;border:1px solid rgba(100,116,139,.3); @endif">
                            {{ ucfirst($project->category) }}
                        </span>
                        @if($project->featured)
                        <span style="padding:.2rem .6rem;border-radius:.375rem;font-size:.7rem;font-family:'JetBrains Mono',monospace;font-weight:500;background:rgba(234,179,8,.15);color:#eab308;border:1px solid rgba(234,179,8,.3);">Featured</span>
                        @endif
                    </div>

                    @if($project->live_url || $project->repo_url)
                    <div class="project-overlay" style="position:absolute;inset:0;background:rgba(5,5,8,.85);display:flex;align-items:center;justify-content:center;gap:.75rem;">
                        @if($project->live_url)<a href="{{ $project->live_url }}" target="_blank" class="btn-primary" style="font-size:.75rem;padding:.5rem 1rem;">Live Demo</a>@endif
                        @if($project->repo_url)<a href="{{ $project->repo_url }}" target="_blank" class="btn-outline" style="font-size:.75rem;padding:.5rem 1rem;">Source Code</a>@endif
                    </div>
                    @endif
                </div>

                <div style="padding:1.25rem;display:flex;flex-direction:column;flex:1;gap:.875rem;">
                    <h3 style="color:white;font-weight:700;font-size:1rem;margin:0;line-height:1.35;transition:color .2s;" onmouseover="this.style.color='#22d3ee'" onmouseout="this.style.color='white'">{{ $project->title }}</h3>
                    <p style="color:#475569;font-size:.85rem;line-height:1.7;margin:0;flex:1;">{{ $project->description }}</p>
                    @if(is_array($project->tech_tags) && count($project->tech_tags))
                    <div style="display:flex;flex-wrap:wrap;gap:.375rem;">
                        @foreach($project->tech_tags as $tag)<span class="tech-tag">{{ $tag }}</span>@endforeach
                    </div>
                    @endif
                </div>
            </div>
            @empty
            <div style="grid-column:1/-1;text-align:center;padding:5rem 0;">
                <p style="color:#334155;font-family:'JetBrains Mono',monospace;font-size:.9rem;margin-bottom:1.5rem;">No projects found for this category.</p>
                <a href="{{ route('projects') }}" class="btn-outline">View All Projects</a>
            </div>
            @endforelse
        </div>

        <div style="text-align:center;margin-top:3.5rem;">
            <a href="{{ route('home') }}" class="btn-outline">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/></svg>
                Back to Home
            </a>
        </div>
    </div>
</div>
@endsection
