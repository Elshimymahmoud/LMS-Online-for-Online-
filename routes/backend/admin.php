<?php

use App\Http\Controllers\Backend\Admin\CoursesController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\Auth\User\AccountController;
use App\Http\Controllers\Backend\Auth\User\ProfileController;
use \App\Http\Controllers\Backend\Auth\User\UpdatePasswordController;
use \App\Http\Controllers\Backend\Auth\User\UserPasswordController;
use App\Http\Controllers\DocsController;

/*
 * All route names are prefixed with 'admin.'.
 */

//===== General Routes =====//

Route::redirect('/', '/user/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');


//====Evaluate courses=====//
Route::group(['middleware' => 'role:teacher|administrator|student'], function () {
    Route::resource('answerEvaluate', 'AnswerController');

    Route::post('answerEvaluate2', ['uses' => 'AnswerController@storeResultByAdmin', 'as' => 'answerEvaluate2.byAdmin']);

    Route::post('answerEvaluateTest', ['uses' => 'AnswerController@storeResultTestByAdmin', 'as' => 'answerEvaluateTest.byAdmin']);

    Route::resource('answerImpactMeasurments', 'AnswerImpactController');
    Route::resource('answerProgramRecommendation', 'AnswerProgramRecommendation');
});

Route::group(['middleware' => 'role:teacher|administrator'], function () {
    Route::resource('orders', 'Admin\OrderController');
    Route::resource('checkout', 'Admin\CheckoutController');
});
Route::group(['middleware' => 'role:administrator|coordinator'], function () {

    //===== Teachers Routes =====//
    Route::resource('teachers', 'Admin\TeachersController');
    Route::get('get-teachers-data', ['uses' => 'Admin\TeachersController@getData', 'as' => 'teachers.get_data']);
    Route::get('get-permissions-data', ['uses' => 'Admin\PermissionsController@index', 'as' => 'tpermissions.index']);
    Route::post('teachers_mass_destroy', ['uses' => 'Admin\TeachersController@massDestroy', 'as' => 'teachers.mass_destroy']);
    Route::post('teachers_restore/{id}', ['uses' => 'Admin\TeachersController@restore', 'as' => 'teachers.restore']);
    Route::delete('teachers_perma_del/{id}', ['uses' => 'Admin\TeachersController@perma_del', 'as' => 'teachers.perma_del']);
    Route::post('teacher/status', ['uses' => 'Admin\TeachersController@updateStatus', 'as' => 'teachers.status']);
    Route::post('teachers/filter', ['uses' => 'Admin\TeachersController@filterData', 'as' => 'teachers.filter_data']);


    //===== FORUMS Routes =====//
    Route::resource('forums-category', 'Admin\ForumController');
    Route::get('forums-category/status/{id}', 'Admin\ForumController@status')->name('forums-category.status');


    Route::get('get_chapter/{id}', 'Admin\ChaptersController@get_chapter')->name('get_chapter');



    //===== Orders Routes =====//
    Route::get('get-orders-data', ['uses' => 'Admin\OrderController@getData', 'as' => 'orders.get_data']);
    Route::get('filter-orders-data', ['uses' => 'Admin\OrderController@filterData', 'as' => 'orders.filter_data']);
    Route::post('orders_mass_destroy', ['uses' => 'Admin\OrderController@massDestroy', 'as' => 'orders.mass_destroy']);
    Route::post('orders/complete', ['uses' => 'Admin\OrderController@complete', 'as' => 'orders.complete']);
    Route::delete('orders_perma_del/{id}', ['uses' => 'Admin\OrderController@perma_del', 'as' => 'orders.perma_del']);

    //===== Checkout Routes =====//
    Route::get('get-checkout-data', ['uses' => 'Admin\CheckoutController@getData', 'as' => 'checkout.get_data']);
    Route::get('filter-checkout-data', ['uses' => 'Admin\CheckoutController@filterData', 'as' => 'checkout.filter_data']);
    Route::post('checkout_mass_destroy', ['uses' => 'Admin\CheckoutController@massDestroy', 'as' => 'checkout.mass_destroy']);
    Route::post('checkout/complete', ['uses' => 'Admin\CheckoutController@complete', 'as' => 'checkout.complete']);
    Route::delete('checkout_perma_del/{id}', ['uses' => 'Admin\CheckoutController@perma_del', 'as' => 'checkout.perma_del']);


    //===== Settings Routes =====//
    Route::get('settings/landing', ['uses' => 'Admin\ConfigController@getlandingSettings', 'as' => 'landing-settings']);
    Route::post('settings/landing', ['uses' => 'Admin\ConfigController@savelandingSettings'])->name('landing-settings');

    Route::get('settings/general', ['uses' => 'Admin\ConfigController@getGeneralSettings', 'as' => 'general-settings']);

    Route::post('settings/general', ['uses' => 'Admin\ConfigController@saveGeneralSettings'])->name('general-settings');

    Route::get('settings/social', ['uses' => 'Admin\ConfigController@getSocialSettings'])->name('social-settings');

    Route::post('settings/social', ['uses' => 'Admin\ConfigController@saveSocialSettings'])->name('social-settings');

    Route::get('contact', ['uses' => 'Admin\ConfigController@getContact'])->name('contact-settings');

    Route::get('footer', ['uses' => 'Admin\ConfigController@getFooter'])->name('footer-settings');

    Route::get('newsletter', ['uses' => 'Admin\ConfigController@getNewsletterConfig'])->name('newsletter-settings');

    Route::post('newsletter/sendgrid-lists', ['uses' => 'Admin\ConfigController@getSendGridLists'])->name('newsletter.getSendGridLists');


    //===== Slider Routes =====/
    Route::resource('sliders', 'Admin\SliderController');
    Route::get('sliders/status/{id}', 'Admin\SliderController@status')->name('sliders.status', 'id');
    Route::post('sliders/save-sequence', ['uses' => 'Admin\SliderController@saveSequence', 'as' => 'sliders.saveSequence']);
    Route::post('sliders/status', ['uses' => 'Admin\SliderController@updateStatus', 'as' => 'sliders.status']);


    //===== Sponsors Routes =====//
    Route::resource('sponsors', 'Admin\SponsorController');
    Route::get('get-sponsors-data', ['uses' => 'Admin\SponsorController@getData', 'as' => 'sponsors.get_data']);
    Route::post('sponsors_mass_destroy', ['uses' => 'Admin\SponsorController@massDestroy', 'as' => 'sponsors.mass_destroy']);
    Route::get('sponsors/status/{id}', 'Admin\SponsorController@status')->name('sponsors.status', 'id');
    Route::post('sponsors/status', ['uses' => 'Admin\SponsorController@updateStatus', 'as' => 'sponsors.status']);


    //===== Sponsors Routes =====//
    Route::resource('clients', 'Admin\ClientController');
    Route::get('get-clients-data', ['uses' => 'Admin\ClientController@getData', 'as' => 'clients.get_data']);
    Route::post('clients_mass_destroy', ['uses' => 'Admin\ClientController@massDestroy', 'as' => 'clients.mass_destroy']);
    Route::get('clients/status/{id}', 'Admin\ClientController@status')->name('clients.status', 'id');
    Route::post('clients/status', ['uses' => 'Admin\ClientController@updateStatus', 'as' => 'clients.status']);

    //===== Testimonials Routes =====//
    Route::resource('testimonials', 'Admin\TestimonialController');
    Route::get('get-testimonials-data', ['uses' => 'Admin\TestimonialController@getData', 'as' => 'testimonials.get_data']);
    Route::post('testimonials_mass_destroy', ['uses' => 'Admin\TestimonialController@massDestroy', 'as' => 'testimonials.mass_destroy']);
    Route::get('testimonials/status/{id}', 'Admin\TestimonialController@status')->name('testimonials.status', 'id');
    Route::post('testimonials/status', ['uses' => 'Admin\TestimonialController@updateStatus', 'as' => 'testimonials.status']);

    //===== Banners Routes =====//
    Route::resource('banners', 'Admin\BannerController');
    Route::get('get-banners-data', ['uses' => 'Admin\BannerController@getData', 'as' => 'banners.get_data']);
    Route::post('banners_mass_destroy', ['uses' => 'Admin\BannerController@massDestroy', 'as' => 'banners.mass_destroy']);
    Route::get('banners/status/{id}', 'Admin\BannerController@status')->name('banners.status', 'id');
    Route::post('banners/status', ['uses' => 'Admin\BannerController@updateStatus', 'as' => 'banners.status']);
    // ======= Banners Routtes=====//
    // user route
    Route::get('user/is_binary/{id}', 'Auth\User\UserController@BinaryFlag')->name('users.BinaryFlag');
    Route::post('user/is_binary', ['uses' => 'Auth\User\UserController@updateBinaryFlag', 'as' => 'users.updateBinaryFlag']);
    // user route
    //===== coordinator Routes =====//
    Route::resource('coordinator', 'Admin\CoordinatorController');
    Route::get('get-coordinator-data', ['uses' => 'Admin\CoordinatorController@getData', 'as' => 'coordinator.get_data']);
    Route::post('coordinator_mass_destroy', ['uses' => 'Admin\CoordinatorController@massDestroy', 'as' => 'coordinator.mass_destroy']);
    Route::get('coordinator/status/{id}', 'Admin\CoordinatorController@status')->name('coordinator.status', 'id');
    Route::post('coordinator/status', ['uses' => 'Admin\CoordinatorController@updateStatus', 'as' => 'coordinator.status']);

    //===== courses_clints Routes =====//
    Route::resource('courses_clints', 'Admin\CoursesClintsController');
    Route::get('get-courses_clints-data', ['uses' => 'Admin\CoursesClintsController@getData', 'as' => 'courses_clints.get_data']);
    Route::post('courses_clints_mass_destroy', ['uses' => 'Admin\CoursesClintsController@massDestroy', 'as' => 'courses_clints.mass_destroy']);
    Route::get('courses_clints/status/{id}', 'Admin\CoursesClintsController@status')->name('courses_clints.status', 'id');
    Route::post('courses_clints/status', ['uses' => 'Admin\CoursesClintsController@updateStatus', 'as' => 'courses_clints.status']);

    //===== courses_groupes Routes =====//
    Route::resource('course/groups', 'Admin\CourseGroupController');
    Route::get('/courses/{course}/description', ['uses' => 'Admin\CourseGroupController@getData', 'as' => 'courses.description']);
    Route::get('/courses/{course_id}/contents', ['uses' => 'Admin\CoursesController@getContents', 'as' => 'courses.contents']);
    Route::get('get_groups_data', ['uses' => 'Admin\CourseGroupController@getGroupsData', 'as' => 'groups.get_group_data']);
    Route::get('/courses/{location}/hall', ['uses' => 'Admin\CourseGroupController@getHall', 'as' => 'courses.hall']);
    Route::post('course/groups/filter', ['uses' => 'Admin\CourseGroupController@filterData', 'as' => 'groups.filter_data']);
    Route::post('/courses/group/students/add', ['uses' => 'Admin\CourseGroupController@addStudents', 'as' => 'groups.addStudents']);
    Route::post('/courses/group/{id}/restore', ['uses' => 'Admin\CourseGroupController@restore', 'as' => 'groups.restore']);
    Route::delete('/courses/group/{id}/perma_del', ['uses' => 'Admin\CourseGroupController@forceDelete', 'as' => 'groups.perma_del']);
    Route::delete('/courses/group/students/delete', ['uses' => 'Admin\CourseGroupController@destroyStudent', 'as' => 'group.students.destroy']);
    Route::post('course/group/edit/{id}', ['uses' => 'Admin\CourseGroupController@update', 'as' => 'group.update']);
    Route::post('/courses/group/{group}/rearrange', ['uses' => 'Admin\CourseGroupController@saveRearrange', 'as' => 'group.rearrange.save']);
    Route::get('/courses/group/{group}/students',  'Admin\CourseGroupController@students')->name('group.students');
    Route::delete('/courses/group/{group}/students/detach',  'Admin\CourseGroupController@detachStudent')->name('group.students.detach');
    Route::get('/courses/groups/students',  'Admin\CourseGroupController@allstudents')->name('group.students.all');
    Route::get('/courses/groups/get-students-data',  'Admin\CourseGroupController@getStudentsData')->name('group.students.get_data');
    Route::get('/courses/groups/students/add',  'Admin\CourseGroupController@addStudentsView')->name('group.students.all.add');
    Route::get('/courses/group/{group}/students/add',  'Admin\CourseGroupController@addStudentsView')->name('group.add.students');
    Route::get('/courses/group/{group}/rearrange',  'Admin\CourseGroupController@rearrange')->name('group.rearrange','group');

    Route::get('/courses/group/{group}/lessons',  'Admin\CourseGroupLessonController@index')->name('groups.lessons','group');
    Route::get('/courses/group/{group}/get_data',  'Admin\CourseGroupLessonController@getData')->name('groups.lessons.get_data','group');
    Route::get('/courses/group/{group}/{lesson}/edit',  'Admin\CourseGroupLessonController@edit')->name('groups.lessons.edit','group', 'lesson');;
    Route::post('/courses/group/lesson/attach', ['uses' => 'Admin\CourseGroupLessonController@lessonAttachStore', 'as' => 'groups.lessons.attach']);

    Route::resource('recommendations', 'Admin\CourseGroupRecommendationController');
    Route::get('course/group/get-recommendations-data', 'Admin\CourseGroupRecommendationController@getData')->name('group.get_rec');
    Route::get('course/group/recommendations', 'Admin\CourseGroupRecommendationController@index')->name('group.recommendations');
    Route::get('course/groups/recommendations/create', 'Admin\CourseGroupRecommendationController@create')->name('groups.rec.create');
    Route::get('course/group/{group}/recommendation/create', 'Admin\CourseGroupRecommendationController@groupAttach')->name('groups.rec.attach', 'group');
    Route::get('course/group/{group}/recommendation', 'Admin\CourseGroupRecommendationController@group')->name('group.rec', 'group');
    Route::post('course/groups/recommendations/create', ['uses' => 'Admin\CourseGroupRecommendationController@store', 'as' => 'groups.rec.store']);
    Route::post('course/groups/recommendations/detach', ['uses' => 'Admin\CourseGroupRecommendationController@detach', 'as' => 'groups.rec.detach']);
    Route::post('course/group/recommendations/attach', ['uses' => 'Admin\CourseGroupRecommendationController@groupAttachStore', 'as' => 'group.rec.attach']);
    Route::get('course/groups/recommendations/edit/{recommendation}', 'Admin\CourseGroupRecommendationController@edit')->name('groups.rec.edit', 'recommendation');
    Route::post('course/groups/recommendations/{id}/restore', ['uses' => 'Admin\CourseGroupRecommendationController@restore', 'as' => 'groups.rec.restore']);
    Route::post('course/group/recommendations/activate', ['uses' => 'Admin\CourseGroupRecommendationController@activateGroupRec', 'as' => 'groups.rec.activate']);
    Route::delete('course/groups/recommendations/{id}/delete', ['uses' => 'Admin\CourseGroupRecommendationController@forceDelete', 'as' => 'groups.rec.perma_del']);

    Route::resource('impacts', 'Admin\CourseGroupImpactController');
    Route::get('course/group/get-impact-data', 'Admin\CourseGroupImpactController@getData')->name('group.get_impact');
    Route::get('course/group/impacts', 'Admin\CourseGroupImpactController@index')->name('group.impacts');
    Route::get('course/groups/impacts/create', 'Admin\CourseGroupImpactController@create')->name('groups.impacts.create');
    Route::get('course/group/{group}/impacts/create', 'Admin\CourseGroupImpactController@groupAttach')->name('groups.impacts.attach', 'group');
    Route::get('course/group/{group}/impacts', 'Admin\CourseGroupImpactController@create')->name('group.impacts.create');
    Route::get('course/group/{group}/impacts/{impact}', 'Admin\CourseGroupImpactController@getGroupImpacts')->name('group.impacts.getImpacts', 'group', 'impact');
    Route::post('course/groups/impacts/create', ['uses' => 'Admin\CourseGroupImpactController@store', 'as' => 'groups.impacts.store']);
    Route::post('course/group/impacts/detach', ['uses' => 'Admin\CourseGroupImpactController@detach', 'as' => 'groups.impacts.detach']);
    Route::post('course/group/impacts/attach', ['uses' => 'Admin\CourseGroupImpactController@groupAttachStore', 'as' => 'group.impacts.attach']);
    Route::get('course/groups/impacts/edit/{impact}', 'Admin\CourseGroupImpactController@edit')->name('groups.impacts.edit', 'impact');
    Route::post('course/group/impacts/{id}/restore', ['uses' => 'Admin\CourseGroupImpactController@restore', 'as' => 'groups.impacts.restore']);
    Route::post('course/group/impacts/activate', ['uses' => 'Admin\CourseGroupImpactController@activateGroupImpact', 'as' => 'groups.impacts.activate']);
    Route::delete('course/group/impacts/{id}/delete', ['uses' => 'Admin\CourseGroupImpactController@forceDelete', 'as' => 'groups.impacts.perma_del']);

    //  Rates
    Route::resource('rates', 'Admin\CourseGroupRatesController');
    Route::get('course/group/get-rates-data', 'Admin\CourseGroupRatesController@getData')->name('group.get_rates');
    Route::get('course/group/rates', 'Admin\CourseGroupRatesController@index')->name('group.rates');
    Route::get('course/groups/rates/create', 'Admin\CourseGroupRatesController@create')->name('groups.rates.create');
    Route::get('course/group/{group}/rates/create', 'Admin\CourseGroupRatesController@groupAttach')->name('groups.rates.attach', 'group');
    Route::get('course/group/{group}/rates', 'Admin\CourseGroupRatesController@create')->name('groups.rates', 'group');
    Route::get('course/group/{group}/rates/{rate}', 'Admin\CourseGroupRatesController@getGroupRates')->name('group.rates.getRates', 'group', 'rate');
    Route::get('course/group/rates/user', 'Admin\CourseGroupRatesController@getGroupRates2')->name('groups.rates.getUserRates');
    Route::get('course/group/{group}/rates/rate/{student}', 'Admin\CourseGroupRatesController@rateStudent')->name('groups.rates.rateStudent', 'group', 'student');
    Route::post('/{id}/restore', ['uses' => 'Admin\CourseGroupRatesController@restore', 'as' => 'groups.rates.restore']);
    Route::post('/activate', ['uses' => 'Admin\CourseGroupRatesController@activateGroupRate', 'as' => 'groups.rates.activate']);
    Route::delete('/{id}/delete', ['uses' => 'Admin\CourseGroupRatesController@forceDelete', 'as' => 'groups.rates.perma_del']);

    //  Rate Divisions
    Route::get('course/group/rates/{rate}/divisions', 'Admin\CourseGroupRatesController@divisions')->name('groups.rates.divisions');
    Route::get('course/group/get-divisions-data', 'Admin\CourseGroupRatesController@getDivisionData')->name('group.get_rate_divisions');
    Route::get('course/group/rates/{rate}/division/create', 'Admin\CourseGroupRatesController@divisionCreate')->name('groups.rate.division.create');
    Route::post('course/groups/rates/{rate}/division/create', ['uses' => 'Admin\CourseGroupRatesController@divisionStore', 'as' => 'groups.rate.division.store']);
    Route::get('course/groups/rates/division/{division}/edit', 'Admin\CourseGroupRatesController@divisionEdit')->name('groups.rate.division.edit', 'division');
    Route::put('course/groups/rates/division/{division}/update', ['uses' => 'Admin\CourseGroupRatesController@divisionUpdate', 'as' => 'groups.rate.division.update']);
    Route::delete('course/groups/rates/division/{division}/delete', ['uses' => 'Admin\CourseGroupRatesController@divisionDestroy', 'as' => 'groups.rate.division.destroy']);
    Route::post('course/groups/rates/division/{division}/restore', ['uses' => 'Admin\CourseGroupRatesController@divisionRestore', 'as' => 'groups.rate.division.restore']);
    Route::post('course/groups/rates/division/{division}/perma_del', ['uses' => 'Admin\CourseGroupRatesController@divisionForceDelete', 'as' => 'groups.rate.division.perma_del']);

    Route::post('course/groups/rates/create', ['uses' => 'Admin\CourseGroupRatesController@store', 'as' => 'groups.rates.store']);
    Route::post('course/groups/rates/detach', ['uses' => 'Admin\CourseGroupRatesController@detach', 'as' => 'groups.rates.detach']);
    Route::post('course/groups/rates/attach', ['uses' => 'Admin\CourseGroupRatesController@groupAttachStore', 'as' => 'group.rates.attach']);
    Route::get('course/groups/rates/edit/{rate}', 'Admin\CourseGroupRatesController@edit')->name('groups.rates.edit', 'rate');


    Route::get('course/groups/{group}/certificate', 'Admin\CertificateController@getCertByGroup')->name('groups.cert.edit', 'group');
    Route::get('course/students/{student}/certificate', 'Admin\CertificateController@getCertByStudent')->name('groups.student.cert.get', 'student');



    //==== courses_groups_test Routes ====//
    Route::group(['prefix' => 'courses/groups/tests'], function () {
        Route::resource('', 'Admin\CourseGroupTestController'); // Use empty string for base URI within the group
        Route::get('/all/{group}', 'Admin\CourseGroupTestController@index')->name('courses.groups.tests.index', 'group');
        Route::get('/all/{group}', 'Admin\CourseGroupTestController@index')->name('courses.groups.tests.index', 'group');
        Route::get('/create/{group}', 'Admin\CourseGroupTestController@create')->name('courses.groups.tests.create', 'group');
//        Route::post('/create', ['uses' => 'Admin\CourseGroupTestController@store', 'as' => 'courses.groups.tests.store']);
        Route::get('/edit/{group}/test/{test}', 'Admin\CourseGroupTestController@edit')->name('courses.groups.tests.edit', 'group', 'test');
        Route::get('/get-test-data', 'Admin\CourseGroupTestController@getData')->name('courses.groups.tests.get_data');

    });
    //==== courses_groups_test Routes ====//
    Route::resource('test', 'Admin\CourseGroupTestController');
    Route::group(['prefix' => 'courses/groups/tests2'], function () {
        Route::get('/all', 'Admin\CourseGroupTestController@index')->name('courses.groups.tests2.index');
        Route::get('/create', 'Admin\CourseGroupTestController@create')->name('courses.groups.tests2.create');
        Route::get('/add/{group}', 'Admin\CourseGroupTestController@showAddForm')->name('courses.groups.tests2.atttach',
            'group');
        Route::post('/create', ['uses' => 'Admin\CourseGroupTestController@store', 'as' => 'courses.groups.tests.store']);
        Route::put('/update', ['uses' => 'Admin\CourseGroupTestController@update', 'as' => 'courses.groups.tests.update']);
        Route::get('/edit/{test}', 'Admin\CourseGroupTestController@edit')->name('courses.groups.tests2.edit', 'test');
        Route::get('/results/{test?}', 'Admin\CourseGroupTestController@results')->name('courses.groups.tests2.result',
            'test');
        Route::get('/{test}/result/{result}', 'Admin\CourseGroupTestController@studentResult')->name('courses.groups.tests2.result.view', 'test', 'result');
        Route::get('/get-test-data', 'Admin\CourseGroupTestController@getData')->name('courses.groups.tests2.get_data');
        Route::get('/get-chapters-data', 'Admin\CourseGroupTestController@getCourseChapters')->name('courses.groups.tests2.get_chapters');
        Route::get('/get-test2-data', 'Admin\CourseGroupTestController@getCourseLessons')->name('courses.groups.tests2.get_lessons');
        Route::get('/rearrange/{test}', 'Admin\CourseGroupTestController@rearrange')->name('courses.groups.tests2.rearrange', 'test');
        Route::post('/rearrange', ['uses' => 'Admin\CourseGroupTestController@saveSequence', 'as' => 'courses.groups.tests2.saveSequence']);
        Route::post('/attach', ['uses' => 'Admin\CourseGroupTestController@saveGroupTest', 'as' => 'courses.groups.tests2.saveGroupTest']);
        Route::post('/markStudentAnswer', ['uses' => 'Admin\CourseGroupTestController@markStudentAnswer', 'as' => 'courses.groups.tests2.markStudentAnswer']);
        Route::delete('/detach', ['uses' => 'Admin\CourseGroupTestController@groupDetach', 'as' => 'courses.groups.tests2.detach']);
        Route::post('/{id}/restore', ['uses' => 'Admin\CourseGroupTestController@restore', 'as' => 'courses.groups.tests2.restore']);
        Route::delete('/{id}/delete', ['uses' => 'Admin\CourseGroupTestController@forceDelete', 'as' => 'courses.groups.tests2.perma_del']);
        Route::post('/activate', ['uses' => 'Admin\CourseGroupTestController@activateGroupTest', 'as' => 'courses.groups.tests2.activate']);

    });

    Route::group(['prefix' => 'courses/groups/activity'], function () {
        Route::get('/all', 'Admin\GroupActivityController@index')->name('courses.groups.activity.index');
        Route::get('/create', 'Admin\GroupActivityController@create')->name('courses.groups.activity.create');
        Route::get('/add/{group}', 'Admin\GroupActivityController@showAddForm')->name('courses.groups.activity.atttach',
            'group');
        Route::post('/create', ['uses' => 'Admin\GroupActivityController@store', 'as' => 'courses.groups.activity.store']);
        Route::put('/update', ['uses' => 'Admin\GroupActivityController@update', 'as' => 'courses.groups.activity.update']);
        Route::get('/edit/{activity}', 'Admin\GroupActivityController@edit')->name('courses.groups.activity.edit', 'activity');
        Route::get('/results/{activity?}', 'Admin\GroupActivityController@results')->name('courses.groups.activity.result',
            'test');
        Route::get('/{activity}/result/{result}', 'Admin\GroupActivityController@markResults')->name('courses.groups.activity.result.view', 'activity', 'result');
        Route::post('/{activity}/result/update', 'Admin\GroupActivityController@resultUpdate')->name('courses.groups.activity.result.update', 'activity');
        Route::get('/get-test-data', 'Admin\GroupActivityController@getData')->name('courses.groups.activity.get_data');
        Route::post('/attach', ['uses' => 'Admin\GroupActivityController@attachActivity', 'as' => 'courses.groups.activity.attachActivity']);
        Route::delete('/detach', ['uses' => 'Admin\GroupActivityController@groupDetach', 'as' => 'courses.groups.activity.detach']);
        Route::post('/{id}/restore', ['uses' => 'Admin\GroupActivityController@restore', 'as' => 'courses.groups.activity.restore']);
        Route::delete('/{id}/f_delete', ['uses' => 'Admin\GroupActivityController@forceDelete', 'as' => 'courses.groups.activity.perma_del']);
        Route::delete('/{id}/delete', ['uses' => 'Admin\GroupActivityController@destroy', 'as' => 'courses.groups.activity.destroy']);
        Route::delete('/{activity}/result/{result}/delete', ['uses' => 'Admin\GroupActivityController@resultDestroy',
            'as' => 'courses.groups.activity.result.delete']);
    });

    // course classification routes
    Route::resource('course_classification', 'Admin\CourseClassificationController');
    Route::get('get-course_classification-data', ['uses' => 'Admin\CourseClassificationController@getData', 'as' => 'course_classification.get_data']);
    Route::post('course_classification_mass_destroy', ['uses' => 'Admin\CourseClassificationController@massDestroy', 'as' => 'course_classification.mass_destroy']);
    Route::get('course_classification/status/{id}', 'Admin\CourseClassificationController@status')->name('course_classification.status', 'id');
    Route::post('course_classification/status', ['uses' => 'Admin\CourseClassificationController@updateStatus', 'as' => 'course_classification.status']);

    Route::group(['prefix' => 'certificates/templates'], function () {
        Route::get('/', 'Admin\CertificateTemplateController@index')->name('certificates.templates.index');
        Route::get('/get_data', 'Admin\CertificateTemplateController@getData')->name('certificates.templates.get_data');
        Route::get('/create', 'Admin\CertificateTemplateController@create')->name('certificates.templates.create');
        Route::post('/create', ['uses' => 'Admin\CertificateTemplateController@store', 'as' => 'certificates.templates.store']);
        Route::get('/edit/{id}', 'Admin\CertificateTemplateController@edit')->name('certificates.templates.edit', 'id');
        Route::put('/edit', ['uses' => 'Admin\CertificateTemplateController@update', 'as' => 'certificates.templates.update']);

        Route::get('/view/{template}/{certificate}', 'Admin\CertificateTemplateController@view')->name('certificates.templates.view', 'template', 'certificate');
    });

    //===== courses_place Routes =====//
    Route::resource('courses_place', 'Admin\courses_placeController');
    Route::get('get-courses_place-data', ['uses' => 'Admin\courses_placeController@getData', 'as' => 'courses_place.get_data']);
    Route::post('courses_place_mass_destroy', ['uses' => 'Admin\courses_placeController@massDestroy', 'as' => 'courses_place.mass_destroy']);
    Route::get('courses_place/status/{id}', 'Admin\courses_placeController@status')->name('courses_place.status', 'id');
    Route::post('courses_place/status', ['uses' => 'Admin\courses_placeController@updateStatus', 'as' => 'courses_place.status']);
    Route::get('courses_place/create', ['uses' => 'Admin\courses_placeController@create', 'as' => 'courses_place.create']);
    Route::get('courses_place/{id}/edit', ['uses' => 'Admin\courses_placeController@edit', 'as' => 'courses_place.edit', 'id']);

    //===== courses_place_unit Routes =====//
    Route::resource('courses_place_unit', 'Admin\CoursePlaceUnit');
    Route::get('get-courses_place_unit-data', ['uses' => 'Admin\CoursePlaceUnit@getData', 'as' => 'courses_place_unit.get_data']);
    Route::post('courses_place_unit_mass_destroy', ['uses' => 'Admin\CoursePlaceUnit@massDestroy', 'as' => 'courses_place_unit.mass_destroy']);
    Route::get('courses_place_unit/status/{id}', 'Admin\CoursePlaceUnit@status')->name('courses_place_unit.status', 'id');
    Route::post('courses_place_unit/status', ['uses' => 'Admin\CoursePlaceUnit@updateStatus', 'as' => 'courses_place_unit.status']);

    // ======= Banners Routtes=====//
    //===== Guests Routes =====//
    Route::resource('guests', 'Admin\GuestController');
    Route::get('get-guests-data', ['uses' => 'Admin\GuestController@getData', 'as' => 'guests.get_data']);
    Route::post('guests_mass_destroy', ['uses' => 'Admin\GuestController@massDestroy', 'as' => 'guests.mass_destroy']);
    Route::get('guests/status/{id}', 'Admin\GuestController@status')->name('guests.status', 'id');
    Route::post('guests/status', ['uses' => 'Admin\GuestController@updateStatus', 'as' => 'guests.status']);
    // =======Guests Routtes=====//
    //===== Banners Routes =====//
    Route::resource('acheivment', 'Admin\AcheivmentController');
    Route::get('get-acheivment-data', ['uses' => 'Admin\AcheivmentController@getData', 'as' => 'acheivment.get_data']);
    Route::post('acheivment_mass_destroy', ['uses' => 'Admin\AcheivmentController@massDestroy', 'as' => 'acheivment.mass_destroy']);
    Route::get('acheivment/status/{id}', 'Admin\AcheivmentController@status')->name('acheivment.status', 'id');
    Route::post('acheivment/status', ['uses' => 'Admin\AcheivmentController@updateStatus', 'as' => 'acheivment.status']);

    //===== course types Routes =====//
    Route::resource('courseTypes', 'Admin\CourseTypesController');
    Route::get('get-courseTypes-data', ['uses' => 'Admin\CourseTypesController@getData', 'as' => 'courseTypes.get_data']);
    Route::post('courseTypes_mass_destroy', ['uses' => 'Admin\CourseTypesController@massDestroy', 'as' => 'courseTypes.mass_destroy']);
    Route::get('courseTypes/status/{id}', 'Admin\CourseTypesController@status')->name('courseTypes.status', 'id');
    Route::post('courseTypes/status', ['uses' => 'Admin\CourseTypesController@updateStatus', 'as' => 'courseTypes.status']);

    //===== Home free Course =====//
    Route::get('home_free_course', [CoursesController::class, 'indexHomeFreeCourse'])->name('home_free_course.index');
    Route::post('home_free_course', [CoursesController::class, 'setHomeFreeCourse'])->name('home_free_course.store');


    //===== Home Service Routes =====//
    Route::resource('home_services', 'Admin\HomeServiceController');
    Route::get('get-home_services-data', ['uses' => 'Admin\HomeServiceController@getData', 'as' => 'home_services.get_data']);
    Route::post('home_services_mass_destroy', ['uses' => 'Admin\HomeServiceController@massDestroy', 'as' => 'home_services.mass_destroy']);
    Route::get('home_services/status/{id}', 'Admin\HomeServiceController@status')->name('home_services.status', 'id');
    Route::post('home_services/status', ['uses' => 'Admin\HomeServiceController@updateStatus', 'as' => 'home_services.status']);

    //===== Home Service Routes =====//
    Route::resource('methodologies', 'Admin\MethodologyController');
    Route::get('get-methodologies-data', ['uses' => 'Admin\MethodologyController@getData', 'as' => 'methodologies.get_data']);
    Route::post('methodologies_mass_destroy', ['uses' => 'Admin\MethodologyController@massDestroy', 'as' => 'methodologies.mass_destroy']);
    Route::get('methodologies/status/{id}', 'Admin\MethodologyController@status')->name('methodologies.status', 'id');
    Route::post('methodologies/status', ['uses' => 'Admin\MethodologyController@updateStatus', 'as' => 'methodologies.status']);

    //===== Home Service Routes =====//
    Route::resource('stories', 'Admin\StoryController');
    Route::get('get-stories-data', ['uses' => 'Admin\StoryController@getData', 'as' => 'stories.get_data']);
    Route::post('stories_mass_destroy', ['uses' => 'Admin\StoryController@massDestroy', 'as' => 'stories.mass_destroy']);
    Route::get('stories/status/{id}', 'Admin\StoryController@status')->name('stories.status', 'id');
    Route::post('stories/status', ['uses' => 'Admin\StoryController@updateStatus', 'as' => 'stories.status']);



    //===== Home Service Routes =====//
    Route::resource('locations', 'Admin\LocationController');
    Route::get('get-locations-data', ['uses' => 'Admin\LocationController@getData', 'as' => 'locations.get_data']);
    Route::post('locations_mass_destroy', ['uses' => 'Admin\LocationController@massDestroy', 'as' => 'locations.mass_destroy']);
    Route::get('locations/status/{id}', 'Admin\LocationController@status')->name('locations.status', 'id');
    Route::post('locations/status', ['uses' => 'Admin\LocationController@updateStatus', 'as' => 'locations.status']);

    Route::get('get-locations-data2', ['uses' => 'Admin\LocationController@getData2', 'as' => 'locations.get_data2']);



    //===== FAQs Routes =====//
    Route::resource('faqs', 'Admin\FaqController');
    Route::get('get-faqs-data', ['uses' => 'Admin\FaqController@getData', 'as' => 'faqs.get_data']);
    Route::post('faqs_mass_destroy', ['uses' => 'Admin\FaqController@massDestroy', 'as' => 'faqs.mass_destroy']);
    Route::get('faqs/status/{id}', 'Admin\FaqController@status')->name('faqs.status');
    Route::post('faqs/status', ['uses' => 'Admin\FaqController@updateStatus', 'as' => 'faqs.status']);


    //====== Contacts Routes =====//
    Route::resource('contact-requests', 'ContactController');
    Route::get('get-contact-requests-data', ['uses' => 'ContactController@getData', 'as' => 'contact_requests.get_data']);


    //====== Tax Routes =====//
    Route::resource('tax', 'TaxController');
    Route::get('tax/status/{id}', 'TaxController@status')->name('tax.status', 'id');
    Route::post('tax/status', 'TaxController@updateStatus')->name('tax.status');

    //====== Rate Routes =====//
    Route::resource('rate', 'RateController');
    Route::get('createCourseRate/{course_id}', 'RateController@createCourseRate')->name('rate.courseRate.create', 'course_id');;

    Route::get('rate/course/{course_id}', 'RateController@showCourseRate')->name('rate.course.show', 'course_id');
    Route::get('course/{course_id}/userQuestion/{user_id}', 'RateController@userQuestion')->name('userQuestion.show', 'rate_id');
    Route::resource('rateType', 'RateTypeController');
    Route::resource('question', 'QuestionController');

    // =========Impact Measurments======//

    Route::resource('impact', 'ImapctMeasurmentsController');
    Route::resource('ImpactQuestions', 'ImpactQuestionsController');

    // =========program Recommendation======//

    Route::resource('programRecommendation', 'programRecommendationController');
    Route::resource('programRecommendationQuestions', 'programRecommendationQuestionsController');

    // =========Training Data======//

    Route::resource('trainingData', 'TrainingDataController');
    Route::resource('trainingDataQuestions', 'TrainingDataQuestionsController');
    //====== Coupon Routes =====//
    Route::resource('coupons', 'CouponController');
    Route::get('coupons/status/{id}', 'CouponController@status')->name('coupons.status', 'id');
    Route::post('coupons/status', 'CouponController@updateStatus')->name('coupons.status');


    //==== Remove Locale FIle ====//
    Route::post('delete-locale', function () {
        \Barryvdh\TranslationManager\Models\Translation::where('locale', request('locale'))->delete();

        \Illuminate\Support\Facades\File::deleteDirectory(public_path('../resources/lang/' . request('locale')));
    })->name('delete-locale');


    //==== Update Theme Routes ====//
    Route::get('update-theme', 'UpdateController@index')->name('update-theme');
    Route::post('update-theme', 'UpdateController@updateTheme')->name('update-files');
    Route::post('list-files', 'UpdateController@listFiles')->name('list-files');
    Route::get('backup', 'BackupController@index')->name('backup');
    Route::get('generate-backup', 'BackupController@generateBackup')->name('generate-backup');

    Route::post('backup', 'BackupController@storeBackup')->name('backup.store');


    //===Trouble shoot ====//
    Route::get('troubleshoot', 'Admin\ConfigController@troubleshoot')->name('troubleshoot');


    //==== API Clients Routes ====//
    Route::prefix('api-client')->group(function () {
        Route::get('all', 'Admin\ApiClientController@all')->name('api-client.all');
        Route::post('generate', 'Admin\ApiClientController@generate')->name('api-client.generate');
        Route::post('status', 'Admin\ApiClientController@status')->name('api-client.status');
    });


    //==== Sitemap Routes =====//
    Route::get('sitemap', 'SitemapController@getIndex')->name('sitemap.index');
    Route::post('sitemap', 'SitemapController@saveSitemapConfig')->name('sitemap.config');
    Route::get('sitemap/generate', 'SitemapController@generateSitemap')->name('sitemap.generate');


    Route::post('translations/locales/add', 'LangController@postAddLocale');
    Route::post('translations/locales/remove', 'LangController@postRemoveLocaleFolder')->name('delete-locale-folder');
});


