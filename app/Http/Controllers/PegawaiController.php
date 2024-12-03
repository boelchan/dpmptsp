<?php

namespace App\Http\Controllers;

use App\DataTables\PegawaiDataTable;
use App\Models\Bidang;
use App\Models\Link;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PegawaiController extends Controller
{
    public $title;

    public function __construct($title = '')
    {
        $this->title = 'Staff dan Pimpinan';
    }

    public function index(PegawaiDataTable $pegawaiDataTable)
    {
        $title = $this->title;
        $breadcrumbs = [['url' => '', 'title' => $title]];

        return $pegawaiDataTable->render('pegawai.index', compact('breadcrumbs', 'title'));
    }

    public function create()
    {
        $title = $this->title;
        $breadcrumbs = [['url' => route('pegawai.index'), 'title' => $title], ['url' => '#', 'title' => 'tambah']];
        $bidangOption = Bidang::pluck('nama', 'id')->all();

        return view('pegawai.create', compact('breadcrumbs', 'title', 'bidangOption'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'mimes:jpg,jpeg,png,gif|max:1000',
            'nama' => 'required|max:250|unique:pegawais',
            'bidang_id' => 'required',
            'jabatan' => 'required|max:250',
        ]);

        $uuid = (string) Str::uuid();
        $id = Pegawai::create($request->all() + ['uuid' => $uuid]);

        return redirect()->route('pegawai.show', [$id, 'uuid' => $uuid]);
    }

    public function show(Pegawai $pegawai)
    {
        checkUuid($pegawai->uuid);
        $title = $this->title;
        $breadcrumbs = [['url' => route('pegawai.index'), 'title' => $title], ['url' => '#', 'title' => 'detail']];

        return view('pegawai.show', compact('pegawai', 'breadcrumbs', 'title'));
    }

    public function edit(Pegawai $pegawai)
    {
        checkUuid($pegawai->uuid);
        $title = $this->title;
        $breadcrumbs = [['url' => route('pegawai.index'), 'title' => $title], ['url' => '', 'title' => 'Edit']];
        $bidangOption = Bidang::pluck('nama', 'id')->all();

        return view('pegawai.edit', compact('pegawai', 'title', 'breadcrumbs', 'bidangOption'));
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'foto' => 'mimes:jpg,jpeg,png,gif|max:1000',
            'nama' => 'required|max:250|unique:pegawais,nama,'.$pegawai->id,
            'jabatan' => 'required|max:250',
            'bidang_id' => 'required',
        ]);

        $pegawai->update($request->all());

        return redirect()->route('pegawai.show', [$pegawai->id, 'uuid' => $pegawai->uuid]);
    }

    public function destroy(Link $link)
    {
        checkUuid($link->uuid);

        if ($link->delete()) {
            return response()->json(['success' => true, 'redirect' => route('pegawai.index')]);
        }

        return response()->json(['message' => 'Gagal menghapus data'], 400);
    }
}
