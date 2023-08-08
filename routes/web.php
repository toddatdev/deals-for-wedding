<?php

use App\Http\Controllers\AdditionalPricingController;
use App\Http\Controllers\Admin\AdminInvoiceController;
use App\Http\Controllers\vendor\VendorInvoiceController;
use Illuminate\Support\Facades\Route;
/* Admin Classes*/
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\DealsController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\Admin\ReviewsController;
use App\Http\Controllers\Admin\ContactVendorController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\CompanyFormController;
use App\Http\Controllers\Admin\CompanyProfileController as AdminCompanyProfileController;
/* Vendor Classes*/
use App\Http\Controllers\Vendor\VendorController;
use App\Http\Controllers\Vendor\CategoryController as VendorCategoryController;
use App\Http\Controllers\Vendor\StateController as VendorStateController;
use App\Http\Controllers\Vendor\DealsController as VendorDealsController;
use App\Http\Controllers\Vendor\ContactVendorController as VendorContactVendorController;
use App\Http\Controllers\Vendor\ReviewsController as VendorReviewsController;
use App\Http\Controllers\Vendor\CompanyProfileController;
/* Front Classes*/
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\Admin\Blog\BlogcategoryController;
use App\Http\Controllers\Admin\Blog\PostController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\TasksController;
use Illuminate\Http\Request;

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

// Route::get('/', function () {
//     return view('front.index');
// });

Auth::routes();
Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/privacy-policy', [FrontController::class, 'privacy_policy'])->name('front.privacy_policy');
Route::get('/about_us', [FrontController::class, 'about_us'])->name('front.about_us');
Route::get('/term_conditions', [FrontController::class, 'term_conditions'])->name('front.term_conditions');
Route::get('/faqs', [FrontController::class, 'faqs'])->name('front.faqs');
Route::get('/contact', [FrontController::class, 'contact'])->name('front.contact');
Route::post('/contact-support', [FrontController::class, 'contact_support'])->name('home.contact_support');
Route::get('/send-test', [NotificationController::class, 'testMail']);
Route::get('/deal-notify', [NotificationController::class, 'deal_notify'])->name('deal_notify');
Route::get('/deal-approval', [NotificationController::class, 'new_deal_to_approve'])->name('deal.approval');
Route::post('/payment', [StripePaymentController::class, 'payment'])->name('stripe_payment');
Route::post('/deal-payment', [StripePaymentController::class, 'deal_payment'])->name('deal.payment');
Route::post('/deal-payment-free', [StripePaymentController::class, 'deal_payment_free'])->name('deal.payment.free');
Route::post('/checkout-all', [StripePaymentController::class, 'checkout_all'])->name('checkout.all');
Route::get('/checkout-all-done', [StripePaymentController::class, 'checkout_all_done'])->name('checkout.all.done');
Route::post('/plan-payment', [StripePaymentController::class, 'plan_payment'])->name('plan.payment');
Route::post('/plan-payment-all', [StripePaymentController::class, 'plan_payment_all'])->name('plan.payment.all');
Route::get('/deal-payment-done', [StripePaymentController::class, 'deal_payment_done'])->name('deal.paymentdone');
Route::get('/update_deal_payment_done', [StripePaymentController::class, 'update_deal_payment_done']);
Route::get('/plan-payment-done', [StripePaymentController::class, 'plan_payment_done'])->name('plan.paymentdone');
Route::get('/plan-payment-all-done', [StripePaymentController::class, 'plan_payment_all_done'])->name('plan.paymentalldone');
Route::get('/notification/mark/{id}', [NotificationController::class, 'MarkAsRead'])->name('notification.mark');

#BLOG FOR FRONT PAGE
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog-details/{id}', [BlogController::class, 'view_post'])->name('blog-details.view_post');

