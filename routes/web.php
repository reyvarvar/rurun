<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FunRunController;

Route::get('/', function () {
    // setiap buka 127.0.0.1:8000 langsung diarahkan ke /fun-run
    return redirect()->route('fun-run.index');
});

Route::resource('fun-run', FunRunController::class);
