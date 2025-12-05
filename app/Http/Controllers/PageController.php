<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Slideshow;
use App\Models\Stakeholder;
use App\Models\PernyataanKeberatan;
use Backpack\MenuCRUD\app\Models\MenuItem;
use Backpack\NewsCRUD\app\Models\Tag;
use Backpack\NewsCRUD\app\Models\Article;
use Backpack\NewsCRUD\app\Models\Category;
use Backpack\Settings\app\Models\Setting;
use Backpack\PageManager\app\Models\Page;
use Carbon\Carbon;
use Google\Client;
use Google\Service\Sheets;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Mockery\Exception;

class PageController extends Controller
{
    public function index()
    {

        $limit_slideshow = 3;
        $limit_news = 3;
        $limit_announcement = 3;

        $news = Article::with('category')
            ->where('category_id', '=', 5)
            ->where('featured', '!=', '1')
            ->where('status', '=', 'PUBLISHED')
            ->orderBy('date', 'DESC')
            ->orderBy('id', 'DESC')
            ->limit($limit_news)
            ->get();

        $slideshows = Slideshow::with('page')
            ->where('deleted_at', '=', NULL)
            ->orderBy('order', 'ASC')
            ->limit($limit_slideshow)
            ->get();

        $announcement = Article::with('category')
            ->where('category_id', '=', 6)
            ->where('featured', '!=', '1')
            ->where('status', '=', 'PUBLISHED')
            ->orderBy('date', 'DESC')
            ->orderBy('id', 'DESC')
            ->limit($limit_announcement)
            ->get();


        // $data_frontpages = Page::where('template', '=', 'frontpage')
        //     ->orderBy('extras', 'ASC')
        //     ->get();

        $data_pages = Page::where('template', '=', 'informasi_publik')
            ->orWhere('template', '=', 'statistik')
            ->get();

        $menus = $this->create_tree();
        $data_settings = Setting::all();
        $stakeholders = Stakeholder::all();

        // $frontpage = array();
        $settings = array();
        $informasipublik = array();
        // $statistik = array();

        // foreach ($data_frontpages as $index => $value) {
        //     $frontpage[$value->slug] = $value;
        // }

        foreach ($data_settings as $index => $value) {
            $settings[$value->key] = $value;
        }

        foreach ($data_pages as $index => $value) {
            if ($value->template == 'informasi_publik')
                $informasipublik[$value->slug] = $value;


            // if ($value->template == 'statistik')
            //     $statistik[$value->slug] = $value;
        }

        // ============================================================
        //   🔥 Tambahkan Bagian Statistik Google Sheets di sini
        // ============================================================

        $client = new \Google\Client();
        $client->setAuthConfig(storage_path('app/google/credentials.json'));
        $client->addScope(\Google\Service\Sheets::SPREADSHEETS_READONLY);

        $service = new \Google\Service\Sheets($client);

        $spreadsheetId = '1IaugIjjFJH3sTQH8vU09SFq---8W_7NyroiYr9HUWgQ';
        $range = 'PermohonanInformasi!A:D';

        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $rows = $response->getValues();

        array_shift($rows); // Hapus header

        // Kolom D = status permohonan (index 3)
        $statusA = 'diterima';
        $statusB = 'ditolak';

        $countA = collect($rows)->filter(function ($row) use ($statusA) {
            return isset($row[3]) && strtolower($row[3]) == strtolower($statusA);
        })->count();

        $countB = collect($rows)->filter(function ($row) use ($statusB) {
            return isset($row[3]) && strtolower($row[3]) == strtolower($statusB);
        })->count();

        $total = count($rows);


        // ============================================================
        //      🔥 Kirim variabel statistik ke view index
        // ============================================================


        return view('frontpage.index')
            // ->with('frontpage', $frontpage)
            ->with('menus', $menus)
            ->with('settings', $settings)
            ->with('slideshows', $slideshows)
            ->with('informasi_publik', $informasipublik)
            // ->with('statistik', $statistik)
            ->with('stakeholders', $stakeholders)
            ->with('news', $news)
            ->with('pengumuman', $announcement)
            ->with('countA', $countA)
            ->with('countB', $countB)
            ->with('total', $total);
    }

