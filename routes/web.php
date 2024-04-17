<?php

use App\Models\Portfolio;
use Spatie\Sitemap\Sitemap;
use Illuminate\Http\Request;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Support\Facades\URL as SEOUrl;
use Illuminate\Support\Facades\Auth;
use UniSharp\LaravelFilemanager\Lfm;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use Artesaos\SEOTools\Facades\SEOTools;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortfolioController;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/portfolios', [PortfolioController::class, 'all'])->name('portfolios');
Route::get('/portfolios/{slug}', [PortfolioController::class, 'show'])->name('portfolio.detail');

Route::get('/posts', [PostController::class, 'all'])->name('posts');
Route::get('/posts/{slug}', [PostController::class, 'show'])->name('post.detail');

Route::get('/sitemap', [SitemapController::class, 'generate']);

// Route::group(['prefix' => 'filemanager'], function () {
//     Lfm::routes();
// });
Route::post('/message/contact', [MessageController::class, 'contact'])->name('message.contact');
Route::get('/reload-captcha', [MessageController::class, 'reloadCaptcha']);

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
        // dd(auth()->user()->roles);
        return view('dashboard');
    })->name('dashboard');

    Route::post('/image-upload', [ImageController::class, 'storeImage'])->name('ckeditor.upload');
    Route::get('log-viewers', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

    // Service
    Route::get('/service', [ServiceController::class, 'index'])->name('service.index');
    Route::get('/service/create', [ServiceController::class, 'create'])->name('service.create');
    Route::post('/service/create', [ServiceController::class, 'store'])->name('service.store');
    Route::get('/service/edit/{id}', [ServiceController::class, 'edit'])->name('service.edit');
    Route::put('/service/edit/{id}', [ServiceController::class, 'update'])->name('service.update');
    Route::delete('/service/delete/{id}', [ServiceController::class, 'destroy'])->name('service.delete');
    Route::post('/service/datatable', [ServiceController::class, 'datatable'])->name('service.datatable');

    // Portfolio
    Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
    Route::get('/portfolio/create', [PortfolioController::class, 'create'])->name('portfolio.create');
    Route::post('/portfolio/create', [PortfolioController::class, 'store'])->name('portfolio.store');
    Route::get('/portfolio/edit/{id}', [PortfolioController::class, 'edit'])->name('portfolio.edit');
    Route::put('/portfolio/edit/{id}', [PortfolioController::class, 'update'])->name('portfolio.update');
    Route::delete('/portfolio/delete/{id}', [PortfolioController::class, 'destroy'])->name('portfolio.delete');
    Route::post('/portfolio/datatable', [PortfolioController::class, 'datatable'])->name('portfolio.datatable');

    // Category
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/create', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/edit/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
    Route::post('/category/datatable', [CategoryController::class, 'datatable'])->name('category.datatable');

    // Post
    Route::get('/post', [PostController::class, 'index'])->name('post.index');
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post/create', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/post/edit/{id}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post/delete/{id}', [PostController::class, 'destroy'])->name('post.delete');
    Route::post('/post/datatable', [PostController::class, 'datatable'])->name('post.datatable');

    // Partner
    Route::get('/partner', [PartnerController::class, 'index'])->name('partner.index');
    Route::get('/partner/create', [PartnerController::class, 'create'])->name('partner.create');
    Route::post('/partner/create', [PartnerController::class, 'store'])->name('partner.store');
    Route::get('/partner/edit/{id}', [PartnerController::class, 'edit'])->name('partner.edit');
    Route::put('/partner/edit/{id}', [PartnerController::class, 'update'])->name('partner.update');
    Route::delete('/partner/delete/{id}', [PartnerController::class, 'destroy'])->name('partner.delete');
    Route::post('/partner/datatable', [PartnerController::class, 'datatable'])->name('partner.datatable');

    // Messages
    Route::get('/message', [MessageController::class, 'index'])->name('message.index');
    Route::get('/message/{id}', [MessageController::class, 'detail'])->name('message.detail');
    Route::post('/message/reply/{id}', [MessageController::class, 'reply'])->name('message.reply');
    Route::post('/message/datatable', [MessageController::class, 'datatable'])->name('message.datatable');

    // Tag
    Route::get('/tags', [TagController::class, 'getAll'])->name('tags.getall');

    Route::post('/logout', [LogoutController::class, 'index'])->name('logout');
});
