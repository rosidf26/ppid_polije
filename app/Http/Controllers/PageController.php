<?php

namespace App\Http\Controllers;
use App\Models\Faq;
use App\Models\Slideshow;
use App\Models\Stakeholder;
use Backpack\MenuCRUD\app\Models\MenuItem;
use Backpack\NewsCRUD\app\Models\Article;
use Backpack\NewsCRUD\app\Models\Category;
use Backpack\Settings\app\Models\Setting;
use Backpack\PageManager\app\Models\Page;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Mockery\Exception;

class PageController extends Controller
{
    // public function index($slug, $subs = null)
    // {
    //     // Ambil data halaman berdasarkan slug
    //     $page = Page::findBySlug($slug);

    //     if (! $page) {
    //         abort(404, 'Halaman tidak ditemukan.');
    //     }

    //     $data = [
    //         'title' => $page->title,
    //         'page'  => $page->withFakes(), // ambil data custom field juga
    //     ];

    //     // Render tampilan berdasarkan nama template halaman
    //     return view('frontpage.' . $page->template, $data);
    // }

    public function page($slug, $subs = null)
    {
        $page = Page::findBySlugOrFail($slug);

        $menus = $this->create_tree();
        $data_settings = Setting::all();

         $featured_news = Article::with(['category'])
            ->where('featured', '=', '1')
            ->orderBy('date', 'DESC')
            ->orderBy('id', 'DESC')
            ->limit(5)
            ->get();

        $settings = array();

         foreach ($data_settings as $index => $value) {
            $settings[$value->key] = $value;
        }

        switch($page->template) {
            case "umum":
                $page_extra = collect();
                if (is_array($page->extras)) {
                    foreach ($page->extras as $index => $value) {
                        $page_extra->put($index, $value);
                    }
                }

                if (View::exists('frontpage.templates.' . 'umum'))
                    return view('frontpage.templates.' . 'umum')
                        ->with('menus', $menus)
                        ->with('about', $page)
                        ->with('about_extra', $page_extra)
                        ->with('settings', $settings);

                return view('jurusan.templates.about')
                    ->with('menus', $menus)
                    ->with('about', $page)
                    ->with('about_extra', $page_extra)
                    ->with('settings', $settings);

            case "sambutan_direktur" :
                $page_extra = collect();
                if (is_array($page->extras)) {
                    foreach ($page->extras as $index => $value) {
                        $page_extra->put($index, $value);
                    }
                }

                if (View::exists('templates.' . 'about_direksi'))
                    return view('templates.' . 'about_direksi')
                        ->with('menus', $menus)
                        ->with('about', $page)
                        ->with('about_extra', $page_extra)
                        ->with('settings', $settings);

                return view('jurusan.templates.about_direksi')
                    ->with('menus', $menus)
                    ->with('about', $page)
                    ->with('about_extra', $page_extra)
                    ->with('settings', $settings);

            default :
                if (View::exists('templates.' . 'page'))
                    return view('templates.' . 'page')
                        ->with('featured_news', $featured_news)
                        ->with('page', $page)
                        ->with('settings', $settings)
                        ->with('menus', $menus);

                return view('jurusan.templates.page')
                    ->with('featured_news', $featured_news)
                    ->with('page', $page)
                    ->with('settings', $settings)
                    ->with('menus', $menus);
        }

        // if (!$page)
        // {
        //     abort(404, 'Please go back to our <a href="'.url('').'">homepage</a>.');
        // }

        // $this->data['title'] = $page->title;
        // $this->data['page'] = $page->withFakes();

        // return view('pages.'.$page->template, $this->data);
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
            $html .= '<li ' . ((count($children)) ? 'class="' . $class_type . '"' : '') . '><a class="nav-link ' . ((count($children) && ($entry->depth == '1')) ? '' : '') . '" href="' . url('/kategori/' . $entry->slug) . '">' . $entry->name . '</a>';

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

    public function index()
    {
        
        $limit_news = 3;
        $limit_slideshow = 3;
        $limit_announcement = 3;

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

        $news = Article::with('category')
            ->where('category_id', '=', 5)
            ->where('featured', '!=', '1')
            ->where('status', '=', 'PUBLISHED')
            ->orderBy('date', 'DESC')
            ->orderBy('id', 'DESC')
            ->limit($limit_news)
            ->get();


        $data_frontpages = Page::where('template', '=', 'frontpage')
            ->orderBy('extras', 'ASC')
            ->get();

        $data_pages = Page::where('template', '=', 'informasi_publik')
            ->orWhere('template', '=', 'rekapitulasi')
            ->orWhere('template', '=', 'statistik')
            ->get();

        $data_settings = Setting::all();
        $stakeholders = Stakeholder::all();
        $menus = $this->create_tree();

        $frontpage = array();
         $informasi_publik = array();
        $rekapitulasi = array();
        $statistik = array();
        $settings = array();

        foreach ($data_settings as $index => $value) {
            $settings[$value->key] = $value;
        }

        foreach ($data_frontpages as $index => $value) {
            $frontpage[$value->slug] = $value;
        }

        foreach ($data_pages as $index => $value) {
            if ($value->template == 'informasi_publik')
                $informasi_publik[$value->slug] = $value;

            if ($value->template == 'rekapitulasi')
                $rekapitulasi[$value->slug] = $value;

             if ($value->template == 'statistik')
                $statistik[$value->slug] = $value;
        }

        return view('frontpage.index')
            ->with('news', $news)
            ->with('pengumuman', $announcement)
            ->with('settings', $settings)
            ->with('stakeholders', $stakeholders)
            ->with('slideshows', $slideshows)
            ->with('menus', $menus)
             ->with('informasi_publik', $informasi_publik)
            ->with('rekapitulasi', $rekapitulasi)
            ->with('statistik', $statistik)
            ->with('frontpage', $frontpage);
    }

     public function clear_cache()
    {
        Artisan::call('cache:clear');
    }
}