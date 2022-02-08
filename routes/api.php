<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PlaneController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/dashboard',[BlogController::class,'dashboard']);



Route::prefix('user')->group(function () {
    Route::get('/users',[UserController::class,'users']);
    Route::post('/post',[UserController::class,'createUser']);
    Route::get('/get/{id?}',[UserController::class,'getUser']);
    Route::post('/update',[UserController::class,'updateUser']);
    Route::get('/delete/{id?}',[UserController::class,'deleteUser']);
});
Route::prefix('article')->group(function () {
    Route::get('/articles',[ArticleController::class,'getArticles']);
    Route::post('/post',[ArticleController::class,'createArticle']);
    Route::get('/get/{id?}',[ArticleController::class,'getArticle']);
    Route::post('/update',[ArticleController::class,'updateArticle']);
    Route::get('/delete/{id?}',[ArticleController::class,'deleteArticle']);
});

Route::resource('category', CategoryController::class);


Route::prefix('blog')->group(function () {
    Route::get('/blogs',[BlogController::class,'getBlogs']);
    Route::post('/post',[BlogController::class,'createBlog']);
    Route::get('/get/{id?}',[BlogController::class,'getBlog']);
    Route::post('/update',[BlogController::class,'updateBlog']);
    Route::get('/delete/{id?}',[BlogController::class,'deleteBlog']);
});


Route::prefix('event')->group(function () {
    Route::get('/events',[EventController::class,'getEvents']);
    Route::post('/post',[EventController::class,'createEvent']);
    Route::get('/get/{id?}',[EventController::class,'getEvent']);
    Route::post('/update',[EventController::class,'updateEvent']);
    Route::get('/delete/{id?}',[EventController::class,'deleteEvent']);
});





Route::prefix('app')->group(function () {


    Route::get('/articles',[ArticleController::class,'getArticles']);
    Route::get('/blogs',   [BlogController::class,'getBlogs']);
    Route::get('/events',  [EventController::class,'getEvents']);
    Route::get('/categories',  [CategoryController::class, 'getAllCategories']);
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [AuthController::class,'login']);
        Route::post('signup', [AuthController::class,'signup']);
        Route::group(['middleware' => 'auth:api'], function() {
            Route::get('logout',[AuthController::class,'logout']);
            Route::get('user', [AuthController::class,'user']);
            Route::post('/user/plane',[PlaneController::class,'newUserPlane']);
        });
    });


});