    public function page($slug)
    {
        $page = Page::findBySlugOrFail($slug);

        $menus = $this->create_tree();
        $data_settings = Setting::all();

        // $featured_news = Article::with(['category'])
        //     ->where('category_id', '=', 5)
        //     ->where('featured', '=', '1')
        //     ->orderBy('date', 'DESC')
        //     ->orderBy('id', 'DESC')
        //     ->limit(3)
        //     ->get();

        $settings = array();

        foreach ($data_settings as $index => $value) {
            $settings[$value->key] = $value;
        }

        switch ($page->template) {


            case "informasi_publik":
                $page_extra = collect();
                if (is_array($page->extras)) {
                    foreach ($page->extras as $index => $value) {
                        $page_extra->put($index, $value);
                    }
                }

                if (View::exists('frontpage.page-templates.' . 'info_publik'))
                    return view('frontpage.page-templates.' . 'info_publik')
                        ->with('menus', $menus)
                        ->with('page', $page)
                        ->with('page_extra', $page_extra)
                        ->with('settings', $settings);

                // return view('frontpage.page-templates.info_publik')
                //     ->with('menus', $menus)
                //     ->with('page', $page)
                //     ->with('page_extra', $page_extra)
                //     ->with('settings', $settings);
            case "tentang_polije":
                $page_extra = collect();
                if (is_array($page->extras)) {
                    foreach ($page->extras as $index => $value) {
                        $page_extra->put($index, $value);
                    }
                }

                if (View::exists('frontpage.page-templates.' . 'tentang_polije'))
                    return view('frontpage.page-templates.' . 'tentang_polije')
                        ->with('menus', $menus)
                        ->with('page', $page)
                        ->with('page_extra', $page_extra)
                        ->with('settings', $settings);

            case "profil_ppid":
                $page_extra = collect();
                if (is_array($page->extras)) {
                    foreach ($page->extras as $index => $value) {
                        $page_extra->put($index, $value);
                    }
                }

                if (View::exists('frontpage.page-templates.' . 'profil_ppid'))
                    return view('frontpage.page-templates.' . 'profil_ppid')
                        ->with('menus', $menus)
                        ->with('page', $page)
                        ->with('page_extra', $page_extra)
                        ->with('settings', $settings);

            case "berkas":
                $page_extra = collect();
                if (is_array($page->extras)) {
                    foreach ($page->extras as $index => $value) {
                        $page_extra->put($index, $value);
                    }
                }

                if (View::exists('frontpage.page-templates.' . 'berkas'))
                    return view('frontpage.page-templates.' . 'berkas')
                        ->with('menus', $menus)
                        ->with('page', $page)
                        ->with('page_extra', $page_extra)
                        ->with('settings', $settings);

            case "layanan_informasi":
                $page_extra = collect();
                if (is_array($page->extras)) {
                    foreach ($page->extras as $index => $value) {
                        $page_extra->put($index, $value);
                    }
                }

                if (View::exists('frontpage.page-templates.' . 'layanan_info'))
                    return view('frontpage.page-templates.' . 'layanan_info')
                        ->with('menus', $menus)
                        ->with('page', $page)
                        ->with('page_extra', $page_extra)
                        ->with('settings', $settings);

            case "e_blangko":

                $page_extra = collect();
                if (is_array($page->extras)) {
                    foreach ($page->extras as $index => $value) {
                        $page_extra->put($index, $value);
                    }
                }

                // Tentukan view berdasarkan slug
                $slug = $page->slug;

                if ($slug === "e-blangko-permohonan-informasi") {
                    $view = "frontpage.page-templates.permohonan_informasi";
                } elseif ($slug === "e-blangko-pernyataan-keberatan") {

                    // --- AMBIL ENUM DARI DATABASE (jika diperlukan khusus slug ini)
                    $enumOptions = DB::select("SHOW COLUMNS FROM pernyataan_keberatan LIKE 'alasan_keberatan'");
                    $type = $enumOptions[0]->Type;
                    preg_match_all("/'([^']+)'/", $type, $matches);
                    $alasan_keberatan = $matches[1];

                    $view = "frontpage.page-templates.pernyataan_keberatan";
                } else {
                    // default jika slug tidak dikenali
                    $view = "frontpage.page-templates.e_blangko";
                }

                if (View::exists($view)) {
                    return view($view, [
                        'menus'            => $menus,
                        'page'             => $page,
                        'page_extra'       => $page_extra,
                        'settings'         => $settings,
                        'alasan_keberatan' => $alasan_keberatan ?? null,
                    ]);
                }

            default:
                if (View::exists('frontpage.' . 'page'))
                    return view('frontpage.' . 'page')
                        // ->with('featured_news', $featured_news)
                        ->with('menus', $menus)
                        ->with('page', $page)
                        ->with('settings', $settings);
        }
    }