/* ############################# USER ROUTING START ############################ */
Route::group(['middleware' => 'auth', 'redirect'], function () {

    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('home.dashboard');

    Route::get('/welcome', [HomeController::class, 'welcome'])->name('home.welcome');

    Route::get('/deals', [HomeController::class, 'allDeals'])->name('home.allDeals');
    Route::get('/deals/{id}', [HomeController::class, 'deal_detail2'])->name('vendor.dealdetail');



    Route::get('/deal/{slug}', [HomeController::class, 'deal_detail'])->name('home.deal_detail');

    Route::get('/send-deal-view/{id}', [HomeController::class, 'viewDealByUser'])->name('home.view-deal-by-user');

    Route::get('/payment-download/{id}', [HomeController::class, 'download_payment'])->name('download_payment');
    Route::get('/deal-download/{slug}', [HomeController::class, 'deal_download'])->name('home.deal_download');
    Route::get('/saved_deal/{id}', [HomeController::class, 'deal_detail2'])->name('home.deal_detail2');
    Route::get('/dream-team', [HomeController::class, 'dreamTeam'])->name('home.dream-team');
    Route::post('/contact-vendor', [HomeController::class, 'contact_vendor'])->name('home.contact_vendor');
    Route::post('/deal-view', [HomeController::class, 'deal_view'])->name('home.deal_view');
    Route::post('/send-review', [HomeController::class, 'send_review'])->name('home.send_review');
    Route::post('/save-deal', [HomeController::class, 'save_deal'])->name('home.save_deal');
    Route::get('/save-deal-delete/{id}', [HomeController::class, 'save_deal_delete'])->name('home.save_deal_delete');
    Route::post('/update-user-profile', [HomeController::class, 'updateUserProfile'])->name('home.update-user-profile');
    Route::get('/user-logout', [HomeController::class, 'userLogout'])->name('home.logout');
    Route::get('/print-deals/{id}', [HomeController::class, 'print_deals'])->name('home.print_deals');
});

/* ############################# USER ROUTING ENDS ############################ */

/* ############################# ADMIN ROUTING START ############################ */


Route::get('/admins', [AdminController::class, 'login'])->name('admin.login');
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admins/login_post', [AdminController::class, 'adminLoginPost'])->name('admin.adminLoginPost');
Route::get('/admin-register', [AdminController::class, 'register'])->name('admin.register');

Route::post('/admin/register_post', [AdminController::class, 'adminRegisterPost'])->name('admin.adminRegisterPost');


Route::post('/admin/new_messages', [AdminController::class, 'postNewMessages'])->name('admin.postNewMessages');

Route::put('/admin/update_messages/{id}', [AdminController::class, 'updateMessages'])->name('admin.updateMessages');


