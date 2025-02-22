<?php

use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\HomeController; 
use App\Http\Controllers\TokenUmumController; 
use App\Http\Controllers\TokenProgramController; 
use App\Http\Controllers\SearchController; 
use App\Http\Controllers\LanguageController; 

// Route::get('/', function () {
//     return view('welcome');
// });


Route::post('/http-notif/{id}', function (Request $request, $id) {
    // URL tujuan
    $targetUrl = "http://localhost:3031/http-notif/mint/{$id}";

    // Kirim data yang sama ke URL tujuan
    $response = Http::post($targetUrl, $request->all());

    // Selalu kirim HTTP 200 OK, tidak peduli status dari $response
    return response()->json([
        'status' => 200,
        'message' => 'Request forwarded successfully',
    ], 200);
});


Route::fallback(function () {
 return "Maaf, alamat tidak ditemukan";
});

//Route::get('/hello-world', function () {     return 'Hello World'; });

    Route::post('/hello', function () {     return 'Hello World'; });

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/token-umum',[TokenUmumController::class, 'listTokenUmum'])->name('token-umum')->name('token-umum');

    Route::get('/token-umum/{tokenName}',[TokenUmumController::class, 'detailTokenUmum'])->name('token-umum-detail');
    
    Route::get('/token-umum/tx/{txhash}',[TokenUmumController::class, 'detailCampaign'])->name('token.detailCampaign');

    Route::get('/token-program',[TokenProgramController::class, 'listTokenProgram'])->name('token-program')->name('token-program');

    Route::get('/token-program/{program}',[TokenProgramController::class, 'detailTokenProgram']);

    Route::get('/token-program/distribusi/tx/{txhash}',[TokenProgramController::class, 'distribusiToken']);

	Route::get('/search-proses', [SearchController::class, 'index'])->name('search-proses');


    Route::post('/upload-images', [LaporanController::class, 'uploadImages']);




Route::get('/lang/{lang}', [LanguageController::class, 'switchLang'])->name('lang.switch');
