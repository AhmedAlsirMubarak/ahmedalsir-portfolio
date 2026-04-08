<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('sort_order')->orderBy('id')->paginate(15);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => ['required', 'max:255'],
            'description' => ['required'],
            'image'       => ['nullable', 'image', 'max:2048'],
            'tech_tags'   => ['nullable', 'string'],
            'category'    => ['required', 'in:web,desktop,other'],
            'featured'    => ['nullable'],
            'sort_order'  => ['nullable', 'integer'],
            'live_url'    => ['nullable', 'url'],
            'repo_url'    => ['nullable', 'url'],
        ]);

        $data['tech_tags'] = $this->parseTags($data['tech_tags'] ?? '');
        $data['featured']  = $request->boolean('featured');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        Project::create($data);

        return redirect()->route('admin.projects.index')->with('success', 'Project created.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title'       => ['required', 'max:255'],
            'description' => ['required'],
            'image'       => ['nullable', 'image', 'max:2048'],
            'tech_tags'   => ['nullable', 'string'],
            'category'    => ['required', 'in:web,desktop,other'],
            'featured'    => ['nullable'],
            'sort_order'  => ['nullable', 'integer'],
            'live_url'    => ['nullable', 'url'],
            'repo_url'    => ['nullable', 'url'],
        ]);

        $data['tech_tags'] = $this->parseTags($data['tech_tags'] ?? '');
        $data['featured']  = $request->boolean('featured');

        if ($request->hasFile('image')) {
            if ($project->image && !str_starts_with($project->image, 'http')) {
                Storage::disk('public')->delete($project->image);
            }
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated.');
    }

    public function destroy(Project $project)
    {
        if ($project->image && !str_starts_with($project->image, 'http')) {
            Storage::disk('public')->delete($project->image);
        }
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted.');
    }

    private function parseTags(string $tags): array
    {
        return array_values(array_filter(array_map('trim', explode(',', $tags))));
    }
}
