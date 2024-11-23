<?php

use App\Models\Identity;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;

if (! function_exists('browser_agent')) {
    function browser_agent($user_agent)
    {
        $agent = tap(new Agent, fn ($agent) => $agent->setUserAgent($user_agent));

        return $agent->platform().' - '.$agent->browser();
    }
}

if (! function_exists('checkUuid')) {
    function checkUuid($fieldUuid)
    {
        abort_if((request()->uuid != $fieldUuid), 404);
    }
}

if (! function_exists('rupiah')) {
    function rupiah($value)
    {
        return 'Rp '.number_format((int) $value, 0, ',', '.');
    }
}

if (! function_exists('angka')) {
    function angka($value)
    {
        return number_format((int) $value, 0, ',', '.');
    }
}

if (! function_exists('setting')) {
    function setting($tipe)
    {
        return Identity::setting($tipe);
    }
}

if (! function_exists('tanggal')) {
    function tanggal($value)
    {
        return Carbon::parse($value)->translatedFormat('d M Y');
    }
}

if (! function_exists('tanggalLengkap')) {
    function tanggalLengkap($value)
    {
        return Carbon::parse($value)->translatedFormat('l, d F Y');
    }
}

if (! function_exists('tanggalJam')) {
    function tanggalJam($value)
    {
        if ($value) {
            return Carbon::parse($value)->translatedFormat('d M Y H:i');
        }

        return '-';
    }
}

if (! function_exists('tahunOption')) {
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
}
