<?php

if (! function_exists('get_page_title')) {
    function get_page_title() {
        // Mengambil semua segments URI
        $segments = request()->segments();

        // Menghapus segment terakhir jika berupa ID atau tipe data lainnya (opsional)
        // if (is_numeric(end($segments))) {
        //     array_pop($segments);
        // }

        // Membalik urutan segment untuk memproses dari yang paling spesifik
        // lalu menggabungkannya menjadi judul yang mudah dibaca
        $title = implode(' - ', array_map(function($segment) {
            // Mengganti tanda hubung dengan spasi dan membuat huruf kapital di awal
            return strtoupper(str_replace('-', ' ', $segment));
        }, $segments));

        // Jika tidak ada segment, gunakan default (misalnya "Home")
        return ! empty($title) ? $title : 'Dashboard';
    }
}