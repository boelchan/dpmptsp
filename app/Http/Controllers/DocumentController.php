<?php

namespace App\Http\Controllers;

use App\DataTables\DocumentDataTable;
use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
    public $title;

    public function __construct($title = '')
    {
        $this->title = 'Layanan & SAKIP';
    }

    public function index(DocumentDataTable $documentDataTable)
    {
        $title = $this->title;
        $breadcrumbs = [['url' => '', 'title' => $title]];
        $kategoriOption = DocumentCategory::pluck('nama', 'id')->all();

        return $documentDataTable->render('document.index', compact('breadcrumbs', 'title', 'kategoriOption'));
    }

    public function create()
    {
        $title = $this->title;
        $breadcrumbs = [['url' => route('document.index'), 'title' => $title], ['url' => '#', 'title' => 'tambah']];
        $kategoriOption = DocumentCategory::pluck('nama', 'id')->all();

        return view('document.create', compact('breadcrumbs', 'title', 'kategoriOption'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'mimes:pdf|max:8000|required',
            'title' => 'required|max:250',
            'document_category_id' => 'required',
            'meta_keywords' => 'max:250',
            'meta_description' => 'max:250',
        ], ['required' => 'Wajib diisi']);

        $uuid = (string) Str::uuid();
        $id = Document::create($request->all() + ['uuid' => $uuid]);

        return redirect()->route('document.show', [$id, 'uuid' => $uuid]);
    }

    public function show(Document $document)
    {
        checkUuid($document->uuid);
        $title = $this->title;
        $breadcrumbs = [['url' => route('document.index'), 'title' => $title], ['url' => '#', 'title' => 'detail']];

        return view('document.show', compact('document', 'breadcrumbs', 'title'));
    }

    public function edit(Document $document)
    {
        checkUuid($document->uuid);
        $title = $this->title;
        $breadcrumbs = [['url' => route('document.index'), 'title' => $title], ['url' => '', 'title' => 'Edit']];
        $kategoriOption = DocumentCategory::pluck('nama', 'id')->all();

        return view('document.edit', compact('document', 'title', 'breadcrumbs', 'kategoriOption'));
    }

    public function update(Request $request, Document $document)
    {
        $request->validate([
            'file' => 'mimes:pdf|max:8000',
            'title' => 'required|max:250',
            'document_category_id' => 'required',
            'meta_keywords' => 'max:250',
            'meta_description' => 'max:250',
        ], ['required' => 'Wajib diisi']);

        $document->update($request->all());

        return redirect()->route('document.show', [$document->id, 'uuid' => $document->uuid]);
    }

    public function destroy(Document $document)
    {
        checkUuid($document->uuid);

        if ($document->delete()) {
            return response()->json(['success' => true, 'redirect' => route('document.index')]);
        }

        return response()->json(['message' => 'Gagal menghapus data'], 400);
    }
}