    public function category($slug = '')
    {
        // Load settings
        $data_settings = Setting::all();
        $settings = [];

        foreach ($data_settings as $value) {
            $settings[$value->key] = $value;
        }

        // Menus
        $menus = $this->create_tree();

        /**
         * =========================
         *  CASE 1: SLUG KOSONG
         *  → tampilkan daftar kategori
         *  → hanya kategori berita & pengumuman
         * =========================
         */
        if ($slug == '') {
            $category = Category::whereIn('slug', ['berita', 'pengumuman'])->get();

            return view('jurusan.templates.kategori')
                ->with('category', $category)
                ->with('menus', $menus)
                ->with('settings', $settings);
        }

        /**
         * =========================
         *  CASE 2: ADA SLUG
         *  → pastikan slug hanya berita atau pengumuman
         * =========================
         */
        // Batasi slug hanya 2 kategori ini
        if (!in_array($slug, ['berita', 'pengumuman'])) {
            abort(404);
        }

        // Ambil kategori berdasarkan slug
        $category = Category::findBySlugOrFail($slug);

        // Artikel di kategori tersebut
        $articles = Article::where('category_id', $category->id)
            ->orderBy('date', 'DESC')
            ->orderBy('id', 'DESC')
            ->paginate(4);


        if ($articles->count() <= 0) {
            abort(404);
        }

        // TEMPLATE A → UNTUK BERITA
        if ($slug === 'berita') {

            // MEMANGGIL HELPER RELASI TAG + ARTIKEL
            $all_tags = berita_tags();

            return view('frontpage.page-templates.berita')
                ->with('articles', $articles)
                ->with('all_tags', $all_tags)
                ->with('menus', $menus)
                ->with('settings', $settings);
        }

        // TEMPLATE B → UNTUK PENGUMUMAN
        if ($slug === 'pengumuman') {

            $all_tags = pengumuman_tags();

            return view('frontpage.page-templates.pengumuman')
                ->with('articles', $articles)
                ->with('all_tags', $all_tags)
                ->with('menus', $menus)
                ->with('settings', $settings);
        }

        // fallback (seharusnya tidak pernah ke sini)
        abort(404);
    }

    public function news_detail($category, $slug)
    {
        if ($category !== 'admin') {

            $categories = $this->create_categories();

            $article = Article::findBySlugOrFail($slug);

            $menus = $this->create_tree();
            $data_settings = Setting::all();


            $tag = Article::with(['tags'])
                ->where('slug', '=', $slug)
                ->firstOrFail();

            $settings = array();

            foreach ($data_settings as $index => $value) {
                $settings[$value->key] = $value;
            }

            // Pilih view berdasarkan kategori
            if ($category === 'berita') {
                $news = Article::with(['category'])
                    ->where('slug', '!=', $slug)
                    ->where('category_id', '=', 5)
                    ->orderBy('date', 'DESC')
                    ->orderBy('id', 'DESC')
                    ->limit(5)
                    ->get();

                $all_tags = berita_tags();

                return view('frontpage.page-templates.detail_berita')
                    ->with('categories', $categories)
                    ->with('news', $news)
                    ->with('all_tags', $all_tags)
                    ->with('article_tag', $tag)
                    ->with('article', $article)
                    ->with('settings', $settings)
                    ->with('menus', $menus);
            }

            if ($category === 'pengumuman') {
                $news = Article::with(['category'])
                    ->where('slug', '!=', $slug)
                    ->where('category_id', '=', 6)
                    ->orderBy('date', 'DESC')
                    ->orderBy('id', 'DESC')
                    ->limit(5)
                    ->get();

                $all_tags = pengumuman_tags();

                return view('frontpage.page-templates.detail_pengumuman')
                    ->with('categories', $categories)
                    ->with('news', $news)
                    ->with('all_tags', $all_tags)
                    ->with('pengumuman_tag', $tag)
                    ->with('article', $article)
                    ->with('settings', $settings)
                    ->with('menus', $menus);
            }
        } else {
            abort(404);
        }
    }

    public function tag($slug)
    {
        // LOAD SETTINGS
        $data_settings = Setting::all();
        $settings = [];

        foreach ($data_settings as $value) {
            $settings[$value->key] = $value;
        }

        // MENUS
        $menus = $this->create_tree();

        // AMBIL TAG
        $tag = Tag::where('slug', $slug)->firstOrFail();

        // ARTIKEL BERDASARKAN TAG INI
        $articles = Article::whereHas('tags', function ($q) use ($tag) {
            $q->where('tags.id', $tag->id);
        })
            ->where('category_id', '=', 5)
            ->where('status', 'PUBLISHED')
            ->orderBy('date', 'DESC')
            ->orderBy('id', 'DESC')
            ->paginate(6);

        // SEMUA TAG + JUMLAH ARTIKEL, URUT BERDASARKAN ID
        $all_tags = berita_tags();

        return view('frontpage.page-templates.tag')
            ->with('articles', $articles)
            ->with('tag', $tag)
            ->with('all_tags', $all_tags)
            ->with('menus', $menus)
            ->with('settings', $settings);
    }

