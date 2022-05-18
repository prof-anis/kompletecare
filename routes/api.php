<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

<?php

use App\Http\Controllers\Api\LaboratoryTestController;
use App\Http\Controllers\Api\UserLaboratoryTestController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get("laboratory-tests", LaboratoryTestController::class);
    Route::post("laboratory-tests/{user}", UserLaboratoryTestController::class);
});


