<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\InstansiLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InstansiLayananController extends Controller
{
    public $title;

    public function __construct($title = '')
    {
        $this->title = 'Layanan Instansi';
    }

    public function create(Instansi $instansi)
    {
        checkUuid($instansi->uuid);

        $title = $this->title;
        $breadcrumbs = [['url' => route('instansi.index'), 'title' => $title], ['url' => '#', 'title' => 'tambah']];

        return view('instansi-layanan.create', compact('breadcrumbs', 'title', 'instansi'));
    }

    public function store(Request $request, Instansi $instansi)
    {
        checkUuid($instansi->uuid);

        $request->validate([
            'nama' => 'required|max:250|unique:instansi_layanan',
            'jenis' => 'required',
            'publish' => 'required',
            'meta_keywords' => 'max:250',
            'meta_description' => 'max:250',
        ]);

        $instansi_id = auth()->user()->instansi_id;
        if (auth()->user()->hasRole('superadmin')) {
            $instansi_id = $instansi->id;
        }

        $uuid = (string) Str::uuid();
        InstansiLayanan::create($request->all() + ['uuid' => $uuid, 'instansi_id' => $instansi_id]);

        return to_route('instansi.show', [$instansi->id, 'uuid' => $instansi->uuid])
            ->withFragment('card-layanan')
            ->with('message', 'Layanan berhasil ditambahkan');
    }

    public function edit(InstansiLayanan $layanan)
    {
        checkUuid($layanan->uuid);
        $title = $this->title;
        $breadcrumbs = [['url' => route('instansi.index'), 'title' => $title], ['url' => '', 'title' => 'Edit']];

        return view('instansi-layanan.edit', compact('layanan', 'title', 'breadcrumbs'));
    }

    public function update(Request $request, InstansiLayanan $layanan)
    {
        $request->validate([
            'nama' => 'required|max:250|unique:instansi_layanan,nama,'.$layanan->id,
            'jenis' => 'required',
            'publish' => 'required',
            'meta_keywords' => 'max:250',
            'meta_description' => 'max:250',
        ]);

        $layanan->update($request->all());

        return to_route('instansi.show', [$layanan->instansi_id, 'uuid' => $layanan->instansi->uuid])
            ->withFragment('card-layanan')
            ->with('message', 'Layanan berhasil diubah');
    }

    public function destroy(InstansiLayanan $layanan)
    {
        checkUuid($layanan->uuid);

        if ($layanan->delete()) {
            return response()->json(['success' => true]);
        }

        return response()->json(['message' => 'Gagal menghapus data'], 400);
    }
}
