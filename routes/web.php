<?php

use App\Http\Controllers\DocsController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Frontend\HomeController;

/*
 * Global Routes
 * Routes that are used between both frontend and backend.
 */
Route::get('/details', function () {
    return view('detailsnew');
});
Route::get('/details2', function () {
    return view('details');
});
// Switch between the included languages
Route::get('lang/{lang}', [LanguageController::class, 'swap']);


Route::get('new', 'Frontend\HomeController@index3')->name('index');


Route::get('/sitemap-' .str_slug(config('app.name')) . '/{file?}', 'SitemapController@index');

Route::get('certificates/showDirect/{id}/{direct?}', 'Backend\CertificateController@showCertificates')->name('certificates.showDirect');

//Route to clean up demo site
Route::get('reset-demo',function (){
    ini_set('memory_limit', '-1');
    ini_set('max_execution_time', 1000);
    try{
        \Illuminate\Support\Facades\Artisan::call('refresh:site');
        return 'Refresh successful!';
    }catch (\Exception $e){
        return $e->getMessage();
    }

});


Route::redirect('/admin', '/user/dashboard', 301);

/*
 * Frontend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
    include_route_files(__DIR__ . '/frontend/');
});

/*
 * Backend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'user', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    /*
     * These routes need view-backend permission
     * (good if you want to allow more than one group in the backend,
     * then limit the backend features by different roles or permissions)
     *
     * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
     * These routes can not be hit if the password is expired
     */
    include_route_files(__DIR__ . '/backend/');
});

Route::group(['namespace' => 'Backend', 'prefix' => 'user', 'as' => 'admin.', 'middleware' => 'auth'], function () {

//==== Messages Routes =====//
    Route::get('messages', ['uses' => 'MessagesController@index', 'as' => 'messages']);
    Route::post('messages/unread', ['uses' => 'MessagesController@getUnreadMessages', 'as' => 'messages.unread']);
    Route::post('messages/send', ['uses' => 'MessagesController@send', 'as' => 'messages.send']);
    Route::post('messages/reply', ['uses' => 'MessagesController@reply', 'as' => 'messages.reply']);
});

// activate email
Route::get('activate/{id}/{code}/{byAdmin?}', 'Frontend\Auth\RegisterController@activate')->name('activate');
Route::get('sendActivate/{id}/{logged?}', 'Frontend\Auth\RegisterController@sendEmailActivate')->name('send.activate');
Route::post('answerEvaluateTraining', ['uses' => 'Backend\AnswerController@store', 'as' => 'answerEvaluateTraining.storeData']);


// ======trainingData form======

Route::get('publicTrainingDataForm', 'Backend\Auth\User\AccountController@publicTrainingDataForm')->name('publicTrainingDataForm.index');

// ===============================
// ///////////////////////////////
Route::get('certificates', 'CertificateController@getCertificates')->name('certificates.index');
Route::post('certificates/generate', 'CertificateController@generateCertificate')->name('certificates.generate');

Route::get('category/{category}/blogs', 'BlogController@getByCategory')->name('blogs.category');
Route::get('tag/{tag}/blogs', 'BlogController@getByTag')->name('blogs.tag');
Route::get('blog/{slug?}', 'BlogController@getIndex')->name('blogs.index');
Route::post('blog/{id}/comment', 'BlogController@storeComment')->name('blogs.comment');
Route::get('blog/comment/delete/{id}', 'BlogController@deleteComment')->name('blogs.comment.delete');

Route::get('teachers', 'Frontend\HomeController@getTeachers')->name('teachers.index');
Route::get('teachers/{id}/show', 'Frontend\HomeController@showTeacher')->name('teachers.show');
Route::get('teacher-details/{id}', 'TeacherController@getTeacherDetails')->name('teachers.get-details');


Route::post('newsletter/subscribe', 'Frontend\HomeController@subscribe')->name('subscribe');
Route::post('subscribe', 'Frontend\HomeController@newsletterSubscribe')->name('newsletter.subscribe');

//============Course Routes=================//
Route::get('courses', ['uses' => 'CoursesController@all', 'as' => 'courses.all']);
Route::get('course/{slug}', ['uses' => 'CoursesController@show', 'as' => 'courses.show']);
Route::get('course/{slug}/landing', ['uses' => 'CoursesController@landing', 'as' => 'courses.landing']);
Route::get('course/{slug}/landing2', ['uses' => 'CoursesController@landing2', 'as' => 'courses.landing2']);
Route::get('course/{slug}/landing3', ['uses' => 'CoursesController@landing3', 'as' => 'courses.landing2-new']);

