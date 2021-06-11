<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
| Please make BLOG & COMMENT CRUD ROUTES
*/

Route::get('/blogs', [BlogController::class, 'index']);

Route::get('/blog/{id}', [BlogController::class, 'blogWithComments']);

Route::post('/add-comment', [CommentController::class, 'addCommentToBlog']);
