<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class SearchController extends Controller
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

    public function index(Request $request)
    {
        $subdomain = "bmh";
        $imageFolder = public_path('image');
        $files = glob($imageFolder . "/{$subdomain}.*");
        $logoPath = trim($files ? asset('image/' . basename($files[0])) : asset('image/default.webp'));

        $this->setModel($subdomain);

        $searchQuery = $request->input('search'); // Input dari form
        $combinedResults = []; // Untuk menyimpan hasil gabungan

        // Validasi input
        if (empty($searchQuery)) {
            return redirect()->back()->with('error', 'Kolom pencarian tidak boleh kosong.');
        }

        $txhashCheck = str_contains($searchQuery, '0x');
        // $tokenCheck = str_contains($searchQuery, '2024');
        $tokenCheck = str_contains($searchQuery, '2024') || str_contains($searchQuery, 'infaq') || str_contains($searchQuery, 'zakat') || str_contains($searchQuery, '2024');
        $programCheck = str_contains($searchQuery, 'BMHPDK') || str_contains($searchQuery, 'BMHSOK') || str_contains($searchQuery, 'BMHDKW') || str_contains($searchQuery, 'BMHEKO');

        // Penanganan pencarian berdasarkan kondisi
        if ($txhashCheck) {
            // Jika pencarian adalah txhash
            $getInvoiceNumber = $this->modelName::select('invoice_number')->where('txhash', $searchQuery)->first();
            $dbData = $this->modelName::all()->where('txhash', $searchQuery)->first();

            $response = Http::get("https://uat.injazfoundation.com/api/v1/invoice/{$getInvoiceNumber->invoice_number}");

            if ($response->successful()) {
                $apiData = $response->json();
                // dd($apiData);
        
                if (isset($apiData['campaign'], $apiData['donate_at'])) {
                    $resultTxhashSearch = [
                        'campaignName' => $apiData['campaign'], // Nama campaign dari API
                        'donationDate' => $apiData['donate_at'], // Tanggal donasi dari API
                        'dbData' => $dbData->toArray() // Semua data dari database
                    ];
                } else {
                    $resultTxhashSearch = null; // Handle jika data API tidak lengkap
                }
            } else {
                $resultTxhashSearch = null; // Handle jika API gagal
            }
            $combinedResults = $resultTxhashSearch;
            $searchType = 'txhash';
        } elseif ($tokenCheck) {
            // Jika pencarian adalah token
            $resultTokenSearch = $this->modelName::select('tokenName', 'tokenUmumSymbol')
            ->where('tokenName', 'LIKE', '%' . $searchQuery . '%')
            ->groupBy('tokenName', 'tokenUmumSymbol') // Masukkan semua kolom yang dipilih
            ->get();
            $combinedResults = $resultTokenSearch;
            $searchType = 'token';
        } elseif ($programCheck) {
            // Jika pencarian adalah program
            // $resultProgramSearch = $this->modelName::select('program')->where('program', $searchQuery)->get();
            $resultProgramSearch = $this->modelName::select('program', )
            ->where('program', 'LIKE', '%' . $searchQuery . '%')
            ->groupBy('program') // Masukkan semua kolom yang dipilih
            ->get();
            $combinedResults = $resultProgramSearch;
            $searchType = 'program';
        } else {
            // Jika pencarian berdasarkan nama campaign melalui API eksternal
            $localInvoices = $this->modelName::select('txhash', 'invoice_number')->get();

            foreach ($localInvoices as $invoice) {
                $response = Http::get("https://uat.injazfoundation.com/api/v1/invoice/{$invoice->invoice_number}");

                if ($response->successful()) {
                    $data = $response->json();
                    if (isset($data['campaign'])) {
                        $campaignName = $data['campaign'];
                        if (stripos($campaignName, $searchQuery) !== false) {
                            $combinedResults[] = [
                                'campaignName' => $campaignName,
                                'txhash' => $invoice->txhash,
                                'invoiceNumber' => $invoice->invoice_number,
                            ];
                        }
                    }
                }
                $searchType = 'campaign';
            }
        }

        // Kirim hasil pencarian ke view
        if (empty($combinedResults)) {
            return redirect()->back()->with('error', 'Tidak ada hasil yang cocok dengan kata kunci pencarian.');
        }

        return view('new2.search-result', [
            'searchQuery' => $searchQuery,
            'combinedResults' => $combinedResults,
            'logoPath' => $logoPath,
            'searchType' => $searchType,
        ]);
    }

}

