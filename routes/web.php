<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Book\BookController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookReturn\BookReturnController;
use App\Http\Controllers\Borrow\BorrowController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Genre\GenreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\Report\ReportController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/{book}/detail', [HomeController::class, 'detail'])->name('detail');
Route::get('/katalog/{id?}', [KatalogController::class, 'index'])->name('katalog');
Route::get('/booking', [BookingController::class, 'index'])->name('booking')->middleware('auth');
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact');
Route::prefix('auth')->middleware('guest')->group(function(){
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/register/store', [AuthController::class, 'store'])->name('auth.register.store');
});
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout'); 

Route::prefix('administrator')->middleware('auth')->group(function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('genres')->group(function(){
        Route::get('', [GenreController::class, 'index'])->name('admin.genres');
        Route::post('store', [GenreController::class, 'store'])->name('admin.genres.store');
        Route::get('{genre}/edit', [GenreController::class, 'edit'])->name('admin.genres.edit');
        Route::post('{genre}/update', [GenreController::class, 'update'])->name('admin.genres.update');
        Route::delete('{genre}/delete', [GenreController::class, 'destroy'])->name('admin.genres.delete');
    });

    Route::prefix('books')->group(function(){
        Route::get('', [BookController::class, 'index'])->name('admin.books');
        Route::get('create', [BookController::class, 'create'])->name('admin.books.create');
        Route::post('store', [BookController::class, 'store'])->name('admin.books.store');
        Route::get('{book}/detail', [BookController::class, 'detail'])->name('admin.books.detail');
        Route::get('{book}/edit', [BookController::class, 'edit'])->name('admin.books.edit');
        Route::post('{book}/update', [BookController::class, 'update'])->name('admin.books.update');
        Route::delete('{book}/delete', [BookController::class, 'destroy'])->name('admin.books.delete');
    });

    Route::prefix('members')->group(function(){
        Route::get('', [MemberController::class, 'index'])->name('admin.members');
        Route::get('create', [MemberController::class, 'create'])->name('admin.members.create');
        Route::post('store', [MemberController::class, 'store'])->name('admin.members.store');
        Route::get('{member}/edit', [MemberController::class, 'edit'])->name('admin.members.edit');
        Route::post('{member}/update', [MemberController::class, 'update'])->name('admin.members.update');
        Route::delete('{member}/delete', [MemberController::class, 'destroy'])->name('admin.members.delete');
    });

    Route::prefix('users')->group(function(){
        Route::get('', [UserController::class, 'index'])->name('admin.users');
        Route::get('create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('store', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::post('{user}/update', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('{user}/delete', [UserController::class, 'destroy'])->name('admin.users.delete');
    });

    Route::prefix('borrows')->group(function(){
        Route::get('', [BorrowController::class, 'index'])->name('admin.borrows');
        Route::get('getDataBook', [BorrowController::class, 'getDataBook'])->name('admin.borrows.getDataBook');
        Route::post('{book_id}/store', [BorrowController::class, 'store'])->name('admin.borrows.store');
        Route::post('checkout', [BorrowController::class, 'checkout'])->name('admin.borrows.checkout');
        Route::delete('{transactionDetail}/delete', [BorrowController::class, 'destroy'])->name('admin.borrows.delete');
    });

    Route::prefix('bookings')->group(function(){
        Route::get('', [BookingController::class, 'index'])->name('admin.bookings');
        Route::get('{transaction}/show', [BookingController::class, 'show'])->name('admin.bookings.show');
        Route::get('{transaction}/getDataDetail', [BookingController::class, 'getDataDetail'])->name('admin.bookings.getDataDetail');
        Route::get('{transaction}/confirm', [BookingController::class, 'confirm'])->name('admin.bookings.confirm');
        Route::get('scan-qr-code', [BookingController::class, 'viewQRCodeScanner'])->name('admin.bookings.scan-qr-code');
        Route::get('{transaction_code}/scanner', [BookingController::class, 'scanner'])->name('admin.bookings.scanner');
    });

    Route::prefix('book-returns')->group(function(){
        Route::get('', [BookReturnController::class, 'index'])->name('admin.book-returns');
        Route::get('{transaction}/show', [BookReturnController::class, 'show'])->name('admin.book-returns.show');
        Route::get('{transaction}/getDataDetail', [BookReturnController::class, 'getDataDetail'])->name('admin.book-returns.getDataDetail');
        Route::get('{transactionDetail}/returned', [BookReturnController::class, 'returned'])->name('admin.book-returns.returned');
        Route::get('scan-qr-code', [BookReturnController::class, 'viewQRCodeScanner'])->name('admin.book-returns.scan-qr-code');
        Route::get('{transaction_code}/scanner', [BookReturnController::class, 'scanner'])->name('admin.book-returns.scanner');
    });

    Route::prefix('reports')->group(function(){
        Route::get('', [ReportController::class, 'index'])->name('admin.reports');
        Route::get('preview-pdf', [ReportController::class, 'preview'])->name('admin.reports.preview');
    });
});