<?php

namespace App\Http\Controllers;

use App\Enum\CategoryEnum;
use App\Models\Category;
use App\Models\Document;
use App\Models\DocumentCategory;
use App\Models\Link;
use App\Models\Pengaduan;
use App\Models\Post;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FrontController extends Controller
{
    public function navbarMenu()
    {
        $kategori = Category::whereNotIn('id', [1, 2])->where('add_to_header_menu', 'tidak')->get();
        $addToHeader = Category::whereNotIn('id', [1, 2])->where('add_to_header_menu', 'ya')->get();
        $addToSidebar = Category::whereNotIn('id', [1, 2])->where('add_to_sidebar_menu', 'ya')->get();
        $addToFooter = Category::whereNotIn('id', [1, 2])->where('add_to_footer_menu', 'ya')->get();

        return ['kategori' => $kategori, 'addToHeader' => $addToHeader, 'addToSidebar' => $addToSidebar, 'addToFooter' => $addToFooter];
    }

    public function index()
    {
        $navbarMenu = $this->navbarMenu();

        $banner = Post::where('kategori_id', CategoryEnum::BANNER)->where('publish', 'ya')->orderBy('publish_at', 'asc')->get();
        $post = Post::where('tampil_banner', 'ya')->where('publish', 'ya')->orderBy('publish_at', 'desc')->orderBy('updated_at', 'desc')->get();
        $slider = $banner->merge($post);

        $lastestPost = Post::where('publish', 'ya')->whereNotIn('kategori_id', [1, 2, 3])->orderBy('publish_at', 'desc')->orderBy('updated_at', 'desc')->limit(10)->get();

        $pamflet = Post::where('kategori_id', CategoryEnum::PAMFLET)->where('publish', 'ya')->orderBy('publish_at', 'desc')->orderBy('updated_at', 'desc')->get()->take(6);
        $sambutan = Post::find(3);
        $layanan = Service::where('publish', 'ya')->get();
        $link = Link::where('publish', 'ya')->get();

        $meta = [
            'title' => 'Beranda',
            'category' => 'Beranda',
            'description' => 'mall pelayanan publik kab sumenep',
            'keywords' => 'mall pelayanan publik kab sumenep',
            'image' => setting('logo'),
        ];

        return view('front.index', compact('navbarMenu', 'slider', 'sambutan', 'pamflet', 'meta', 'layanan', 'lastestPost', 'link'));
    }

    public function post($slug = '')
    {
        $navbarMenu = $this->navbarMenu();

        $post = Post::where('slug', $slug)->where('publish', 'ya')->first();

        if (! $post) {
            return to_route('index');
        }

        $meta = [
            'title' => $post->judul,
            'category' => $post->kategori->nama,
            'description' => ($post->meta_description != '' ? $post->meta_description : Str::limit($post->konten, 250)),
            'keywords' => $post->meta_keywords,
            'image' => $post->gambar_url,
        ];

        return view('front.post-detail', compact('navbarMenu', 'post', 'meta'));
    }

    public function kategori($kategoriSlug)
    {
        $navbarMenu = $this->navbarMenu();

        $kategori = Category::firstWhere('slug', $kategoriSlug);

        if (! $kategori) {
            return to_route('index');
        }

        $post = Post::where('kategori_id', $kategori->id)
            ->where('publish', 'ya')
            ->orderBy('publish_at', 'desc')
            ->orderBy('updated_at', 'desc')
            ->paginate(15);

        $meta = [
            'title' => 'Post',
            'category' => $kategori->nama,
            'description' => $kategori->nama,
            'keywords' => 'Agenda, Kegiatan, '.$kategori->nama,
            'image' => setting('logo'),
        ];

        return view('front.post', compact('navbarMenu', 'post', 'meta'));
    }

    public function documentCategory($kategoriSlug)
    {
        $navbarMenu = $this->navbarMenu();

        $kategori = DocumentCategory::firstWhere('slug', $kategoriSlug);

        if (! $kategori) {
            return to_route('index');
        }

        $post = Document::where('document_category_id', $kategori->id)
            ->where('publish', 'ya')
            ->orderBy('updated_at', 'desc')
            ->paginate(15);

        $meta = [
            'title' => 'Dokumen',
            'category' => $kategori->nama,
            'description' => $kategori->nama,
            'keywords' => 'Agenda, Kegiatan, '.$kategori->nama,
            'image' => setting('logo'),
        ];

        return view('front.document', compact('navbarMenu', 'post', 'meta'));
    }

    public function cari(Request $request)
    {
        $navbarMenu = $this->navbarMenu();

        $meta = [
            'title' => 'Pencarian',
            'category' => 'Pencarian',
            'description' => 'pencarian',
            'keywords' => 'pencarian, search, cari',
            'image' => setting('logo'),
        ];

        return view('front.pencarian', compact('navbarMenu', 'q', 'searchResults', 'meta'));
    }

    public function pengaduan(Request $request)
    {
        $rules = [
            'nama_pemohon' => 'required|max:50',
            'email' => 'required',
            'telepon' => 'required|max:13',
            'pengaduan' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan. Silahkan ulangi kembali'], 400);
        }

        Pengaduan::create($request->all());

        return response()->json(['success' => true, 'message' => 'Pengaduan Anda berhasil diajukan. Terima kasih', 'redirect' => route('index')]);
    }
}
