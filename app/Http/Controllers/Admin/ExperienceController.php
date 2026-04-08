<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::orderBy('sort_order')->orderBy('id')->paginate(15);
        return view('admin.experiences.index', compact('experiences'));
    }

    public function create()
    {
        return view('admin.experiences.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'role'             => ['required', 'max:255'],
            'company'         => ['required', 'max:255'],
            'location'        => ['nullable', 'max:255'],
            'duration'        => ['required', 'max:255'],
            'type'            => ['required', 'in:full-time,freelance,remote,part-time'],
            'description'     => ['nullable'],
            'responsibilities' => ['nullable', 'string'],
            'tech_tags'       => ['nullable', 'string'],
            'sort_order'      => ['nullable', 'integer'],
        ]);

        $data['responsibilities'] = $this->parseLines($data['responsibilities'] ?? '');
        $data['tech_tags']        = $this->parseTags($data['tech_tags'] ?? '');

        Experience::create($data);
        return redirect()->route('admin.experiences.index')->with('success', 'Experience created.');
    }

    public function edit(Experience $experience)
    {
        return view('admin.experiences.edit', compact('experience'));
    }

    public function update(Request $request, Experience $experience)
    {
        $data = $request->validate([
            'role'             => ['required', 'max:255'],
            'company'         => ['required', 'max:255'],
            'location'        => ['nullable', 'max:255'],
            'duration'        => ['required', 'max:255'],
            'type'            => ['required', 'in:full-time,freelance,remote,part-time'],
            'description'     => ['nullable'],
            'responsibilities' => ['nullable', 'string'],
            'tech_tags'       => ['nullable', 'string'],
            'sort_order'      => ['nullable', 'integer'],
        ]);

        $data['responsibilities'] = $this->parseLines($data['responsibilities'] ?? '');
        $data['tech_tags']        = $this->parseTags($data['tech_tags'] ?? '');

        $experience->update($data);
        return redirect()->route('admin.experiences.index')->with('success', 'Experience updated.');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();
        return redirect()->route('admin.experiences.index')->with('success', 'Experience deleted.');
    }

    private function parseTags(string $tags): array
    {
        return array_values(array_filter(array_map('trim', explode(',', $tags))));
    }

    private function parseLines(string $text): array
    {
        return array_values(array_filter(array_map('trim', explode("\n", $text))));
    }
}
