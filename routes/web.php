<?php

use App\Models\Invoice;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResetPasswordController;

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

// MAIN ROUTES
Route::middleware(['auth'])->group(function () {

    //Dashboard
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

    //Businesses
    Route::get('/businesses/bulk-create', [BusinessController::class, 'bulkCreate'])->name('businesses.bulk-create');
    Route::post('/businesses/bulk-create', [BusinessController::class, 'bulkStore'])->name('businesses.bulk-store');
    Route::resource('businesses', BusinessController::class);

    //Projects
    Route::resource('projects', ProjectController::class);

    //Invoices
    Route::get("/invoices",[InvoiceController::class, "index"])->name('invoices.index');;
    Route::get("/invoices/create/{id?}",[InvoiceController::class, "create"])->name('invoices.create');
    Route::get("/invoices/{id}",[InvoiceController::class, "show"])->name('invoices.show');
    Route::get("/invoices/{id}/edit",[InvoiceController::class, "edit"])->name('invoices.edit');
    Route::post("/invoices/store",[InvoiceController::class, "store"])->name("invoices.store");
    Route::post("/invoices/{id}/update",[InvoiceController::class, "update"])->name("invoices.update");
    Route::post("/invoices/{id}/destroy",[InvoiceController::class, "destroy"])->name("invoices.destroy");
    Route::post("/invoices/{id}/{newValue?}/mark_as",[InvoiceController::class, "markAs"])->name("invoices.mark_as");
    Route::get("/invoices/{id}/pdf",[PDFController::class,"generatePDF" ]);
    
    //Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// AUTHENTICATION
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('authenticate');   
    Route::get('/forgot-password', [ResetPasswordController::class, 'showForgotPasswordForm'])->name('forgot-password-form');
    Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetPasswordEmail'])->name('reset-password-email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetPasswordForm'])->name('reset-password-form');
    Route::post('/reset-password/', [ResetPasswordController::class, 'resetPassword'])->name('reset-password');
});
