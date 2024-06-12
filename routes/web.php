<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StripeController;

route::get('/',[AdminController::class,'home']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        if(Auth::id())
        {
            $usertype = Auth()->user()->usertype;
            if($usertype=="user")
            {
                return view('home.index');
            }

            else if($usertype=="admin")
            {
                return view ('admin.index');
            }
            
            else
            {
                return redirect()->back();
            }
        }
    })->name('dashboard');
});
Route::get('logout', function ()
{
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logout');

route::get('/create_room',[AdminController::class,'create_room']);

route::post('/add_room',[AdminController::class,'add_room']);

route::get('/view_rooms',[AdminController::class,'view_rooms']);

route::get('/rooms', [AdminController::class, 'show_rooms'])->name('admin.show_rooms');

route::get('/room_details/{id}', [HomeController::class, 'room_details'])->name('room_details');

route::post('/add_booking/{id}', [HomeController::class, 'add_booking'])->name('add_booking');

route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings');

route::get('/mybookings', [AdminController::class, 'mybookings'])->name('mybookings');

route::get('/delete_bookings/{id}', [AdminController::class, 'delete_bookings']);

route::get('/approve_book/{id}', [AdminController::class, 'approve_book']);

route::get('/reject_book/{id}', [AdminController::class, 'reject_book']);