//Common - Shared Routes for Teacher and Administrator
Route::group(['middleware' => 'role:administrator|teacher'], function () {

    //====== Reports Routes =====//
    Route::get('report/sales', ['uses' => 'ReportController@getSalesReport', 'as' => 'reports.sales']);
    Route::get('report/students', ['uses' => 'ReportController@getStudentsReport', 'as' => 'reports.students']);


    Route::get('get-course-reports-data', ['uses' => 'ReportController@getCourseData', 'as' => 'reports.get_course_data']);
    Route::get('get-bundle-reports-data', ['uses' => 'ReportController@getBundleData', 'as' => 'reports.get_bundle_data']);
    Route::get('get-students-reports-data', ['uses' => 'ReportController@getStudentsData', 'as' => 'reports.get_students_data']);


    //====== Wallet  =====//
    Route::get('payments', ['uses' => 'PaymentController@index', 'as' => 'payments']);
    Route::get('get-earning-data', ['uses' => 'PaymentController@getEarningData', 'as' => 'payments.get_earning_data']);
    Route::get('get-withdrawal-data', ['uses' => 'PaymentController@getwithdrawalData', 'as' => 'payments.get_withdrawal_data']);
    Route::get('payments/withdraw-request', ['uses' => 'PaymentController@createRequest', 'as' => 'payments.withdraw_request']);
    Route::post('payments/withdraw-store', ['uses' => 'PaymentController@storeRequest', 'as' => 'payments.withdraw_store']);
    Route::get('payments-requests', ['uses' => 'PaymentController@paymentRequest', 'as' => 'payments.requests']);
    Route::get('get-payment-request-data', ['uses' => 'PaymentController@getPaymentRequestData', 'as' => 'payments.get_payment_request_data']);
    Route::post('payments-request-update', ['uses' => 'PaymentController@paymentsRequestUpdate', 'as' => 'payments.payments_request_update']);


    Route::get('menu-manager', ['uses' => 'MenuController@index'])->name('menu-manager');
});