Route::group(['prefix' => 'admin', 'middleware' => ['admin', 'auth']], function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/cart-list', [AdminController::class, 'cartList'])->name('admin.cart-list');

    Route::get('/dashboard/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::get('/dashboard/messages', [AdminController::class, 'messages'])->name('admin.messages');
    Route::post('/dashboard/update', [AdminController::class, 'settings_update'])->name('admin.settings.update');
    Route::post('/dashboard/pass_update', [AdminController::class, 'settings_password'])->name('admin.settings.password');
    Route::get('/profile', [AdminController::class, 'view_profile'])->name('admin.profile');
    Route::post('/profile/update', [AdminController::class, 'update_profile'])->name('admin.profile.update');
    Route::get('/advertiser-list', [AdminController::class, 'AdvertiserList'])->name('admin.advertiser-list');
    Route::get('/add-advertiser', [AdminController::class, 'addAdvertiser'])->name('admin.add-advertiser');
    Route::post('/add-advertiser', [AdminController::class, 'saveAdvertiser'])->name('admin.save-advertiser');
    Route::post('/update-advertiser/{id}', [AdminController::class, 'updateAdvertiser'])->name('admin.update-advertiser');
    Route::get('/edit-advertiser/{id}', [AdminController::class, 'editAdvertiser'])->name('admin.edit-advertiser');
    Route::get('/advertiser-deals/{id}', [AdminController::class, 'showAdvertiserDealList'])->name('admin.show-advertiser-deal-list');
    Route::get('/delete-advertiser/{id}', [AdminController::class, 'deleteAdvertiser'])->name('admin.delete-advertiser');

    Route::get('/user-list', [AdminController::class, 'userList'])->name('admin.user-list');
    Route::get('/admin-list', [AdminController::class, 'adminList'])->name('admin.admin-list');

    Route::post('/download-user-list', [AdminController::class, 'download_user_list'])->name('admin.download_user_list');
    Route::get('/download-deals', [AdminController::class, 'download_deals'])->name('admin.download_deals');
    Route::get('/create-user', [AdminController::class, 'addUsers'])->name('admin.add-users');
    Route::post('/update-users/{id}', [AdminController::class, 'updateUsers'])->name('admin.update-user');

    Route::put('/update-admins/{id}', [AdminController::class, 'updateAdmin'])->name('admin.update-admin');

    Route::post('/add-users', [AdminController::class, 'saveUsers'])->name('admin.add-user');
    Route::get('/edit-user/{id}', [AdminController::class, 'editUsers'])->name('admin.edit-user');
    Route::get('/delete-user/{id}', [AdminController::class, 'deleteUsers'])->name('admin.delete-user');

    Route::get('/delete-admin/{id}', [AdminController::class, 'deleteAdmin'])->name('admin.delete-admin');

    //discounts
    Route::get('/discounts', [DiscountController::class, 'index'])->name('discount.index');
    Route::get('/discounts/add-discount', [DiscountController::class, 'create'])->name('discount.add');
    Route::post('/discounts/store', [DiscountController::class, 'store'])->name('discount.store');
    Route::get('/discounts/edit/{id}', [DiscountController::class, 'edit'])->name('discount.edit');
    Route::post('/discounts/update/{id}', [DiscountController::class, 'update'])->name('discount.update');
    Route::get('/discounts/delete/{id}', [DiscountController::class, 'destroy'])->name('discount.delete');

    //pricing plan
    Route::get('/pricing', [BillingController::class, 'index'])->name('plan.index');
    Route::get('/pricing/add-plan', [BillingController::class, 'create'])->name('plan.add');
    Route::post('/pricing/store', [BillingController::class, 'store'])->name('plan.store');
    Route::get('/pricing/edit/{id}', [BillingController::class, 'edit'])->name('plan.edit');
    Route::post('/pricing/update/{id}', [BillingController::class, 'update'])->name('plan.update');
    Route::get('/pricing/delete/{id}', [BillingController::class, 'destroy'])->name('plan.delete');
    Route::get('/pricing/additional', [AdditionalPricingController::class, 'index'])->name('plan.additional');
    Route::post('/pricing/additionalupdate', [AdditionalPricingController::class, 'update'])->name('plan.additionalupdate');

    //tasks

    Route::post('/tasks/add/', [TasksController::class, 'store'])->name('tasks.add');
    Route::post('/tasks/update/', [TasksController::class, 'update'])->name('tasks.update');
    Route::post('/tasks/delete/', [TasksController::class, 'destroy'])->name('tasks.delete');

    //email-copy

    Route::get('/emails', [AdminController::class, 'email_index'])->name('email.index');
    Route::post('/emails/update', [AdminController::class, 'email_update'])->name('email.update');

    Route::get('/notifications', [AdminController::class, 'all_notifications'])->name('admin.notifications');

    //Category Management
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categories/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('categories.delete');

    //State Management
    Route::get('/states', [StateController::class, 'index'])->name('states.index');
    Route::get('/states/create', [StateController::class, 'create'])->name('states.create');
    Route::post('/states/store', [StateController::class, 'store'])->name('states.store');
    Route::get('/states/edit/{id}', [StateController::class, 'edit'])->name('states.edit');
    Route::post('/states/update/{id}', [StateController::class, 'update'])->name('states.update');
    Route::get('/states/delete/{id}', [StateController::class, 'destroy'])->name('states.delete');

    //Deals Management
    Route::get('/deals', [DealsController::class, 'index'])->name('deals.index');
    Route::get('/deals/create', [DealsController::class, 'create'])->name('deals.create');
    Route::post('/deals/store', [DealsController::class, 'store'])->name('deals.store');
    Route::get('/deals/edit/{id}', [DealsController::class, 'edit'])->name('deals.edit');
    Route::post('/deals/update/{id}', [DealsController::class, 'update'])->name('deals.update');
    Route::get('/deals/delete/{id}', [DealsController::class, 'destroy'])->name('deals.delete');
    Route::get('/deals/approve/{id}', [DealsController::class, 'approve'])->name('deals.approve');
    Route::get('/deals/deny/{id}', [DealsController::class, 'deny'])->name('deals.deny');
    Route::get('/deals/deal_sold', [AdminController::class, 'deal_view'])->name('deals.sold');
    Route::post('/deals/deal_sold', [AdminController::class, 'deal_viewf'])->name('deals.soldf');
    Route::get('/deals/deal_per_user', [AdminController::class, 'per_user_deals'])->name('deals.peruser');
    Route::post('/deals/deal_per_user', [AdminController::class, 'per_user_dealsf'])->name('deals.perusers');

    Route::get('/invoice', [AdminInvoiceController::class, 'index'])->name('admin-invoice.index');

    //Contact Vendor
    Route::get('/contact-vendor/listing', [ContactVendorController::class, 'index'])->name('contact_vendor.index');
    Route::get('/contact-vendor/edit/{id}', [ContactVendorController::class, 'edit'])->name('contact_vendor.edit');
    Route::post('/contact-vendor/update', [ContactVendorController::class, 'update'])->name('contact_vendor.update');
    Route::get('/contact-vendor/delete/{id}', [ContactVendorController::class, 'destroy'])->name('contact_vendor.destroy');
    Route::get('/advertiser-payment', [PaymentsController::class, 'index'])->name('vendor.payment');

    //Deal Reviews
    Route::get('/reviews/listing', [ReviewsController::class, 'index'])->name('adminreviews.index');

    //Page mangemnet
    Route::get('/privacy_policy', [PageController::class, 'privacy_policy'])->name('page.privacy_policy');
    Route::get('/about_us', [PageController::class, 'about_us'])->name('page.about_us');
    Route::get('/term_conditions', [PageController::class, 'term_conditions'])->name('page.term_conditions');
    Route::post('/page/save', [PageController::class, 'save_data'])->name('page.save_data');

    //FAQs Management
    Route::get('/faqs', [FaqController::class, 'index'])->name('faqs.index');
    Route::get('/faq/create', [FaqController::class, 'create'])->name('faqs.create');
    Route::post('/faq/store', [FaqController::class, 'store'])->name('faqs.store');
    Route::get('/faq/edit/{id}', [FaqController::class, 'edit'])->name('faqs.edit');
    Route::post('/faq/update/{id}', [FaqController::class, 'update'])->name('faqs.update');
    Route::get('/faq/delete/{id}', [FaqController::class, 'destroy'])->name('faqs.delete');

    //Company Form Management
    Route::get('/all-form-fields', [CompanyFormController::class, 'index'])->name('company_form.index');
    Route::get('/field/create', [CompanyFormController::class, 'create'])->name('company_form.create');
    Route::post('/field/store', [CompanyFormController::class, 'store'])->name('company_form.store');
    Route::get('/field/edit/{id}', [CompanyFormController::class, 'edit'])->name('company_form.edit');
    Route::post('/field/update/{id}', [CompanyFormController::class, 'update'])->name('company_form.update');
    Route::get('/field/delete/{id}', [CompanyFormController::class, 'destroy'])->name('company_form.delete');

    //Company Profile
    Route::get('/company_profile/{id}', [AdminCompanyProfileController::class, 'edit'])->name('admin.vendor.company_profile');
    Route::get('/company_profile_list', [AdminCompanyProfileController::class, 'index'])->name('admin.company_profile');
    Route::post('/company_profile/update/{id}', [AdminCompanyProfileController::class, 'update'])->name('admin.vendor.company_profile.update');

    #ADMIN CATEGORY BLOG MANAGEMENT
    Route::get('/blog-category', [BlogcategoryController::class, 'index'])->name('blog.category');
    Route::get('/add-blog-category', [BlogcategoryController::class, 'create'])->name('blog.category.create');
    Route::post('/add_blog_category_action', [BlogcategoryController::class, 'store'])->name('blog.add_blog_category_action');
    Route::get('/blog-edit-category/{id}', [BlogcategoryController::class, 'edit'])->name('blog.edit.category');
    Route::post('/update_blog_category_action', [BlogcategoryController::class, 'update'])->name('blog.update.category');
    Route::get('/blog-delete-category/{id}', [BlogcategoryController::class, 'destroy'])->name('blog.delete.destroy');

    #ADMIN BLOG MANAGEMENT
    Route::get('/blog', [PostController::class, 'index'])->name('blog.index');
    Route::get('/add-blog', [PostController::class, 'create'])->name('blog.create');
    Route::post('/add_blog_action', [PostController::class, 'store'])->name('blog.add_blog_action');
    Route::get('/blog-edit/{id}', [PostController::class, 'edit'])->name('blog.edit');
    Route::post('/update_blog_action', [PostController::class, 'update'])->name('blog.update_blog_action');
    Route::get('/blog-delete/{id}', [PostController::class, 'destroy'])->name('blog.destroy');
});


