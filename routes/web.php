<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});
//use App\Http\Controllers\MainController;

//Route::get('/', [MainController::class, "home"]);
//
//Route::get('/about', [MainController::class, "about"]);
//
//Route::get('/user/{id}/{name}', function ($id, $name) {
//    ddd($id, $name);
//    return 'This is user ' . $name . ' with an id of ' . $id;
//});

// main page
Route::get('/', [ListingController::class, "index"]);

// create a new listing
Route::get('/listings/create', [ListingController::class, "create"]);

// show the user's listings
Route::get('/listings/manage', [ListingController::class, "manage"])
    ->middleware('auth');

// show a single listing
Route::get('/listings/{listing}', [ListingController::class, "show"]);

// store a new listing
Route::post('listings', [ListingController::class, "store"])
    ->middleware('auth');

// edit a listing
Route::get('/listings/{listing}/edit', [ListingController::class, "edit"])
    ->middleware('auth');

// update a listing
Route::put('/listings/{listing}', [ListingController::class, "update"])
    ->middleware('auth');

// delete a listing
Route::delete('/listings/{listing}', [ListingController::class, "destroy"])
    ->middleware('auth');

// show registration form
Route::get('/register', [UserController::class, "create"])
    ->middleware('guest');

// create a new user
Route::post('/users', [UserController::class, "store"])
    ->middleware('guest');

// show login form
Route::get('/login', [UserController::class, "login"])
    ->name('login')
    ->middleware('guest');

// log the user in
Route::post('/users/signin', [UserController::class, "signin"])
    ->middleware('guest');

// log the user out
Route::post('/logout', [UserController::class, "logout"])
    ->middleware('auth');





//    function (Listing $listing) {
////    $listing = Listing::find($id);
////    if (!$listing) {
////        abort(404);
////    }
//    return view('listing',
//        [
//            'listing' => $listing,
//        ]
//    );
//});

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
