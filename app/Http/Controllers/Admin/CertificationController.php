<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use Illuminate\Http\Request;

class CertificationController extends Controller
{
    public function index()
    {
        $certifications = Certification::orderBy('sort_order')->orderBy('id')->paginate(15);
        return view('admin.certifications.index', compact('certifications'));
    }

    public function create()
    {
        return view('admin.certifications.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'      => ['required', 'max:255'],
            'issuer'     => ['required', 'max:255'],
            'date'       => ['required', 'max:50'],
            'url'        => ['nullable', 'url'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        Certification::create($data);
        return redirect()->route('admin.certifications.index')->with('success', 'Certification created.');
    }

    public function edit(Certification $certification)
    {
        return view('admin.certifications.edit', compact('certification'));
    }

    public function update(Request $request, Certification $certification)
    {
        $data = $request->validate([
            'title'      => ['required', 'max:255'],
            'issuer'     => ['required', 'max:255'],
            'date'       => ['required', 'max:50'],
            'url'        => ['nullable', 'url'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $certification->update($data);
        return redirect()->route('admin.certifications.index')->with('success', 'Certification updated.');
    }

    public function destroy(Certification $certification)
    {
        $certification->delete();
        return redirect()->route('admin.certifications.index')->with('success', 'Certification deleted.');
    }
}
