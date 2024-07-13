<?php

use Illuminate\Support\Facades\Route;
use App\Domain\Website\Controllers\WebController;

Route::get("/", [WebController::class, "home"])->name("website.home");
Route::get("/kelas", [WebController::class, "kelas"])->name("website.kelas");
Route::get("/informasi", [WebController::class, "informasi"])->name("website.informasi");
Route::get("/informasi/{slug}", [WebController::class, "informasi_slug"])->name("website.informasi.slug");
Route::get("/informasi/tag/{slug}", [WebController::class, "informasi_tag_slug"])->name("website.informasi.tag.slug");

