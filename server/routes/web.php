<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any?}', function () {
    $path = public_path('dist/index.html');
    if (!file_exists($path)) {
        return abort(404);
    }
    return file_get_contents($path);
})->where('any', '.*');
