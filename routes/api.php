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
    use App\Http\Controllers\User\Auth\ProfileController;
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
        // Login and Registration page API routes
        Route::group([ 'middleware' => 'auth:api' ], function () {
            Route::post('/logout', [LoginController::class, 'logout']);
            Route::get('/user', [UserController::class, 'current']);
            Route::patch('/settings/profile', [ProfileController::class, 'update']);
            Route::patch('/settings/password', [PasswordController::class, 'update']);
        });

        // Home page, Newsletter and Terms and Conditions page API routes
        Route::apiResource('', HomeController::class)->only(['index']);
        Route::get('/display-testimonials', [HomeController::class, 'displayTestimonialSection']);
        Route::apiResource('/subscribe', SubscribeToNewsletterController::class)->only(['store']);
        Route::apiResource('/unsubscribe', SubscribeToNewsletterController::class)->only(['destroy']);
        Route::apiResource('/terms-and-conditions', TermsAndConditionsController::class)->only(['index']);

        // Schedule Appointment page API routes
        Route::group(['prefix' => '/schedule-appointment'], function () {
            Route::apiResource('/', ScheduleAppointmentController::class)->only(['index']);
            Route::apiResource('/questionnaire', QuestionnaireAppointmentController::class)->only(['index', 'store', 'show']);
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
                Route::get('/{id}/comments', [BlogSubcategoryController::class, 'displayBlogArticleComments']);
            });
            Route::group(['middleware' => 'auth:api', 'prefix' => '/appreciate'], function () {
                Route::post('/rate-article', [BlogArticleAppreciationController::class, 'rateTheArticle']);
                Route::delete('/remove-rate-article', [BlogArticleAppreciationController::class, 'removeTheRatedArticle']);
                Route::post('/like-article', [BlogArticleAppreciationController::class, 'likeTheArticle']);
                Route::delete('/remove-like-article', [BlogArticleAppreciationController::class, 'removeTheLikedArticle']);
                Route::post('/dislike-article', [BlogArticleAppreciationController::class, 'dislikeTheArticle']);
                Route::delete('/remove-dislike-article', [BlogArticleAppreciationController::class, 'removeTheDislikedArticle']);
                Route::post('/like-comment', [BlogArticleAppreciationController::class, 'likeTheComment']);
                Route::delete('/remove-like-comment', [BlogArticleAppreciationController::class, 'removeTheLikedComment']);
                Route::post('/dislike-comment', [BlogArticleAppreciationController::class, 'dislikeTheComment']);
                Route::delete('/remove-dislike-comment', [BlogArticleAppreciationController::class, 'removeTheDislikedComment']);
                Route::post('/like-comment-reply', [BlogArticleAppreciationController::class, 'likeTheCommentReply']);
                Route::delete('/remove-like-comment-reply', [BlogArticleAppreciationController::class, 'removeTheLikedCommentReply']);
                Route::post('/dislike-comment-reply', [BlogArticleAppreciationController::class, 'dislikeTheCommentReply']);
                Route::delete('/remove-dislike-comment-reply', [BlogArticleAppreciationController::class, 'removeTheDislikedCommentReply']);
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
    // Import the Blog System system
    use App\Http\Controllers\Admin\BlogSystem\BlogCategoryAndSubcategorySystemController;
    use App\Http\Controllers\Admin\BlogSystem\BlogArticleAndCommentSystemController;

    // Import the Contact Me system
    use App\Http\Controllers\Admin\ContactMeSystem\ContactMeSystemController;

    // Import the Home, Newsletter and Terms and Conditions systems
    use App\Http\Controllers\Admin\HomeSystem\NewsletterCampaignSystemController;
    use App\Http\Controllers\Admin\HomeSystem\NewsletterSubscriberSystemController;
    use App\Http\Controllers\Admin\HomeSystem\NewsletterKpiSystemController;

    // Import the Schedule Appointment system
    use App\Http\Controllers\Admin\ScheduleAppointmentSystem\ScheduleAppointmentSystemController;
    use App\Http\Controllers\Admin\ScheduleAppointmentSystem\QuestionnaireAppointmentSystemController;
    use App\Http\Controllers\Admin\ScheduleAppointmentSystem\BookAppointmentSystemController;

    // Import the Application system
    use App\Http\Controllers\Admin\System\AcceptedDomainSystemController;
    use App\Http\Controllers\Admin\System\ErrorAndNotificationSystemController;
    use App\Http\Controllers\Admin\System\LogSystemController;
    use App\Http\Controllers\Admin\System\PageSectionController;
    use App\Http\Controllers\Admin\System\UserListSystemController;

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
        Route::group([ 'prefix' => '/system' ], function () {
            // Home page System Admin API routes
            Route::group([ 'prefix' => 'home-page' ], function () {
                // User carousel sections
                Route::get('/display-carousel', [PageSectionController::class, 'displayCarouselSection']);
                Route::put('/update-carousel', [PageSectionController::class, 'updateCarouselSection']);
                // User jumbotron section
                Route::get('/display-jumbotron', [PageSectionController::class, 'displayJumbotronSection']);
                Route::put('/update-jumbotron', [PageSectionController::class, 'updateJumbotronSection']);
                // User testimonials sections
                Route::get('/display-testimonials', [PageSectionController::class, 'displayTestimonialSection']);
                Route::put('/update-testimonials', [PageSectionController::class, 'updateTestimonialSection']);
                // User footer section
                Route::get('/display-footer', [PageSectionController::class, 'displayFooterSection']);
                Route::put('/update-footer', [PageSectionController::class, 'updateFooterSection']);
                // User contact section
                Route::get('/display-contact', [PageSectionController::class, 'displayContactSection']);
                Route::put('/update-contact', [PageSectionController::class, 'updateContactSection']);
            });
            // Blog System Admin API routes
            Route::group([ 'prefix' => '/blog' ], function () {
                Route::group([ 'prefix' => '/' ], function () {
                    // Blog categories admin API routes
                    Route::get('/display-categories', [BlogCategoryAndSubcategorySystemController::class, 'displayBlogCategories']);
                    Route::post('/edit-category/{id}', [BlogCategoryAndSubcategorySystemController::class, 'editCategory']);
                    // Blog subcategories admin API routes
                    Route::get('/display-subcategories', [BlogCategoryAndSubcategorySystemController::class, 'displayBlogSubcategories']);
                    Route::post('/create-subcategory', [BlogCategoryAndSubcategorySystemController::class, 'createSubcategory']);
                    Route::post('/edit-subcategory/{id}', [BlogCategoryAndSubcategorySystemController::class, 'editSubcategory']);
                    Route::delete('/delete-subcategory/{id}', [BlogCategoryAndSubcategorySystemController::class, 'deleteSubcategory']);
                    // Blog articles admin API routes
                    Route::get('/display-articles', [BlogArticleAndCommentSystemController::class, 'displayArticles']);
                    Route::post('/create-article', [BlogArticleAndCommentSystemController::class, 'createArticle']);
                    // Blog appreciation admin API routes
                    
                    // Blog comments admin API routes
                    
                    // Blog articles and comments
                    Route::apiResource('/articles-and-comments', BlogArticleAndCommentSystemController::class)->only(['index']);
                });
                // Blog articles, appreciations & comments Admin API routes
                Route::group([ 'prefix' => '/' ], function () {
                    Route::delete('/delete-all-articles', [BlogArticleAndCommentSystemController::class, 'deleteAllArticles']);
                    // Route::apiResource('/articles-and-comments', BlogArticleAndCommentSystemController::class);
                });
            });
            // Contact me System Admin API routes
            Route::group([ 'prefix' => '/' ], function () {
                Route::delete('/contact-me/delete-all', [ContactMeSystemController::class, 'deleteAllRecords']);
                Route::post('/contact-me/respond', [ContactMeSystemController::class, 'respondToMessage']);
                Route::apiResource('/contact-me', ContactMeSystemController::class)->only(['index', 'destroy']);
            });
            // Newsletter System Admin API routes
            Route::group([ 'prefix' => '/newsletter' ], function () {
                Route::get('/logs', [NewsletterSubscriberSystemController::class, 'newsletterLogs']);
                Route::delete('/campaigns/delete-all', [NewsletterCampaignSystemController::class, 'deleteAllCampaigns']);
                Route::post('/resend-emails', [NewsletterSubscriberSystemController::class, 'newsletterResendEmails']);
                Route::post('/change-send-day', [NewsletterSubscriberSystemController::class, 'newsletterChangeSendDay']);
                Route::post('/change-welcome-template', [NewsletterSubscriberSystemController::class, 'newsletterChangeWelcomeTemplate']);
                Route::post('/change-template', [NewsletterSubscriberSystemController::class, 'newsletterChangeTemplate']);
                Route::apiResource('/campaigns', NewsletterCampaignSystemController::class)->only(['index', 'store', 'update', 'destroy']);
                Route::apiResource('/subscribers', NewsletterSubscriberSystemController::class)->only(['index']);
                Route::group([ 'prefix' => '/' ], function () {
                    Route::get('/kpi', [NewsletterKpiSystemController::class, 'displayNewsletterReportKpi']);
                    Route::get('/kpi/statistics', [NewsletterKpiSystemController::class, 'displayStatistics']);
                });
            });
            // Application Settings Admin API routes
            Route::apiResource('/accepted-domains', AcceptedDomainSystemController::class);
            Route::apiResource('/errors-and-notifications', ErrorAndNotificationSystemController::class)->only(['index', 'store', 'update']);
            Route::delete('/delete-all-logs', [LogSystemController::class, 'deleteAllLogs']);
            Route::apiResource('/logs', LogSystemController::class)->only(['index']);
            Route::apiResource('/user-list', UserListSystemController::class);
        });
        // Login and Registration System Admin API routes    
        Route::post('/logout', [LoginController::class, 'logout']);
        Route::get('/user', [UserController::class, 'current']);
        Route::patch('/settings/profile', [ProfileController::class, 'update']);
        Route::patch('/settings/password', [PasswordController::class, 'update']);
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