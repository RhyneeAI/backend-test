<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\EmployeeController;
use Illuminate\Support\Facades\Route;

// p.s : Error handling is on bootstrap/app.php

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function() {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/register', [AuthController::class, 'register']);
    });
    
    Route::middleware('auth:sanctum')->group(function() { 
        Route::prefix('auth')->group(function() {
            Route::post('/logout', [AuthController::class, 'logout']);
            Route::post('/profile', [EmployeeController::class, 'update']);
            Route::get('/test', function () {
                return response()->json([
                    'message' => 'TESTTTT',
                ], 200);
            });
        });

        Route::middleware('role:ADMIN')->group(function() { 

        });

        Route::middleware('role:ADMIN,EMPLOYEE')->group(function() { 
            Route::apiResource('/employee', EmployeeController::class)->parameters(['employees' => 'id'])->except('update');

        });
    });
});
