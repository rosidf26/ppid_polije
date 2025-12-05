<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermohonanInformasiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // --- Kategori Pemohon ---
            'kategori' => 'required|in:perseorangan,lembaga',

            // --- FORM PERORANGAN ---
            'nama_pemohon'    => 'required_if:kategori,perseorangan|string|max:150',
            'alamat_pemohon'  => 'required_if:kategori,perseorangan|string|max:255',
            'hp_pemohon'      => 'required_if:kategori,perseorangan|numeric|digits_between:8,15',
            'email_pemohon'   => 'required_if:kategori,perseorangan|email|max:150',
            'ktp_pemohon'     => 'required_if:kategori,perseorangan|file|mimes:jpg,jpeg,png,pdf|max:2048',

            'nama_pengguna'   => 'nullable|string|max:150',
            'alamat_pengguna' => 'nullable|string|max:255',
            'hp_pengguna'     => 'nullable|numeric|digits_between:8,15',
            'email_pengguna'  => 'nullable|email|max:150',
            'ktp_pengguna'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',


            // --- FORM LEMBAGA ---
            'nama_organisasi'   => 'required_if:kategori,lembaga|string|max:150',
            'telp_organisasi'   => 'required_if:kategori,lembaga|numeric|digits_between:8,15',
            'email_organisasi'  => 'required_if:kategori,lembaga|email|max:150',
            'medsos_organisasi' => 'nullable|string|max:255',

            'nama_narahubung'   => 'required_if:kategori,lembaga|string|max:150',
            'telp_narahubung'   => 'required_if:kategori,lembaga|numeric|digits_between:8,15',
            'ktp_narahubung'    => 'required_if:kategori,lembaga|file|mimes:jpg,jpeg,png,pdf|max:2048',

            // --- FORM INFORMASI (WAJIB DI KEDUA KATEGORI) ---
            'info_dibutuhkan' => 'required|string|min:5',
            'alasan_butuh'    => 'required|string|min:5',
            'sumber_info'     => 'required|in:pertanyaan,website,medsos',
            'alamat_info'     => 'required_if:sumber_info,website,medsos|string|max:255',
        ];
    }

    public function messages()
    {
        return [

            // kategori
            'kategori.required' => 'Silakan pilih kategori pemohon.',

            // pemohon pribadi
            'nama_pemohon.required_if' => 'Nama pemohon wajib diisi.',
            'alamat_pemohon.required_if' => 'Alamat pemohon wajib diisi.',
            'hp_pemohon.required_if' => 'Nomor HP pemohon wajib diisi.',
            'hp_pemohon.numeric' => 'Nomor HP hanya boleh berisi angka.',
            'email_pemohon.required_if' => 'Email pemohon wajib diisi.',
            'email_pemohon.email' => 'Format email pemohon tidak valid.',
            'ktp_pemohon.required_if' => 'Silakan upload file KTP pemohon.',
            'ktp_pemohon.mimes' => 'File identitas harus jpg / jpeg / png / pdf.',

            // lembaga
            'nama_organisasi.required_if' => 'Nama organisasi wajib diisi.',
            'telp_organisasi.required_if' => 'Telp organisasi wajib diisi.',
            'telp_organisasi.numeric' => 'Telp organisasi hanya boleh angka.',
            'email_organisasi.required_if' => 'Email organisasi wajib diisi.',
            'email_organisasi.email' => 'Format email organisasi tidak valid.',

            'nama_narahubung.required_if' => 'Nama narahubung wajib diisi.',
            'telp_narahubung.required_if' => 'Telp narahubung wajib diisi.',
            'telp_narahubung.numeric' => 'Telp narahubung hanya boleh angka.',
            'ktp_narahubung.required_if' => 'Silakan upload file KTP narahubung.',
            'ktp_narahubung.mimes' => 'File identitas harus jpg / jpeg / png / pdf.',
            'ktp_narahubung.max' => 'File tidak boleh lebih dari 2048 kilobytes.',

            // informasi
            'info_dibutuhkan.required' => 'Informasi yang dibutuhkan wajib diisi.',
            'alasan_butuh.required' => 'Alasan permohonan informasi wajib diisi.',
            'alasan_butuh.min' => 'Alasan permohonan informasi minimal terdiri dari 5 karakter.',

            // sumber informasi
            'sumber_info.required' => 'Silakan pilih sumber informasi.',
            'alamat_info.required_if' => 'Isikan tautan / alamat website jika pertanyaan bukan merupakan pertanyaan langsung pemohon.',
            'alamat_info.string' => 'Alamat sumber informasi wajib diisi.',
        ];
    }
}