// =========course details===============
Route::get('course/{course_slug}/Details', ['uses' => 'CoursesController@courseDetails', 'as' => 'courses.details']);

// ============================================
//Route::post('course/payment', ['uses' => 'CoursesController@payment', 'as' => 'courses.payment']);
Route::post('course/{course_id}/rating', ['uses' => 'CoursesController@rating', 'as' => 'courses.rating']);
Route::get('category/{category}/courses', ['uses' => 'CoursesController@all', 'as' => 'courses.category']);
Route::post('courses/{id}/review', ['uses' => 'CoursesController@addReview', 'as' => 'courses.review']);
Route::get('courses/review/{id}/edit', ['uses' => 'CoursesController@editReview', 'as' => 'courses.review.edit']);
Route::post('courses/review/{id}/edit', ['uses' => 'CoursesController@updateReview', 'as' => 'courses.review.update']);
Route::get('courses/review/{id}/delete', ['uses' => 'CoursesController@deleteReview', 'as' => 'courses.review.delete']);

Route::post('courses/search/', ['uses' => 'CoursesController@filterCourses', 'as' => 'courses.search']);
Route::get('courses/search/{courseType?}', ['uses' => 'CoursesController@filterCourses', 'as' => 'courses.search']);
Route::get('course/{course_id}/blogs/{slug}/{course_location_id?}', ['uses' => 'LessonsController@blog', 'as' => 'courses.blogs']);
Route::get('course/{course_id}/rate/{course_location_id?}', ['uses' => 'LessonsController@rate', 'as' => 'courses.rate']);

Route::get('course/{course_id}/impacts/{id}/{course_location_id?}', ['uses' => 'LessonsController@impacts', 'as' => 'courses.impacts']);
Route::get('course/{course_id}/programRecommendation/{id}/{course_location_id?}', ['uses' => 'LessonsController@programRecommendation', 'as' => 'courses.programRecommendations']);

// invite friends to course

Route::get('courses/inviteFriends/{course_id}/{group_id?}', ['uses' => 'CoursesController@inviteFriends', 'as' => 'courses.inviteFriends']);
Route::post('courses/sendInvitation', ['uses' => 'CoursesController@sendInvitation', 'as' => 'courses.sendInvitation']);


//============Bundle Routes=================//
Route::get('bundles', ['uses' => 'BundlesController@all', 'as' => 'bundles.all']);
Route::get('bundle/{slug}', ['uses' => 'BundlesController@show', 'as' => 'bundles.show']);
//Route::post('course/payment', ['uses' => 'CoursesController@payment', 'as' => 'courses.payment']);
Route::post('bundle/{bundle_id}/rating', ['uses' => 'BundlesController@rating', 'as' => 'bundles.rating']);
Route::get('category/{category}/bundles', ['uses' => 'BundlesController@getByCategory', 'as' => 'bundles.category']);
Route::post('bundles/{id}/review', ['uses' => 'BundlesController@addReview', 'as' => 'bundles.review']);
Route::get('bundles/review/{id}/edit', ['uses' => 'BundlesController@editReview', 'as' => 'bundles.review.edit']);
Route::post('bundles/review/{id}/edit', ['uses' => 'BundlesController@updateReview', 'as' => 'bundles.review.update']);
Route::get('bundles/review/{id}/delete', ['uses' => 'BundlesController@deleteReview', 'as' => 'bundles.review.delete']);
Route::get('test-cert', ['uses' => 'Backend\CertificateController@generateTestCertificate', 'as' => 'generateTestCertificate']);
Route::get('test-cert2', ['uses' => 'Backend\CertificateController@generateTestDomCertificate', 'as' => 'generateTestDomCertificate']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('lesson/{course_id}/{slug}/{course_location_id?}', ['uses' => 'LessonsController@show', 'as' => 'lessons.show']);
    Route::post('lesson/{slug}/test', ['uses' => 'LessonsController@test', 'as' => 'lessons.test']);
    Route::post('lesson/{slug}/activity', ['uses' => 'LessonsController@activity', 'as' => 'lessons.activity']);
    Route::post('lesson/{slug}/retest', ['uses' => 'LessonsController@retest', 'as' => 'lessons.retest']);
    Route::post('video/progress', 'LessonsController@videoProgress')->name('update.videos.progress');
    Route::post('lesson/progress', 'LessonsController@courseProgress')->name('update.course.progress');
    Route::get('certificates/success', 'Backend\CertificateController@success')->name('certificates.success');
    Route::get('certificate/success', 'Backend\CertificateController@success')->name('certificate.success');


    Route::get('course/{course_slug}/details/blogs/{course_location_id?}', ['uses' => 'CoursesController@courseDetailsBlogs', 'as' => 'courses.details.blogs']);
    Route::get('course/{course_slug}/details/rates/{course_location_id?}', ['uses' => 'CoursesController@courseDetailsRates', 'as' => 'courses.details.rates']);

});
// ==========Landing==============

