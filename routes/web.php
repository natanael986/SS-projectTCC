<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BannedController;
use App\Http\Controllers\Comment\CommentControllerManager;
use App\Http\Controllers\Comment\CommentLikeController;
use App\Http\Controllers\Comment\CommentReportControllerManager;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyPubliControllerManager;
use App\Http\Controllers\Post\PostControllerManager as PostControllerManager;
use App\Http\Controllers\Post\PostLikeController as PostLikeController;
use App\Http\Controllers\Post\PostReportControllerManager;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserReportController;
use Illuminate\Support\Facades\Route;

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

//ROTA PRINCIPAL QUE VAI PARA A PAGINA HOME
Route::get('/', [HomeController::class, 'index'])->name('Inicio');

// ROTA RESPONSÁVEL PELA SEARCHBAR
Route::get('/search', [HomeController::class, 'index'])->name('Pesquisa');
Route::get('/autocomplete-search', [HomeController::class, 'autocompleteSearch']);

//ROTA QUE VAI PARA A PAGINA SOBRE A EMPRESA
Route::get('/about', [AboutController::class, 'index'])->name('site.about');

//ROTA QUE VAI PARA A PAGINA DE PUBLICAÇÕES DOS USUÁRIOS
Route::get('/mypost', [MyPubliControllerManager::class, 'index'])->name('Minhas Publicações');


//ROTA QUE VAI PARA A PAGINA DE CRIAR PUBLICAÇÕES
Route::get('/post', [PostControllerManager::class, 'create'])->name('Publicar');
Route::post('/post', [PostControllerManager::class, 'store'])->name('postmanager.store');
Route::get('/post/{id}/edit', [PostControllerManager::class, 'edit'])->name('Editar Publicação');
Route::post('/post/{id}/edited', [PostControllerManager::class, 'update'])->name('postmanager.update');
Route::delete('/post/{id}', [PostControllerManager::class, 'destroy'])->name('postmanager.destroy');

//ROTA QUE GERENCIA OS LIKES E DESLIKES DAS PUBLICAÇÕES
Route::resource('/postlike', PostLikeController::class);
Route::post('/posts/{post}/like', [PostLikeController::class, 'like'])->name('posts.like');
Route::post('/posts/{post}/dislike', [postLikeController::class, 'dislike'])->name('posts.dislike');


//ROTA QUE GERENCIA AS DENUNCIAS DE PUBLICAÇÕES
Route::get('/report', [PostReportControllerManager::class, 'index'])->name('Denúncias');
Route::get('/reportmanager/{id}', [PostReportControllerManager::class, 'create'])->name('Denúnciar Publicação');
Route::post('/reportmanager', [PostReportControllerManager::class, 'store'])->name('reportmanager.store');
Route::get('/reportshow/{id}', [PostReportControllerManager::class, 'show'])->name('reportmanager.show');
Route::get('/report-edit/{id}/edit', [PostReportControllerManager::class, 'edit'])->name('reportmanager.edit');
Route::put('/report-update/{id}', [PostReportControllerManager::class, 'update'])->name('reportmanager.update');
Route::delete('/report-delete/{id}', [PostReportControllerManager::class, 'destroy'])->name('reportmanager.destroy');


//ROTA QUE VAI PARA A PAGINA DE CRIAR COMENTARIOS NAS PUBLICAÇÕES
Route::get('/comment', [CommentControllerManager::class, 'create'])->name('commentmanager.create');
Route::post('/comment', [CommentControllerManager::class, 'store'])->name('commentmanager.store');
Route::get('/comment/{id}/edit', [CommentControllerManager::class, 'edit'])->name('commentmanager.edit');
Route::put('/comment/{id}', [CommentControllerManager::class, 'update'])->name('commentmanager.update');
Route::delete('/comment/{id}', [CommentControllerManager::class, 'destroy'])->name('commentmanager.destroy');


//ROTA QUE GERENCIA OS LIKES E DESLIKES DOS COMENTARIOS
Route::resource('/commentlike', CommentLikeController::class);
Route::post('/comments/{comment}/like', [CommentLikeController::class, 'like'])->name('comments.like');
Route::post('/comments/{comment}/dislike', [CommentLikeController::class, 'dislike'])->name('comments.dislike');

//ROTA QUE GERENCIA AS DENUNCIAS DE COMENTARIOS
Route::get('/comment-report/{id}', [CommentReportControllerManager::class, 'create'])->name('commentreportmanager.create');
Route::post('/comment-report', [CommentReportControllerManager::class, 'store'])->name('commentreportmanager.store');
Route::get('/comment-report-show/{id}', [CommentReportControllerManager::class, 'show'])->name('commentreportmanager.show');
Route::get('/comment-report-edit/{id}/edit', [CommentReportControllerManager::class, 'edit'])->name('commentreportmanager.edit');
Route::put('/comment-report-update/{id}', [CommentReportControllerManager::class, 'update'])->name('commentreportmanager.update');
Route::delete('/comment-report-delete/{id}', [CommentReportControllerManager::class, 'destroy'])->name('commentreportmanager.destroy');

//ROTA QUE VAI PARA A PAGINA DE DENUNCIAS DE PUBLICAÇÕES E COMENTARIO
// Route::resource('/report', PostReportController::class);
Route::resource('/reportadm', ReportAdmController::class);

//ROTA QUE GERENCIA A VERIFICAÇÃO DE EMAIL DO USUÁRIO
Route::get('route-verify', [EmailController::class, 'exibirFormulario']);
Route::get('route-verifyced/{id}', [EmailController::class, 'exibirFormularioVerificado']);
Route::post('route-verifyced/{id}', [EmailController::class, 'VerificarEmail'])->name('verifyced');

// Route::get('/verify/{token}', [RegisteredUserController::class, 'verify'])->name('auth.verify-email');

Route::get('/email/verify/{token}', [RegisteredUserController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');


// ROTAS RELACIONADAS AO RELATÓRIO DOS USUÁRIOS
Route::GET('/usersearch', [UserReportController::class, 'index'])->name('site.user');

Route::get('/usershow/{id}', [UserReportController::class, 'show'])->name('user.show');
Route::resource('/usershow', UserReportController::class);

Route::middleware(['can:admin'])->group(function () {
    Route::GET('/user', [UserReportController::class, 'index'])->name('Relatórios');
    Route::get('/report', [PostReportControllerManager::class, 'index'])->name('Denúncias');
});

//ROTAS RELACIONADAS AO BANIMENTO E RESTRIÇOES DE USUÁRIOS
Route::post('users/{id}/banned', [BannedController::class, 'banned'])->name('Banir');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('Perfil');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