//===== Categories Routes =====//
Route::resource('categories', 'Admin\CategoriesController');
Route::get('get-categories-data', ['uses' => 'Admin\CategoriesController@getData', 'as' => 'categories.get_data']);
Route::post('categories_mass_destroy', ['uses' => 'Admin\CategoriesController@massDestroy', 'as' => 'categories.mass_destroy']);
Route::post('categories_restore/{id}', ['uses' => 'Admin\CategoriesController@restore', 'as' => 'categories.restore']);
Route::delete('categories_perma_del/{id}', ['uses' => 'Admin\CategoriesController@perma_del', 'as' => 'categories.perma_del']);

// Add Students to course
Route::get('courses/addStudents', [CoursesController::class, 'addStudents'])->name('courses.add_students_to_course');
Route::get('getCourseLoc/ajax/{course_id}', [CoursesController::class, 'getCourseLocAjax'])->name('courses.getCourseLocAjax');
Route::post('storeStudentsToCourse', [CoursesController::class, 'storeStudentsToCourse'])->name('courses.storeStudentsToCourse');


Route::get('courses/removeStudents', [CoursesController::class, 'removeStudents'])->name('courses.remove_students_from_course');

Route::post('storeStudentsToCourse/remove', [CoursesController::class, 'removeStudentsFromCourse'])->name('courses.removeStudentsFromCourse');
// **********************
Route::get('courses_content', [CoursesController::class, 'index2'])->name('courses.index2');

