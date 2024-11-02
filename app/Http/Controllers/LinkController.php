<?php

namespace App\Http\Controllers;

use App\DataTables\LinkDataTable;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    public $title;

    public function __construct($title = '')
    {
        $this->title = 'Link Terkait';
    }

    public function index(LinkDataTable $linkDatatable)
    {
        $title = $this->title;
        $breadcrumbs = [['url' => '', 'title' => $title]];

        return $linkDatatable->render('link.index', compact('breadcrumbs', 'title'));
    }

    public function create()
    {
        $title = $this->title;
        $breadcrumbs = [['url' => route('link.index'), 'title' => $title], ['url' => '#', 'title' => 'tambah']];

        return view('link.create', compact('breadcrumbs', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'mimes:jpg,jpeg,png,gif|max:1000',
            'nama' => 'required|max:250|unique:links',
            'url' => 'required|max:250|unique:links',
            'meta_keywords' => 'max:250',
            'meta_description' => 'max:250',
        ]);

        $uuid = (string) Str::uuid();
        $id = Link::create($request->all() + ['uuid' => $uuid]);

        return redirect()->route('link.show', [$id, 'uuid' => $uuid]);
    }

    public function show(Link $link)
    {
        checkUuid($link->uuid);
        $title = $this->title;
        $breadcrumbs = [['url' => route('link.index'), 'title' => $title], ['url' => '#', 'title' => 'detail']];

        return view('link.show', compact('link', 'breadcrumbs', 'title'));
    }

    public function edit(Link $link)
    {
        checkUuid($link->uuid);
        $title = $this->title;
        $breadcrumbs = [['url' => route('link.index'), 'title' => $title], ['url' => '', 'title' => 'Edit']];

        return view('link.edit', compact('link', 'title', 'breadcrumbs'));
    }

    public function update(Request $request, Link $link)
    {
        $request->validate([
            'icon' => 'mimes:jpg,jpeg,png,gif|max:1000',
            'nama' => 'required|max:250|unique:links,nama,'.$link->id,
            'url' => 'required|max:250|unique:links,url,'.$link->id,
            'meta_keywords' => 'max:250',
            'meta_description' => 'max:250',
        ]);

        $link->update($request->all());

        return redirect()->route('link.show', [$link->id, 'uuid' => $link->uuid]);
    }

    public function destroy(Link $link)
    {
        checkUuid($link->uuid);

        if ($link->delete()) {
            return response()->json(['success' => true, 'redirect' => route('link.index')]);
        }

        return response()->json(['message' => 'Gagal menghapus data'], 400);
    }
}
