<?php

use Illuminate\Support\Facades\Route;
use App\Models\News;

Route::get('/', function () {
    $news = News::all();
    return view('welcome', ['news' => $news]);
});