/* ############################# ADMIN ROUTING END ############################ */


/* ############################# VENDOR ROUTING STARTS ############################ */

Route::get('/vendor/login', [VendorController::class, 'login'])->name('vendor.login');
Route::get('/advertiser/login', [VendorController::class, 'login'])->name('vendor.login');
Route::post('/advertiser/login_post', [VendorController::class, 'login_post'])->name('vendor.login_post');
Route::get('/advertiser/register', [VendorController::class, 'register'])->name('vendor.register');
Route::post('/advertiser/register_post', [VendorController::class, 'register_post'])->name('vendor.register_post');

Route::group(['prefix' => 'advertiser', 'middleware' => ['vendor', 'auth']], function () {
    Route::get('/dashboard', [VendorController::class, 'index'])->name('vendor.dashboard');
    Route::get('/company-profile', [VendorController::class, 'company_profile'])->name('vendor.company_profile');
    Route::post('/update_company_profile/{id}', [VendorController::class, 'update_company_profile'])->name('vendor.update_company_profile');
    Route::get('/profile', [VendorController::class, 'view_profile'])->name('vendor.profile');
    Route::post('/profile/update', [VendorController::class, 'update_profile'])->name('vendor.profile.update');
    Route::get('/logout', [VendorController::class, 'logout'])->name('vendor.logout');
    Route::get('/pricing', [BillingController::class, 'pricing'])->name('plan.pricing');
    Route::get('/plancheckout', [CartController::class, 'plancheckout'])->name('plan.checkout'); 
    Route::get('/plancheckoutall', [CartController::class, 'plancheckoutall'])->name('plan.checkout.all');




    //Category Management
    Route::get('/categories', [VendorCategoryController::class, 'index'])->name('vendor.categories.index');
    Route::get('/categories/create', [VendorCategoryController::class, 'create'])->name('vendor.categories.create');
    Route::post('/categories/store', [VendorCategoryController::class, 'store'])->name('vendor.categories.store');
    Route::get('/categories/edit/{id}', [VendorCategoryController::class, 'edit'])->name('vendor.categories.edit');
    Route::post('/categories/update/{id}', [VendorCategoryController::class, 'update'])->name('vendor.categories.update');
    Route::get('/categories/delete/{id}', [VendorCategoryController::class, 'destroy'])->name('vendor.categories.delete');

    //State Management
    Route::get('/states', [VendorStateController::class, 'index'])->name('vendor.states.index');
    Route::get('/states/create', [VendorStateController::class, 'create'])->name('vendor.states.create');
    Route::post('/states/store', [VendorStateController::class, 'store'])->name('vendor.states.store');
    Route::get('/states/edit/{id}', [VendorStateController::class, 'edit'])->name('vendor.states.edit');
    Route::post('/states/update/{id}', [VendorStateController::class, 'update'])->name('vendor.states.update');
    Route::get('/states/delete/{id}', [VendorStateController::class, 'destroy'])->name('vendor.states.delete');

    //Deals Management
    Route::get('/deals', [VendorDealsController::class, 'index'])->name('vendor.deals.index');
    Route::get('/deals/create', [VendorDealsController::class, 'create'])->name('vendor.deals.create');
    Route::post('/deals/store', [VendorDealsController::class, 'store'])->name('vendor.deals.store');
    Route::get('/deals/edit/{id}', [VendorDealsController::class, 'edit'])->name('vendor.deals.edit');
    Route::get('/deals/edit-deal-city/{id}', [VendorDealsController::class, 'editDealCity'])->name('vendor.deals.editDealCity');
    Route::post('/deals/update/{id}', [VendorDealsController::class, 'update'])->name('vendor.deals.update');
    Route::get('/deals/delete/{id}', [VendorDealsController::class, 'destroy'])->name('vendor.deals.delete');
    Route::get('/deals/viewed_deals', [VendorDealsController::class, 'dealView'])->name('vendor.deals.viewed');
    Route::get('/deals/deals-view-by-users', [VendorDealsController::class, 'dealViewByUser'])->name('vendor.deal-view-by-users');

    Route::get('/invoice', [VendorInvoiceController::class, 'index'])->name('vendor-invoice.index');


    //Cart Management

    Route::get('/cart', [CartController::class, 'index'])->name('vendor.cart');
    Route::post('/cart/store', [CartController::class, 'store'])->name('vendor.cart.store');  
    Route::get('/cart/edit/{id}', [CartController::class, 'edit'])->name('vendor.cart.edit');
    Route::get('/cart/edit-city/{id}', [CartController::class, 'editCity'])->name('vendor.cart.editCity');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('vendor.cart.update');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('vendor.cart.checkout');
    Route::get('/cart/delete/{id}', [CartController::class, 'destroy'])->name('vendor.cart.delete');
    //Route::post('/cart/checkoutprocess', [CartController::class, 'checkoutprocess'])->name('vendor.cart.checkoutprocess');

    //Contact Vendor
    Route::get('/contact-vendor/listing', [VendorContactVendorController::class, 'index'])->name('vendor.contact_vendor.index');


    //Deal Reviews
    Route::get('/reviews/listing', [ReviewsController::class, 'index2'])->name('reviews.index');
    Route::get('/notifications', [VendorController::class, 'all_notifications'])->name('vendor.notifications');

    //Company Profile
    Route::get('/company_profile/{id}', [CompanyProfileController::class, 'edit'])->name('vendor.company_profile');
    Route::post('/company_profile/update/{id}', [CompanyProfileController::class, 'update'])->name('vendor.company_profile.update');

    Route::get('/advertiser/billing-portal', function (Request $request) {
        return $request->user()->redirectToBillingPortal();
    });
});
/* ############################# VENDOR ROUTING END ############################ */

/* ########### HELPER ACTION ############## */
Route::get('cli/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
});
Route::get('cli/model', function () {
    Artisan::call('make:model', ['name' => 'Settings']);
});
Route::get('cli/controller', function () {
    return Artisan::call('make:controller', ['name' => 'Vendor\CompanyProfileController', '--resource' => true]);
});
Route::get('cli/migrate', function () {
    return Artisan::call('make:migration', ['name' => 'CreateVendorCompanyProfileTable', '--table' => 'vendor_company_profile']);
});
Route::get('cli/mi', function () {
    return Artisan::call('migrate');
});
/* ########### HELPER ACTION ############## */
