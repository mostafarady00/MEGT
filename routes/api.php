<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BestofferController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\InternationalfaqController;
use App\Http\Controllers\InternationaltradController;
use App\Http\Controllers\OurteamController;
use App\Http\Controllers\NumberspeakController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




Route::post('/register', [AuthController::class, 'register']);
Route::middleware(['auth:sanctum', 'admin'])->get('/allusers', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/loginadmin', [AuthController::class, 'loginadmin']);
Route::post('/forget-password', [AuthController::class, 'forgetPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);
Route::post('/verifyOtp', [AuthController::class, 'verifyOtp']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);


//contacts

Route::prefix('contacts')->group(function () {
    Route::get('/', [ContactController::class, 'index']);
    Route::post('/', [ContactController::class, 'store']);
    Route::get('/{id}', [ContactController::class, 'show']);
    Route::middleware(['auth:sanctum', 'admin'])->delete('/{id}', [ContactController::class, 'destroy']);
});


//Bestoffer

Route::prefix('Bestoffer')->group(function () {
    Route::get('/', [BestofferController::class, 'index']);
    Route::post('/', [BestofferController::class, 'store']);
    Route::get('/{id}', [BestofferController::class, 'show']);
    Route::middleware(['auth:sanctum', 'admin'])->delete('/{id}', [BestofferController::class, 'destroy']);
});


// Terms Routes
Route::prefix('terms')->group(function () {
    Route::get('/', [TermController::class, 'index']);
    Route::middleware(['auth:sanctum', 'admin'])->post('/', [TermController::class, 'store']);
    Route::get('/{id}', [TermController::class, 'show']);
    Route::middleware(['auth:sanctum', 'admin'])->put('/{id}', [TermController::class, 'update']);
    Route::middleware(['auth:sanctum', 'admin'])->delete('/{id}', [TermController::class, 'destroy']);
});

// FAQs Routes
Route::prefix('faqs')->group(function () {
    Route::get('/', [FaqController::class, 'index']);
    Route::middleware(['auth:sanctum', 'admin'])->post('/', [FaqController::class, 'store']);
    Route::get('/{id}', [FaqController::class, 'show']);
    Route::middleware(['auth:sanctum', 'admin'])->post('/{id}', [FaqController::class, 'update']);
    Route::middleware(['auth:sanctum', 'admin'])->delete('/{id}', [FaqController::class, 'destroy']);
});

// Blogs Routes
Route::prefix('blogs')->group(function () {
    Route::get('/', [BlogController::class, 'index']);
    Route::middleware(['auth:sanctum', 'admin'])->post('/', [BlogController::class, 'store']);
    Route::get('/{id}', [BlogController::class, 'show']);
    Route::middleware(['auth:sanctum', 'admin'])->post('/{id}', [BlogController::class, 'update']);
    Route::middleware(['auth:sanctum', 'admin'])->delete('/{id}', [BlogController::class, 'destroy']);
});

// International Trad Routes
Route::prefix('internationaltrads')->group(function () {
    Route::get('/', [InternationaltradController::class, 'index']);
    Route::middleware(['auth:sanctum', 'admin'])->post('/', [InternationaltradController::class, 'store']);
    Route::get('/{id}', [InternationaltradController::class, 'show']);
    Route::middleware(['auth:sanctum', 'admin'])->post('/{id}', [InternationaltradController::class, 'update']);
    Route::middleware(['auth:sanctum', 'admin'])->delete('/{id}', [InternationaltradController::class, 'destroy']);
});

// Our Teams Routes
Route::prefix('ourteams')->group(function () {
    Route::get('/', [OurteamController::class, 'index']);
    Route::middleware(['auth:sanctum', 'admin'])->post('/', [OurteamController::class, 'store']);
    Route::get('/{id}', [OurteamController::class, 'show']);
    Route::middleware(['auth:sanctum', 'admin'])->post('/{id}', [OurteamController::class, 'update']);
    Route::middleware(['auth:sanctum', 'admin'])->delete('/{id}', [OurteamController::class, 'destroy']);
});

// Number Speaks Routes
Route::prefix('numberspeaks')->group(function () {
    Route::get('/', [NumberspeakController::class, 'index']);
    // Route::middleware(['auth:sanctum', 'admin'])->post('/', [NumberspeakController::class, 'store']);
    Route::get('/{id}', [NumberspeakController::class, 'show']);
    Route::middleware(['auth:sanctum', 'admin'])->post('/{id}', [NumberspeakController::class, 'update']);
    Route::middleware(['auth:sanctum', 'admin'])->delete('/{id}', [NumberspeakController::class, 'destroy']);
});

// International FAQs Routes
Route::prefix('internationalfaq')->group(function () {
    Route::get('/', [InternationalfaqController::class, 'index']);
    Route::middleware(['auth:sanctum', 'admin'])->post('/', [InternationalfaqController::class, 'store']);
    Route::get('/{id}', [InternationalfaqController::class, 'show']);
    Route::middleware(['auth:sanctum', 'admin'])->post('/{id}', [InternationalfaqController::class, 'update']);
    Route::middleware(['auth:sanctum', 'admin'])->delete('/{id}', [InternationalfaqController::class, 'destroy']);
});
