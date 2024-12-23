<?php

use App\Http\Controllers\PaiementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RemboursementController;
use Illuminate\Support\Facades\Route;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('paiements', PaiementController::class)->except(['show']);
    // Route pour afficher le formulaire de remboursement
    Route::get('/paiements/{uuid}/refund', [PaiementController::class, 'refundForm'])->name('paiements.refund.form');
    Route::post('/paiements/{uuid}/refund', [PaiementController::class, 'processRefund'])->name('paiements.refund.process');

Route::get('/', function () {
    return view('dashboard');
});
});

require __DIR__.'/auth.php';