//===== Courses Routes =====//
Route::resource('courses', 'Admin\CoursesController');
Route::get('get-courses-data-all', 'Admin\CoursesController@getCoursesData')->name('courses.getData');
Route::resource('articles', 'Admin\ArticleController');
Route::get('courses_invite', 'Admin\CoursesController@invite')->name('courses_invite');
// Route::get('courses/invite', [CoursesController::class, 'invite'])->name('courses.invite');

Route::get('courses2/all', [CoursesController::class, 'index3'])->name('courses2.index3');

Route::post('upload-image', 'Admin\CoursesController@upload')->name('upload.image');

// *************************
Route::get('all_certificates/abrove', 'Admin\CertificateController@showabrove_certificate')->name('all_certificates.abrove_certificate');
Route::get('all_certificates_online/abrove', 'Admin\CertificateController@showabrove_certificate_online')->name('all_certificates.abrove_certificate_online');

Route::get('all_certificates_online/abrove_all', 'Admin\CertificateController@abroveonline_all')->name('cirtificate.abroveonline_all');
Route::get('all_certificates/abrove_all', 'Admin\CertificateController@abrove_all')->name('cirtificate.abrove_all');

Route::get('certificates/updateshow/{id}', 'Admin\CertificateController@updateshow')->name('certificates.updateshow');
Route::post('certificates/updateshow2', 'Admin\CertificateController@updateshow2')->name('certificates.updateshow2');


