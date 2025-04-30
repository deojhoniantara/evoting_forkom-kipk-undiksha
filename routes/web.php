<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VotingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VoterManagementController;
use App\Http\Controllers\Admin\CandidateController;
use App\Http\Controllers\Admin\VoteController;


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

// Redirect dari root ke /voting
Route::get('/', function () {
    return redirect()->route('voting.form');
});

// Voting Routes
Route::get('/voting', [VotingController::class, 'showForm'])->name('voting.form');
Route::post('/voting/verify', [VotingController::class, 'verifyCode'])->name('verify.code');
Route::get('/voting/{voter}', [VotingController::class, 'showVotePage'])->name('vote.page');
Route::post('/voting/{voter}', [VotingController::class, 'submitVote'])->name('submit.vote');
Route::get('/thank-you', function () {
    return view('voting.thank-you');
})->name('thank.you');

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/statistics', [AdminController::class, 'statistics'])->name('admin.statistics');
    
    // Voters
    Route::get('/admin/voters', [AdminController::class, 'voters'])->name('admin.voters');
    
    // Votes
    Route::get('/admin/votes', [AdminController::class, 'votes'])->name('admin.votes');
    Route::get('/vote-result', [VoteController::class, 'getResult'])->name('vote.result');

    // Voter Management
    Route::prefix('admin/voter-management')->group(function () {
        Route::get('/', [VoterManagementController::class, 'index'])->name('voter-management.index');
        Route::get('/create', [VoterManagementController::class, 'create'])->name('voter-management.create');
        Route::post('/', [VoterManagementController::class, 'store'])->name('voter-management.store');
        Route::get('/export', [VoterManagementController::class, 'export'])->name('voter-management.export');
        Route::post('/import', [VoterManagementController::class, 'import'])->name('voter-management.import');
        Route::delete('/admin/voter-management/{voter}', [VoterManagementController::class, 'destroy'])->name('voter-management.destroy');
    });
    
    Route::resource('candidates', CandidateController::class);
    Route::patch('candidates/{candidate}/toggle-active', [CandidateController::class, 'toggleActive'])
        ->name('admin.candidates.toggle-active');
    Route::get('/admin/candidates', [CandidateController::class, 'index'])->name('admin.candidates.index');
    Route::get('/candidates/create', [CandidateController::class, 'create'])->name('admin.candidates.create');
    Route::post('/candidates', [CandidateController::class, 'store'])->name('admin.candidates.store');
    Route::get('/candidates/{candidate}/edit', [CandidateController::class, 'edit'])->name('admin.candidates.edit');
    Route::put('/candidates/{candidate}', [CandidateController::class, 'update'])->name('admin.candidates.update');
    Route::delete('/candidates/{candidate}', [CandidateController::class, 'destroy'])->name('admin.candidates.destroy');

});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


