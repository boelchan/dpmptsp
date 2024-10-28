<?php

use App\Models\Identity;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;

function browser_agent($user_agent)
{
    $agent = tap(new Agent(), fn ($agent) => $agent->setUserAgent($user_agent));

    return $agent->platform().' - '.$agent->browser();
}

function checkUuid($fieldUuid)
{
    abort_if((request()->uuid != $fieldUuid), 404);
}

function rupiah($value)
{
    return 'Rp '.number_format((int) $value, 0, ',', '.');
}

function angka($value)
{
    return number_format((int) $value, 0, ',', '.');
}

function setting($tipe)
{
    return Identity::setting($tipe);
}

function tanggal($value)
{
    return Carbon::parse($value)->translatedFormat('d M Y');
}

function tanggalLengkap($value)
{
    return Carbon::parse($value)->translatedFormat('l, d F Y');
}

function tanggalJam($value)
{
    if ($value) {
        return Carbon::parse($value)->translatedFormat('d M Y H:i');
    }

    return '-';
}

function tahunOption()
{
    $tahunAwal = 1800;
    $tahunSekarang = date('Y');
    $tahunOption = [];
    for ($i = $tahunSekarang; $i >= $tahunAwal; $i--) {
        $tahunOption[$i] = (string) $i;
    }

    return $tahunOption;
}
