<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects'       => Project::count(),
            'experiences'    => Experience::count(),
            'skills'         => Skill::count(),
            'educations'     => Education::count(),
            'certifications' => Certification::count(),
            'testimonials'   => Testimonial::count(),
        ];

        $recentProjects = Project::latest()->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'recentProjects'));
    }
}
