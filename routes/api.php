<?php

use App\Http\Controllers\routeToDownloadPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\uploadImageAndDataApiController;

Route::post('uploadDataApi', [uploadImageAndDataApiController::class, 'uploadImages']);
Route::post('/generation', [routeToDownloadPage::class, 'handleRouting']);
// Route::post('uploadData', [uploadImageAndDataApiController::class, 'test']);
