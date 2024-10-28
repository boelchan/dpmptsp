<?php

namespace App\Http\Controllers;

use App\DataTables\TimDataTable;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TimController extends Controller
{
    public function index(TimDataTable $timDataTable)
    {
        $breadcrumbs = [['url' => '', 'title' => 'Post'], ['url' => '', 'title' => 'tim']];

        return $timDataTable->render('tim.index', compact('breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [['url' => '#', 'title' => 'Post'], ['url' => route('post.tim.index'), 'title' => 'tim'], ['url' => '#', 'title' => 'tambah']];

        return view('tim.create', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|mimes:jpg,jpeg,png|max:1000',
            'jabatan' => 'required',
            'nama' => 'required|max:250|unique:teams',
            'meta_keywords' => 'max:250',
            'meta_description' => 'max:250',

        ]);

        $uuid = (string) Str::uuid();
        $id = Team::create($request->all() + ['uuid' => $uuid]);

        return redirect()->route('post.tim.show', [$id, 'uuid' => $uuid]);
    }

    public function show(Team $tim)
    {
        checkUuid($tim->uuid);
        $breadcrumbs = [['url' => '#', 'title' => 'Post'], ['url' => route('post.tim.index'), 'title' => 'tim'], ['url' => '#', 'title' => 'preview']];

        return view('tim.show', compact('tim', 'breadcrumbs'));
    }

    public function edit(Team $tim)
    {
        checkUuid($tim->uuid);
        $breadcrumbs = [['url' => '#', 'title' => 'Post'], ['url' => route('post.tim.index'), 'title' => 'tim'], ['url' => '', 'title' => 'Edit']];

        return view('tim.edit', compact('tim', 'breadcrumbs'));
    }

    public function update(Request $request, Team $tim)
    {
        $request->validate([
            'gambar' => 'mimes:jpg,jpeg,png|max:1000',
            'jabatan' => 'required',
            'nama' => 'required|max:250|unique:teams,nama,'.$tim->id,
            'meta_keywords' => 'max:250',
            'meta_description' => 'max:250',
        ]);

        $tim->update($request->all());

        return redirect()->route('post.tim.show', [$tim->id, 'uuid' => $tim->uuid]);
    }

    public function destroy(Team $tim)
    {
        checkUuid($tim->uuid);

        if ($tim->delete()) {
            return response()->json(['success' => true, 'redirect' => route('post.tim.index')]);
        }

        return response()->json(['message' => 'Gagal menghapus data'], 400);
    }
}
