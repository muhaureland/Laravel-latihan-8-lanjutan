<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\DashboardPostController;

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
    return view('home',[
        'active' => 'home',
    ]);
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/posts', [PostController::class, 'index']);
Route::get('/categories', [PostController::class, 'kategori']);
Route::get('/posts/{post:slug}', [PostController::class, 'show']);

// Route::get('/categories', function () {
//     return view('categories', [
//         'title' => 'post categories',
//         'categories' => Category::all()
//     ]);
// });

// Route::get('/categories/{category:slug}', function(Category $category){
//     return view('posts', [
//         'title' => "Post By Category : $category->name",
//         'active' => 'categories',
//         'posts' => $category->posts->load('category', 'author')
//     ]);
// });

// Route::get('/authors/{author:username}', function (User $author) {
//     return view('posts', [
//         'title' => "Post By Author : $author->name",
//         'active' => 'categories',
//         'posts' => $author->posts->load('category', 'author')
//         //fungsi load juga sama seperti with tapi load ketika sudah melakusan routes model binding
//         //maksudnya ketika model sudah dipanggil maka ambil sisanya menggunakan load ketika menggunakan relationship table
//     ]);
// });

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
//middleware guest untuk user yg belum terontifikasi
//middleware auth untuk user yg sudah terontifikasi
//name untuk
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);


Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/dashboard', function(){
        return view('dashboard.index');
    });
    Route::resource('/dashboard/posts', DashboardPostController::class);
});

// except untuk mematikan route yg tidak digunakan
// //route middleware yg digabung dengan gate
// //route yg dibuat dengan authorization gate yg dibuat di 
// //App\Provider\AppServiceProvider 
Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('is_admin');