<?php

use Illuminate\Support\Facades\Route;
use Spatie\GoogleCalendar\Event;

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

// Route::get('/welcome', function () {
//     return view('welcome');
// });

Route::get('/test-calendar', function () {
    $addEvent = new Event;
    $addEvent->name = 'Test 1 - Laravel Web Application';
    $addEvent->startDateTime = Carbon\Carbon::now();
    $addEvent->endDateTime = Carbon\Carbon::now()->addHour();
    $addEvent->description = 'This is a test description';

    $addEvent->save();


    $e = Event::get();
    dd($e);
});
