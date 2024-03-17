<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoftwareController;
use App\Http\Controllers\ServicioController;
use App\Models\User;
use App\Models\SistemaOperativo;
use App\Models\Licencia;

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

    // apis adicionales
    Route::get('sistemas-operativos', function (Request $request) {
        $so = SistemaOperativo::all();
        return $so ? response()->json($so, 200) : response()->json(['message' => 'No hay registros'], 404);
    });

    Route::get('licencias', function (Request $request) {
        $licencias = Licencia::all();
        return $licencias ? response()->json($licencias, 200) : response()->json(['message' => 'No hay registros'], 404);
    });
});

Route::fallback(function () {
    return response()->json(['message' => 'Not Found'], 404);
});