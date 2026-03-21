<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\ProduitController;
Route::get('/', function () {
    return view('welcome');
});
Route::resource('Prods',ProduitController::class);