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
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

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

        DB::beginTransaction();

        try {
            // ======================================================
            // GENERATE ID UNIK
            // ======================================================
            $data['unik_request'] = 'REQ-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(6));

            // ======================================================
            // SET DEFAULT SYSTEM FIELD
            // ======================================================
            $data['tgl_pengajuan'] = now()->toDateString();
            $data['status'] = 'belum direspon';

            // ======================================================
            // HANDLE FILE UPLOAD
            // ======================================================
            if ($request->hasFile('ktp_pemohon')) {
                $data['ktp_pemohon'] = $request->file('ktp_pemohon')->store('ktp_pemohon', 'public');
            }

            if ($request->hasFile('ktp_pengguna')) {
                $data['ktp_pengguna'] = $request->file('ktp_pengguna')->store('ktp_pengguna', 'public');
            }

            if ($request->hasFile('ktp_narahubung')) {
                $data['ktp_narahubung'] = $request->file('ktp_narahubung')->store('ktp_narahubung', 'public');
            }

            // ======================================================
            // INSERT DATABASE
            // ======================================================
            PermohonanInformasi::create($data);

            DB::commit();

            return redirect()->route(
                'permohonan.sukses',
                $data['unik_request']
            );

        } catch (\Exception $e) {

            DB::rollBack();

            // hapus file jika ada
            foreach (['ktp_pemohon', 'ktp_pengguna', 'ktp_narahubung'] as $file) {
                if (!empty($data[$file])) {
                    Storage::disk('public')->delete($data[$file]);
                }
            }

            return back()
                ->withErrors([
                    'db_error' => 'Terjadi kesalahan pada server, silakan coba lagi.',
                ])
                ->withInput();
        }
    }

    public function permohonanSukses($unik_request)
    {
        $menus = $this->create_tree();
        $data_settings = Setting::all();
        $settings = [];

        foreach ($data_settings as $index => $value) {
            $settings[$value->key] = $value;
        }

        $data = PermohonanInformasi::where('unik_request', $unik_request)->firstOrFail();

        return view('frontpage.page-templates.permohonan_sukses')
            ->with("menus", $menus)
            ->with("data", $data)
            ->with("settings", $settings);
    }

    public function downloadPermohonan($unik_request)
    {
        $data = PermohonanInformasi::where('unik_request', $unik_request)->firstOrFail();

        $view = $data->kategori === 'perseorangan'
            ? 'pdf.perseorangan'
            : 'pdf.lembaga';

        return Pdf::loadView($view, compact('data'))
            ->setPaper('A5', 'portrait')
            ->download($data->unik_request . '.pdf');
    }

    /**
     * FORM CEK STATUS PERMOHONAN
     */
    public function cekPStatus()
    {
        $menus = $this->create_tree();
        $data_settings = Setting::all();
        $settings = [];

        foreach ($data_settings as $index => $value) {
            $settings[$value->key] = $value;
        }
        return view('frontpage.page-templates.cek_status_permohonan')
            ->with("menus", $menus)
            ->with("settings", $settings);
        ;
    }

    /**
     * HASIL CEK STATUS
     */
    public function cekPStatusResult(Request $request)
    {
        $menus = $this->create_tree();
        $data_settings = Setting::all();
        $settings = [];

        foreach ($data_settings as $index => $value) {
            $settings[$value->key] = $value;
        }

        $request->validate([
            'unik_request' => 'required|string',
        ], [
            'unik_request.required' => 'Nomor permohonan wajib diisi.',
        ]);

        $data = PermohonanInformasi::where('unik_request', $request->unik_request)
            ->first();

        if (!$data) {
            return back()->withErrors([
                'unik_request' => 'Nomor permohonan tidak ditemukan.',
            ]);
        }

        return view('frontpage.page-templates.result_status_permohonan')
            ->with("menus", $menus)
            ->with("data", $data)
            ->with("settings", $settings);
    }


    public function formCariP()
    {
        $menus = $this->create_tree();
        $data_settings = Setting::all();
        $settings = [];

        foreach ($data_settings as $index => $value) {
            $settings[$value->key] = $value;
        }
        return view('frontpage.page-templates.cari_permohonan')
            ->with("menus", $menus)
            ->with("settings", $settings);
        ;
    }

    public function cariPermohonan(Request $request)
    {
        $request->validate([
            'unik_request' => 'required|string',
            'email' => 'required|email',
        ], [
            'unik_request.required' => 'Nomor permohonan wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
        ]);

        $permohonan = PermohonanInformasi::where('unik_request', $request->unik_request)
            ->where(function ($q) use ($request) {
                $q->where('email_pemohon', $request->email)
                    ->orWhere('email_organisasi', $request->email);
            })
            ->first();


        if (!$permohonan) {
            return back()
                ->withErrors([
                    'not_found' => 'Data permohonan tidak ditemukan.',
                ])
                ->withInput();
        }

        // ❗ CEK STATUS
        // if ($permohonan->status === 'diterima') {
        //     return back()
        //         ->withErrors([
        //             'status' => 'Permohonan telah diterima, silahkan cek status permohonan.',
        //         ]);
        // }

        // 🔐 simpan ID permohonan ke session
        session()->put('permohonan_keberatan_id', $permohonan->id);

        // ➡️ redirect ke slug CMS
        return redirect('/e-blangko-pernyataan-keberatan');
    }

    public function keberatanSubmit(PernyataanKeberatanRequest $request)
    {
        try {
            // 🔐 ambil dari session (SUMBER UTAMA)
            $permohonanId = session()->get('permohonan_keberatan_id');

            if (!$permohonanId) {
                return redirect('/cari-permohonan')
                    ->withErrors(['db_error' => 'Silakan cari permohonan terlebih dahulu.']);
            }

            if (!PermohonanInformasi::where('id', $permohonanId)->exists()) {
                session()->forget('permohonan_keberatan_id');

                return redirect('/cari-permohonan')
                    ->withErrors(['db_error' => 'Permohonan tidak valid.']);
            }

            // cegah double submit
            if (PernyataanKeberatan::where('permohonan_id', $permohonanId)->exists()) {
                return back()->withErrors(['db_error' => 'Permohonan ini sudah diajukan keberatan.']);
            }

            $data = $request->validated();

            // paksa permohonan_id dari session
            $data['permohonan_id'] = $permohonanId;
            /* =======================================================
             * GENERATE ID UNIK PERMOHONAN
             * =======================================================*/
            $data["unik_request"] =
                "KB-" .
                now()->format("YmdHis") .
                "-" .
                Str::upper(Str::random(6));

            $data['tgl_pengajuan'] = now()->toDateString();

            PernyataanKeberatan::create($data);

            // 🧹 hapus session agar tidak submit ulang
            session()->forget('permohonan_keberatan_id');

            return redirect()->route(
                'keberatan.sukses',
                $data['unik_request']
            );

        } catch (\Exception $e) {
            return back()
                ->withErrors([
                    "db_error" =>
                        "Terjadi kesalahan pada server, silakan coba lagi.",
                ])
                ->withInput();
        }
    }

    public function keberatanSukses($unik_request)
    {
        $menus = $this->create_tree();
        $data_settings = Setting::all();
        $settings = [];

        foreach ($data_settings as $index => $value) {
            $settings[$value->key] = $value;
        }

        $data = PernyataanKeberatan::where('unik_request', $unik_request)->firstOrFail();

        return view('frontpage.page-templates.keberatan_sukses')
            ->with("menus", $menus)
            ->with("data", $data)
            ->with("settings", $settings);
    }

    public function downloadKeberatan($unik_request)
    {
        $data = PernyataanKeberatan::where('unik_request', $unik_request)->firstOrFail();

        $view = 'pdf.keberatan';

        return Pdf::loadView($view, compact('data'))
            ->setPaper('A5', 'portrait')
            ->download($data->unik_request . '.pdf');
    }

    /**
     * FORM CEK STATUS KEBERATAN
     */
    public function cekKStatus()
    {
        $menus = $this->create_tree();
        $data_settings = Setting::all();
        $settings = [];

        foreach ($data_settings as $index => $value) {
            $settings[$value->key] = $value;
        }
        return view('frontpage.page-templates.cek_status_keberatan')
            ->with("menus", $menus)
            ->with("settings", $settings);
        ;
    }

    /**
     * HASIL CEK STATUS
     */
    public function cekKStatusResult(Request $request)
    {
        $menus = $this->create_tree();

        $settings = Setting::all()->keyBy('key');

        $request->validate([
            'unik_request' => 'required|string',
        ], [
            'unik_request.required' => 'Nomor permohonan wajib diisi.',
        ]);

        // 🔹 ambil keberatan + relasi permohonan informasi
        $data = PernyataanKeberatan::with('permohonan')
            ->where('unik_request', $request->unik_request)
            ->first();

        if (!$data) {
            return back()->withErrors([
                'unik_request' => 'Nomor pernyataan keberatan tidak ditemukan.',
            ]);
        }

        // 🔐 safety check (opsional tapi disarankan)
        if (!$data->permohonan) {
            return back()->withErrors([
                'unik_request' => 'Data permohonan informasi tidak ditemukan.',
            ]);
        }

        return view('frontpage.page-templates.result_status_keberatan', [
            'menus' => $menus,
            'settings' => $settings,
            'data' => $data,              // data keberatan
            'permohonan' => $data->permohonan // riwayat permohonan informasi
        ]);
    }


    public function rekap(Request $request)
    {
        $menus = $this->create_tree();
        $data_settings = Setting::all();
        $settings = [];

        foreach ($data_settings as $index => $value) {
            $settings[$value->key] = $value;
        }

        // Ambil tahun saat ini atau dari dropdown
        $tahun = $request->get("tahun", date("Y"));

        // --- Data permohonan per bulan ---
        $rekap = PermohonanInformasi::select(
            DB::raw("MONTH(tgl_pengajuan) as bulan"),
            DB::raw("COUNT(*) as jumlah_permohonan"),
            DB::raw(
                'SUM(CASE WHEN status = "diterima" THEN 1 ELSE 0 END) as diterima'
            ),
            DB::raw(
                'SUM(CASE WHEN status = "ditolak" THEN 1 ELSE 0 END) as ditolak'
            ),
            DB::raw("AVG(waktu_menjawab) as waktu_menjawab")
        )
            ->whereYear("tgl_pengajuan", $tahun)
            ->groupBy(DB::raw("MONTH(tgl_pengajuan)"))
            ->orderBy(DB::raw("MONTH(tgl_pengajuan)"))
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
            12 => "Desember",
        ];

        // --- Siapkan data untuk ChartJS ---
        $labels = [];
        $chart_jumlah = [];
        $chart_rerata = [];
        $chart_diterima = [];
        $chart_ditolak = [];

        foreach ($bulan_list as $num => $nama) {
            $data = $rekap->firstWhere("bulan", $num);

            $labels[] = $nama;
            $chart_jumlah[] = $data->jumlah_permohonan ?? 0;
            $chart_rerata[] = $data && $data->waktu_menjawab !== null
                ? round($data->waktu_menjawab, 2)
                : 0;
            $chart_diterima[] = $data->diterima ?? 0;
            $chart_ditolak[] = $data->ditolak ?? 0;
        }

        return view("frontpage.rekapitulasi")
            ->with("menus", $menus)
            ->with("tahun", $tahun)
            ->with("rekap", $rekap)
            ->with("bulan_list", $bulan_list)
            ->with("labels", $labels)
            ->with("chart_jumlah", $chart_jumlah)
            ->with("chart_rerata", $chart_rerata)
            ->with("chart_diterima", $chart_diterima)
            ->with("chart_ditolak", $chart_ditolak)
            ->with("settings", $settings);
    }

    public function rekapKeberatan(Request $request)
    {
        $menus = $this->create_tree();
        $data_settings = Setting::all();
        $settings = [];

        foreach ($data_settings as $value) {
            $settings[$value->key] = $value;
        }

        // Tahun dipilih (default: tahun berjalan)
        $tahun = $request->get('tahun', date('Y'));

        /* =========================================================
         * 1️⃣ Jumlah Keberatan per Bulan + Rata-rata Waktu Menjawab
         * ========================================================= */
        $rekapBulanan = PernyataanKeberatan::select(
            DB::raw('MONTH(tgl_pengajuan) as bulan'),
            DB::raw('COUNT(*) as jumlah_keberatan'),
            DB::raw('AVG(waktu_menjawab) as rata_waktu')
        )
            ->whereYear('tgl_pengajuan', $tahun)
            ->groupBy(DB::raw('MONTH(tgl_pengajuan)'))
            ->orderBy(DB::raw('MONTH(tgl_pengajuan)'))
            ->get();

        /* =========================================================
         * 2️⃣ Alasan Keberatan Terbanyak
         * ========================================================= */
        $alasanTerbanyak = PernyataanKeberatan::select(
            'alasan_keberatan',
            DB::raw('COUNT(*) as total')
        )
            ->whereYear('tgl_pengajuan', $tahun)
            ->groupBy('alasan_keberatan')
            ->orderByDesc('total')
            ->get();

        /* =========================================================
         * 3️⃣ Persentase Permohonan yang Berujung Keberatan
         * ========================================================= */
        $totalPermohonan = PermohonanInformasi::whereYear(
            'tgl_pengajuan',
            $tahun
        )->count();

        $totalKeberatan = PernyataanKeberatan::whereYear(
            'tgl_pengajuan',
            $tahun
        )->count();

        $persentaseKeberatan = $totalPermohonan > 0
            ? round(($totalKeberatan / $totalPermohonan) * 100, 2)
            : 0;

        /* =========================================================
         * 4️⃣ Persiapan Data Chart
         * ========================================================= */
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
            12 => "Desember",
        ];

        $labels = [];
        $chart_jumlah = [];
        $chart_rerata = [];

        foreach ($bulan_list as $num => $nama) {
            $data = $rekapBulanan->firstWhere('bulan', $num);

            $labels[] = $nama;
            $chart_jumlah[] = $data->jumlah_keberatan ?? 0;
            $chart_rerata[] = $data && $data->rata_waktu !== null
                ? round($data->rata_waktu, 2)
                : 0;
        }

        /* =========================================================
         * 5️⃣ Return View
         * ========================================================= */
        return view('frontpage.rekap_keberatan')
            ->with('menus', $menus)
            ->with('settings', $settings)
            ->with("rekap", $rekapBulanan)
            ->with("bulan_list", $bulan_list)
            ->with('tahun', $tahun)
            ->with('labels', $labels)
            ->with('chart_jumlah', $chart_jumlah)
            ->with('chart_rerata', $chart_rerata)
            ->with('alasanTerbanyak', $alasanTerbanyak)
            ->with('totalPermohonan', $totalPermohonan)
            ->with('totalKeberatan', $totalKeberatan)
            ->with('persentaseKeberatan', $persentaseKeberatan);
    }

    public function getData($year)
    {
        // per bulan
        $perBulan = PermohonanInformasi::select(
            DB::raw("MONTH(tgl_pengajuan) as bulan"),
            DB::raw("COUNT(*) as total")
        )
            ->whereYear("tgl_pengajuan", $year)
            ->groupBy("bulan")
            ->pluck("total", "bulan");

        // kategori
        $kategori = PermohonanInformasi::select(
            "kategori",
            DB::raw("COUNT(*) as total")
        )
            ->whereYear("tgl_pengajuan", $year)
            ->groupBy("kategori")
            ->pluck("total", "kategori");

        // status
        $status = PermohonanInformasi::select(
            "status",
            DB::raw("COUNT(*) as total")
        )
            ->whereYear("tgl_pengajuan", $year)
            ->groupBy("status")
            ->pluck("total", "status");

        return response()->json([
            "per_bulan" => $perBulan,
            "kategori" => $kategori,
            "status" => $status,
        ]);
    }

    public function getDataKeberatan($year)
    {
        // ===============================
        // 1. Jumlah keberatan per bulan
        // ===============================
        $perBulan = PernyataanKeberatan::select(
            DB::raw("MONTH(tgl_pengajuan) as bulan"),
            DB::raw("COUNT(*) as total")
        )
            ->whereYear("tgl_pengajuan", $year)
            ->groupBy(DB::raw("MONTH(tgl_pengajuan)"))
            ->pluck("total", "bulan");

        // ===============================
        // 2. Rata-rata waktu menjawab
        // ===============================
        $rerataWaktu = PernyataanKeberatan::select(
            DB::raw("MONTH(tgl_pengajuan) as bulan"),
            DB::raw("AVG(waktu_menjawab) as rerata")
        )
            ->whereYear("tgl_pengajuan", $year)
            ->whereNotNull("waktu_menjawab")
            ->groupBy(DB::raw("MONTH(tgl_pengajuan)"))
            ->pluck("rerata", "bulan");

        // ===============================
        // 3. Alasan keberatan terbanyak
        // ===============================
        $alasanTerbanyak = PernyataanKeberatan::select(
            "alasan_keberatan",
            DB::raw("COUNT(*) as total")
        )
            ->whereYear("tgl_pengajuan", $year)
            ->groupBy("alasan_keberatan")
            ->orderByDesc("total")
            ->limit(5)
            ->pluck("total", "alasan_keberatan");

        // ===============================
        // 4. Persentase permohonan berujung keberatan
        // ===============================
        $totalPermohonan = PermohonanInformasi::whereYear(
            "tgl_pengajuan",
            $year
        )->count();

        $totalKeberatan = PernyataanKeberatan::whereYear(
            "tgl_pengajuan",
            $year
        )->count();

        $persentaseKeberatan = $totalPermohonan > 0
            ? round(($totalKeberatan / $totalPermohonan) * 100, 2)
            : 0;

        // ===============================
        // RESPONSE JSON
        // ===============================
        return response()->json([
            "per_bulan" => $perBulan,
            "rerata_waktu" => $rerataWaktu,
            "alasan_terbanyak" => $alasanTerbanyak,
            "persentase_keberatan" => $persentaseKeberatan,
            "total_keberatan" => $totalKeberatan,
            "total_permohonan" => $totalPermohonan,
        ]);
    }

    public function create_tree()
    {
        $menu = new MenuItem();
        $all_entries = collect(MenuItem::with("page")->get())
            ->sortBy("depth")
            ->sortBy("lft")
            ->keyBy($menu->getKeyName());

        $root_entries = $all_entries->filter(function ($item) {
            return $item->parent_id == 0;
        });
        $html = "";

        foreach ($root_entries as $key => $entry) {
            $root_entries[$key] = $this->tree_element(
                $entry,
                $key,
                $all_entries,
                $menu,
                $html
            );
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

            $children = collect($children)
                ->sortBy("depth")
                ->sortBy("lft");

            switch ($entry->type) {
                case "external_link":
                case "internal_link":
                    $link = is_null($entry->link) ? "#" : url($entry->link);
                    break;

                default:
                    //page_link
                    $link = "#";
                    if ($entry->page) {
                        $link = url("/" . $entry->page["slug"]);
                    }
                    break;
            }

            // if it does have children, show them
            $html_loop = "";

            $class_type =
                $entry->depth == "1" || $entry->parent_id == ""
                ? "dropdown"
                : "dropdown-submenu";
            $html .=
                "<li " .
                (count($children) ? 'class="' . $class_type . '"' : "") .
                '><a class="dropdown-item ' .
                (count($children) && $entry->depth == "1"
                    ? "dropdown-toggle"
                    : "") .
                '" href="' .
                $link .
                '" data-hash>' .
                $entry->name .
                "</a>";

            if (count($children) > 0) {
                // show the tree element
                $html .= '<ul class="dropdown-menu">';
                foreach ($children as $key => $child) {
                    $html .= $this->tree_element(
                        $child,
                        $child->getKey(),
                        $all_entries,
                        $crud,
                        $html_loop
                    );
                }
                $html .= "</ul>";
            }

            $html .= "</li>";
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
