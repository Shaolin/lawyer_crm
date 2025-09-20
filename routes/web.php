<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\PaystackController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LegalCaseController;
use App\Http\Controllers\UserManagementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/features', function () {
    return view('features');
})->name('features');
Route::get('/whyus', function () {
    return view('whyus');
})->name('whyus');


// users
Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::middleware('can:manage-users')->group(function () {
        Route::resource('users', UserManagementController::class)->names('dashboard.users');
    });
});

// clients
Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::resource('clients', ClientController::class)->names('dashboard.clients');
});

// cases
Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::resource('cases', LegalCaseController::class)
        ->names('dashboard.cases');
});

// tasks

Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::resource('tasks', TaskController::class)->names('dashboard.tasks');
});

// Documents (resource)
Route::middleware(['auth'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::resource('documents', DocumentController::class);
});

Route::middleware(['auth'])->prefix('dashboard')->name('dashboard.')->group(function () {
    
    // Invoices (CRUD)
    Route::resource('invoices', InvoiceController::class);
    Route::get('invoices/{invoice}/download', [InvoiceController::class, 'download'])
    ->name('invoices.download');
    

    // Payments (nested under invoices)
    Route::post('invoices/{invoice}/payments', [PaymentController::class, 'store'])
        ->name('payments.store');

    Route::delete('payments/{payment}', [PaymentController::class, 'destroy'])
        ->name('payments.destroy');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');




Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');


Route::view('/pricing', 'pricing')->name('pricing');




Route::get('/pay', [PaystackController::class, 'redirectToGateway'])->name('pay');
Route::get('/payment/callback', [PaystackController::class, 'handleGatewayCallback']);





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
