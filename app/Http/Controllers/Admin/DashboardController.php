<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PermohonanInformasi;
use App\Models\PernyataanKeberatan;
use App\Models\Comment;

class DashboardController extends Controller
{
    public function index()
    {

        if (!backpack_user()->can('lihat dashboard')) {
            abort(403);
        }

        return view(backpack_view('dashboard'), [
            'permohonanBaru' => PermohonanInformasi::where('status', 'belum direspon')->count(),
            'keberatanMasuk' => PernyataanKeberatan::where('status', 'belum direspon')->count(),
            'komentarMasuk' => Comment::count(),
        ]);
    }
}
