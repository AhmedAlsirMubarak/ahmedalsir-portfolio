<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::orderBy('sort_order')->orderBy('id')->paginate(15);
        return view('admin.education.index', compact('educations'));
    }

    public function create()
    {
        return view('admin.education.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'degree'      => ['required', 'max:255'],
            'institution' => ['required', 'max:255'],
            'year'        => ['required', 'max:50'],
            'location'    => ['nullable', 'max:255'],
            'description' => ['nullable'],
            'logo'        => ['nullable', 'image', 'max:1024'],
            'sort_order'  => ['nullable', 'integer'],
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('education', 'public');
        }

        Education::create($data);
        return redirect()->route('admin.education.index')->with('success', 'Education created.');
    }

    public function edit(Education $education)
    {
        return view('admin.education.edit', compact('education'));
    }

    public function update(Request $request, Education $education)
    {
        $data = $request->validate([
            'degree'      => ['required', 'max:255'],
            'institution' => ['required', 'max:255'],
            'year'        => ['required', 'max:50'],
            'location'    => ['nullable', 'max:255'],
            'description' => ['nullable'],
            'logo'        => ['nullable', 'image', 'max:1024'],
            'sort_order'  => ['nullable', 'integer'],
        ]);

        if ($request->hasFile('logo')) {
            if ($education->logo) {
                Storage::disk('public')->delete($education->logo);
            }
            $data['logo'] = $request->file('logo')->store('education', 'public');
        }

        $education->update($data);
        return redirect()->route('admin.education.index')->with('success', 'Education updated.');
    }

    public function destroy(Education $education)
    {
        if ($education->logo) {
            Storage::disk('public')->delete($education->logo);
        }
        $education->delete();
        return redirect()->route('admin.education.index')->with('success', 'Education deleted.');
    }
}
