<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes for the Presentation Website
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for the application's front view.
| These routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
|
*/

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ScheduleAppointmentController;
use App\Http\Controllers\AboutMeController;
use App\Http\Controllers\ContactMeController;
use App\Http\Controllers\BlogController;

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

Route::group(['/'], function () {
    // Route to the Home Page
    Route::get('/', [HomeController::class, 'index']);

    // Route to the Schedule Appointment Page
    Route::get('/schedule-appointment', [ScheduleAppointmentController::class, 'index']);

    // Route Group to the Blog List and Posts Page
    Route::group(['prefix' => '/blog'], function() {
        Route::get('/', [BlogController::class, 'index']);

        // Route to Blog Audio section
        Route::group(['prefix' => '/audios'], function() {
            Route::get('/list', function () { return view('pages/blog/audios/list'); });
            Route::get('/article', function () { return view('pages/blog/audios/post'); });
        });

        // Route to Blog Video section
        Route::group(['prefix' => '/videos'], function() {
            Route::get('/list', function () { return view('pages/blog/videos/list'); });
            Route::get('/article', function () { return view('pages/blog/videos/post'); });
        });

        // Route to Blog Articles section
        Route::group(['prefix' => '/articles'], function() {
            Route::get('/list', function () { return view('pages/blog/articles/list'); });
            Route::get('/article', function () { return view('pages/blog/articles/post'); });
        });
    });

    // Route to the About Me Page
    Route::get('/about-me', [AboutMeController::class, 'index']);

    // Route to the Contact Me Page
    Route::resource('/contact-me', ContactMeController::class);
});
