<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Models\AntrianDetail;
use App\Models\Instansi;
use Carbon\Carbon;

class AntrianController extends Controller
{
    public function list_instansi()
    {
        $instansi = Instansi::select('id', 'uuid', 'nama', 'icon')->where('publish', 'ya')->orderBy('nama', 'asc')->get();

        $instansi_arr = [];
        foreach ($instansi as $v) {
            $imagePath = public_path('/storage/instansi/'.$v->icon);
            $imageData = base64_encode(file_get_contents($imagePath));
            $imageType = mime_content_type($imagePath);
            $imageSrc = 'data:'.$imageType.';base64,'.$imageData;

            $instansi_arr[] = [
                'id' => $v->id,
                'uuid' => $v->uuid,
                'nama' => $v->nama,
                'icon' => $imageSrc,
            ];
        }

        return response()->json(['success' => true, 'data' => $instansi_arr]);
    }

    public function ambil_antrian($instansi_id, $uuid)
    {
        $instansi = Instansi::where('id', $instansi_id)->where('uuid', $uuid)->first();
        if (! $instansi) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan']);
        }

        $today = Carbon::today();
        $antrian = Antrian::firstOrCreate(
            ['instansi_id' => $instansi_id, 'tanggal' => $today]
        );
        $no_antrian_sekarang = $antrian->no_antrian_sekarang + 1;

        $antrian->no_antrian_sekarang = $no_antrian_sekarang;
        $antrian->save();

        $detail = AntrianDetail::create(['antrian_id' => $antrian->id, 'no_antrian' => $no_antrian_sekarang]);

        $res = [
            'no_antrian' => $detail->no_antrian,
            'instansi' => $instansi->nama,
            'tanggal_cetak' => Carbon::parse($detail->created_at)->translatedFormat('d M Y H:i:s'),
            'skm_url' => route('front.skmqr.create', ['id' => $detail->id, 'uuid' => $detail->uuid]),
        ];

        return response()->json(['success' => true, 'data' => $res]);
    }

    public function list_antrian_instansi($instansi_id, $uuid)
    {
        $instansi = Instansi::where('id', $instansi_id)->where('uuid', $uuid)->first();
        if (! $instansi) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan']);
        }

        $antrian = Antrian::where('instansi_id', $instansi_id)->where('tanggal', Carbon::today())->first();

        return response()->json(['success' => true, 'data' => $antrian->detail_kunjungan]);
    }
}
