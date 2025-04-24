<?php

use Illuminate\Support\Facades\Route;


Route::middleware(["lang", "cors"])->group(function () {
    require __DIR__ . '/authentication.php';

});

















