<?php

namespace App\Http\Controllers;

use App\DataTables\KepuasanMasyarakatDataTable;
use App\Enum\KepuasanMasyarakatEnum;
use App\Models\Instansi;
use App\Models\KepuasanMasyarakat;

class KepuasanMasyarakatController extends Controller
{
    public $title;

    public function __construct($title = '')
    {
        $this->title = 'Survei Kepuasan Masyarakat';
    }

    public function index(KepuasanMasyarakatDataTable $kepuasanMasyarakatDataTable)
    {
        $title = $this->title;
        $breadcrumbs = [['url' => '', 'title' => $title]];
        $kepuasanOption = ['' => 'Semua'] + KepuasanMasyarakatEnum::choice();
        $instansiOption = ['' => 'Semua'] + Instansi::where('publish', 'ya')->orderBy('nama', 'asc')->pluck('nama', 'id')->all();

        return $kepuasanMasyarakatDataTable->render('kepuasan-masyarakat.index', compact('breadcrumbs', 'title', 'kepuasanOption', 'instansiOption'));
    }

    public function show(KepuasanMasyarakat $kepuasan)
    {
        checkUuid($kepuasan->uuid);

        $title = $this->title;
        $breadcrumbs = [['url' => route('kepuasan.index'), 'title' => $title], ['url' => '', 'title' => 'detail']];

        return view('kepuasan-masyarakat.show', compact('breadcrumbs', 'title', 'kepuasan'));
    }
}
