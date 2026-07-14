<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LeaveController;
use Illuminate\Support\Facades\Route;

// Redirect welcome page to login screen
Route::get('/', function () {
    return redirect()->route('login');
});

// 🔒 Authenticated Employee & Shared Routes
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Shared Dashboard route handler
    Route::get('/dashboard', function () {
        // If the logged-in user is the admin, send them straight to the admin panel!
        if (auth()->user()->isAdmin()) {
            return redirect()->route('leaves.index');
        }
        
        // Otherwise, load the regular employee's history
        $leaves = auth()->user()->leaves()->latest()->get();
        return view('dashboard', compact('leaves'));
    })->name('dashboard');

    // Employee Application Form Submission Paths
    Route::get('/leaves/create', [LeaveController::class, 'create'])->name('leaves.create');
    Route::post('/leaves', [LeaveController::class, 'store'])->name('leaves.store');
});

// 🔒 Private Admin Routes (Locked behind the 'is_admin' gateway)
Route::middleware(['auth', 'is_admin'])->group(function () {
    // PDF download must be placed FIRST before individual /{leave} wildcards!
    Route::get('/admin/leaves/pdf', [LeaveController::class, 'downloadPDF'])->name('leaves.pdf');
    
    Route::get('/admin/leaves', [LeaveController::class, 'index'])->name('leaves.index');
    Route::get('/admin/leaves/{leave}', [LeaveController::class, 'show'])->name('leaves.show');
    Route::get('/admin/leaves/{leave}/edit', [LeaveController::class, 'edit'])->name('leaves.edit');
    Route::put('/admin/leaves/{leave}', [LeaveController::class, 'update'])->name('leaves.update');
    Route::patch('/admin/leaves/{leave}/status', [LeaveController::class, 'updateStatus'])->name('leaves.updateStatus');
    Route::delete('/admin/leaves/{leave}', [LeaveController::class, 'destroy'])->name('leaves.destroy');
});

// Default Breeze Profile Settings Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';