<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TokenProgramController extends Controller
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

    public function distribusiToken($txhash)
    {
        $subdomain = "bmh";
        $imageFolder = public_path('image'); 

        $files = glob($imageFolder . "/{$subdomain}.*");
    
        $logoPath = trim($files ? asset('image/' . basename($files[0])) : asset('image/default.webp'));
        $this->setModel($subdomain);

        $laporanDetails = DB::table('laporan_detail')
    ->whereIn('tx_index', function($query) use ($txhash) {
        $query->select('tx_index')
            ->from('transaction')
            ->where('txhashtokenprogram', $txhash);
        })
        ->get();

        // dd($laporanDetails);

        $allData = $this->modelName::where('txhashtokenprogram', $txhash)->get();

        $transactions = $this->modelName::select('tokenName', 'program', 'signers', 'tokenUmumSymbol')
            ->selectRaw('SUM(amount) as total_amount')
            ->selectRaw('MAX(tglDisalurkan) AS lastDistributionDate')
            ->where('txhashtokenprogram', $txhash)
            ->groupBy('tokenName', 'program', 'signers', 'tokenUmumSymbol') // Tambahkan GROUP BY untuk kolom non-agregat
            ->first();


        foreach ($allData as $data) {
            $invoiceNumber = $data->invoice_number;
            $apiResponse = Http::get("https://uat-pay.bmh.or.id/api/v1/invoice/{$invoiceNumber}");

            // Pastikan API mengembalikan data yang valid
            if ($apiResponse->successful()) {
                $apiData = $apiResponse->json();
                // Gabungkan data API, misalnya menambahkan kolom 'campaign' ke setiap row
                $data->campaign = $apiData['campaign'] ?? null;
                $data->donate_at = $apiData['donate_at'] ?? null;
            } else {
                $data->campaign = 'API Error'; // Menandakan jika ada error pada response API
            }
        }
        // dd($allData);

        return view('new2.distribution', [
            'txHash' => $txhash,
            'transactions' => $transactions,
            'allData' => $allData,
            'subdomain' => $subdomain,
            'logoPath' => $logoPath,
            'laporanDetails' => $laporanDetails,
        ]);
    }

    public function listTokenProgram()
    {
        $subdomain = "bmh";
        $imageFolder = public_path('image'); 

        $files = glob($imageFolder . "/{$subdomain}.*");
    
        $logoPath = trim($files ? asset('image/' . basename($files[0])) : asset('image/default.webp'));
        // Set model yang digunakan berdasarkan subdomain
        $this->setModel($subdomain);

        // Query untuk mengambil ringkasan token
        // $results = $this->modelName::select('program')
        //     ->selectRaw('SUM(amount) as totalAmount')
        //     ->whereIn('status', [1, 2]) 
        //     ->groupBy('program')
        //     ->get(); // Mengambil satu hasil pertam
        
        $results = $this->modelName::select('program')
            ->selectRaw('SUM(CASE WHEN status IN (1, 2) THEN amount ELSE 0 END) as totalAmount')
            ->groupBy('program')
            ->get();

        // Mengirimkan data ke view
        return view('new2.token-program', [
            'results' => $results,
            'subdomain' => $subdomain,
            'logoPath' => $logoPath
        ]);
    }
    public function detailTokenProgram( $program)
    {
        $subdomain = "bmh";
        $imageFolder = public_path('image'); 

        $files = glob($imageFolder . "/{$subdomain}.*");
    
        $logoPath = trim($files ? asset('image/' . basename($files[0])) : asset('image/default.webp'));
        // Buat instance model berdasarkan nama subdomain
        // $modelName = "App\\Models\\" . ucfirst($subdomain);

        $this->setModel($subdomain);

        // Query untuk mengambil total amount program
        $programAmount = $this->modelName::selectRaw('
            SUM(amount) as total_program_amount
            ')
            ->where('program', $program)
             ->whereIn('status', [1, 2]) 
            ->first();

        // Query untuk mendapatkan daftar token penerima dan total per token umum, serta total keseluruhan amount
        $tokenListQuery = $this->modelName::select('tokenName', 'tokenUmumSymbol')
            ->selectRaw('SUM(amount) as total_amount')
            ->where('program', $program)
             ->whereIn('status', [1, 2]) 
            ->groupBy('tokenName', 'tokenUmumSymbol') // Pastikan kedua kolom ada di GROUP BY
            ->get();


        // Query untuk mengambil semua data untuk program tertentu
        $allData = $this->modelName::where('program', $program) ->whereIn('status', [1, 2]) ->get();

        // Loop untuk menggabungkan setiap row dari $allData dengan data API
        foreach ($allData as $data) {
            $invoiceNumber = $data->invoice_number;
            $apiResponse = Http::get("https://uat-pay.bmh.or.id/api/v1/invoice/{$invoiceNumber}");

            // Pastikan API mengembalikan data yang valid
            if ($apiResponse->successful()) {
                $apiData = $apiResponse->json();
                // Gabungkan data API, misalnya menambahkan kolom 'campaign' ke setiap row
                $data->campaign = $apiData['campaign'] ?? null;
            } else {
                $data->campaign = 'API Error'; // Menandakan jika ada error pada response API
            }
        }

        // Parsing data ke view
        return view('new2.token-program-detail', [
            'programAmount' => $programAmount,
            'tokenListQuery' => $tokenListQuery,
            'allData' => $allData,
            'program' => $program,
            'subdomain' => $subdomain,
            'logoPath' => $logoPath
        ]);
    }
}