Route::get('/landing', 'Backend\LandingController@index')->name('landing.index');

Route::get('/search', [HomeController::class, 'searchCourse'])->name('search');
Route::get('/search-course', [HomeController::class, 'searchCourse'])->name('search-course');
Route::get('/search-bundle', [HomeController::class, 'searchBundle'])->name('search-bundle');
Route::get('/search-blog', [HomeController::class, 'searchBlog'])->name('blogs.search');
Route::resource('RequestCourse', 'RequestCourseController');


Route::get('/faqs', 'Frontend\HomeController@getFaqs')->name('faqs');
Route::get('/about-us', 'Frontend\HomeController@about')->name('about');
Route::get('/why-ivory', 'Frontend\HomeController@why')->name('why');
Route::get('/training', 'Frontend\HomeController@training')->name('training');
Route::get('/facilitator', 'Frontend\HomeController@facilitator')->name('facilitator');

// ////////////////policies////////////
Route::get('/privacy', 'Frontend\HomeController@privacy')->name('privacy');
Route::get('/AcademicIntegrity', 'Frontend\HomeController@AcademicIntegrity')->name('AcademicIntegrity');
Route::get('/commonQuestions', 'Frontend\HomeController@commonQuestions')->name('commonQuestions');
Route::get('/page/{page}', 'Frontend\HomeController@pages')->name('pages', 'page');
Route::get('/termsConditions', 'Frontend\HomeController@termsConditions')->name('termsConditions');
Route::get('/technicalSupport', 'Frontend\HomeController@technicalSupport')->name('technicalSupport');
Route::get('/technicalSpecifications', 'Frontend\HomeController@technicalSpecifications')->name('technicalSpecifications');
Route::get('/complainments', 'Frontend\HomeController@complainments')->name('complainments');

Route::get('/documentation', 'DocsController@index')->name('documentation');
Route::get('/plan2021', 'Frontend\HomeController@plan2021')->name('plan2021');
Route::get('/plan2020', 'Frontend\HomeController@plan2020')->name('plan2020');
Route::get('/plan2022', 'Frontend\HomeController@plan2022')->name('plan2022');
Route::get('/plan2023', 'Frontend\HomeController@plan2023')->name('plan2023');
Route::get('/plan2024', 'Frontend\HomeController@plan2024')->name('plan2024');

Route::get('home_services/{id}', 'Frontend\HomeController@homeServiceDetails')->name('home_services.details', 'id');
Route::get('/returnPolicy', 'Frontend\HomeController@returnPolicy')->name('returnPolicy');
Route::get('/feePolicy', 'Frontend\HomeController@feePolicy')->name('feePolicy');


// ==========Landing==============

Route::get('/landing', 'Backend\LandingController@index')->name('landing.index');


Route::get('achievements/{id}', 'Frontend\HomeController@achievements')->name('achievements');
Route::get('all_achievements/all', 'Frontend\HomeController@AllAchievements')->name('achievements.all');

//Tickets
Route::get('/tickets', 'TicketController@index')->name('tickets.index');
Route::get('/ticket/{ticket}/show', 'TicketController@show')->name('tickets.show', 'ticket');
Route::post('/tickets/store', 'TicketController@store')->name('tickets.store');
Route::post('/tickets/send', 'TicketController@send')->name('tickets.send');
//Route::resource('tickets', 'TicketController');

//Notifications
Route::get('/notifications/read/{id}', 'NotificationController@markAsRead')->name('notifications.read');

//Group Chat
Route::post('/course-group-chats/send/{group}', 'GroupChatController@send')->name('group.chat.send', 'group');

/*=============== Theme blades routes ends ===================*/


Route::get('contact', 'Frontend\ContactController@index')->name('contact');
Route::post('contact/send', 'Frontend\ContactController@send')->name('contact.send');


Route::get('download', ['uses' => 'Frontend\HomeController@getDownload', 'as' => 'download']);

