<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TweetsController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\TweetsLikesController;
use App\Http\Controllers\MentionsController;
use App\Http\Controllers\NotificationsController;

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

Route::get('/', function () {

    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/tweets', [TweetsController::class, 'index'])->name('home');
    Route::post('/tweets', [TweetsController::class, 'store']);
    Route::delete('/tweets/{tweet}', [TweetsController::class, 'destroy'])->middleware('can:destroy,tweet')->name('tweets.destroy');

    Route::get('/mentions', [MentionsController::class, 'index'])->name('mentions');

    Route::post('/tweets/{tweet}/like', [TweetsLikesController::class, 'store']);
    Route::delete('/tweets/{tweet}/like', [TweetsLikesController::class, 'destroy']);

    Route::post('/profiles/{user:username}/follow', [FollowsController::class, 'store']);
    Route::get('/profiles/{user:username}/edit', [ProfilesController::class, 'edit'])->middleware('can:edit,user');
    Route::patch('/profiles/{user:username}', [ProfilesController::class, 'update'])->middleware('can:edit,user');

    Route::get('/profiles/{user:username}', [ProfilesController::class, 'show'])->name('profile');

    Route::get('/explore', ExploreController::class)->name('explore');

    Route::get('/notifications', [NotificationsController::class, 'index'])->name('notifications.index');
    Route::delete('/notifications/{notification}', [NotificationsController::class, 'destroy'])->middleware('can:destroy,notification')->name('notifications.destroy');
    Route::delete('/notifications', [NotificationsController::class, 'destroyAll'])->name('notifications.destroyAll');
});

Route::get('/migrate-fresh', function () {

    Artisan::call('migrate:fresh');

});