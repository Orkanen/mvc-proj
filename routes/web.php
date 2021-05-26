<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloWorldController;
use App\Http\Controllers\YatzyView;
use App\Http\Controllers\DiceController;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\BetController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

Route::get('/', function () {
    return view('');
});
*/

// Added for mos example code

Route::get('/', function () {
    return view('message', [
        'message' => "Hello World from within a view"
    ]);
});
Route::get('/hello', [HelloWorldController::class, 'hello']);
Route::get('/hello/{message}', [HelloWorldController::class, 'hello']);

Route::get('/dice', [DiceController::class, 'index']);
//Route::get('/dice/{message}', [DiceController::class, 'index']);
Route::post('/dice/roll', [DiceController::class, 'postIndex']);
Route::get('/score', [DiceController::class, 'highScore']);

Route::get('/pizzas', [PizzaController::class, 'index']);
Route::get('/pizzas/create', [PizzaController::class, 'create']);
Route::get('/pizzas/{id}', [PizzaController::class, 'show']);

Route::get('/bet/create', [BetController::class, 'setCurrency']);
Route::get('/bet', [BetController::class, 'index']);
Route::get('/bets', [BetController::class, 'updateBet']);
Route::post('/make/bet', [BetController::class, 'updateBetAmount']);