Route::post('cart/checkout', ['uses' => 'CartController@checkout', 'as' => 'cart.checkout']);
Route::post('cart/add', ['uses' => 'CartController@addToCart', 'as' => 'cart.addToCart']);
Route::get('cart', ['uses' => 'CartController@index', 'as' => 'cart.index']);
Route::get('cart/clear', ['uses' => 'CartController@clear', 'as' => 'cart.clear']);
Route::get('cart/remove', ['uses' => 'CartController@remove', 'as' => 'cart.remove']);
Route::post('cart/apply-coupon',['uses' => 'CartController@applyCoupon','as'=>'cart.applyCoupon']);
Route::post('cart/remove-coupon',['uses' => 'CartController@removeCoupon','as'=>'cart.removeCoupon']);

Route::group(['middleware' => 'auth'], function () {

    Route::post('cart/stripe-payment', ['uses' => 'CartController@stripePayment', 'as' => 'cart.stripe.payment']);
    Route::post('cart/paypal-payment', ['uses' => 'CartController@paypalPayment', 'as' => 'cart.paypal.payment']);
    Route::get('cart/paypal-payment/status', ['uses' => 'CartController@getPaymentStatus'])->name('cart.paypal.status');

    Route::get('status', function () {
        return view('frontend.cart.status');
    })->name('status');
    Route::post('cart/offline-payment', ['uses' => 'CartController@offlinePayment', 'as' => 'cart.offline.payment']);
    Route::post('cart/getnow',['uses'=>'CartController@getNow','as' =>'cart.getnow']);

    // ///////////Fatoorah routes//////////////////
    Route::post('cart/fatoorahPay', ['uses' => 'CartController@fatoorahPayment'])->name('cart.fatoorah.pay');
    Route::get('cart/fatoorahSuccess', ['uses' => 'CartController@fatoorahSuccess'])->name('cart.fatoorah.success');
    Route::get('cart/fatoorahFail', ['uses' => 'CartController@fatoorahFail'])->name('cart.fatoorah.fail');

    Route::post('cart/tabby', ['uses' => 'CartController@tabbyPayment'])->name('cart.tabby.pay');
    Route::post('cart/jeel', ['uses' => 'CartController@jeelPayment'])->name('cart.jeel.pay');
    Route::get('cart/jeel/callback', ['uses' => 'CartController@jeelSuccess'])->name('cart.jeel.callback');


});

//============= Menu  Manager Routes ===============//
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'middleware' => config('menu.middleware')], function () {
    //Route::get('wmenuindex', array('uses'=>'\Harimayco\Menu\Controllers\MenuController@wmenuindex'));
    Route::post('add-custom-menu', 'MenuController@addcustommenu')->name('haddcustommenu');
    Route::post('delete-item-menu', 'MenuController@deleteitemmenu')->name('hdeleteitemmenu');
    Route::post('delete-menug', 'MenuController@deletemenug')->name('hdeletemenug');
    Route::post('create-new-menu', 'MenuController@createnewmenu')->name('hcreatenewmenu');
    Route::post('generate-menu-control', 'MenuController@generatemenucontrol')->name('hgeneratemenucontrol');
    Route::post('update-item', 'MenuController@updateitem')->name('hupdateitem');
    Route::post('save-custom-menu', 'MenuController@saveCustomMenu')->name('hcustomitem');
    Route::post('change-location', 'MenuController@updateLocation')->name('update-location');
});

Route::get('certificate-verification','Backend\CertificateController@getVerificationForm')->name('frontend.certificates.getVerificationForm');
Route::post('certificate-verification','Backend\CertificateController@verifyCertificate')->name('frontend.certificates.verify');
Route::get('certificates/download', ['uses' => 'Backend\CertificateController@download', 'as' => 'certificates.download']);
Route::get('certificates/{certificate}', 'Backend\CertificateController@showCertificates')->name('certificates.show');

Route::post('course/{course}/{group}/{lesson}/finished', ['uses' => 'Backend\AttendanceController@finished','as' =>'courses.markAsFinished']);
Route::post('course/{course}/{group}/{lesson}/present', ['uses' => 'Backend\AttendanceController@present','as' =>'courses.markAsPresent']);

if(config('show_offers') == 1){
    Route::get('offers',['uses' => 'CartController@getOffers', 'as' => 'frontend.offers']);
}

Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
    Route::get('/{page?}', [HomeController::class, 'index2'])->name('index');
});

