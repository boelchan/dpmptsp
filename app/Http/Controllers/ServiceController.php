<?php

namespace App\Http\Controllers;

use App\DataTables\ServiceDataTable;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public $title;

    public function __construct($title = '')
    {
        $this->title = 'Fasilitas';
    }

    public function index(ServiceDataTable $serviceDatatable)
    {
        $title = $this->title;
        $breadcrumbs = [['url' => '', 'title' => $title]];

        return $serviceDatatable->render('service.index', compact('breadcrumbs', 'title'));
    }

    public function create()
    {
        $title = $this->title;
        $breadcrumbs = [['url' => route('service.index'), 'title' => $title], ['url' => '#', 'title' => 'tambah']];

        return view('service.create', compact('breadcrumbs', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'mimes:jpg,jpeg,png,gif|max:1000',
            'nama' => 'required|max:250|unique:services',
            'meta_keywords' => 'max:250',
            'meta_description' => 'max:250',
        ]);

        $uuid = (string) Str::uuid();
        $id = Service::create($request->all() + ['uuid' => $uuid]);

        return redirect()->route('service.show', [$id, 'uuid' => $uuid]);
    }

    public function show(Service $service)
    {
        checkUuid($service->uuid);
        $title = $this->title;
        $breadcrumbs = [['url' => route('service.index'), 'title' => $title], ['url' => '#', 'title' => 'preview']];

        return view('service.show', compact('service', 'breadcrumbs', 'title'));
    }

    public function edit(Service $service)
    {
        checkUuid($service->uuid);
        $title = $this->title;
        $breadcrumbs = [['url' => route('service.index'), 'title' => $title], ['url' => '', 'title' => 'Edit']];

        return view('service.edit', compact('service', 'title', 'breadcrumbs'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'icon' => 'mimes:jpg,jpeg,png,gif|max:1000',
            'nama' => 'required|max:250|unique:services,nama,'.$service->id,
            'meta_keywords' => 'max:250',
            'meta_description' => 'max:250',
        ]);

        $service->update($request->all());

        return redirect()->route('service.show', [$service->id, 'uuid' => $service->uuid]);
    }

    public function destroy(Service $service)
    {
        checkUuid($service->uuid);

        if ($service->delete()) {
            return response()->json(['success' => true, 'redirect' => route('service.index')]);
        }

        return response()->json(['message' => 'Gagal menghapus data'], 400);
    }
}
