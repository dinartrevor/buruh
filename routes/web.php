<?php

use App\Http\Controllers\LaborController;
use App\Models\Labor;
use Illuminate\Support\Facades\Route;

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
    $labors = Labor::all();

    return view('index', compact('labors'));
});
Route::resource('labor', LaborController::class)->only(['update']);
