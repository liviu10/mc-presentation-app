<?php

// Import Laravel's api settings
use Illuminate\Support\Facades\Route;

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
    // Import the Home page, Newsletter and the Terms and conditions Controller files
    use App\Http\Controllers\User\HomePage\HomeController;
    use App\Http\Controllers\User\HomePage\SubscribeToNewsletterController;
    use App\Http\Controllers\User\HomePage\TermsAndConditionsController;

    // Import the Schedule Appointment Controller files
    use App\Http\Controllers\User\ScheduleAppointmentPage\ScheduleAppointmentController;
    use App\Http\Controllers\User\ScheduleAppointmentPage\QuestionnaireAppointmentController;
    use App\Http\Controllers\User\ScheduleAppointmentPage\BookAppointmentController;

    // Import the Blog System Controller files
    use App\Http\Controllers\User\BlogPage\BlogCategoryController;
    use App\Http\Controllers\User\BlogPage\BlogSubcategoryController;
    use App\Http\Controllers\User\BlogPage\BlogArticleCommentController;
    use App\Http\Controllers\User\BlogPage\BlogArticleAppreciationController;

    // Import the About Me page Controller files
    use App\Http\Controllers\User\AboutMePage\AboutMeController;
    
    // Import the Contact Me page Controller file
    use App\Http\Controllers\User\ContactMePage\ContactMeController;

    // Import User Login and Registration System Controller files
    use App\Http\Controllers\User\Auth\ForgotPasswordController;
    use App\Http\Controllers\User\Auth\LoginController;
    use App\Http\Controllers\User\Auth\OAuthController;
    use App\Http\Controllers\User\Auth\RegisterController;
    use App\Http\Controllers\User\Auth\ResetPasswordController;
    use App\Http\Controllers\User\Auth\UserController;
    use App\Http\Controllers\User\Auth\VerificationController;
    use App\Http\Controllers\User\Settings\PasswordController;
    use App\Http\Controllers\User\Settings\ProfileController;
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
    Route::group(['prefix' => '/'], function () {
        // Home page, Newsletter and Terms and Conditions page API routes
        Route::apiResource('', HomeController::class)->only(['index']);
        Route::apiResource('/subscribe', SubscribeToNewsletterController::class)->only(['store']);
        Route::apiResource('/unsubscribe', SubscribeToNewsletterController::class)->only(['destroy']);
        Route::apiResource('/terms-and-conditions', TermsAndConditionsController::class)->only(['index']);

        // Schedule Appointment page API routes
        Route::group(['prefix' => '/schedule-appointment'], function () {
            Route::apiResource('/', ScheduleAppointmentController::class)->only(['index']);
            Route::apiResource('/questionnaire', QuestionnaireAppointmentController::class)->only(['index', 'store', 'show']);
            Route::apiResource('/booking', BookAppointmentController::class)->only(['index', 'store']);
        });
        
        // Blog page API routes
        Route::group(['prefix' => '/blog'], function () {
            Route::get('/categories-and-subcategories', [BlogCategoryController::class, 'getAllBlogMainCategoriesAndSubcategories']);
            Route::group([ 'prefix' => '/subcategory' ], function () {
                Route::get('/{id}/all-written-articles', [BlogSubcategoryController::class, 'getAllBlogSubcategoryWrittenArticles']);
                Route::get('/{id}/all-audio-articles', [BlogSubcategoryController::class, 'getAllBlogSubcategoryAudioArticles']);
                Route::get('/{id}/all-video-articles', [BlogSubcategoryController::class, 'getAllBlogSubcategoryVideoArticles']);
            });
            Route::group([ 'prefix' => '/articles' ], function () {
                Route::get('/all-written-articles', [BlogSubcategoryController::class, 'getAllWrittenBlogArticles']);
                Route::get('/all-audio-articles', [BlogSubcategoryController::class, 'getAllAudioBlogArticles']);
                Route::get('/all-video-articles', [BlogSubcategoryController::class, 'getAllVideoBlogArticles']);
                Route::group([ 'prefix' => '/related' ], function () {
                    Route::get('/written-articles/{id}', [BlogSubcategoryController::class, 'displayRelatedWrittenArticle']);
                    Route::get('/audio-articles/{id}', [BlogSubcategoryController::class, 'displayRelatedAudioArticle']);
                    Route::get('/video-articles/{id}', [BlogSubcategoryController::class, 'displayRelatedVideoArticle']);
                });
                Route::get('/{id}', [BlogSubcategoryController::class, 'displaySingleBlogArticle']);
            });
            Route::group(['middleware' => 'auth:api', 'prefix' => '/appreciate'], function () {
                Route::post('/rate-article', [BlogArticleAppreciationController::class, 'rateTheArticle']);
                Route::post('/like-article', [BlogArticleAppreciationController::class, 'likeTheArticle']);
                Route::post('/dislike-article', [BlogArticleAppreciationController::class, 'dislikeTheArticle']);
                Route::post('/like-comment', [BlogArticleAppreciationController::class, 'likeTheComment']);
                Route::post('/dislike-comment', [BlogArticleAppreciationController::class, 'dislikeTheComment']);
                Route::post('/like-comment-reply', [BlogArticleAppreciationController::class, 'likeTheCommentReply']);
                Route::post('/dislike-comment-reply', [BlogArticleAppreciationController::class, 'dislikeTheCommentReply']);
                Route::post('/add-new', [BlogArticleCommentController::class, 'addNewComment']);
                Route::post('/respond-to-comment', [BlogArticleCommentController::class, 'respondToComment']);
                Route::post('/respond-to-reply', [BlogArticleCommentController::class, 'respondToCommentReply']);
            });
        });

        // About me page API routes
        Route::apiResource('/about-me', AboutMeController::class)->only(['index']);

        // Contact me page API routes
        Route::apiResource('/contact-me', ContactMeController::class)->only(['store']);
    });