// ************************
Route::get('all_certificates2', 'Admin\CertificateController@getCertificates2')->name('all_certificates.index2');

Route::get('certificatesAll/generateAll', 'CertificateController@generateAllCertByAdmin')->name('certificates.generateAll');


Route::get('all_certificates', 'Admin\CertificateController@getCertificates')->name('all_certificates.index');
Route::get('all_certificates/download', ['uses' => 'Admin\CertificateController@download', 'as' => 'all_certificates.download']);
Route::get('all_certificates/{id}', 'Admin\CertificateController@show')->name('all_certificates.show');
Route::get('certificates/delete/{id}', 'Admin\CertificateController@destroy')->name('certificates.destroy');

Route::get('certificates/showDirect/{id}/{direct?}', 'CertificateController@showCertificates')->name('certificates.showDirect');
Route::get('certificates/showDirect2/{id}/{direct?}', 'CertificateController@showCertificates2')->name('certificates.showDirect2');
Route::get('certificates/approve/{certificate}', 'Admin\CertificateController@approveStudent')->name('certificates.approveStudent', 'certificate' );
Route::get('CourseStudent', ['uses' => 'Admin\CoursesController@getCourseStudent2', 'as' => 'courses.get_course_student2']);
Route::get('CourseStudent/cirtificate', ['uses' => 'Admin\CoursesController@getCourseStudent3', 'as' => 'courses.get_course_student3']);

