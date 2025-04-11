<?php
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route login & register (tambahkan name pada login jika ingin hindari error route not found)
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login')->name('login'); //
    Route::post('register', 'register');
});

// Route yang butuh autentikasi JWT
Route::middleware('auth:api')->group(function () {
    Route::get('me', [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);
});

// Resource route
Route::apiResource('/students', StudentController::class);
