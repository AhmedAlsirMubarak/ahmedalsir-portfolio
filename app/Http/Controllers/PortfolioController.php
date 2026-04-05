<?php
namespace App\Http\Controllers;
use App\Models\{Certification,Education,Experience,Project,Setting,Skill,Testimonial};
use Illuminate\Http\Request;
class PortfolioController extends Controller {
    private function settings(): array { return Setting::allKeyed(); }
    public function home() {
        $settings       = $this->settings();
        $projects       = Project::ordered()->get();
        $experiences    = Experience::ordered()->get();
        $skills         = Skill::ordered()->get()->groupBy('category');
        $educations     = Education::ordered()->get();
        $certifications = Certification::ordered()->get();
        $testimonials   = Testimonial::ordered()->get();
        return view('pages.home', compact('settings','projects','experiences','skills','educations','certifications','testimonials'));
    }
    public function projects(Request $request) {
        $settings = $this->settings();
        $category = $request->query('category','all');
        $query = Project::ordered();
        if ($category !== 'all') $query->where('category', $category);
        $projects = $query->get();
        return view('pages.projects', compact('settings','projects','category'));
    }
}
