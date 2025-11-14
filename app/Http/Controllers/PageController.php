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
        $statistik = array();

        // foreach ($data_frontpages as $index => $value) {
        //     $frontpage[$value->slug] = $value;
        // }

        foreach ($data_settings as $index => $value) {
            $settings[$value->key] = $value;
        }

        foreach ($data_pages as $index => $value) {
            if ($value->template == 'informasi_publik')
                $informasipublik[$value->slug] = $value;


            if ($value->template == 'statistik')
                $statistik[$value->slug] = $value;
        }

        return view('frontpage.index')
            // ->with('frontpage', $frontpage)
            ->with('menus', $menus)
            ->with('settings', $settings)
            ->with('slideshows', $slideshows)
            ->with('informasi_publik', $informasipublik)
            ->with('statistik', $statistik)
            ->with('stakeholders', $stakeholders)
            ->with('news', $news)
            ->with('pengumuman', $announcement);
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

        switch($page->template) {
           

            case "informasi_publik" :
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
             case "tentang_polije" :
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

             case "profil_ppid" :
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

            case "berkas" :
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

            default :
                if (View::exists('frontpage.' . 'page'))
                    return view('frontpage.' . 'page')
                        // ->with('featured_news', $featured_news)
                        ->with('menus', $menus)
                        ->with('page', $page)
                        ->with('settings', $settings);
        }


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

    

     public function clear_cache()
    {
        Artisan::call('cache:clear');
    }
}