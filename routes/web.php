<?php

use App\Http\Controllers\AssignProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormDetailsController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

if (env('APP_ENV') === 'production') {
    URL::forceSchema('https');
    // \URL::forceScheme('https');
}


Route::get('/', function () {
    return Redirect::route('login');
});

Route::group(['middleware' => ['auth', '\Spatie\Permission\Middleware\RoleMiddleware:superadmin']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::get('/user-status-update/{id}', [UserController::class, 'userStatusUpdate'])->name('user.statusUpdate');
});

Route::middleware(['auth', 'verified'])->group(function () {

    // dashboard
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    // User Profile
    Route::get('/logout', function (Request $request) {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Redirect::route('login');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/update-password', [ProfileController::class, 'update_password'])->name('profile.update_password');


   // Project Controller Routes
   Route::get('projects', [ProjectController::class, 'projects'])->name('projects');

   Route::get('project-view/{project?}', [ProjectController::class, 'show'])->name('project.show');

   Route::get('project-add', [ProjectController::class, 'create'])->name('project.create');
   Route::post('project-store/{project?}', [ProjectController::class, 'store'])->name('project.store');


   Route::get('project-edit/{project}', [ProjectController::class, 'edit'])->name('project.edit');
   Route::post('project-update/{project?}', [ProjectController::class, 'update'])->name('project.update');

   Route::get('/project-delete/{project?}', [ProjectController::class, 'delete'])->name('project.delete');


// Assign Project Controller Routes

Route::get('assign-projects', [AssignProjectController::class, 'assignProject'])->name('assignProjects');
Route::get('assign-projects-view/{assignProject?}', [AssignProjectController::class, 'show'])->name('assignProject.show');

Route::post('assign-store', [AssignProjectController::class, 'store'])->name('assignProject.store');
Route::post('assign-update/{assignProject?}', [AssignProjectController::class, 'update'])->name('assignProject.update');

Route::get('assign-projects-delete/{assignProject?}', [AssignProjectController::class, 'delete'])->name('assignProject.delete');

// Route::get('assign-projects-list/', [AssignProjectController::class, 'assignProjectCustomerList'])->name('assignProjectCustomerList');


// Forms Controller Routes




Route::get('form-details-add',[FormDetailsController::class,'preview'])->name('formDetail.preview');

Route::get('form-details-add/{c_id?}/{p_id?}',[FormDetailsController::class,'create'])->name('formDetail.create');
Route::post('form-details-store',[FormDetailsController::class,'store'])->name('formDetail.store');


Route::get('form-details-view/{c_id?}/{p_id?}',[FormDetailsController::class,'viewCustomerGetDetailsForm'])->name('formDetail.viewCustomerGetDetailsForm');


Route::post('detete-product-img/{formDetails?}',[FormDetailsController::class, 'formUpdateTimeDeleteBrandLogo'])->name('formDetail.formUpdateTimeDeleteBrandLogo');


});




require __DIR__ . '/auth.php';