    public function tag_announce($slug)
    {
        // LOAD SETTINGS
        $data_settings = Setting::all();
        $settings = [];

        foreach ($data_settings as $value) {
            $settings[$value->key] = $value;
        }

        // MENUS
        $menus = $this->create_tree();

        // AMBIL TAG
        $tag = Tag::where('slug', $slug)->firstOrFail();

        // ARTIKEL BERDASARKAN TAG INI
        $articles = Article::whereHas('tags', function ($q) use ($tag) {
            $q->where('tags.id', $tag->id);
        })
            ->where('category_id', '=', 6)
            ->where('status', 'PUBLISHED')
            ->orderBy('date', 'DESC')
            ->orderBy('id', 'DESC')
            ->paginate(6);

        // SEMUA TAG + JUMLAH ARTIKEL, URUT BERDASARKAN ID
        $all_tags = pengumuman_tags();

        return view('frontpage.page-templates.tag_pengumuman')
            ->with('articles', $articles)
            ->with('tag', $tag)
            ->with('all_tags', $all_tags)
            ->with('menus', $menus)
            ->with('settings', $settings);
    }

    public function search_news(Request $request)
    {
        $article = Article::where(function ($query) use ($request) {
            $query->where('title', 'like', '%' . $request->get('q') . '%');
        })->where('status', 'PUBLISHED')
            ->where('category_id', '=', 5)
            ->paginate(10);

        $menus = $this->create_tree();

        $data_settings = Setting::all();
        $settings = array();

        foreach ($data_settings as $index => $value) {
            $settings[$value->key] = $value;
        }

        if (View::exists('frontpage.page-templates.hasil_cari')) {
            return view('frontpage.page-templates.hasil_cari')
                ->with('request', $request)
                ->with('article', $article)
                ->with('settings', $settings)
                ->with('menus', $menus);
        }
    }

    public function search_announce(Request $request)
    {
        $article = Article::where(function ($query) use ($request) {
            $query->where('title', 'like', '%' . $request->get('p') . '%');
        })->where('status', 'PUBLISHED')
            ->where('category_id', '=', 6)
            ->paginate(10);

        $menus = $this->create_tree();

        $data_settings = Setting::all();
        $settings = array();

        foreach ($data_settings as $index => $value) {
            $settings[$value->key] = $value;
        }

        if (View::exists('frontpage.page-templates.hasil_cari_announce')) {
            return view('frontpage.page-templates.hasil_cari_announce')
                ->with('request', $request)
                ->with('article', $article)
                ->with('settings', $settings)
                ->with('menus', $menus);
        }
    }

    public function faq()
    {
        $menus = $this->create_tree();
        $data_settings = Setting::all();
        $faq = Faq::paginate(10);

        $settings = array();
        foreach ($data_settings as $index => $value) {
            $settings[$value->key] = $value;
        }

        if (View::exists('frontpage.page-templates.' . 'faq')) {
            return view('frontpage.page-templates.' . 'faq')
                ->with('menus', $menus)
                ->with('settings', $settings)
                ->with('faq', $faq);
        } else return Redirect::route('beranda');
    }

    public function komentar()
    {
        $menus = $this->create_tree();
        $data_settings = Setting::all();
        $settings = array();
        foreach ($data_settings as $index => $value) {
            $settings[$value->key] = $value;
        }

        if (View::exists('frontpage.' . 'kirim_komentar')) {
            return view('frontpage.' . 'kirim_komentar')
                ->with('menus', $menus)
                ->with('settings', $settings);
        } else return Redirect::route('beranda');
    }

    public function tree_element($entry, $key, $all_entries, $crud, $html)
    {
        if (!isset($entry->tree_element_shown)) {
            // mark the element as shown
            $all_entries[$key]->tree_element_shown = true;
            $entry->tree_element_shown = true;

            // see if this element has any children
            $children = [];
            foreach ($all_entries as $skey => $subentry) {
                if ($subentry->parent_id == $key) {
                    $children[] = $subentry;
                }
            }

            $children = collect($children)->sortBy('depth')->sortBy('lft');

            switch ($entry->type) {
                case 'external_link':
                case 'internal_link':
                    $link = is_null($entry->link) ? '#' : url($entry->link);
                    break;

                default: //page_link
                    $link = '#';
                    if ($entry->page) {
                        $link = url('/' . $entry->page['slug']);
                    }
                    break;
            }

            // if it does have children, show them
            $html_loop = '';

            $class_type = ($entry->depth == '1' || ($entry->parent_id == '')) ? "dropdown" : "dropdown-submenu";
            $html .= '<li ' . ((count($children)) ? 'class="' . $class_type . '"' : '') . '><a class="dropdown-item ' . ((count($children) && ($entry->depth == '1')) ? 'dropdown-toggle' : '') . '" href="' . $link . '" data-hash>' . $entry->name . '</a>';

            if (count($children) > 0) {
                // show the tree element
                $html .= '<ul class="dropdown-menu">';
                foreach ($children as $key => $child) {
                    $html .= $this->tree_element($child, $child->getKey(), $all_entries, $crud, $html_loop);
                }
                $html .= '</ul>';
            }

            $html .= '</li>';
        }

        return $html;
    }

