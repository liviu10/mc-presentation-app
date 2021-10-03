<?php

// Import Laravel's api settings
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Import Login and Registration System Controller files
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;

// Import the Home page and the Newsletter Controller files
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;

// Import the Schedule Appointment Controller file


// Import the Blog System Controller files
use App\Http\Controllers\Blog\BlogCategoryController;
use App\Http\Controllers\Blog\BlogSubcategoryController;
use App\Http\Controllers\Blog\BlogArticleController;
use App\Http\Controllers\Blog\BlogArticleCommentController;
use App\Http\Controllers\Blog\BlogArticleCommentReplyController;

// Import the About me page Controller file


// Import the Contact me page Controller file
use App\Http\Controllers\ContactMeController;

// Import the Error and Notification System Controller file
use App\Http\Controllers\ErrorAndNotificationSystemController;

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
    // Home page and Newsletter section API routes
    Route::apiResource('', HomeController::class);
    Route::delete('/newsletter/delete-all', [NewsletterController::class, 'deleteAllRecords']);
    Route::apiResource('/newsletter', NewsletterController::class);

    // Schedule Appointment page API routes


    // Blog System API routes
        // Blog Categories
    Route::delete('/blog-configuration/delete-all', [BlogCategoryController::class, 'deleteAllRecords']);
    Route::apiResource('/blog-configuration/categories', BlogCategoryController::class);
        // Blog Subcategories
    Route::delete('/blog-configuration/subcategories/delete-all', [BlogSubcategoryController::class, 'deleteAllRecords']);
    Route::apiResource('/blog-configuration/subcategories', BlogSubcategoryController::class);
        // Blog Articles
    Route::delete('/blog-configuration/articles/delete-all', [BlogArticleController::class, 'deleteAllRecords']);
    Route::apiResource('/blog-configuration/articles', BlogArticleController::class);
        // Blog Article Comments
    Route::delete('/blog-configuration/article-comments/delete-all', [BlogArticleCommentController::class, 'deleteAllRecords']);
    Route::apiResource('/blog-configuration/article-comments', BlogArticleCommentController::class);
        // Blog Article Comment Replies
    Route::delete('/blog-configuration/article-comment-replies/delete-all', [BlogArticleCommentReplyController::class, 'deleteAllRecords']);
    Route::apiResource('/blog-configuration/article-comment-replies', BlogArticleCommentReplyController::class);

    // About me page API routes


    // Contact me page API routes
    Route::apiResource('/contact-me', ContactMeController::class);
});

Route::delete('/errors-and-notification-system', [ErrorAndNotificationSystemController::class, 'deleteAllRecords']);
Route::apiResource('/errors-and-notification-system', ErrorAndNotificationSystemController::class);
