<?php

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