    public function tree_element_category($entry, $key, $all_entries, $crud, $html)
    {
        if (!isset($entry->tree_element_shown)) {
            // mark the element as shown
            $all_entries[$key]->tree_element_shown = true;
            $entry->tree_element_shown = true;

            // see if this element has any children
            $children = [];
            foreach ($all_entries as $skey => $subentry) {
                if ($subentry->parent_id == $key) {
                    $children[] = $subentry;
                }
            }

            $children = collect($children)->sortBy('depth')->sortBy('lft');

            // if it does have children, show them
            $html_loop = '';

            $class_type = ($entry->depth == '1' || ($entry->parent_id == '')) ? "nav-item" : "nav-item";
            $html .= '<li class="nav-item"' . ((count($children)) ? 'class="' . $class_type . '"' : '') . '><a class="nav-link ' . ((count($children) && ($entry->depth == '1')) ? '' : '') . '" href="' . url('/kategori/' . $entry->slug) . '">' . $entry->name . '</a>';

            if (count($children) > 0) {
                // show the tree element
                $html .= '<ul>';
                foreach ($children as $key => $child) {
                    $html .= $this->tree_element_category($child, $child->getKey(), $all_entries, $crud, $html_loop);
                }
                $html .= '</ul>';
            }

            $html .= '</li>';
        }

        return $html;
    }

    public function create_tree()
    {
        $menu = new MenuItem();
        $all_entries = collect(MenuItem::with('page')->get())
            ->sortBy('depth')
            ->sortBy('lft')
            ->keyBy($menu->getKeyName());

        $root_entries = $all_entries->filter(function ($item) {
            return $item->parent_id == 0;
        });
        $html = '';

        foreach ($root_entries as $key => $entry) {
            $root_entries[$key] = $this->tree_element($entry, $key, $all_entries, $menu, $html);
        }

        return $root_entries;
    }

    public function create_categories()
    {
        $menu = new Category();
        $all_entries = collect(Category::get())
            ->sortBy('depth')
            ->sortBy('lft')
            ->keyBy($menu->getKeyName());

        $root_entries = $all_entries->filter(function ($item) {
            return $item->parent_id == 0;
        });
        $html = '';

        foreach ($root_entries as $key => $entry) {
            $root_entries[$key] = $this->tree_element_category($entry, $key, $all_entries, $menu, $html);
        }

        return $root_entries;
    }


    public function countTwoStatus()
    {
        // --- Google Sheets API ---
        $client = new \Google\Client();
        $client->setAuthConfig(storage_path('app/google/credentials.json'));
        $client->addScope(\Google\Service\Sheets::SPREADSHEETS_READONLY);

        $service = new \Google\Service\Sheets($client);

        $spreadsheetId = '1IaugIjjFJH3sTQH8vU09SFq---8W_7NyroiYr9HUWgQ';
        $range = 'PermohonanInformasi!A:D'; // Kolom hanya sampai D

        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $rows = $response->getValues();

        // Hapus header
        array_shift($rows);

        // --- Status yang ingin dihitung ---
        $statusA = 'diterima';
        $statusB = 'ditolak';

        // --- Hitung kondisi pertama ---
        $countA = collect($rows)->filter(function ($row) use ($statusA) {
            return isset($row[3]) && strtolower($row[3]) == strtolower($statusA);
        })->count();  // Kolom D = index 3

        // --- Hitung kondisi kedua ---
        $countB = collect($rows)->filter(function ($row) use ($statusB) {
            return isset($row[3]) && strtolower($row[3]) == strtolower($statusB);
        })->count();

        // --- Hitung total (semua data) ---
        $total = count($rows);

        return view('frontpage.sections.statistik', compact('countA', 'countB', 'total'));
    }






    public function clear_cache()
    {
        Artisan::call('cache:clear');
    }
}