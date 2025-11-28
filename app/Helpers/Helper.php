<?php
use Backpack\NewsCRUD\app\Models\Tag;

if (! function_exists('get_page_title')) {
    function get_page_title() {
        // Ambil semua segment dari URL
        $segments = request()->segments();

        // Jika tidak ada segment, default Dashboard
        if (empty($segments)) {
            return 'Dashboard';
        }

        // Ambil segment terakhir
        $lastSegment = end($segments);

        // Ubah format: berita → Berita, pengumuman-baru → Pengumuman Baru
        $title = ucwords(str_replace('-', ' ', $lastSegment));

        return $title;
    }
}


function tgl_indo($date)
{
    return \Carbon\Carbon::parse($date)
            ->locale('id')
            ->translatedFormat('l, d F Y');
}

if (! function_exists('berita_tags')) {
    function berita_tags()
    {
        return Tag::select('tags.id', 'tags.name', 'tags.slug')
    ->join('article_tag', 'article_tag.tag_id', '=', 'tags.id')
    ->join('articles', 'articles.id', '=', 'article_tag.article_id')
    ->where('articles.category_id', 5)
    ->where('articles.status', 'PUBLISHED')
    ->groupBy('tags.id', 'tags.name', 'tags.slug')
    ->selectRaw('COUNT(articles.id) as articles_count')
    ->orderBy('tags.id', 'ASC')
    ->get();
    }
}

if (! function_exists('pengumuman_tags')) {
    function pengumuman_tags()
    {
        return Tag::select('tags.id', 'tags.name', 'tags.slug')
    ->join('article_tag', 'article_tag.tag_id', '=', 'tags.id')
    ->join('articles', 'articles.id', '=', 'article_tag.article_id')
    ->where('articles.category_id', 6)
    ->where('articles.status', 'PUBLISHED')
    ->groupBy('tags.id', 'tags.name', 'tags.slug')
    ->selectRaw('COUNT(articles.id) as announce_count')
    ->orderBy('tags.id', 'ASC')
    ->get();
    }
}

if (!function_exists('extractYoutubeId')) {
    function extractYoutubeId($input)
    {
        if (!is_string($input) || empty($input)) {
            return null;
        }

        // Daftar regex untuk berbagai format YouTube
        $patterns = [
            '/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/',   // watch?v=
            '/youtu\.be\/([a-zA-Z0-9_-]+)/',               // youtu.be
            '/youtube\.com\/embed\/([a-zA-Z0-9_-]+)/',     // embed
            '/youtube\.com\/shorts\/([a-zA-Z0-9_-]+)/',    // shorts
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $input, $matches)) {
                return $matches[1]; // Kembalikan ID video
            }
        }

        // Jika bukan URL, mungkin hanya ID → sanitasi
        $clean = preg_replace('/[^a-zA-Z0-9_-]/', '', $input);

        return !empty($clean) ? $clean : null;
    }
}