<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\HomeController as Site;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PerfilController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SobreController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\CvController;
use App\Http\Controllers\Admin\MensagensController;
use App\Mail\SendRegisterMessage;

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

Route::get('/', [Site::class, 'index'])->name('home');
Route::post('mensagem', [Site::class, 'mensagem'])->name('mensagem');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/email', function(){
    return new SendRegisterMessage();
});

Route::prefix('admin')->group(function(){
    Route::get('/', [HomeController::class, 'index'])->name('admin');

    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('profile', [PerfilController::class, 'index'])->name('profile');
    Route::put('profile/save', [PerfilController::class, 'save'])->name('profile.save');

    Route::get('settings', [SettingsController::class, 'index'])->name('settings');
    Route::put('settings/save', [SettingsController::class, 'save'])->name('settings.save');

    Route::get('about', [SobreController::class, 'index'])->name('sobre');
    Route::put('about/save', [SobreController::class, 'save'])->name('sobre.save');

    Route::resource('skills', Admin\SkillsController::class);
    Route::resource('portfolio', Admin\PortfolioController::class);
    Route::resource('experiences', Admin\ExperienciasController::class);
    Route::resource('academic', Admin\AcademicoController::class);
    Route::resource('social-media', Admin\RedesSociaisController::class);

    Route::get('seo', [SeoController::class, 'index'])->name('seo');
    Route::post('seo', [SeoController::class, 'update'])->name('seo.update');

    Route::get('cv', [CvController::class, 'index'])->name('cv');
    Route::post('cv', [CvController::class, 'update'])->name('cv.update');

    Route::get('messages', [MensagensController::class, 'index'])->name('messages');
    Route::get('message/{id}', [MensagensController::class, 'show'])->name('messages.show');
    Route::delete('message/{id}', [MensagensController::class, 'delete'])->name('messages.destroy');
});