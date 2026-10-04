<?php

use App\Http\Controllers\WelcomeController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CoronaupdateController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\ZilaController;
use App\Http\Controllers\Admin\UpazilaController;
use App\Http\Controllers\Admin\UnionController;
use App\Http\Controllers\Admin\GramController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\SellController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ChalanController;
use App\Http\Controllers\Admin\ContactusController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\IncomeExpenseCategoryController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\MonthlyCollectionController;
use App\Http\Controllers\Admin\IncomeExpenseController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\WorkController;
use App\Http\Controllers\BkashTokenizePaymentController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\PaypalPaymentController;
use App\Http\Controllers\ShurjopayPaymentController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('config_cache', function () {
    Artisan::call('config:cache');

    return "Config-Cache is cleared";
});


Route::get('/', [WelcomeController::class, 'index'])->name('/');
Route::get('works', [WelcomeController::class, 'works'])->name('works');
Route::get('aboutus', [WelcomeController::class, 'aboutus'])->name('aboutus');
Route::get('enquiry', [WelcomeController::class, 'enquiry'])->name('enquiry');
Route::get('contactus', [WelcomeController::class, 'contactus'])->name('contactus');
Route::post('submit_message', [WelcomeController::class, 'submit_message'])->name('submit_message');
Route::post('submit_enquiry', [WelcomeController::class, 'submit_enquiry'])->name('submit_enquiry');
Route::get('service/{slug}', [WelcomeController::class, 'service_details'])->name('service');



// Payment Routes for bKash
Route::get('/bkash/payment', [BkashTokenizePaymentController::class, 'index']);
Route::get('/bkash/create-payment', [BkashTokenizePaymentController::class, 'createPayment'])->name('bkash-create-payment');
Route::get('bkash-callBack', [BkashTokenizePaymentController::class, 'callBack'])->name('bkash-callBack');
Route::get('bkash-payment-cancel', [BkashTokenizePaymentController::class, 'bkash_payment_cancel'])->name('bkash-payment-cancel');


//shurjopay
Route::get('success-url', [ShurjopayPaymentController::class, 'verifyPayment']);
Route::get('cancel-url', [ShurjopayPaymentController::class, 'cancelPayemnt']);


//Paypal
Route::get('handle-payment/{pay_amount}/{project_id}/{income_expense_category_id}', [PaypalPaymentController::class, 'paypalHandle'])->name('make.payment');
Route::get('cancel-payment', [PaypalPaymentController::class, 'paymentCancel'])->name('cancel.payment');
Route::get('payment-success/{pay_amount}/{project_id}/{income_expense_category_id}', [PaypalPaymentController::class, 'paymentSuccess'])->name('success.payment');


//Stripe
Route::get('success/{pay_amount}/{project_id}/{income_expense_category_id}', [StripePaymentController::class, 'success'])->name('stripe.success');


