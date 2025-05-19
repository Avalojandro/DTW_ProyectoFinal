<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\Login\LoginController;
use App\Http\Controllers\Controles\ControlController;
use App\Http\Controllers\Backend\Roles\RolesController;
use App\Http\Controllers\Backend\Roles\PermisoController;
use App\Http\Controllers\Backend\Perfil\PerfilController;
use App\Http\Controllers\Backend\Configuracion\ConfiguracionController;
use App\Http\Controllers\Backend\Registro\RegistroController;
use App\Http\Controllers\Backend\Dashboard\DashboardController;
use App\Http\Controllers\Controles\MovieController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar las rutas web para tu aplicación.
| Estas rutas son cargadas por el RouteServiceProvider dentro de un grupo
| que contiene el middleware "web".
|
*/

// Ruta de bienvenida/página principal
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Sistema de autenticación
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/admin/login', [LoginController::class, 'login']);
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

// PRUEBA: Sacamos temporalmente las rutas de películas del grupo auth para diagnóstico
Route::prefix('peliculas')->group(function () {
    Route::get('/', [MovieController::class, 'index'])->name('movies.index');
    Route::get('/crear', [MovieController::class, 'create'])->name('movies.create');
    Route::post('/', [MovieController::class, 'store'])->name('movies.store');
    Route::get('/{id}', [MovieController::class, 'show'])->name('movies.show');
    Route::get('/{id}/editar', [MovieController::class, 'edit'])->name('movies.edit');
    Route::put('/{id}', [MovieController::class, 'update'])->name('movies.update');
    Route::delete('/{id}', [MovieController::class, 'destroy'])->name('movies.destroy');
});

// Rutas protegidas (requieren autenticación) - Resto de rutas administrativas
Route::middleware(['auth'])->group(function () {

    // Panel de control principal
    //Route::get('/panel', [ControlController::class, 'indexRedireccionamiento'])->name('admin.panel');

    // Dashboard administrativo
    Route::get('/admin/dashboard', [DashboardController::class, 'vistaDashboard'])->name('admin.dashboard.index');

    // Gestión de roles
    Route::prefix('admin/roles')->group(function () {
        Route::get('/index', [RolesController::class, 'index'])->name('admin.roles.index');
        Route::get('/tabla', [RolesController::class, 'tablaRoles']);
        Route::get('/lista/permisos/{id}', [RolesController::class, 'vistaPermisos']);
        Route::get('/permisos/tabla/{id}', [RolesController::class, 'tablaRolesPermisos']);
        Route::post('/permiso/borrar', [RolesController::class, 'borrarPermiso']);
        Route::post('/permiso/agregar', [RolesController::class, 'agregarPermiso']);
        Route::get('/permisos/lista', [RolesController::class, 'listaTodosPermisos']);
        Route::get('/permisos-todos/tabla', [RolesController::class, 'tablaTodosPermisos']);
        Route::post('/borrar-global', [RolesController::class, 'borrarRolGlobal']);
    });

    // Administración de permisos
    Route::prefix('admin/permisos')->group(function () {
        Route::get('/index', [PermisoController::class, 'index'])->name('admin.permisos.index');
        Route::get('/tabla', [PermisoController::class, 'tablaUsuarios']);
        Route::post('/nuevo-usuario', [PermisoController::class, 'nuevoUsuario']);
        Route::post('/info-usuario', [PermisoController::class, 'infoUsuario']);
        Route::post('/editar-usuario', [PermisoController::class, 'editarUsuario']);
        Route::post('/nuevo-rol', [PermisoController::class, 'nuevoRol']);
        Route::post('/extra-nuevo', [PermisoController::class, 'nuevoPermisoExtra']);
        Route::post('/extra-borrar', [PermisoController::class, 'borrarPermisoGlobal']);
    });

    // Gestión de perfil de usuario
    Route::prefix('admin/editar-perfil')->group(function () {
        Route::get('/index', [PerfilController::class, 'indexEditarPerfil'])->name('admin.perfil');
        Route::post('/actualizar', [PerfilController::class, 'editarUsuario']);
    });

    // Configuración del sistema
    Route::prefix('admin/configuracion')->group(function () {
        // Rutas de configuración pueden agregarse aquí
    });

    // Registro de usuarios (si es necesario)
    Route::prefix('admin/registro')->group(function () {
        // Rutas de registro pueden agregarse aquí
    });
});

// Manejo de errores y acceso denegado
Route::get('sin-permisos', [ControlController::class, 'indexSinPermiso'])->name('no.permisos.index');

// Rutas de API si son necesarias
Route::prefix('api')->group(function () {
    // Rutas API pueden agregarse aquí
});

// Otras rutas públicas
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
