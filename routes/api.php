<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\uploadImageAndDataApiController;

Route::post('uploadDataApi', [uploadImageAndDataApiController::class, 'uploadImages']);
// Route::post('uploadData', [uploadImageAndDataApiController::class, 'test']);