Route::get('CourseStudent/{course_id}', ['uses' => 'Admin\CoursesController@getCourseStudent', 'as' => 'courses.get_course_student']);
Route::get('evaluateStudent/{course_id}/{student_id}', ['uses' => 'Admin\CoursesController@evaluateStudent', 'as' => 'courses.evaluate_student']);
Route::get('CourseInvitations/{course_id}', ['uses' => 'Admin\CoursesController@getCourseInvitations', 'as' => 'courses.get_invitations']);

Route::get('get-courses-data1', ['uses' => 'Admin\CoursesController@getData1', 'as' => 'courses.get_data1']);

Route::get('get-courses-data2', ['uses' => 'Admin\CoursesController@getData2', 'as' => 'courses.get_data2']);
Route::get('get-courses-data', ['uses' => 'Admin\CoursesController@getData', 'as' => 'courses.get_data']);
Route::post('get-courses-data-filter', ['uses' => 'Admin\CoursesController@filterData', 'as' => 'courses.filter_data']);

Route::post('courses_mass_destroy', ['uses' => 'Admin\CoursesController@massDestroy', 'as' => 'courses.mass_destroy']);
Route::post('courses_restore/{id}', ['uses' => 'Admin\CoursesController@restore', 'as' => 'courses.restore']);
Route::delete('courses_perma_del/{id}', ['uses' => 'Admin\CoursesController@perma_del', 'as' => 'courses.perma_del']);
Route::post('course-save-sequence', ['uses' => 'Admin\CoursesController@saveSequence', 'as' => 'courses.saveSequence']);
Route::get('course-publish/{id}', ['uses' => 'Admin\CoursesController@publish', 'as' => 'courses.publish']);
Route::get('course/articles/{course_id}', ['uses' => 'Admin\ArticleController@showCourseBlogs', 'as' => 'courses.articles.index']);
Route::get('course/articles/create/{course_id}', ['uses' => 'Admin\ArticleController@createCourseArticle', 'as' => 'course.articles.create']);



