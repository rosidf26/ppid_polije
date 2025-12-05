<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KeberatanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

            'nama_pemohon'       => 'required|string|max:150',
            'pekerjaan_pemohon'  => 'required|string|max:255',
            'nama_kuasa_pemohon' => 'required|string|max:150',
            'alasan_keberatan'   => 'required|string|min:5',
            'kasus_posisi'       => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [

            'nama_pemohon.required' => 'Nama pemohon wajib diisi.',
            'pekerjaan_pemohon.required' => 'Pekerjaan pemohon wajib diisi.',
            'nama_kuasa_pemohon.required' => 'Nama kuasa pemohon wajib diisi.',
            'alasan_keberatan.required' => 'Alasan keberatan wajib diisi.',
            'kasus_posisi.required' => 'Kasus posisi wajib diisi.',
        ];
    }
}
