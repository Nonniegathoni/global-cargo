<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\ShipController;
use App\Http\Controllers\Api\CrewController;
use App\Http\Controllers\Api\PortController;
use App\Http\Controllers\Api\CargoController;
use App\Http\Controllers\Api\ShipmentController;

Route::apiResource('clients', ClientController::class);
Route::apiResource('ships', ShipController::class);
Route::apiResource('crew', CrewController::class);
Route::apiResource('ports', PortController::class);
Route::apiResource('cargo', CargoController::class);
Route::apiResource('shipments', ShipmentController::class); 