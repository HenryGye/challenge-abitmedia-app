<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoftwareController;
use App\Http\Controllers\ServicioController;
use App\Models\User;

app('router')->aliasMiddleware('auth:sanctum', function ($request, $next) {
    if (!auth('sanctum')->check()) {
        return response('UNAUTHORIZED', 401);
    }

    return $next($request);
});

// rutas para crear y eliminar token para rutas seguras
Route::post('/tokens/create', function (Request $request) {
    $user = User::first();
    return $user ? ['token' => $user->createToken('API Token')->plainTextToken] : 
        response()->json(['message' => 'UNAUTHORIZED'], 404);
});

Route::post('/tokens/delete', function (Request $request) {
    $user = User::first();
    $user->tokens()->delete();
    return response()->json(['message' => 'Tokens eliminados'], 200);
});

// rutas seguras
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/user', function (Request $request) {
        return $request->user('sanctum');
    });
    Route::resource('softwares', SoftwareController::class)->only(['index','store','show','update','destroy']);
    Route::resource('servicios', ServicioController::class)->only(['index','store','show','update','destroy']);
});