// /Courses Location
Route::resource('courses.location', 'Admin\CourseLocationController');
Route::get('courses/{course_id}/location2', ['uses' => 'Admin\CourseLocationController@index2', 'as' => 'courses.location2.index']);


// ///Attendance
Route::resource('Attendance', 'AttendanceController');
Route::get('group/attendance', 'AttendanceController@index1')->name('Attendance.course_locations2');
Route::get('students/{student_id}/attendance', 'AttendanceController@index1')->name('students.attendance');

Route::get('AttendanceCourseLocations', 'AttendanceController@index0')->name('Attendance.course_locations');
Route::get('show/{course_id}/{group}', 'AttendanceController@show')->name('Attendance.show');


//===== Bundles Routes =====//
Route::resource('bundles', 'Admin\BundlesController');
Route::get('get-bundles-data', ['uses' => 'Admin\BundlesController@getData', 'as' => 'bundles.get_data']);
Route::post('bundles_mass_destroy', ['uses' => 'Admin\BundlesController@massDestroy', 'as' => 'bundles.mass_destroy']);
Route::post('bundles_restore/{id}', ['uses' => 'Admin\BundlesController@restore', 'as' => 'bundles.restore']);
Route::delete('bundles_perma_del/{id}', ['uses' => 'Admin\BundlesController@perma_del', 'as' => 'bundles.perma_del']);
Route::post('bundle-save-sequence', ['uses' => 'Admin\BundlesController@saveSequence', 'as' => 'bundles.saveSequence']);
Route::get('bundle-publish/{id}', ['uses' => 'Admin\BundlesController@publish', 'as' => 'bundles.publish']);


//===== chapters Routes =====//
Route::resource('chapters', 'Admin\ChaptersController');
Route::get('rearrange-chapters', ['uses' => 'Admin\ChaptersController@ReArrange', 'as' => 'chapters.rearrange']);

Route::post('chapters-save-sequence', ['uses' => 'Admin\ChaptersController@saveSequence', 'as' => 'chapters.saveSequence']);

Route::get('get-chapters-data', ['uses' => 'Admin\ChaptersController@getData', 'as' => 'chapters.get_data']);
Route::post('chapters_mass_destroy', ['uses' => 'Admin\ChaptersController@massDestroy', 'as' => 'chapters.mass_destroy']);
Route::post('chapters_restore/{id}', ['uses' => 'Admin\ChaptersController@restore', 'as' => 'chapters.restore']);
Route::delete('chapters_perma_del/{id}', ['uses' => 'Admin\ChaptersController@perma_del', 'as' => 'chapters.perma_del']);
Route::get('chapters/{id}/copy', ['uses' => 'Admin\ChaptersController@copy', 'as' => 'chapters.copy']);
Route::post('chapters/storeCopy', ['uses' => 'Admin\ChaptersController@storeCopy', 'as' => 'chapters.storeCopy']);

//===== new chapter route ===//
Route::get('chapters2/index2', ['uses' => 'Admin\ChaptersController@index2', 'as' => 'chapters2.index2']);

Route::get('get-chapters-data2', ['uses' => 'Admin\ChaptersController@getData2', 'as' => 'chapters.get_data2']);

//===== Lessons Routes =====//
Route::resource('lessons', 'Admin\LessonsController');
Route::get('lessons2', ['uses' => 'Admin\LessonsController@index2', 'as' => 'lessons.index2']);
Route::get('get-lessons-data2', ['uses' => 'Admin\LessonsController@getData2', 'as' => 'lessons.get_data2']);

Route::get('lessons/{lesson_id}/copy', ['uses' => 'Admin\LessonsController@copyLesson', 'as' => 'lessons.copy']);
Route::get('lessons/{lesson}/edit', ['uses' => 'Admin\LessonsController@edit', 'as' => 'lessons.edit', 'lesson']);



Route::get('get-lessons-data', ['uses' => 'Admin\LessonsController@getData', 'as' => 'lessons.get_data']);
Route::post('lessons_mass_destroy', ['uses' => 'Admin\LessonsController@massDestroy', 'as' => 'lessons.mass_destroy']);
Route::post('lessons_restore/{id}', ['uses' => 'Admin\LessonsController@restore', 'as' => 'lessons.restore']);
Route::delete('lessons_perma_del/{id}', ['uses' => 'Admin\LessonsController@perma_del', 'as' => 'lessons.perma_del']);
Route::post('lessons/save-sequence', ['uses' => 'Admin\LessonsController@saveSequence', 'as' => 'lessons.saveSequence']);


//===== Questions Routes =====//
Route::resource('questions', 'Admin\QuestionsController');
Route::post('storeQuestion', ['uses' => 'Admin\QuestionsController@storeQuestion', 'as' => 'questions.storeQuestion']);

Route::get('get-questions-data', ['uses' => 'Admin\QuestionsController@getData', 'as' => 'questions.get_data']);
Route::post('questions_mass_destroy', ['uses' => 'Admin\QuestionsController@massDestroy', 'as' => 'questions.mass_destroy']);
Route::post('questions_restore/{id}', ['uses' => 'Admin\QuestionsController@restore', 'as' => 'questions.restore']);
Route::delete('questions_perma_del/{id}', ['uses' => 'Admin\QuestionsController@perma_del', 'as' => 'questions.perma_del']);


//===== Questions Options Routes =====//
Route::resource('questions_options', 'Admin\QuestionsOptionsController');
Route::get('get-qo-data', ['uses' => 'Admin\QuestionsOptionsController@getData', 'as' => 'questions_options.get_data']);
Route::post('questions_options_mass_destroy', ['uses' => 'Admin\QuestionsOptionsController@massDestroy', 'as' => 'questions_options.mass_destroy']);
Route::post('questions_options_restore/{id}', ['uses' => 'Admin\QuestionsOptionsController@restore', 'as' => 'questions_options.restore']);
Route::delete('questions_options_perma_del/{id}', ['uses' => 'Admin\QuestionsOptionsController@perma_del', 'as' => 'questions_options.perma_del']);


//===== Tests Routes =====//
Route::resource('tests', 'Admin\TestsController');
Route::get('tests-ff', ['uses' => 'Admin\TestsController@ff', 'as' => 'tests.ff']);

Route::get('get-tests-data', ['uses' => 'Admin\TestsController@getData', 'as' => 'tests.get_data']);
Route::post('tests_mass_destroy', ['uses' => 'Admin\TestsController@massDestroy', 'as' => 'tests.mass_destroy']);
Route::post('tests_restore/{id}', ['uses' => 'Admin\TestsController@restore', 'as' => 'tests.restore']);
Route::delete('tests_perma_del/{id}', ['uses' => 'Admin\TestsController@perma_del', 'as' => 'tests.perma_del']);


//===== Forms Routes =====//
// Route::get('rearrange-forms', ['uses' => 'Admin\FormsController@ReArrange', 'as' => 'forms.rearrange']);
Route::post('forms-save-sequence', ['uses' => 'Admin\FormsController@saveSequence', 'as' => 'forms.saveSequence']);

Route::resource('forms', 'Admin\FormsController');
Route::get('forms/edit/{id}', 'Admin\FormsController@edit');
// Route::post('forms_store', ['uses' => 'Admin\FormsController@store2', 'as' => 'forms.store2']);

Route::get('forms/{test_id}/copy', ['uses' => 'Admin\FormsController@copyTest', 'as' => 'forms.copy']);
Route::get('forms/{test_id}/rearrange', ['uses' => 'Admin\FormsController@ReArrange', 'as' => 'forms.rearrange']);

// ===forms2====
Route::get('forms2/index2', ['uses' => 'Admin\FormsController@index2', 'as' => 'forms2.index2']);
Route::get('get-forms-data2', ['uses' => 'Admin\FormsController@getData2', 'as' => 'forms.get_data2']);


// ===================




