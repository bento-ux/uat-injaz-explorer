<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function uploadImages(Request $request)
    {
        // Validasi input
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi tipe gambar dan ukuran
        ]);

        $imagePaths = [];

        // Menyimpan setiap gambar yang diupload langsung ke folder public/images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Mengambil nama asli dari file gambar yang diupload
                $imageName = $image->getClientOriginalName();
                
                // Simpan gambar di public/images folder dengan nama aslinya
                $image->move(public_path('images'), $imageName);

                // Menambahkan path file gambar yang disimpan
                $imagePaths[] = asset('images/' . $imageName); // Menyimpan URL gambar yang telah diupload
            }
        }

        // Tanggapan berhasil
        return response()->json([
            'message' => 'Gambar berhasil diupload',
            'imagePaths' => $imagePaths,
        ]);
    }
}
