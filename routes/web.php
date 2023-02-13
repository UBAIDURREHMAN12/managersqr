<?php

use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Response\QrCodeResponse;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;


// default route for registration provided by laravel auth system
Auth::routes(['register' => false]);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// route for landing page (login page)
Route::get('/','adminController@index');
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//routes for creating custom website  page url is (http://managersqr.managershq.com.au/web)
Route::get('/web','NewQrcodeController@custom_web')->name('custom.web');
Route::get('/website/{id}','Controller@website')->name('custom.webs');

//routes for updating above created custom websites
Route::post('/updateTemplate','qrcodeController@editTemplate');
Route::get('/updateTemplate/{id}','qrcodeController@updateTemplate');

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


// this route will returns the custom qr code list
Route::get('/load/view','NewQrcodeController@LoadView')->name('list.loadview');
// this route accepts form id an returns feedback page
Route::get('/get/feedbacks/{form_id}','NewQrcodeController@GetFeedbacks')->name('get_feedbacks');
Route::get('/load/web/view','NewQrcodeController@LoadView2');

Route::get('/deleteqrcode/{id}','NewQrcodeController@deleteQr')->name('delete.qrcodes');
Route::get('find/unique/name/{name}','NewQrcodeController@FindUniqueName');

// routes for custom website create,update,delete etc (basic 4 operations)
Route::post('/store/web-content','NewQrcodeController@storeweb_content')->name('store.webcontent');
Route::get('/delete/website/{id}','NewQrcodeController@Deletewebsite')->name('delete.website');
Route::get('/edit/web-content/{id}','NewQrcodeController@editweb_content')->name('edit.webcontent');
Route::get('/edit/web/{id}','NewQrcodeController@editweb_content2')->name('edit.webcontent2');
Route::patch('/update/web-content/{id}','NewQrcodeController@updateweb_content')->name('update.webcontent');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// routes for custom qr codes
Route::post('/generateQrcode2','NewQrcodeController@store');
Route::post('/generateQr2','NewQrcodeController@generateQr');
Route::post('/fileuploader2','NewQrcodeController@fileuploader');
Route::post('/fileuploaderlogo2','NewQrcodeController@fileuploaderlogo');
Route::post('/downloadQrcode2','NewQrcodeController@createProperty');
Route::post('/downloadQrcode23','NewQrcodeController@createProperty2');
Route::post('/setUpcontent2','NewQrcodeController@downloadQrcode');
Route::get('/createQrcode2','NewQrcodeController@createQrcode');
Route::get('/createQrcode3','NewQrcodeController@createQrcode2');
Route::get('/updateQr/{id}','NewQrcodeController@updateQr')->name('update.qr');
Route::post('/downloadupdatedqr/{id}','NewQrcodeController@downloadupdatedqr')->name('download.updateqr');
Route::get('/downloadsimpleqr/{id}','NewQrcodeController@downloadsimpleqr')->name('downloadsimpleqr');
Route::get('/downloadsimpleqr2/{id}','NewQrcodeController@downloadsimpleqr2')->name('downloadsimpleqr2');
Route::get('/gallery/{id}','NewQrcodeController@gallery')->name('gallery');
Route::get('/delete/images/{id}','NewQrcodeController@deletegallery_images')->name('delete.images');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// routes to load dashboard pages for admin panel after login
Route::get('/dashboard','adminController@index')->name('dashboard');

Route::get('/vendors','vendorsController@index')->name('vendors');
Route::get('/vendors/create', 'vendorsController@create');
Route::post('/vendors/store', 'vendorsController@store');
Route::post('/vendors/destroy', 'vendorsController@destroy');
Route::post('/vendors/update', 'vendorsController@update');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// rotues related to property feedbacks
Route::post('/properties/update', 'propertiesController@update');
Route::post('/properties/propertyUpdate', 'propertiesController@propertyUpdate');
Route::post('/properties/destroy', 'propertiesController@destroy');
Route::post('/getFeedbackInfo', 'propertiesController@getFeedbackInfo');
Route::post('/feedbacks/delete', 'propertiesController@deleteFeddback');

// this route takes property id in url parameter and get logo details against it and save in sessions
Route::get('/generateQrCode/{id}','qrcodeController@index');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::post('/categories/update', 'categoriesController@update');
Route::post('/categories/destroy', 'categoriesController@destroy');

Route::get('/form/{id}', 'orderController@index');
Route::post('/submitForm', 'orderController@submitForm');
Route::get('/feedbacks', 'pdashboardropertiesController@feedbacks');
Route::get('/user/logout', 'adminController@logout');


// resoures routes with authentication for vendor , properties and categories
Route::group(['middleware' => ['auth']], function() {
    Route::resource('vendors','vendorsController');
    Route::resource('properties','propertiesController');
    Route::resource('categories','categoriesController');

});

Route::get('/properties/create', 'propertiesController@create');

