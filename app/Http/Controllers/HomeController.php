<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Goutte\Client;


class HomeController extends Controller
{

    protected $modelName;


    public function setModel()
    {
        $subdomain = "bmh";
        $modelClass = "App\\Models\\" . ucfirst($subdomain); // Menetapkan model berdasarkan subdomain
        if (class_exists($modelClass)) {
            $this->modelName = $modelClass; // Tetapkan model jika kelas ada
        } else {
            abort(404, "Model for subdomain '{$subdomain}' not found."); // Tampilkan pesan error 404 jika model tidak ada
        }
    }

    // Fungsi untuk menampilkan ringkasan token dan program
    public function index()
    {
        $subdomain = "bmh";

	// $client = new Client();
    //     $crawler = $client->request('GET', 'https://bmh.or.id/rubrik/news/'); // URL website target

    //     // Array untuk menyimpan data artikel
    //     $articles = [];

    //     // Cari elemen 'article' dan ambil 3 berita terakhir
    //     $crawler->filter('article.elementor-post')->slice(0, 3)->each(function ($node) use (&$articles) {
    //         $title = $node->filter('.elementor-post__title a')->text(); // Judul artikel
    //         $thumbnail = $node->filter('.elementor-post__thumbnail img')->attr('src'); // Gambar artikel
    //         $link = $node->filter('.elementor-post__thumbnail__link')->attr('href'); // Link artikel

    //         // Simpan data ke array
    //         $articles[] = [
    //             'title' => $title,
    //             'thumbnail' => $thumbnail,
    //             'link' => $link,
    //         ];
    //     });

        $imageFolder = public_path('image'); 

        $files = glob($imageFolder . "/{$subdomain}.*");
    
        $logoPath = trim($files ? asset('image/' . basename($files[0])) : asset('image/default.webp'));

        $this->setModel($subdomain);

        // Query untuk mengambil ringkasan token
        $tokenUmum = $this->modelName::select('tokenName', 'tokenUmumSymbol')
               ->selectRaw('SUM(amount) as totalAmount')
            ->groupBy('tokenName', 'tokenUmumSymbol')
            ->get(); // Mengambil satu hasil pertama

        // Query untuk mengambil jumlah program spesifik ketika status = 1
        // $tokenProgram = $this->modelName::select('program')
        //     ->selectRaw('SUM(amount) as totalAmount')
        //     ->whereIn('status', [1, 2]) // Ambil status 1 atau 2
        //     ->groupBy('program')
        //     ->get();
        $tokenProgram = $this->modelName::select('program')
            ->selectRaw('SUM(CASE WHEN status IN (1, 2) THEN amount ELSE 0 END) as totalAmount')
            ->groupBy('program')
            ->get();
            
        return view('new2.home', [
            'tokenUmum' => $tokenUmum,
            'tokenProgram' => $tokenProgram,
            'subdomain' => $subdomain,
            'logoPath' => $logoPath,
	// 'articles' => $articles       
 ]);
    }
}
