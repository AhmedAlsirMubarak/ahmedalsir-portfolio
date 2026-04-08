<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::orderBy('sort_order')->orderBy('id')->paginate(20);
        return view('admin.skills.index', compact('skills'));
    }

    public function create()
    {
        return view('admin.skills.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'       => ['required', 'max:100'],
            'category'   => ['required', 'in:frontend,backend,database,other'],
            'level'      => ['required', 'integer', 'min:0', 'max:100'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        Skill::create($data);
        return redirect()->route('admin.skills.index')->with('success', 'Skill created.');
    }

    public function edit(Skill $skill)
    {
        return view('admin.skills.edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $data = $request->validate([
            'name'       => ['required', 'max:100'],
            'category'   => ['required', 'in:frontend,backend,database,other'],
            'level'      => ['required', 'integer', 'min:0', 'max:100'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $skill->update($data);
        return redirect()->route('admin.skills.index')->with('success', 'Skill updated.');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('admin.skills.index')->with('success', 'Skill deleted.');
    }
}
