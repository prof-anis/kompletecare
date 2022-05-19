<?php

use App\Http\Controllers\Api\LaboratoryTestController;
use App\Http\Controllers\Api\UserLaboratoryTestController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum']], function (): void {
    Route::get('laboratory-tests', LaboratoryTestController::class);
    Route::post('laboratory-tests/{user}', UserLaboratoryTestController::class);
});
