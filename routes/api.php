<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\ArtikelImageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataPanenController;
use App\Http\Controllers\InformasiAirController;
use App\Http\Controllers\InformasiSuhuController;
use App\Http\Controllers\InformasiTanahController;
use App\Http\Controllers\LahanPetaniController;
use App\Http\Controllers\PanganController;
use App\Http\Controllers\WilayahController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']); //Selesai
Route::post('login', [AuthController::class, 'login']); //Selesai

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'user']);
});

// Wilayah Admin
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post( //Selesai
        "wilayah",
        [WilayahController::class, 'store']
    );
    Route::put( //Selesai
        "wilayah/{id}",
        [WilayahController::class, 'update']
    );
    Route::delete( //Selesai
        "wilayah/{id}",
        [WilayahController::class, 'destroy']
    );
});

// Wilayah
Route::get( //Selesai
    "wilayah",
    [WilayahController::class, 'index']
);
Route::get( //Selesai
    "wilayah/{id}",
    [WilayahController::class, 'show']
);

// Pangan Admin
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post( //Selesai
        "pangan",
        [PanganController::class, 'store']
    );
    Route::put( //Selesai
        "pangan/{id}",
        [PanganController::class, 'update']
    );
    Route::delete( //Selesai
        "pangan/{id}",
        [PanganController::class, 'destroy']
    );
});

Route::get( //Selesai
    "pangan",
    [PanganController::class, 'index']
);
Route::get( //Selesai
    "pangan/{id}",
    [PanganController::class, 'show']
);

// Lahan - Petani
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post( //Selesai
        "lahan",
        [LahanPetaniController::class, 'store']
    );
    Route::put(
        "lahan/{id}",
        [LahanPetaniController::class, 'update']
    );
    Route::delete( //Selesai
        "lahan/{id}",
        [LahanPetaniController::class, 'destroy']
    );
    Route::get( //Selesai
        "lahan",
        [LahanPetaniController::class, 'index']
    );
});


Route::get( //Selesai
    "lahan/{id}",
    [LahanPetaniController::class, 'show']
);

// Informasi Air - Admin
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post( //Selesai
        "informasi-air",
        [InformasiAirController::class, 'store']
    );
    Route::put( //Selesai
        "informasi-air/{id}",
        [InformasiAirController::class, 'update']
    );
    Route::delete( //Selesai
        "informasi-air/{id}",
        [InformasiAirController::class, 'destroy']
    );
});

Route::get( //Sisa User
    "informasi-air",
    [InformasiAirController::class, 'index']
);
Route::get( //Sisa User
    "informasi-air/{id}",
    [InformasiAirController::class, 'show']
);

// Informasi Tanah - Admin
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post( //Selesai
        "informasi-tanah",
        [InformasiTanahController::class, 'store']
    );
    Route::put( //Selesai
        "informasi-tanah/{id}",
        [InformasiTanahController::class, 'update']
    );
    Route::delete( //Selesai
        "informasi-tanah/{id}",
        [InformasiTanahController::class, 'destroy']
    );
});

Route::get( //Selesai
    "informasi-tanah",
    [InformasiTanahController::class, 'index']
);
Route::get( //Selesai
    "informasi-tanah/{id}",
    [InformasiTanahController::class, 'show']
);

// Informasi Suhu - Admin

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post( //Selesai
        "informasi-suhu",
        [InformasiSuhuController::class, 'store']
    );
    Route::put( //Selesai
        "informasi-suhu/{id}",
        [InformasiSuhuController::class, 'update']
    );
    Route::delete( //Selesai
        "informasi-suhu/{id}",
        [InformasiSuhuController::class, 'destroy']
    );
});

Route::get( //Selesai
    "informasi-suhu",
    [InformasiSuhuController::class, 'index']
);

Route::get( //Selesai
    "informasi-suhu/{id}",
    [InformasiSuhuController::class, 'show']
);

// Data Panen - Petani
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post( //Selesai
        "data-panen",
        [DataPanenController::class, 'store']
    );
    Route::put(
        "data-panen/{id}",
        [DataPanenController::class, 'update']
    );
    Route::delete( //Selesai
        "data-panen/{id}",
        [DataPanenController::class, 'destroy']
    );
    Route::get( //Selesai
        "data-panen",
        [DataPanenController::class, 'index']
    );
});

Route::get( //Selesai
    "data-panen/{id}",
    [DataPanenController::class, 'show']
);

// Artikel - Admin
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post( //Selesai
        "artikel",
        [ArtikelController::class, 'store']
    );
    Route::put( //Selesai
        "artikel/{id}",
        [ArtikelController::class, 'update']
    );
    Route::delete( //Selesai
        "artikel/{id}",
        [ArtikelController::class, 'destroy']
    );
});

Route::get( //Selesai
    "artikel",
    [ArtikelController::class, 'index']
);
Route::get( //Selesai
    "artikel/{id}",
    [ArtikelController::class, 'show']
);

// // Artikel Image - Admin
// Route::middleware(['auth:sanctum'])->group(function () {
//     Route::post(
//         "artikel-image",
//         [ArtikelImageController::class, 'store']
//     );
//     Route::put(
//         "artikel-image/{id}",
//         [ArtikelImageController::class, 'update']
//     );
//     Route::delete(
//         "artikel-image/{id}",
//         [ArtikelImageController::class, 'destroy']
//     );
// });

// Route::get(
//     "artikel-image",
//     [ArtikelImageController::class, 'index']
// );
// Route::get(
//     "artikel-image/{id}",
//     [ArtikelImageController::class, 'show']
// );