/*
|--------------------------------------------------------------------------
| ADMIN VIEW WEB APPLICATION CONTROLLERS
|--------------------------------------------------------------------------
|
| Here is where you can import all the controller files that are only
| available for the front view web application. These controllers will handle
| only the HTTP requests that comes from the user.
|
*/
    // Import the Home, Newsletter and Terms and Conditions Admin Controller files
    use App\Http\Controllers\Admin\HomeSystem\HomeSystemController;
    use App\Http\Controllers\Admin\HomeSystem\NewsletterSystemController;
    use App\Http\Controllers\Admin\HomeSystem\TermsAndConditionsSystemController;

    // Import the Schedule Appointment Admin Controller files
    use App\Http\Controllers\Admin\ScheduleAppointmentSystem\ScheduleAppointmentSystemController;
    use App\Http\Controllers\Admin\ScheduleAppointmentSystem\QuestionnaireAppointmentSystemController;
    use App\Http\Controllers\Admin\ScheduleAppointmentSystem\BookAppointmentSystemController;

    // Import the Blog System Controller files
    use App\Http\Controllers\Admin\BlogSystem\BlogCategorySystemController;
    use App\Http\Controllers\Admin\BlogSystem\BlogSubcategorySystemController;
    use App\Http\Controllers\Admin\BlogSystem\BlogArticleSystemController;
    use App\Http\Controllers\Admin\BlogSystem\BlogArticleCommentSystemController;
    use App\Http\Controllers\Admin\BlogSystem\BlogArticleCommentReplySystemController;

    // Import the About Me page Controller files
    use App\Http\Controllers\Admin\AboutMeSystem\AboutMeSystemController;
    
    // Import the Contact Me page Controller file
    use App\Http\Controllers\Admin\ContactMeSystem\ContactMeSystemController;    

    // Import Login and Registration System Controller files
    // use App\Http\Controllers\Auth\ForgotPasswordController;
    // use App\Http\Controllers\Auth\LoginController;
    // use App\Http\Controllers\Auth\OAuthController;
    // use App\Http\Controllers\Auth\RegisterController;
    // use App\Http\Controllers\Auth\ResetPasswordController;
    // use App\Http\Controllers\Auth\UserController;
    // use App\Http\Controllers\Auth\VerificationController;
    // use App\Http\Controllers\Settings\PasswordController;
    // use App\Http\Controllers\Settings\ProfileController;
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
        // Login and Registration System Admin API routes    
        Route::post('/logout', [LoginController::class, 'logout']);
        Route::get('/user', [UserController::class, 'current']);
        Route::patch('/settings/profile', [ProfileController::class, 'update']);
        Route::patch('/settings/password', [PasswordController::class, 'update']);

        // Home, Newsletter and Terms and Conditions System Admin API routes
        Route::apiResource('', HomeSystemController::class);
        Route::group([ 'prefix' => '/newsletter-system' ], function () {
            Route::delete('/newsletter-system/delete-all', [NewsletterSystemController::class, 'deleteAllRecords']);
            Route::apiResource('/', NewsletterSystemController::class);
        });
        Route::apiResource('/terms-and-conditions', TermsAndConditionsSystemController::class)->only(['index']);

        // Schedule Appointment System Admin API routes
        Route::group([ 'prefix' => '/schedule-appointment-system' ], function () {
            Route::apiResource('/', ScheduleAppointmentSystemController::class)->only(['index']);
            Route::apiResource('/questionnaire', QuestionnaireAppointmentSystemController::class)->only(['index', 'store']);
            Route::apiResource('/booking', BookAppointmentSystemController::class)->only(['index', 'store']);
        });

        // Blog System Admin API routes
        Route::group([ 'prefix' => '/blog-system' ], function () {
            // Blog categories Admin API routes
            Route::delete('/delete-all-categories', [BlogCategorySystemController::class, 'deleteAllRecords']);
            Route::apiResource('/categories', BlogCategorySystemController::class);

            // Blog subcategories Admin API routes
            Route::delete('/delete-all-subcategories', [BlogSubcategorySystemController::class, 'deleteAllRecords']);
            Route::apiResource('/subcategories', BlogSubcategorySystemController::class);

            // Blog articles Admin API routes
            Route::delete('/delete-all-articles', [BlogArticleSystemController::class, 'deleteAllRecords']);
            Route::apiResource('/articles', BlogArticleSystemController::class);

            // Blog article comments Admin API routes
            Route::delete('/delete-all-comments', [BlogArticleCommentSystemController::class, 'deleteAllRecords']);
            Route::apiResource('/comments', BlogArticleCommentSystemController::class);

            // Blog article comment replies Admin API routes
            Route::delete('/delete-all-replies', [BlogArticleCommentReplySystemController::class, 'deleteAllRecords']);
            Route::apiResource('/replies', BlogArticleCommentReplySystemController::class);
        });

        // About me System Admin API routes
        Route::apiResource('/about-me-system', AboutMeSystemController::class);

        // Contact me System Admin API routes
        Route::apiResource('/contact-me-system', ContactMeSystemController::class);
    });
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