// ===formsstudent====
Route::get('formsStudent/indexStudent', ['uses' => 'Admin\FormsController@indexStudent', 'as' => 'forms2.indexStudent']);
Route::get('get-forms-data-student', ['uses' => 'Admin\FormsController@getDataStudent', 'as' => 'forms.get_data-student']);

Route::get('formsStudent/make_evaluate', ['uses' => 'Admin\FormsController@makeStudentRate', 'as' => 'forms.make_student_rate']);
Route::get('formsStudent/make_test_answer', ['uses' => 'Admin\FormsController@makeStudentTest', 'as' => 'forms.make_student_test']);

// ===================

Route::get('get-forms-data', ['uses' => 'Admin\FormsController@getData', 'as' => 'forms.get_data']);
Route::post('forms_mass_destroy', ['uses' => 'Admin\FormsController@massDestroy', 'as' => 'forms.mass_destroy']);
Route::post('forms_restore/{id}', ['uses' => 'Admin\FormsController@restore', 'as' => 'forms.restore']);
Route::resource('forms/{id}/results', 'Admin\ResultController');

Route::get('customers/complains', ['uses' => 'Admin\FormsController@getComplainForms', 'as' => 'forms.get_complainForms']);

//===== Tests Result Routes =====//
Route::resource('tests_result', 'Admin\ResultController');
Route::get('get-tests-result-data', ['uses' => 'Admin\ResultController@getData', 'as' => 'tests_result.get_data']);
Route::post('tests-result_mass_destroy', ['uses' => 'Admin\ResultController@massDestroy', 'as' => 'tests_result.mass_destroy']);
Route::post('tests-result_restore/{id}', ['uses' => 'Admin\ResultController@restore', 'as' => 'tests_result.restore']);
Route::delete('tests-result_perma_del/{id}', ['uses' => 'Admin\ResultController@perma_del', 'as' => 'tests_result.perma_del']);
Route::get('filter-tests-result-data/', ['uses' => 'Admin\ResultController@filterData', 'as' => 'tests_result.filter_data']);
Route::post('reply_complaints/{id}', ['uses' => 'Admin\ResultController@replyComplaints', 'as' => 'reply_complaints.store']);
Route::post('tests_result-correct', ['uses' => 'Admin\ResultController@correctTest', 'as' => 'test_result.correct']);


//===== Media Routes =====//
Route::post('media/remove', ['uses' => 'Admin\MediaController@destroy', 'as' => 'media.destroy']);

Route::patch('account2/{email?}', [UserPasswordController::class, 'update2'])->name('account.post2');

//===== User Account Routes =====//
Route::group(['middleware' => ['auth', 'password_expires']], function () {
    Route::get('account', [AccountController::class, 'index'])->name('account');
    Route::get('account2', [AccountController::class, 'index2'])->name('account2');

    Route::patch('account/{email?}', [UserPasswordController::class, 'update'])->name('account.post');

    Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::patch('account/deactivate', [AccountController::class, 'deactivateAccount'])->name('account.deactivate');
});


Route::group(['middleware' => 'role:administrator|teacher'], function () {
    //====== Review Routes =====//
    Route::resource('reviews', 'ReviewController');
    Route::get('get-reviews-data', ['uses' => 'ReviewController@getData', 'as' => 'reviews.get_data']);

    //=== Tickets Routes =====//
    Route::get('/tickets', 'Admin\TicketController@index')->name('tickets.index');
    Route::get('/ticket/{ticket}', 'Admin\TicketController@show')->name('tickets.show');
    Route::get('get_ticket_data', 'Admin\TicketController@getData')->name('tickets.get_data');
    Route::post('/tickets/send', 'Admin\TicketController@index')->name('tickets.send');
    Route::post('/tickets/reply', 'Admin\TicketController@storeMessage')->name('tickets.reply');
    Route::post('/ticket/{ticket}/status', 'Admin\TicketController@updateStatus')->name('tickets.updateStatus', 'ticket');

});



Route::group(['middleware' => 'role:student|administrator'], function () {

    //==== Certificates ====//
    Route::get('certificates2', 'CertificateController@getCertificates2')->name('certificates.index2');

    Route::get('certificates', 'CertificateController@getCertificates')->name('certificates.index');
    Route::any('certificates/generate', 'CertificateController@generateCertificate')->name('certificates.generate');
    Route::get('certificates/download', ['uses' => 'CertificateController@download', 'as' => 'certificates.download']);
    Route::get('certificates/{id}', 'CertificateController@show')->name('certificates.show');
    Route::get('certificates/create_cert/{course_id}/{student_id}', 'CertificateController@generate_certificate_from_admin')->name('certificates.create_cert');
    Route::get('certificates/show/{course_id}/{student_id}', 'CertificateController@showCourseUserCertificate')->name('certificates.user.show', 'course_id', 'student_id');

    Route::get('certificates/create22/{cert_id}', 'CertificateController@generateCertificateById')->name('certificates.create_cert22');
});


//==== Messages Routes =====//
Route::get('messages', ['uses' => 'MessagesController@index', 'as' => 'messages']);
Route::post('messages/unread', ['uses' => 'MessagesController@getUnreadMessages', 'as' => 'messages.unread']);
Route::post('messages/send', ['uses' => 'MessagesController@send', 'as' => 'messages.send']);
Route::post('messages/reply', ['uses' => 'MessagesController@reply', 'as' => 'messages.reply']);

//=== Invoice Routes =====//
Route::get('invoice/download', ['uses' => 'Admin\InvoiceController@getInvoice', 'as' => 'invoice.download']);
Route::get('invoices', ['uses' => 'Admin\InvoiceController@getIndex', 'as' => 'invoices.index']);


//======= Blog Routes =====//
Route::group(['prefix' => 'blog'], function () {
    Route::get('/create', 'Admin\BlogController@create');
    Route::post('/create', 'Admin\BlogController@store');
    Route::get('delete/{id}', 'Admin\BlogController@destroy')->name('blogs.delete');
    Route::get('edit/{id}', 'Admin\BlogController@edit')->name('blogs.edit');
    Route::post('edit/{id}', 'Admin\BlogController@update');
    Route::get('view/{id}', 'Admin\BlogController@show');
    //        Route::get('{blog}/restore', 'BlogController@restore')->name('blog.restore');
    Route::post('{id}/storecomment', 'Admin\BlogController@storeComment')->name('storeComment');
});
Route::resource('blogs', 'Admin\BlogController');
Route::get('get-blogs-data', ['uses' => 'Admin\BlogController@getData', 'as' => 'blogs.get_data']);
Route::get('get-blogs-course-data/{course_id}', ['uses' => 'Admin\BlogController@getCourseData', 'as' => 'blogs.get_course_data']);


Route::post('blogs_mass_destroy', ['uses' => 'Admin\BlogController@massDestroy', 'as' => 'blogs.mass_destroy']);


//======= Pages Routes =====//
Route::resource('pages', 'Admin\PageController');
Route::get('get-pages-data', ['uses' => 'Admin\PageController@getData', 'as' => 'pages.get_data']);
Route::post('pages_mass_destroy', ['uses' => 'Admin\PageController@massDestroy', 'as' => 'pages.mass_destroy']);
Route::post('pages_restore/{id}', ['uses' => 'Admin\PageController@restore', 'as' => 'pages.restore']);
Route::delete('pages_perma_del/{id}', ['uses' => 'Admin\PageController@perma_del', 'as' => 'pages.perma_del']);


//==== Reasons Routes ====//
Route::resource('reasons', 'Admin\ReasonController');
Route::get('get-reasons-data', ['uses' => 'Admin\ReasonController@getData', 'as' => 'reasons.get_data']);
Route::post('reasons_mass_destroy', ['uses' => 'Admin\ReasonController@massDestroy', 'as' => 'reasons.mass_destroy']);
Route::get('reasons/status/{id}', 'Admin\ReasonController@status')->name('reasons.status');
Route::post('reasons/status', ['uses' => 'Admin\ReasonController@updateStatus', 'as' => 'reasons.status']);
