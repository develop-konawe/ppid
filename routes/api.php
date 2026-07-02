<?php

use App\Http\Controllers\Api\V1\IntegrationApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['api.key'])->prefix('v1')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/public-informations', [IntegrationApiController::class, 'getPublicInformations']);
    Route::get('/public-informations/{id}', [IntegrationApiController::class, 'getPublicInformationDetail']);
    Route::get('/statistics', [IntegrationApiController::class, 'getStatistics']);
    Route::post('/information-requests', [IntegrationApiController::class, 'storeInformationRequest']);
    Route::post('/information-requests/check', [IntegrationApiController::class, 'checkInformationRequestStatus']);
});
