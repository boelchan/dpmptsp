<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->hasRole('pasien')) {
            $riwayatBaru = auth()->user()->riwayatBookingBaru;
            $riwayatSelesai = auth()->user()->riwayatBookingSelesai;

            return view('pasien.home', compact('riwayatBaru', 'riwayatSelesai'));
        }

        return view('home');
    }
}
