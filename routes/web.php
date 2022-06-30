<?php

use App\Http\Controllers\NodeController;
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
    return view('welcome');
})->middleware('guest');

Route::middleware(['justNodeAdmin'])->group(function(){
    Route::get("/node", [NodeController::class, 'getNode']); // only node admin && hasNode
    Route::post("/node/", [NodeController::class, 'newNodeStats']); // only node admin
    Route::get("/node/new-node", [NodeController::class, 'newNode']); // only node admin && without node
    Route::post("/node/new-node", [NodeController::class, 'addOrUpdateNode']);
    Route::delete('/node/entry/{id}',[NodeController::class, 'deleteEntry']);   
    Route::put('/node/update-node',[NodeController::class, 'addOrUpdateNode']);
    Route::get('/test',[NodeController::class, 'testExclusion']);
});


Route::get("/admin", [NodeController::class, 'getAllStats'])->middleware('isSuperAdmin');   // only super admin

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
