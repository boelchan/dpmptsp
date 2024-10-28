<?php

namespace App\Http\Controllers;

use App\Models\Identity;
use Illuminate\Http\Request;

class IdentitasController extends Controller
{
    public function index()
    {
        $breadcrumbs = [['url' => '', 'title' => 'Setting'], ['url' => '', 'title' => 'Identitas']];

        $sosmed = Identity::where('tipe', 'sosmed')->get();
        $website = Identity::where('tipe', 'website')->get();
        $identitas = Identity::where('tipe', 'identitas')->get();

        return view('identitas.index', compact('breadcrumbs', 'sosmed', 'website', 'identitas'));
    }

    public function edit($slug)
    {
        $breadcrumbs = [['url' => '#', 'title' => 'Setting'], ['url' => route('identitas.index'), 'title' => 'identitas'], ['url' => '', 'title' => 'Edit']];

        $identitas = Identity::firstWhere('slug', $slug);
        if (! $identitas) {
            return redirect()->route('identitas.index');
        }

        return view('identitas.edit', compact('identitas', 'breadcrumbs'));
    }

    public function update(Request $request, $identitas)
    {
        $identitas = Identity::findOrFail($identitas);

        if ($identitas->tipe == 'website') {
            $request->validate(['value' => 'required|mimes:jpg,jpeg,png|max:300']);
            if ($file = request()->file('value')) {
                $fileName = $identitas->slug.'-'.microtime().'.'.$file->extension();
                $file->move('storage/static/', $fileName);
                $identitas->update(['value' => $fileName]);
            }
        } else {
            $identitas->update(['value' => $request->value]);
        }

        return redirect()->route('identitas.index');
    }
}
