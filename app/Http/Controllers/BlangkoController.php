<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PermohonanInformasiRequest;
use App\Http\Requests\PernyataanKeberatanRequest;
use App\Models\PermohonanInformasi;
use App\Models\PernyataanKeberatan;
use Backpack\Settings\app\Models\Setting;
use Backpack\MenuCRUD\app\Models\MenuItem;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BlangkoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index($slug = null)
    // {
    //     // Normalisasi slug biar aman (lowercase)
    //     $slug = strtolower($slug);

    //     switch ($slug) {
    //         case 'permohonan-informasi':
    //             return view('frontpage.page-templates.permintaan_informasi');  // VIEW A

    //         case 'pernyataan-keberatan':
    //             return view('frontpage.page-templates.pernyataan_keberatan');  // VIEW B

    //         default:
    //             abort(404);  // Jika slug tidak dikenali
    //     }
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function permohonanSubmit(PermohonanInformasiRequest $request)
    {
        $data = $request->validated();
        try {

            /* =======================================================
         * 1. HANDLE FILE UPLOAD (SEMENTARA)
         * =======================================================*/

            // KTP Pemohon
            if ($request->hasFile('ktp_pemohon')) {
                $data['ktp_pemohon'] = $request->file('ktp_pemohon')
                    ->store('ktp_pemohon', 'public');
            }

            // KTP Pengguna
            if ($request->hasFile('ktp_pengguna')) {
                $data['ktp_pengguna'] = $request->file('ktp_pengguna')
                    ->store('ktp_pengguna', 'public');
            }

            // KTP Lembaga – Organisasi
            if ($request->hasFile('ktp_narahubung')) {
                $data['ktp_narahubung'] = $request->file('ktp_narahubung')
                    ->store('ktp_narahubung', 'public');
            }

            /* =======================================================
         * 2. INSERT DATABASE
         * Model: PermohonanInformasi
         * =======================================================*/

            PermohonanInformasi::create($data);

            /* =======================================================
         * 3. Jika berhasil simpan → return sukses
         * =======================================================*/

            return redirect('/e-blangko-permohonan-informasi')->with('success', 'Permohonan informasi Anda berhasil terkirim. Estimasi waktu respons adalah 3-5 hari kerja, dan kami mohon kesabaran Anda untuk menunggu, Terimakasih.');
        } catch (\Exception $e) {

            /* =======================================================
         * 4. HAPUS FILE JIKA DATABASE GAGAL
         * =======================================================*/

            if (!empty($data['ktp_pemohon'])) {
                \Storage::disk('public')->delete($data['ktp_pemohon']);
            }

            if (!empty($data['ktp_pengguna'])) {
                \Storage::disk('public')->delete($data['ktp_pengguna']);
            }

            if (!empty($data['ktp_narahubung'])) {
                \Storage::disk('public')->delete($data['ktp_narahubung']);
            }

            /* =======================================================
         * 5. Return error ke user dengan pesan aman
         * =======================================================*/

            return back()
                ->withErrors(['db_error' => 'Terjadi kesalahan pada server, silakan coba lagi.'])
                ->withInput();
        }
    }

    public function keberatanSubmit(PernyataanKeberatanRequest $request)
    {
        $data = $request->validated();
        try {


            PernyataanKeberatan::create($data);

            return redirect('/e-blangko-pernyataan-keberatan')->with('success', 'Pernyataan keberatan Anda berhasil terkirim. Estimasi waktu respons adalah 3-5 hari kerja, dan kami mohon kesabaran Anda untuk menunggu, Terimakasih.');
        } catch (\Exception $e) {

            return back()
                ->withErrors(['db_error' => 'Terjadi kesalahan pada server, silakan coba lagi.'])
                ->withInput();
        }
    }

    public function rekap(Request $request)
    {
        $menus = $this->create_tree();
        $data_settings = Setting::all();
        $settings = array();

        // Ambil tahun saat ini atau dari dropdown
        $tahun = $request->get('tahun', date('Y'));

        // --- Data permohonan per bulan ---
        $rekap = PermohonanInformasi::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('COUNT(*) as jumlah_permohonan'),
            DB::raw('SUM(CASE WHEN status = "diterima" THEN 1 ELSE 0 END) as diterima'),
            DB::raw('SUM(CASE WHEN status = "ditolak" THEN 1 ELSE 0 END) as ditolak'),
            DB::raw('AVG(rerata_menjawab) as rerata_menjawab')
        )
            ->whereYear('created_at', $tahun)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();

        // List bulan
        $bulan_list = [
            1 => "Januari",
            2 => "Februari",
            3 => "Maret",
            4 => "April",
            5 => "Mei",
            6 => "Juni",
            7 => "Juli",
            8 => "Agustus",
            9 => "September",
            10 => "Oktober",
            11 => "November",
            12 => "Desember"
        ];

        // --- Siapkan data untuk ChartJS ---
        $labels = [];
        $chart_jumlah = [];
        $chart_rerata = [];
        $chart_diterima = [];
        $chart_ditolak = [];

        foreach ($bulan_list as $num => $nama) {
            $data = $rekap->firstWhere('bulan', $num);

            $labels[] = $nama;
            $chart_jumlah[]  = $data->jumlah_permohonan ?? 0;
            $chart_rerata[]  = round($data->rerata_menjawab ?? 0);
            $chart_diterima[] = $data->diterima ?? 0;
            $chart_ditolak[] = $data->ditolak ?? 0;
        }

        foreach ($data_settings as $index => $value) {
            $settings[$value->key] = $value;
        }

        return view('frontpage.rekapitulasi')
            ->with('menus', $menus)
            ->with('tahun', $tahun)
            ->with('rekap', $rekap)
            ->with('bulan_list', $bulan_list)
            ->with('labels', $labels)
            ->with('chart_jumlah', $chart_jumlah)
            ->with('chart_rerata', $chart_rerata)
            ->with('chart_diterima', $chart_diterima)
            ->with('chart_ditolak', $chart_ditolak)
            ->with('settings', $settings);
    }

    public function getData($year)
    {
        // per bulan
        $perBulan = PermohonanInformasi::select(
            DB::raw("MONTH(created_at) as bulan"),
            DB::raw("COUNT(*) as total")
        )
            ->whereYear('created_at', $year)
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        // kategori
        $kategori = PermohonanInformasi::select('kategori', DB::raw("COUNT(*) as total"))
            ->whereYear('created_at', $year)
            ->groupBy('kategori')
            ->pluck('total', 'kategori');

        // status
        $status = PermohonanInformasi::select('status', DB::raw("COUNT(*) as total"))
            ->whereYear('created_at', $year)
            ->groupBy('status')
            ->pluck('total', 'status');

        return response()->json([
            'per_bulan' => $perBulan,
            'kategori'  => $kategori,
            'status'    => $status,
        ]);
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


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
