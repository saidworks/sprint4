<?php

use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;
use App\Http\Controllers\Front\{ PostController as FrontPostController,
                                ContactController as FrontContactController};
use App\Http\Controllers\Front\CommentController as FrontCommentController;
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
//home page
Route::name('home')->get('/',[FrontPostController::class,'index']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => 'auth'], function () {
    Lfm::routes();
});


//posts
Route::prefix('posts')->group(function () {
    Route::name('posts.display')->get('{slug}', [FrontPostController::class, 'show']);
    Route::name('posts.search')->get('', [FrontPostController::class, 'search']);
    //Comments
    Route::name('posts.comments')->get('{post}/comments', [FrontCommentController::class, 'comments']);
    Route::name('posts.comments.store')->post('{post}/comments', [FrontCommentController::class, 'store'])->middleware('auth');
    Route::name('front.comments.destroy')->delete('comments/{comment}', [FrontCommentController::class, 'destroy']);
});

// categories 
Route::name('category')->get('category/{category:slug}', [FrontPostController::class, 'category']);

//authors
Route::name('author')->get('author/{user}', [FrontPostController::class, 'user']);

//tags
Route::name('tag')->get('tag/{tag:slug}', [FrontPostController::class, 'tag']);

//Contact 
Route::resource('contacts', FrontContactController::class, ['only' => ['create', 'store']]);