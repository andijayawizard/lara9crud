<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Yajra\Datatables\Datatables;

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

// Route::get('/dashboard', function () {
//     return view('dashboard/index');
// })->middleware(['auth'])->name('dashboard');
Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', DashboardController::class);
    Route::resource('car', CarController::class);
    Route::resource('user', UserController::class);
    Route::resource('transaction', TransactionController::class);
    Route::resource('posts', PostController::class);
    Route::resource('products', ProductController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('categories', CategoriesController::class);
    Route::resource('subcategories', SubCategoryController::class);
    Route::resource('items', ItemController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('invoices', InvoiceController::class);
    Route::post('transaction/{transaction:id}/status', [TransactionController::class, 'status'])->name('transaction.status');
});
Route::get('profile/password', [ProfileController::class, 'password']);
Route::put('change-password', [ProfileController::class, 'change_password'])->name('change-password');
Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
Route::post('change-profile', [ProfileController::class, 'change_profile'])->name('change-profile');
// require __DIR__ . '/auth.php';
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/articles')->name('articles');

// Route::get('getUser', function (Request $request) {
//     if ($request->ajax()) {
//         $data = User::latest()->get();
//         return Datatables::of($data)
//             ->addIndexColumn()
//             ->addColumn('action', function ($row) {
//                 $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
//                 return $actionBtn;
//             })
//             ->rawColumns(['action'])
//             ->make(true);
//     }
// })->name('user.index');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');