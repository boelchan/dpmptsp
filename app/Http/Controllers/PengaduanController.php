<?php

namespace App\Http\Controllers;

use App\DataTables\PengaduanDataTable;
use App\Enum\StatusPengaduanEnum;
use App\Models\Instansi;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PengaduanController extends Controller
{
    public $title;

    public function __construct($title = '')
    {
        $this->title = 'Pengaduan';
    }

    public function index(PengaduanDataTable $pengaduanDataTable)
    {
        $title = $this->title;
        $breadcrumbs = [['url' => '', 'title' => $title]];
        $statusOption = ['' => 'Semua'] + StatusPengaduanEnum::choice();
        $instansiOption = ['' => 'Semua'] + Instansi::where('publish', 'ya')->orderBy('nama', 'asc')->pluck('nama', 'id')->all();

        return $pengaduanDataTable->render('pengaduan.index', compact('breadcrumbs', 'title', 'statusOption', 'instansiOption'));
    }

    public function show(Pengaduan $pengaduan): View
    {
        checkUuid($pengaduan->uuid);
        $title = $this->title;
        $breadcrumbs = [['url' => route('pengaduan.index'), 'title' => $title], ['url' => '', 'title' => 'detail']];

        return view('pengaduan.show', compact('title', 'breadcrumbs', 'pengaduan'));
    }

    public function validasi(Request $request, Pengaduan $pengaduan)
    {
        checkUuid($pengaduan->uuid);

        $pengaduan->status = StatusPengaduanEnum::VALID->value;
        $pengaduan->validasi_at = now();
        $pengaduan->save();

        return response()->json(['success' => true, 'message' => 'Validasi berhasil', 'redirect' => route('pengaduan.index')]);
    }

    public function tanggapan(Request $request, Pengaduan $pengaduan)
    {
        checkUuid($pengaduan->uuid);

        $pengaduan->tanggapan = $request->input('tanggapan');
        $pengaduan->status = StatusPengaduanEnum::SELESAI->value;
        $pengaduan->tanggapan_at = now();
        $pengaduan->save();

        return response()->json(['success' => true, 'message' => 'Tanggapan berhasil disimpan', 'redirect' => route('pengaduan.index')]);
    }

    public function destroy(Pengaduan $pengaduan)
    {
        checkUuid($pengaduan->uuid);

        if ($pengaduan->delete()) {
            return response()->json(['success' => true, 'redirect' => route('pengaduan.index')]);
        }

        return response()->json(['message' => 'Gagal menghapus data'], 400);
    }
}
