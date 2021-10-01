<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\BlogCategoryConfigurationController;
use App\Http\Controllers\BlogSubcategoryConfigurationController;
use App\Http\Controllers\ContactMeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\ErrorAndNotificationSystemController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [LoginController::class, 'logout']);

    Route::get('user', [UserController::class, 'current']);

    Route::patch('settings/profile', [ProfileController::class, 'update']);
    Route::patch('settings/password', [PasswordController::class, 'update']);
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'register']);

    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);

    Route::post('email/verify/{user}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend']);

    Route::post('oauth/{driver}', [OAuthController::class, 'redirect']);
    Route::get('oauth/{driver}/callback', [OAuthController::class, 'handleCallback'])->name('oauth.callback');
});

/*
|--------------------------------------------------------------------------
| API Routes for the Front View of the Web Application
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for the front view of the application.
| These routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['middleware' => 'guest:api'], function () {
    // Home page
    Route::apiResource('', HomeController::class);

    // Newsletter section
    Route::delete('/newsletter/delete-all', [NewsletterController::class, 'deleteAllRecords']);
    Route::apiResource('/newsletter', NewsletterController::class);

    // Contact me page
    Route::apiResource('/contact-me', ContactMeController::class);

    // Blog main categories
    Route::delete('/blog-configuration/categories/delete-all', [BlogCategoryConfigurationController::class, 'deleteAllRecords']);
    Route::apiResource('/blog-configuration/categories', BlogCategoryConfigurationController::class);
    
    // Blog subcategories
    Route::delete('/blog-configuration/subcategories/delete-all', [BlogSubcategoryConfigurationController::class, 'deleteAllRecords']);
    Route::apiResource('/blog-configuration/subcategories', BlogSubcategoryConfigurationController::class);
});

Route::delete('/errors-and-notification-system', [ErrorAndNotificationSystemController::class, 'deleteAllRecords']);
Route::apiResource('/errors-and-notification-system', ErrorAndNotificationSystemController::class);