Route::prefix('client')->group(function () {
    Route::get('/login', [ClientController::class, 'login'])->name('client.login');
    Route::post('/submit_login', [ClientController::class, 'submit_login'])->name('client.submit_login');

    Route::get('/dashboard', [ClientController::class, 'dashboard'])->name('client.dashboard');
    Route::get('/account-details', [ClientController::class, 'account_details'])->name('client.account-details');
    Route::get('/logout', [ClientController::class, 'logout'])->name('client.logout');

    Route::get('/projects', [ClientController::class, 'projects'])->name('client.projects');
    Route::get('/make-payment/{id}', [ClientController::class, 'make_payment'])->name('client.make-payment');


    Route::get('make-online-payment', [ClientController::class, 'make_online_payment'])->name('client.make-online-payment');


});


Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'login']);
    Route::get('/dashboard', [AdminController::class, 'home'])->name('dashboard');
    Route::post('/login', [AdminController::class, 'admin_login'])->name('admin-login');
    Route::get('/logout', [AdminController::class, 'admin_logout'])->name('admin-logout');
    Route::get('/forget-password', 'AdminController@forget_password')->name('forget-password');
    Route::group(['middleware' => ['AdminUserMiddleWare']], function () {
        Route::get('/dashboard', [AdminController::class, 'home'])->name('dashboard');
        Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
        Route::post('/profile', [AdminController::class, 'save_profile'])->name('save-profile');
        Route::get('/change-password', [AdminController::class, 'change_password'])->name('change-password');
        Route::post('/save-password', [AdminController::class, 'save_password'])->name('save-password');
        //website setting
        Route::get('/site-setting', [SettingController::class, 'setting'])->name('site-setting');
        Route::post('/save-logo', [SettingController::class, 'save_logo'])->name('save-logo');
        Route::post('/save-favicon', [SettingController::class, 'save_favicon'])->name('save-favicon');
        Route::post('/save-site-info/{id}', [SettingController::class, 'save_site_info'])->name('save-site-info');
        Route::post('/save-social-link/{id}', [SettingController::class, 'save_social_link'])->name('save-social-link');
        Route::post('/save-seo/{id}', [SettingController::class, 'save_seo'])->name('save-seo');


        //tag
        Route::resource('tag', TagController::class);
        //subject
        Route::resource('subject', SubjectController::class);
        //subscription
        Route::resource('subscription', SubscriptionController::class);
        //role
        Route::resource('role', RoleController::class);
        Route::get('add-permission', [RoleController::class, 'add_permission'])->name('add-permission');
        Route::post('submit-permission', [RoleController::class, 'submit_permission'])->name('submit-permission');
        Route::get('edit-permission/{id}', [RoleController::class, 'edit_permission'])->name('edit-permission');
        Route::post('update-permission/{id}', [RoleController::class, 'update_permission'])->name('update-permission');
        //admins
        Route::resource('admins', AdminUserController::class);
        //post
        Route::resource('post', PostController::class);
        //banner
        Route::resource('banner', BannerController::class);


        //division
        Route::resource('division', DivisionController::class);

        //zila
        Route::resource('zila', ZilaController::class);

        //upazila
        Route::resource('upazila', UpazilaController::class);

        //union
        Route::resource('union', UnionController::class);

        //gram
        Route::resource('gram', GramController::class);

        Route::get('/corona', [CoronaupdateController::class, 'corona'])->name('corona');
        Route::post('/update-corona-news/{id}', [CoronaupdateController::class, 'update_corona_news'])->name('update-corona-news');




        //Stock management
        //category
        Route::resource('category', CategoryController::class);


        //income_expense_category
        Route::resource('income_expense_category', IncomeExpenseCategoryController::class);


        //subcategory
        Route::resource('subcategory', SubcategoryController::class);

        //brand
        Route::resource('brand', BrandController::class);

        //unit
        Route::resource('unit', UnitController::class);

        //project
        Route::resource('project', ProjectController::class);
        Route::get('filter_project', [ProjectController::class, 'filter_project'])->name('admin/filter_project');



        //technology
        Route::resource('technology', TechnologyController::class);


        //service
        Route::resource('service', ServiceController::class);

        //work
        Route::resource('work', WorkController::class);

        //review
        Route::resource('review', ReviewController::class);

        //enquiry
        Route::resource('enquiry', EnquiryController::class);
        Route::get('pending_enquiry', [EnquiryController::class, 'pending_enquiry'])->name('admin/pending_enquiry');


        //enquiry
        Route::resource('contact_us', ContactusController::class);
        Route::get('pending_contact_us', [ContactusController::class, 'pending_contact_us'])->name('admin/pending_contact_us');


        //chalan
        Route::resource('chalan', ChalanController::class);
        Route::post('filter_chalan', [ChalanController::class, 'filter_chalan'])->name('admin/filter_chalan');
        Route::get('chalan_invoice/{id}', [ChalanController::class, 'invoice'])->name('admin/invoice');


        //product
        Route::resource('product', ProductController::class);
        Route::post('filter_product', [ProductController::class, 'filter_product'])->name('admin/filter_product');

        //company
        Route::resource('company', CompanyController::class);

        //sell
        Route::resource('sell', SellController::class);
        Route::post('filter_sell', [SellController::class, 'filter_sell'])->name('admin/filter_sell');
        Route::get('invoice/{id}', [SellController::class, 'invoice'])->name('admin/invoice');

        //stock
        Route::resource('stock', StockController::class);
        Route::post('filter_stock', [StockController::class, 'filter_stock'])->name('admin/filter_stock');



        Route::resource('monthly_collection', MonthlyCollectionController::class);
        Route::post('filter_monthly_collection', [MonthlyCollectionController::class, 'filter_monthly_collection'])->name('admin/filter_monthly_collection');



        Route::resource('income_expense', IncomeExpenseController::class);
        Route::post('filter_income_expense', [IncomeExpenseController::class, 'filter_income_expense'])->name('admin/filter_income_expense');
        Route::post('get_projects', [IncomeExpenseController::class, 'get_projects'])->name('admin/get_projects');
        Route::post('get_project_details', [IncomeExpenseController::class, 'get_project_details'])->name('admin/get_project_details');
        Route::post('get_ie_category', [IncomeExpenseController::class, 'get_ie_category'])->name('admin/get_ie_category');



        Route::get('all_transaction', [TransactionController::class, 'all_transaction'])->name('all_transaction');
        Route::post('filter_transaction', [TransactionController::class, 'filter_transaction'])->name('admin/filter_transaction');
        Route::get('ledger', [TransactionController::class, 'ledger'])->name('ledger');
        Route::get('filter_ledger', [TransactionController::class, 'filter_ledger'])->name('admin/filter_ledger');


        Route::get('/report', [ReportController::class, 'report'])->name('report');


        Route::post('get_product_details', [StockController::class, 'get_product_details'])->name('admin/get_product_details');
        Route::post('get_company_details', [SellController::class, 'get_company_details'])->name('admin/get_company_details');
        Route::post('get_category_details', [IncomeExpenseController::class, 'get_category_details'])->name('admin/get_category_details');



        Route::get('/get-products/{search}', [ChalanController::class, 'getProducts'])->name('admin/get-products');

        Route::get('/get-product-details/{productId}', [ChalanController::class, 'getProductDetails'])->name('admin/get-product-details');
    });
});
