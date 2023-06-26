<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\RoleController;
use App\Models\Product;
use App\Models\User;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function(){

    Route::controller(AuthController::class)->group(function(){
        Route::get('register','register')->name('register');
        Route::post('register','registerSave')->name('register.save');

        Route::get('login','login')->name('login');
        Route::post('login','loginAction')->name('login.action');

        Route::get('logout','logout')->middleware('auth')->name('logout');
    });




    Route::middleware('auth')->group(function(){
        Route::get('/dashborad',function (){
            return view('dashboard');
        })->name('dashboard');




        Route::prefix('products')->group(function () {
            Route::get('', [ProductController::class, 'product'])->name('products');
            Route::post('/getproduct', [ProductController::class, 'getproduct'])->name('getproduct');
            Route::get('create', [ProductController::class, 'create'])->name('products.create');
            Route::post('store', [ProductController::class, 'store'])->name('products.store');
            Route::get('show/{id}', [ProductController::class, 'show'])->name('products.show');
            Route::get('edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
            Route::put('update/{product}', [ProductController::class, 'update'])->name('products.update');

            Route::get('/destroy/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
            Route::get('/images/{image}', [ProductController::class, 'destroyImage'])->name('images.destroy');
            Route::delete('/products/{id}/delete-image', [ProductController::class, 'deleteImage'])->name('products.deleteImage');
            // Route::delete('/products/delete-image1', [ProductController::class, 'deleteImage1'])->name('products.deleteImage1');

        });


        Route::prefix('categories')->group(function () {
            Route::get('', [CategoryController::class, 'category'])->name('categories');
            Route::post('/getcategory', [CategoryController::class, 'getcategory'])->name('getcategory');
            Route::get('create', [CategoryController::class, 'create'])->name('categories.create');
            Route::get('store', [CategoryController::class, 'store'])->name('categories.store');
            Route::get('show/{id}', [CategoryController::class, 'show'])->name('categories.show');
            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
            Route::put('update/{id}', [CategoryController::class, 'update'])->name('categories.update');
            Route::get('destroy/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
            Route::delete('/categories/{id}/delete-image', [CategoryController::class, 'deleteImage'])->name('categories.deleteImage');

            // Route::post('/update-category-status', 'CategoryController@updateStatus');
           //  Route::get('/changeStatus', [CategoryController::class, 'changeCategoryStaus'])->name('categories.changeStatus');

        });
        // Route::post('categories',[CategoryController::class,'index'])->name('cateegories');


        Route::get('profile', [App\Http\Controllers\AuthController::class,'profile'])->name('profile');
        Route::get('view',[App\Http\Controllers\AuthController::class,'view'])->name('view');
        Route::post('/profile/update',[App\Http\Controllers\ProfileController::class,'profileupdate'])->name('profileupdate');
        Route::delete('/profile/update/{id}/delete-image', [ProfileController::class, 'deleteImage'])->name('profileupdate.deleteImage');
        Route::post('/increment-change-count', [ProfileController::class, 'incrementChangeCount'])->name('incrementChangeCount');
        Route::post('/profile/update/store-avatar', [ProfileUpdateController::class, 'storeAvatar'])->name('profileupdate.storeAvatar');
        Route::post('profile/update/set-avatar',[ProfileController::class,'setAvatar'])->name('profileupdate.setAvatar');

;

        //  Route::post('/profile/update', 'ProfileController@profileupdate')->name('profileupdate');


        // Route::post('profileupdate',[App\Http\Controllers\AuthController::class,'profileupdate'])->name('profileupdate');
        Route::post('check-email-unique', [App\Http\Controllers\AuthController::class, 'checkEmailUnique'])->name('check.email.unique');
        Route::get('search_results', [CategoryController::class, 'search'])->name('search');

        Route::prefix('users')->group(function(){
            Route::get('', [UserController::class, 'user'])->name('users');
            Route::post('/getuser', [UserController::class, 'getuser'])->name('getuser');
            Route::get('create',[UserController::class,'create'])->name('users.create');
            Route::post('store',[UserController::class,'store'])->name('users.store');
            Route::get('show/{id}',[UserController::class,'show'])->name('users.show');
            Route::get('edit/{id}',[UserController::class,'edit'])->name('users.edit');
            Route::put('update/{id}',[UserController::class,'update'])->name('users.update');
            // Route::delete('destroy/{id}',[UserController::class,'destroy'])->name('users.destroy');
            Route::get('destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
            Route::delete('/users/{id}/delete-image', [UserController::class, 'deleteImage'])->name('users.deleteImage');

        });


        Route::prefix('customers')->group(function(){
            Route::get('', [CustomerController::class, 'customer'])->name('customers');
            Route::post('/getcustomer', [CustomerController::class, 'getcustomer'])->name('getcustomer');
            Route::get('create',[CustomerController::class,'create'])->name('customers.create');
            Route::get('store',[CustomerController::class,'store'])->name('customers.store');
            Route::get('show/{id}',[CustomerController::class,'show'])->name('customers.show');
            Route::get('edit/{id}',[CustomerController::class,'edit'])->name('customers.edit');
            Route::put('update/{id}',[CustomerController::class,'update'])->name('customers.update');
            Route::get('destroy/{id}',[CustomerController::class,'destroy'])->name('customers.destroy');
            Route::delete('/customers/{id}/delete-image', [CustomerController::class, 'deleteImage'])->name('customers.deleteImage');
            // Route::resource('customers', CustomerController::class);
            Route::post('getStatesByCountry', [CustomerController::class, 'getStatesByCountry'])->name('getStatesByCountry');
            Route::post('cities/getCitiesByState', [CustomerController::class, 'getCitiesByState'])->name('cities.getCitiesByState');
            // Route::get('customer/states/{country}', 'Customer@getStatesByCountry')->name('getStatesByCountry');


            // Route::get('index', [CustomerController::class, 'index'])->name('customers.index');


        });

        Route::resource('/roles', RoleController::class);
        Route::post('/getroles',[RoleController::class, 'getroles'])->name('getroles');




    });
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

});

    // Password Reset Routes