<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Komentar;

class KomentarController extends Controller
{
   public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'subject' => 'nullable|string|max:255',
                'message' => 'required|string',
            ]);

            // Create and save the comment
            Komentar::create($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'Komentar berhasil dikirim!'
            ], 200); // Kode status 200 OK

        } catch (ValidationException $e) {
            // Jika validasi gagal, tangkap exception ini

            // Anda bisa mengembalikan pesan error kustom Anda di sini
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan validasi. Mohon periksa kembali input Anda!',
                'errors' => $e->errors() // Opsional: tetap sertakan detail error spesifik per field
            ], 422); // Kode status 422 Unprocessable Entity
        } catch (\Exception $e) {
            // Tangani exception lain yang mungkin terjadi (misal error database)
             return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan komentar!'
            ], 500); // Kode status 500 Internal Server Error
        }
    }
}
