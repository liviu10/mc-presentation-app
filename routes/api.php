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


// Import the Blog System Controller files
use App\Http\Controllers\Blog\BlogCategoryController;
use App\Http\Controllers\Blog\BlogSubcategoryController;
use App\Http\Controllers\Blog\BlogArticleController;
use App\Http\Controllers\Blog\BlogArticleCommentController;
use App\Http\Controllers\Blog\BlogArticleCommentReplyController;

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

    // Import the About Me page Controller files
    use App\Http\Controllers\User\AboutMePage\AboutMeController;
    
    // Import the Contact Me page Controller file
    use App\Http\Controllers\User\ContactMePage\ContactMeController;


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
Route::group(['middleware' => 'guest:api'], function () {
    // Home page and Newsletter API routes
    Route::apiResource('', HomeController::class)->only(['index']);
    Route::apiResource('/subscribe', SubscribeToNewsletterController::class)->only(['store']);
    Route::apiResource('/unsubscribe', SubscribeToNewsletterController::class)->only(['destroy']);

    // Schedule Appointment page API routes
    Route::group([ 'prefix' => '/schedule-appointment' ], function () {
        Route::apiResource('/', ScheduleAppointmentController::class)->only(['index']);
        Route::apiResource('/questionnaire', QuestionnaireAppointmentController::class)->only(['index', 'store']);
        Route::apiResource('/booking', BookAppointmentController::class)->only(['index', 'store']);
    });

    // About me page API routes
    Route::apiResource('/about-me', AboutMeController::class)->only(['index']);

    // Contact me page API routes
    Route::apiResource('/contact-me', ContactMeController::class)->only(['store']);

    // Blog System API routes
    Route::group([ 'prefix' => '/blog-configuration' ], function () {
        // Blog Categories
        Route::get('/categories-and-subcategories', [BlogCategoryController::class, 'getAllBlogMainCategoriesAndSubcategories']);
        Route::delete('/categories/delete-all', [BlogCategoryController::class, 'deleteAllRecords']);

        Route::apiResource('/categories', BlogCategoryController::class);
        // Blog Subcategories
        Route::get('/subcategory/{id}/all-written-articles', [BlogSubcategoryController::class, 'getAllBlogSubcategoryWrittenArticles']);
        Route::get('/subcategory/{id}/all-audio-articles', [BlogSubcategoryController::class, 'getAllBlogSubcategoryAudioArticles']);
        Route::get('/subcategory/{id}/all-video-articles', [BlogSubcategoryController::class, 'getAllBlogSubcategoryVideoArticles']);
        Route::delete('/subcategories/delete-all', [BlogSubcategoryController::class, 'deleteAllRecords']);
        Route::apiResource('/subcategories', BlogSubcategoryController::class);

        // Blog Articles
        Route::get('/articles/all-written-articles', [BlogArticleController::class, 'getAllWrittenBlogArticles']);
        Route::get('/articles/all-audio-articles', [BlogArticleController::class, 'getAllAudioBlogArticles']);
        Route::get('/articles/all-video-articles', [BlogArticleController::class, 'getAllVideoBlogArticles']);
        Route::get('/articles/{id}', [BlogArticleController::class, 'displaySingleBlogArticle']);
        Route::delete('/articles/delete-all', [BlogArticleController::class, 'deleteAllRecords']);
        Route::apiResource('/articles', BlogArticleController::class);

        // Blog Article Comments
        Route::delete('/article-comments/delete-all', [BlogArticleCommentController::class, 'deleteAllRecords']);
        Route::apiResource('/article-comments', BlogArticleCommentController::class);

        // Blog Article Comment Replies
        Route::delete('/article-comment-replies/delete-all', [BlogArticleCommentReplyController::class, 'deleteAllRecords']);
        Route::apiResource('/article-comment-replies', BlogArticleCommentReplyController::class);
    });
});

Route::delete('/errors-and-notification-system', [ErrorAndNotificationSystemController::class, 'deleteAllRecords']);
Route::apiResource('/errors-and-notification-system', ErrorAndNotificationSystemController::class);

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