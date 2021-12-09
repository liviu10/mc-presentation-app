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
use App\Http\Controllers\NewsletterController;

// Import the Schedule Appointment Controller file

// Import the Error and Notification System Controller file
use App\Http\Controllers\ErrorAndNotificationSystemController;

/*
|--------------------------------------------------------------------------
| FRONT VIEW WEB APPLICATION CONTROLLERS
|--------------------------------------------------------------------------
|
| Here is where you can import all the controller files that are only
| available for the front view web application. These controllers will handle
| only the HTTP requests that comes from the user.
|
*/
    // Import the Home page and the Newsletter Controller files
    use App\Http\Controllers\User\HomePage\HomeController;
    use App\Http\Controllers\User\HomePage\SubscribeToNewsletterController;

    // Import the Schedule Appointment Controller files
    use App\Http\Controllers\User\ScheduleAppointmentPage\ScheduleAppointmentController;
    use App\Http\Controllers\User\ScheduleAppointmentPage\QuestionnaireAppointmentController;
    use App\Http\Controllers\User\ScheduleAppointmentPage\BookAppointmentController;

    // Import the Blog System Controller files
    use App\Http\Controllers\User\BlogPage\BlogCategoryController;
    use App\Http\Controllers\User\BlogPage\BlogSubcategoryController;
    use App\Http\Controllers\User\BlogPage\BlogArticleController;

    // Import the About Me page Controller files
    use App\Http\Controllers\User\AboutMePage\AboutMeController;
    
    // Import the Contact Me page Controller file
    use App\Http\Controllers\User\ContactMePage\ContactMeController;

    // Import the Contact Me page Controller file
    use App\Http\Controllers\User\TermsAndConditionsPage\TermsAndConditionsController;


/*
|--------------------------------------------------------------------------
| FRONT VIEW WEB APPLICATION API ROUTES
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for the front view of the application.
| These routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['middleware' => 'guest:api', 'prefix' => '/'], function () {
    // Home page, Newsletter and Terms and Conditions page API routes
    Route::apiResource('', HomeController::class)->only(['index']);
    Route::apiResource('/subscribe', SubscribeToNewsletterController::class)->only(['store']);
    Route::apiResource('/unsubscribe', SubscribeToNewsletterController::class)->only(['destroy']);
    Route::apiResource('/terms-and-conditions', TermsAndConditionsController::class)->only(['index']);

    // Schedule Appointment page API routes
    Route::group([ 'prefix' => '/schedule-appointment' ], function () {
        Route::apiResource('/', ScheduleAppointmentController::class)->only(['index']);
        Route::apiResource('/questionnaire', QuestionnaireAppointmentController::class)->only(['index', 'store']);
        Route::apiResource('/booking', BookAppointmentController::class)->only(['index', 'store']);
    });
    
    // Blog page API routes
    Route::group([ 'prefix' => '/blog' ], function () {
        Route::get('/categories-and-subcategories', [BlogCategoryController::class, 'getAllBlogMainCategoriesAndSubcategories']);
        Route::get('/subcategory/{id}/all-written-articles', [BlogSubcategoryController::class, 'getAllBlogSubcategoryWrittenArticles']);
        Route::get('/subcategory/{id}/all-audio-articles', [BlogSubcategoryController::class, 'getAllBlogSubcategoryAudioArticles']);
        Route::get('/subcategory/{id}/all-video-articles', [BlogSubcategoryController::class, 'getAllBlogSubcategoryVideoArticles']);
        Route::group([ 'prefix' => '/articles' ], function () {
            Route::get('/all-written-articles', [BlogSubcategoryController::class, 'getAllWrittenBlogArticles']);
            Route::get('/all-audio-articles', [BlogSubcategoryController::class, 'getAllAudioBlogArticles']);
            Route::get('/all-video-articles', [BlogSubcategoryController::class, 'getAllVideoBlogArticles']);
            Route::get('/{id}', [BlogArticleController::class, 'displaySingleBlogArticle']);
        });
    });

    // About me page API routes
    Route::apiResource('/about-me', AboutMeController::class)->only(['index']);

    // Contact me page API routes
    Route::apiResource('/contact-me', ContactMeController::class)->only(['store']);
});

/* --- ADMIN ROUTES BELOW --- */
/*
|--------------------------------------------------------------------------
| API Routes for the Login & Registration System of the Web Application
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for the login & registration system
| of the application. These routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::delete('/errors-and-notification-system', [ErrorAndNotificationSystemController::class, 'deleteAllRecords']);
Route::apiResource('/errors-and-notification-system', ErrorAndNotificationSystemController::class);

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
| API Routes for the Administration View of the Web Application
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for the administration view of the application.
| These routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['middleware' => 'auth:api', 'prefix' => '/admin'], function () {
    // Newsletter system API routes
    Route::delete('/newsletter-system/delete-all', [NewsletterController::class, 'deleteAllRecords']);
    Route::apiResource('/newsletter-system', NewsletterController::class);
});