//test route for encryption
Route::get('testencryption', 'propertiesController@testencryption');

Route::get('/subscription', 'adminController@subscription');


route::get('/response', function () {
    return view('response');

});
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// following is a route for just image download purpose
Route::get('/downloadImage', function () {

    $qrcode = new Generator;

    $qrcode=$image = $qrcode->format('png')
        ->merge('https://qrcodegenerator.ioptime.com/public/img/ic_logout.png', 0.5, true)
        ->size(500)->errorCorrection('H')
        ->generate('A simple example of QR code!');;
    return response($qrcode)->header('Content-type','image/png');
});
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::post('/getEditRooms', 'propertiesController@getEditRooms');

// routes related to qr codes

//this route returns this page (http://managersqr.managershq.com.au/listqrcodes) from here you can create custom qrcodes
Route::get('/listqrcodes','NewQrcodeController@listqrcodes')->name('list.qrcodes');
//this route returns this page (http://managersqr.managershq.com.au/listqrcodes) from here you can Setup Qr Code Layout
Route::get('/manageQrcode','propertiesController@index');

Route::post('/generateQrcode','qrcodeController@store');
Route::post('/test444','qrcodeController@store333')->name('ajax-crud.store');
Route::post('/generateQr','qrcodeController@generateQr');
Route::post('/fileuploader','qrcodeController@fileuploader');
Route::post('/fileuploaderlogo','qrcodeController@fileuploaderlogo');
Route::post('/downloadQrcode','qrcodeController@createProperty');
Route::post('/setUpcontent','qrcodeController@downloadQrcode');
Route::get('/createQrcode','qrcodeController@createQrcode');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/sendReport', 'orderController@sendReport');

Route::post('/setProperty', 'propertiesController@setProperty');
Route::post('/searchRecords', 'propertiesController@searchRecords');
Route::post('/searchRecordsinactive', 'propertiesController@searchRecordsinactive');

Route::get('/getFeedback/{id}', 'orderController@getFeedback');
Route::get('/feedback/{id}', 'orderController@getFeedback');

Route::post('/updateNotificationStatus', 'HomeController@updateNotificationStatus');
Route::post('/deleteNotification', 'HomeController@deleteNotification');
Route::get('/closedFeedback/{id}', 'propertiesController@closedFeedback');

Route::get('/feedback/{user}/{type}', 'propertiesController@feedbacksBytype');
Route::post('/getpropertyareainfo', 'propertiesController@getpropertyareainfo');

///////////////////////////////////////////////// /////////////////////////////////////////// ////////////////////////////////////////////////////////
// routes related to payment after registration
Route::get('payment', 'PaymentController@stripe')->name('stripe');
Route::post('stripe', 'PaymentController@stripePost')->name('stripe.post');
Route::post('subscription-payment', 'PaymentController@stripePayment')->name('stripe.payment');
Route::get('cancelSubscription', 'PaymentController@cancelSubscription');
Route::get('detachCard', 'PaymentController@detachCard');
Route::get('detachPaymentCard', 'PaymentController@detachPaymentCard');
Route::post('attachCard', 'PaymentController@attachCard');
Route::post('madePayment', 'PaymentController@madePayment');
Route::get('user_subscription', 'PaymentController@user_subscription');
Route::get('user_subscription_login', 'PaymentController@user_subscription_login');
Route::get('subscribe', 'PaymentController@subscribe');
Route::get('subscription-payment', 'PaymentController@subscriptions');
Route::get('manageUsertype', 'adminController@manageWelcomPage');
Route::post('addFeedbackType', 'adminController@addFeedbackType');
Route::get('manageUsertype', 'adminController@manageWelcomPage');
Route::get('get/usertype/{id}', 'adminController@getUserTypeData');
Route::get('update/key/{feedbackId}/{password?}', 'adminController@UpdateKey');
Route::get('manageWelcomeNote', 'adminController@manageWelcomeNote');
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// route to save , update and delete routes for feedbacks..
// feedback can be against a property
Route::post('updateFeedback', 'adminController@updateFeedback');
Route::post('deleteFeedbacktype', 'adminController@deleteFeedbacktype');
Route::post('getFeedbackType', 'orderController@getFeedbackType');
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// route to add note
Route::post('addNote', 'adminController@addNote');
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//webhook
Route::post(
    'stripe/webhook',
    '\App\Http\Controllers\WebhookController@handleCustomerSubscriptionUpdated'
);
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//cronjob
Route::get('canceledPayment', 'PaymentController@canceledPayment');
Route::post('startTrail', 'PaymentController@startTrail');
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// routes for survey questions
Route::get('survey/feedback/{id}','NewQrcodeController@FetchSurvey');
Route::get('survey/question/form/{id}','NewQrcodeController@FetchQuestionForm');
Route::post('SubmitAnswers','NewQrcodeController@SubmitAnswers');