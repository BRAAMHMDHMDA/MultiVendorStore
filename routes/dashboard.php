<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\{
  CategoryController
};


Route::group([
  'middleware' => [],
  'as' => 'dashboard.',
  'prefix' => 'dashboard',
], function (){

  // Routes Category
  Route::resource('categories', CategoryController::class);

});
