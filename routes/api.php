<?php

use App\Http\Controllers\TeamController;
use App\Http\Controllers\MemberController;
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
*/

Route::resource('teams', TeamController::class, ['only' => ['index', 'destroy']]);
Route::get('team/{team}', [TeamController::class, 'show']);

Route::resource('members', MemberController::class, ['only' => ['index', 'store']]);
Route::get('member/{member}', [MemberController::class, 'show']);