<?php

namespace App\Http\Controllers;

use App\Models\{Certification, Education, Experience, Project, Setting, Skill, Testimonial, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // ── Auth ──────────────────────────────────────────────────────────────────

    public function loginForm()
    {
        return Auth::check() ? redirect()->route('admin.dashboard') : view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    // ── Dashboard ────────────────────────────────────────────────────────────

    public function dashboard()
    {
        $stats = [
            'projects'       => Project::count(),
            'experiences'    => Experience::count(),
            'skills'         => Skill::count(),
            'educations'     => Education::count(),
            'certifications' => Certification::count(),
            'testimonials'   => Testimonial::count(),
        ];
        $recentProjects = Project::ordered()->take(5)->get();
        return view('admin.dashboard', compact('stats', 'recentProjects'));
    }

    // ── Projects ─────────────────────────────────────────────────────────────

    public function projectsIndex()
    {
        return view('admin.projects.index', ['projects' => Project::ordered()->paginate(20)]);
    }

    public function projectsCreate()
    {
        return view('admin.projects.create');
    }

    public function projectsStore(Request $request)
    {
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category'    => ['required', 'in:web,desktop,other'],
            'tech_tags'   => ['nullable', 'string'],
            'live_url'    => ['nullable', 'url', 'max:255'],
            'repo_url'    => ['nullable', 'url', 'max:255'],
            'sort_order'  => ['nullable', 'integer'],
            'featured'    => ['nullable'],
            'image'       => ['nullable', 'image', 'max:2048'],
        ]);

        $data['featured']  = $request->boolean('featured');
        $data['sort_order'] = $request->integer('sort_order', 0);
        $data['tech_tags'] = $this->parseTags($request->input('tech_tags', ''));

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('projects');
        }

        Project::create($data);
        return redirect()->route('admin.projects.index')->with('success', 'Project created.');
    }

    public function projectsEdit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function projectsUpdate(Request $request, Project $project)
    {
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category'    => ['required', 'in:web,desktop,other'],
            'tech_tags'   => ['nullable', 'string'],
            'live_url'    => ['nullable', 'url', 'max:255'],
            'repo_url'    => ['nullable', 'url', 'max:255'],
            'sort_order'  => ['nullable', 'integer'],
            'featured'    => ['nullable'],
            'image'       => ['nullable', 'image', 'max:2048'],
        ]);

        $data['featured']   = $request->boolean('featured');
        $data['sort_order'] = $request->integer('sort_order', 0);
        $data['tech_tags']  = $this->parseTags($request->input('tech_tags', ''));

        if ($request->hasFile('image')) {
            if ($project->image) Storage::delete($project->image);
            $data['image'] = $request->file('image')->store('projects');
        }

        $project->update($data);
        return redirect()->route('admin.projects.index')->with('success', 'Project updated.');
    }

    public function projectsDestroy(Project $project)
    {
        if ($project->image) Storage::delete($project->image);
        $project->delete();
        return back()->with('success', 'Project deleted.');
    }

    // ── Skills ───────────────────────────────────────────────────────────────

    public function skillsIndex()
    {
        return view('admin.skills.index', ['skills' => Skill::ordered()->paginate(20)]);
    }

    public function skillsCreate()
    {
        return view('admin.skills.create');
    }

    public function skillsStore(Request $request)
    {
        $data = $request->validate([
            'name'       => ['required', 'string', 'max:100'],
            'category'   => ['required', 'in:frontend,backend,database,other'],
            'level'      => ['required', 'integer', 'min:0', 'max:100'],
            'sort_order' => ['nullable', 'integer'],
        ]);
        $data['sort_order'] = $request->integer('sort_order', 0);
        Skill::create($data);
        return redirect()->route('admin.skills.index')->with('success', 'Skill created.');
    }

    public function skillsEdit(Skill $skill)
    {
        return view('admin.skills.edit', compact('skill'));
    }

    public function skillsUpdate(Request $request, Skill $skill)
    {
        $data = $request->validate([
            'name'       => ['required', 'string', 'max:100'],
            'category'   => ['required', 'in:frontend,backend,database,other'],
            'level'      => ['required', 'integer', 'min:0', 'max:100'],
            'sort_order' => ['nullable', 'integer'],
        ]);
        $data['sort_order'] = $request->integer('sort_order', 0);
        $skill->update($data);
        return redirect()->route('admin.skills.index')->with('success', 'Skill updated.');
    }

    public function skillsDestroy(Skill $skill)
    {
        $skill->delete();
        return back()->with('success', 'Skill deleted.');
    }

    // ── Experiences ──────────────────────────────────────────────────────────

    public function experiencesIndex()
    {
        return view('admin.experiences.index', ['experiences' => Experience::ordered()->paginate(20)]);
    }

    public function experiencesCreate()
    {
        return view('admin.experiences.create');
    }

    public function experiencesStore(Request $request)
    {
        $data = $request->validate([
            'role'             => ['required', 'string', 'max:255'],
            'company'          => ['required', 'string', 'max:255'],
            'location'         => ['nullable', 'string', 'max:255'],
            'duration'         => ['nullable', 'string', 'max:100'],
            'type'             => ['nullable', 'string', 'max:50'],
            'description'      => ['nullable', 'string'],
            'responsibilities' => ['nullable', 'string'],
            'tech_tags'        => ['nullable', 'string'],
            'sort_order'       => ['nullable', 'integer'],
        ]);
        $data['sort_order']       = $request->integer('sort_order', 0);
        $data['tech_tags']        = $this->parseTags($request->input('tech_tags', ''));
        $data['responsibilities'] = $this->parseLines($request->input('responsibilities', ''));
        Experience::create($data);
        return redirect()->route('admin.experiences.index')->with('success', 'Experience created.');
    }

    public function experiencesEdit(Experience $experience)
    {
        return view('admin.experiences.edit', compact('experience'));
    }

    public function experiencesUpdate(Request $request, Experience $experience)
    {
        $data = $request->validate([
            'role'             => ['required', 'string', 'max:255'],
            'company'          => ['required', 'string', 'max:255'],
            'location'         => ['nullable', 'string', 'max:255'],
            'duration'         => ['nullable', 'string', 'max:100'],
            'type'             => ['nullable', 'string', 'max:50'],
            'description'      => ['nullable', 'string'],
            'responsibilities' => ['nullable', 'string'],
            'tech_tags'        => ['nullable', 'string'],
            'sort_order'       => ['nullable', 'integer'],
        ]);
        $data['sort_order']       = $request->integer('sort_order', 0);
        $data['tech_tags']        = $this->parseTags($request->input('tech_tags', ''));
        $data['responsibilities'] = $this->parseLines($request->input('responsibilities', ''));
        $experience->update($data);
        return redirect()->route('admin.experiences.index')->with('success', 'Experience updated.');
    }

    public function experiencesDestroy(Experience $experience)
    {
        $experience->delete();
        return back()->with('success', 'Experience deleted.');
    }

    // ── Education ────────────────────────────────────────────────────────────

    public function educationIndex()
    {
        return view('admin.education.index', ['educations' => Education::ordered()->paginate(20)]);
    }

    public function educationCreate()
    {
        return view('admin.education.create');
    }

    public function educationStore(Request $request)
    {
        $data = $request->validate([
            'degree'      => ['required', 'string', 'max:255'],
            'institution' => ['required', 'string', 'max:255'],
            'year'        => ['nullable', 'string', 'max:20'],
            'location'    => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order'  => ['nullable', 'integer'],
        ]);
        $data['sort_order'] = $request->integer('sort_order', 0);
        Education::create($data);
        return redirect()->route('admin.education.index')->with('success', 'Education created.');
    }

    public function educationEdit(Education $education)
    {
        return view('admin.education.edit', compact('education'));
    }

    public function educationUpdate(Request $request, Education $education)
    {
        $data = $request->validate([
            'degree'      => ['required', 'string', 'max:255'],
            'institution' => ['required', 'string', 'max:255'],
            'year'        => ['nullable', 'string', 'max:20'],
            'location'    => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order'  => ['nullable', 'integer'],
        ]);
        $data['sort_order'] = $request->integer('sort_order', 0);
        $education->update($data);
        return redirect()->route('admin.education.index')->with('success', 'Education updated.');
    }

    public function educationDestroy(Education $education)
    {
        $education->delete();
        return back()->with('success', 'Education deleted.');
    }

    // ── Certifications ───────────────────────────────────────────────────────

    public function certificationsIndex()
    {
        return view('admin.certifications.index', ['certifications' => Certification::ordered()->paginate(20)]);
    }

    public function certificationsCreate()
    {
        return view('admin.certifications.create');
    }

    public function certificationsStore(Request $request)
    {
        $data = $request->validate([
            'title'      => ['required', 'string', 'max:255'],
            'issuer'     => ['required', 'string', 'max:255'],
            'date'       => ['nullable', 'string', 'max:50'],
            'url'        => ['nullable', 'url', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
        ]);
        $data['sort_order'] = $request->integer('sort_order', 0);
        Certification::create($data);
        return redirect()->route('admin.certifications.index')->with('success', 'Certification created.');
    }

    public function certificationsEdit(Certification $certification)
    {
        return view('admin.certifications.edit', compact('certification'));
    }

    public function certificationsUpdate(Request $request, Certification $certification)
    {
        $data = $request->validate([
            'title'      => ['required', 'string', 'max:255'],
            'issuer'     => ['required', 'string', 'max:255'],
            'date'       => ['nullable', 'string', 'max:50'],
            'url'        => ['nullable', 'url', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
        ]);
        $data['sort_order'] = $request->integer('sort_order', 0);
        $certification->update($data);
        return redirect()->route('admin.certifications.index')->with('success', 'Certification updated.');
    }

    public function certificationsDestroy(Certification $certification)
    {
        $certification->delete();
        return back()->with('success', 'Certification deleted.');
    }

    // ── Testimonials ─────────────────────────────────────────────────────────

    public function testimonialsIndex()
    {
        return view('admin.testimonials.index', ['testimonials' => Testimonial::ordered()->paginate(20)]);
    }

    public function testimonialsCreate()
    {
        return view('admin.testimonials.create');
    }

    public function testimonialsStore(Request $request)
    {
        $data = $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'role'       => ['nullable', 'string', 'max:255'],
            'company'    => ['nullable', 'string', 'max:255'],
            'quote'      => ['required', 'string'],
            'avatar'     => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
        ]);
        $data['sort_order'] = $request->integer('sort_order', 0);
        Testimonial::create($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created.');
    }

    public function testimonialsEdit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function testimonialsUpdate(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'role'       => ['nullable', 'string', 'max:255'],
            'company'    => ['nullable', 'string', 'max:255'],
            'quote'      => ['required', 'string'],
            'avatar'     => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
        ]);
        $data['sort_order'] = $request->integer('sort_order', 0);
        $testimonial->update($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated.');
    }

    public function testimonialsDestroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return back()->with('success', 'Testimonial deleted.');
    }

    // ── Settings ─────────────────────────────────────────────────────────────

    public function settingsIndex()
    {
        $settings = Setting::allKeyed();
        return view('admin.settings.index', compact('settings'));
    }

    public function settingsUpdate(Request $request)
    {
        $skip = ['_token', '_method'];
        foreach ($request->except($skip) as $key => $value) {
            Setting::set($key, $value ?? '');
        }
        return back()->with('success', 'Settings saved.');
    }

    // ── Helpers ──────────────────────────────────────────────────────────────

    private function parseTags(string $raw): array
    {
        if (empty(trim($raw))) return [];
        // Accept comma-separated or already JSON
        $decoded = json_decode($raw, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) return $decoded;
        return array_values(array_filter(array_map('trim', explode(',', $raw))));
    }

    private function parseLines(string $raw): array
    {
        if (empty(trim($raw))) return [];
        return array_values(array_filter(array_map('trim', explode("\n", $raw))));
    }
}
