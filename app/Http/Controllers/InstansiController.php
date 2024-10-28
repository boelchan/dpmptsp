<?php

namespace App\Http\Controllers;

use App\DataTables\InstansiDataTable;
use App\Models\Antrian;
use App\Models\AntrianDetail;
use App\Models\Instansi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Spatie\SimpleExcel\SimpleExcelWriter;

class InstansiController extends Controller
{
    public $title;

    public function __construct($title = '')
    {
        $this->title = 'Instansi';
    }

    public function index(InstansiDataTable $instansiDataTable)
    {
        $title = $this->title;
        $breadcrumbs = [['url' => '', 'title' => $title]];

        if (auth()->user()->hasRole('instansi')) {
            $instansi = auth()->user()->instansi;

            return to_route('instansi.show', [$instansi->id, 'uuid' => $instansi->uuid]);
        }

        return $instansiDataTable->render('instansi.index', compact('breadcrumbs', 'title'));
    }

    public function create()
    {
        $title = $this->title;
        $breadcrumbs = [['url' => route('instansi.index'), 'title' => $title], ['url' => '#', 'title' => 'tambah']];

        return view('instansi.create', compact('breadcrumbs', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'mimes:jpg,jpeg,png,gif|max:500',
            'nama' => 'required|max:250|unique:instansi',
            'meta_keywords' => 'max:250',
            'meta_description' => 'max:250',
        ]);

        $uuid = (string) Str::uuid();
        $id = Instansi::create($request->all() + ['uuid' => $uuid]);

        return redirect()->route('instansi.show', [$id, 'uuid' => $uuid]);
    }

    public function show(Instansi $instansi)
    {
        checkUuid($instansi->uuid);
        $title = $this->title;
        $breadcrumbs = [['url' => route('instansi.index'), 'title' => $title], ['url' => '#', 'title' => 'preview']];

        return view('instansi.show', compact('instansi', 'breadcrumbs', 'title'));
    }

    public function edit(Instansi $instansi)
    {
        checkUuid($instansi->uuid);
        $title = $this->title;
        $breadcrumbs = [['url' => route('instansi.index'), 'title' => $title], ['url' => '', 'title' => 'Edit']];

        return view('instansi.edit', compact('instansi', 'title', 'breadcrumbs'));
    }

    public function update(Request $request, Instansi $instansi)
    {
        $request->validate([
            'icon' => 'mimes:jpg,jpeg,png,gif|max:500',
            'nama' => 'required|max:250|unique:instansi,nama,'.$instansi->id,
            'meta_keywords' => 'max:250',
            'meta_description' => 'max:250',
        ]);

        $instansi->update($request->all());

        return redirect()->route('instansi.show', [$instansi->id, 'uuid' => $instansi->uuid]);
    }

    public function destroy(Instansi $instansi)
    {
        checkUuid($instansi->uuid);

        if ($instansi->delete()) {
            return response()->json(['success' => true, 'redirect' => route('instansi.index')]);
        }

        return response()->json(['message' => 'Gagal menghapus data'], 400);
    }

    public function qrcode(Instansi $instansi)
    {
        checkUuid($instansi->uuid);

        QrCode::format('svg')->size(300)->generate(route('front.skm.create', [$instansi->id, 'uuid' => $instansi->uuid]), 'storage/instansi/qrcode/'.$instansi->id.'.svg');
        echo "<img src='".asset('storage/instansi/qrcode/'.$instansi->id.'.svg')."'>";
    }

    public function antrian(Instansi $instansi)
    {
        checkUuid($instansi->uuid);

        $title = $this->title;
        $breadcrumbs = [['url' => route('instansi.index'), 'title' => $title], ['url' => '', 'title' => 'Antrian']];

        $tanggal = request()->tanggal ?? Carbon::today();
        $antrian = Antrian::where('instansi_id', $instansi->id)->where('tanggal', $tanggal)->first();

        return view('instansi.antrian', compact('instansi', 'antrian', 'title', 'breadcrumbs'));
    }

    public function antrianExcel(Instansi $instansi)
    {
        checkUuid($instansi->uuid);

        $data = [];
        $tanggal = request()->tanggal ?? Carbon::today();
        $antrian = Antrian::where('instansi_id', $instansi->id)->where('tanggal', $tanggal)->first();
        if ($antrian) {
            foreach ($antrian->detail_kunjungan as $antrian) {
                $data[] = [
                    $antrian->no_antrian,
                    str($antrian->created_at),
                    $antrian->layanan_label,
                    $antrian->kepuasan_label,
                    $antrian->masukan,
                ];
            }
        }

        $writer = SimpleExcelWriter::streamDownload('rekap-antrian-'.$tanggal.'.xlsx')
            ->addHeader(['No Antrian', 'Waktu Kedatangan', 'Layanan', 'SKM', 'Saran'])
            ->addRows($data);
    }

    public function simpan_layanan_antrian()
    {
        AntrianDetail::where('id', request()->antrian_detail_id)->update(['layanan_id' => request()->layanan_id]);

        return back();
    }

    public function antrianRekap()
    {
        $title = $this->title;
        $breadcrumbs = [['url' => route('instansi.index'), 'title' => $title], ['url' => '', 'title' => 'Rekap Antrian']];

        $instansi = Instansi::where('publish', 'ya')->orderBy('nama', 'asc')->get();
        $jumlahAntrian = Instansi::jumlahAntrian();

        return view('instansi.antrian-rekap', compact('instansi', 'jumlahAntrian', 'title', 'breadcrumbs'));
    }

    public function antrianRekapInstansi(Instansi $instansi)
    {
        checkUuid($instansi->uuid);

        $title = $this->title;
        $breadcrumbs = [['url' => route('instansi.index'), 'title' => $title], ['url' => '', 'title' => 'Rekap Antrian']];

        $antrian = [];

        $tanggal = request()->tanggal;
        if ($tanggal) {
            $date_range = explode(' - ', $tanggal);
            $start = $date_range[0];
            $end = $start;
            if (count($date_range) == 2) {
                $end = $date_range[1];
            }
            $antrian = Antrian::where('instansi_id', $instansi->id)->whereBetween('tanggal', [$start, $end])->get();
        }

        return view('instansi.antrian-rekap-instansi', compact('instansi', 'antrian', 'title', 'breadcrumbs'));
    }

    public function antrianRekapDetail(Instansi $instansi)
    {
        checkUuid($instansi->uuid);

        $title = $this->title;
        $breadcrumbs = [['url' => route('instansi.index'), 'title' => $title], ['url' => '', 'title' => 'Rekap Antrian Detail']];

        $tanggal = request()->tanggal ?? Carbon::today();
        $antrian = Antrian::where('instansi_id', $instansi->id)->where('tanggal', $tanggal)->first();

        return view('instansi.antrian-rekap-detail', compact('instansi', 'antrian', 'title', 'breadcrumbs'));
    }

    public function antrianRekapExcel()
    {
        $data = [];
        $tanggal = request()->tanggal ?? Carbon::today();
        $instansi = Instansi::where('publish', 'ya')->orderBy('nama', 'asc')->get();
        if ($instansi) {
            foreach ($instansi as $key => $antrian) {
                $data[] = [
                    ($key + 1),
                    $antrian->nama,
                    $antrian->jumlah_antrian_instansi,
                ];
            }
        }

        $writer = SimpleExcelWriter::streamDownload('rekap-'.$tanggal.'.xlsx')
            ->addHeader(['No', 'Instansi', 'Jumlah Antrian'])
            ->addRows($data);
    }
}
