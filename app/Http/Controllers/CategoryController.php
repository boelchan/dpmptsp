<?php

namespace App\Http\Controllers;

use App\DataTables\CategoryDataTable;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(CategoryDataTable $categoryDataTable)
    {
        $breadcrumbs = [['url' => route('post.index'), 'title' => 'Post'], ['url' => '', 'title' => 'category']];

        return $categoryDataTable->render('category.index', compact('breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [['url' => route('post.index'), 'title' => 'Post'], ['url' => route('category.index'), 'title' => 'category'], ['url' => '#', 'title' => 'tambah']];

        return view('category.create', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:50|unique:categories',
        ]);
        Category::create($request->all());

        return redirect()->route('category.index');
    }

    public function edit(Category $category)
    {
        $breadcrumbs = [['url' => route('post.index'), 'title' => 'Post'], ['url' => route('category.index'), 'title' => 'category'], ['url' => '', 'title' => 'Edit']];

        return view('category.edit', compact('category', 'breadcrumbs'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'nama' => 'required|max:50|unique:categories,nama,'.$category->id,
        ]);

        $category->update($request->all());

        return redirect()->route('category.index');
    }

    public function destroy(Category $category)
    {
        if (in_array($category->id, [1, 2])) {
            return response()->json(['message' => 'Kategori ini tidak dapat dihapus'], 400);
        }
        if ($category->delete()) {
            return response()->json(['success' => true, 'redirect' => route('category.index')]);
        }

        return response()->json(['message' => 'Gagal menghapus data'], 400);
    }
}
