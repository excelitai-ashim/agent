<?php

use App\Http\Controllers\AgentController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!  agentViewPage
|
*/

// Route::get('/', function () {
//     // return view('layouts.back-end.app');
//     return view('layouts.index');
//     // return view('layouts.back-end.partials.agent.agent_view');
// });
Route::get('/', [AgentController::class, 'index'])->name('dashboard');

Route::get('/agent_list',[AgentController::class,'agentViewPage'])->name('agent_list');
Route::prefix('agent')->group(function () {
    Route::post('/store_data',[AgentController::class,'storeAgent']);
    Route::get('/getData',[AgentController::class,'agentgetData']);
    Route::get('/edit/{agent_id}',[AgentController::class,'edit'])->name('customer.edit');
    Route::post('/update/{agent_id}',[AgentController::class,'update']);
    Route::get('/remove/{agent_id}',[AgentController::class,'removeAgent']);

});
