<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CatContoller;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\userHomeController;
use App\Http\Controllers\Admin\productController;
use App\Http\Controllers\Admin\SetupController;
use App\Http\Controllers\Admin\SubcatController;
use App\Http\Controllers\Admin\bannerController;
use App\Http\Controllers\Admin\infoController;
use App\Http\Controllers\Admin\subBannerController;
use App\Http\Controllers\Admin\specialOfferController;
use App\Http\Controllers\Admin\productViewController;
use App\Http\Controllers\Admin\soicalController;
use App\Http\Controllers\Admin\linkController;
use App\Http\Controllers\Admin\reportController;
use App\Http\Controllers\Admin\Auth\loginController;
use App\Http\Controllers\Admin\adminController;



 
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


// -------------------------------------------Front end routs -------------------------------------------
//-------------------------------------------------------------------------------------------------------
Route::get('/', [App\Http\Controllers\FrontController::class, 'index']);
Route::get('/home', [App\Http\Controllers\userHomeController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\FrontController::class, 'about']);
Route::get('/category',[App\Http\Controllers\FrontController::class, 'category']);
Route::get('/product',[App\Http\Controllers\FrontController::class, 'product']);
Route::get('/contact',[App\Http\Controllers\FrontController::class, 'contact']);
Route::any ('/search',[App\Http\Controllers\FrontController::class, 'search']);
Route::get('/add_to_wish/{id}',[App\Http\Controllers\FrontController::class, 'add_to_wish']);
Route::get('/delete_from_wish/{id}',[App\Http\Controllers\FrontController::class, 'delete_from_wish']);
Route::get('/add_to_cart',[App\Http\Controllers\FrontController::class, 'add_to_cart']);
Route::get('/add_to_cart_once',[App\Http\Controllers\FrontController::class, 'add_to_cart_once']);

Route::get('/remove_from_cart',[App\Http\Controllers\FrontController::class, 'remove_from_cart']);

Route::get('/cart_view',[App\Http\Controllers\FrontController::class, 'cart_view']);
Route::get('/delete_cart/{id}',[App\Http\Controllers\FrontController::class, 'delete_cart']);
Route::get('/edit_cart/{id}',[App\Http\Controllers\FrontController::class, 'edit_cart']);
Route::post('/update_cart',[App\Http\Controllers\FrontController::class, 'update_cart']);
Route::get('/buy/{addr}/{dlv_time}',[App\Http\Controllers\FrontController::class, 'buy']);
Route::get('/pay_buy/{addr}/{t_price}/{dlv_time}',[App\Http\Controllers\FrontController::class, 'pay_buy']);

Route::post('/review',[App\Http\Controllers\FrontController::class, 'review']);
Route::get('/privacy_policy',[App\Http\Controllers\FrontController::class, 'privacy_policy']);
Route::get('/toc',[App\Http\Controllers\FrontController::class, 'toc']);
Route::get('/return_policy',[App\Http\Controllers\FrontController::class, 'return_policy']);
Route::post('/update_infos', [App\Http\Controllers\FrontController::class, 'update_infos' ]);
    





// Auto loading [products ] for all pages 
Route::get('/products', [App\Http\Controllers\FrontController::class, 'load_more']);
Route::get('/cat_load', [App\Http\Controllers\FrontController::class, 'cat_load']);
Route::get('/subcat_load', [App\Http\Controllers\FrontController::class, 'subcat_load']);
Route::get('/subsubcat_load', [App\Http\Controllers\FrontController::class, 'subsubcat_load']);
Route::get('/mikamunumunumunule', [App\Http\Controllers\userHomeController::class, 'reset']);
Route::get('/filter', [App\Http\Controllers\filterContoller::class, 'filter']);






Auth::routes();

Route::get('/home', [App\Http\Controllers\userHomeController::class, 'index'])->name('home');
Route::get('/recharge_page', [App\Http\Controllers\userHomeController::class, 'recharge_page']);
Route::get('/payment_method', [App\Http\Controllers\userHomeController::class, 'payment_method']);
Route::post('/create_payment', [App\Http\Controllers\userHomeController::class, 'create_payment']);
Route::get('/wishlist',[App\Http\Controllers\userHomeController::class, 'wishlist']);
Route::get('/checkout',[App\Http\Controllers\userHomeController::class, 'checkout']);
Route::get('/cart',[App\Http\Controllers\userHomeController::class, 'cart']);




Route::post('/buy_package', [App\Http\Controllers\userHomeController::class, 'buy_package']);
Route::get('/package/{package_type}/{user_name}/{who_refered_name}/{loop_no}', [App\Http\Controllers\userHomeController::class, 'package']);
Route::get('/premium', [App\Http\Controllers\userHomeController::class, 'premium']);

Route::get('/factory', [App\Http\Controllers\userHomeController::class, 'factory']);
Route::get('/test', [App\Http\Controllers\userHomeController::class, 'test']);
Route::post('/recharge', [App\Http\Controllers\userHomeController::class, 'recharge']);
Route::get('/withdraw', [App\Http\Controllers\userHomeController::class, 'withdraw']);
Route::get('/assigned/{assigner}/{new_comer}/{assigner_id}', [App\Http\Controllers\userHomeController::class, 'assigned']);
Route::get('/start_again/{user_id}', [App\Http\Controllers\userHomeController::class, 'start_again']);


// Front End controllers started from here ------------------------------------------------------------
// Rout for productt view -----------------------
Route::get('/category/{id}/{main_cat}', [App\Http\Controllers\productViewController::class, 'category']);
Route::get('/sub_category_view/{id}/{sub_cat}', [App\Http\Controllers\productViewController::class, 'sub_category']);
Route::get('/sub_sub_category_view/{id}/{sub_sub_cat}', [App\Http\Controllers\productViewController::class, 'sub_sub_category']);
Route::get('/single_product_view/{id}', [App\Http\Controllers\productViewController::class, 'single_product_view']);

        
                // Rout for  productt view  ----------------------- ended 
        




// ----------------------------------Admin pages routing ------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------



Route::middleware(['guest:admin'])->group(function () {
        Route::get('/admin/login', function(){return view('admin/auth/login');})->name('admin.login');
        Route::post('/admin/check', [App\Http\Controllers\Admin\Auth\loginController::class, 'check']);
    //  Route::get('register', [App\Http\Controllers\Admin\HomeController::class, 'admin_register']);
    });

    Route::middleware(['auth:admin'])->group(function () {
    Route::view('admin/home', 'admin/auth/home');
    // Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index']);
    Route::get('admin/home', [App\Http\Controllers\Admin\HomeController::class, 'admin_home']);
    Route::get('admin/logout', [App\Http\Controllers\Admin\Auth\loginController::class, 'logout']);
    Route::get('admin/admin_list', [App\Http\Controllers\Admin\HomeController::class, 'admin_list']);
    Route::get('admin/create_payment_page', [App\Http\Controllers\Admin\HomeController::class, 'create_payment_page']);
    Route::post('admin/create_payment', [App\Http\Controllers\Admin\HomeController::class, 'create_payment']);
    Route::get('admin/method_list', [App\Http\Controllers\Admin\HomeController::class, 'method_list']);
    Route::post('admin/delete_method/', [App\Http\Controllers\Admin\HomeController::class, 'delete_method'])->name('method_delete');
    Route::get('admin/admin_withdraw',[App\Http\Controllers\Admin\HomeController::class, 'admin_withdraw']);
    Route::post('admin/withdraw',[App\Http\Controllers\Admin\HomeController::class, 'withdraw']);
    Route::get('admin/toc',[App\Http\Controllers\Admin\HomeController::class, 'toc']);
    Route::get('admin/privacy_policy',[App\Http\Controllers\Admin\HomeController::class,'privacy_policy' ]);
    Route::get('admin/return_policy',[App\Http\Controllers\Admin\HomeController::class, 'return_policy' ]);

    Route::post('admin/toc_update',[App\Http\Controllers\Admin\HomeController::class, 'toc_update']);
    Route::post('admin/privacy_policy_update',[App\Http\Controllers\Admin\HomeController::class, 'privacy_policy_update']);
    Route::post('admin/return_policy_update',[App\Http\Controllers\Admin\HomeController::class, 'return_policy_update']);




            // Rout for setup shop -----------------------
            Route::get('admin/create_brand', [App\Http\Controllers\Admin\SetupController::class, 'create_brand']);
            Route::post('admin/insert_brand', [App\Http\Controllers\Admin\SetupController::class, 'insert_brand']);
            Route::get('admin/brand_list', [App\Http\Controllers\Admin\SetupController::class, 'brand_list']);
            Route::post('admin/delete_brand/', [App\Http\Controllers\Admin\SetupController::class, 'delete_brand'])->name('admin.brand_delete');
    
            Route::get('admin/create_color', [App\Http\Controllers\Admin\SetupController::class, 'create_color']);
            Route::post('admin/insert_color', [App\Http\Controllers\Admin\SetupController::class, 'insert_color']);
            Route::get('admin/color_list', [App\Http\Controllers\Admin\SetupController::class, 'color_list']);
            Route::post('admin/delete_color/', [App\Http\Controllers\Admin\SetupController::class, 'delete_color'])->name('admin.color_delete');
    
    
            Route::get('admin/create_size', [App\Http\Controllers\Admin\SetupController::class, 'create_size']);
            Route::post('admin/insert_size', [App\Http\Controllers\Admin\SetupController::class, 'insert_size']);
            Route::get('admin/size_list', [App\Http\Controllers\Admin\SetupController::class, 'size_list']);
            Route::post('admin/delete_size/', [App\Http\Controllers\Admin\SetupController::class, 'delete_size'])->name('admin.size_delete');
    
            Route::get('admin/create_unit', [App\Http\Controllers\Admin\SetupController::class, 'create_unit']);
            Route::post('admin/insert_unit', [App\Http\Controllers\Admin\SetupController::class, 'insert_unit']);
            Route::get('admin/unit_list', [App\Http\Controllers\Admin\SetupController::class, 'unit_list']);
            Route::post('admin/delete_unit/', [App\Http\Controllers\Admin\SetupController::class, 'delete_unit'])->name('admin.unit_delete');
    
            Route::get('admin/create_tag', [App\Http\Controllers\Admin\SetupController::class, 'create_tag']);
            Route::post('admin/insert_tag', [App\Http\Controllers\Admin\SetupController::class, 'insert_tag']);
            Route::get('admin/tag_list', [App\Http\Controllers\Admin\SetupController::class, 'tag_list']);
            Route::post('admin/delete_tag/', [App\Http\Controllers\Admin\SetupController::class, 'delete_tag'])->name('admin.tag_delete');
    
            // Rout for setup shop ----------------------- ended 
    
            // Rout for categories -----------------------
            Route::get('admin/create_cat', [App\Http\Controllers\Admin\CatController::class, 'create_cat']);
            Route::post('admin/insert_cat', [App\Http\Controllers\Admin\CatController::class, 'insert_cat']);
            Route::get('admin/cat_list', [App\Http\Controllers\Admin\CatController::class, 'cat_list']);
            Route::get('admin/edit_cat/{id}', [App\Http\Controllers\Admin\CatController::class, 'edit_cat']);
            Route::post('admin/update_cat/{id}/{prev_img}/{prev_name}', [App\Http\Controllers\Admin\CatController::class, 'update_cat']);
            Route::post('admin/delete_cat/', [App\Http\Controllers\Admin\CatController::class, 'delete_cat'])->name('admin.cat_delete');
    
    
            Route::get('admin/create_sub_cat', [App\Http\Controllers\Admin\SubcatController::class, 'create_sub_cat']);
            Route::post('admin/insert_sub_cat', [App\Http\Controllers\Admin\SubcatController::class, 'insert_sub_cat']);
            Route::get('admin/sub_cat_list', [App\Http\Controllers\Admin\SubcatController::class, 'sub_cat_list']);
            Route::get('admin/edit_sub_cat/{id}', [App\Http\Controllers\Admin\SubcatController::class, 'edit_sub_cat']);
            Route::post('admin/update_sub_cat/{id}/{prev_img}/{prev_cat_name}', [App\Http\Controllers\Admin\SubcatController::class, 'admin.update_sub_cat']);
            Route::post('admin/delete_sub_cat/', [App\Http\Controllers\Admin\SubcatController::class, 'delete_sub_cat'])->name('admin.subcat_delete');
    
    
            Route::get('admin/create_sub_sub_cat', [App\Http\Controllers\Admin\SubSubcatController::class, 'create_sub_sub_cat']);
            Route::post('admin/insert_sub_sub_cat', [App\Http\Controllers\Admin\SubSubcatController::class, 'insert_sub_sub_cat']);
            Route::get('admin/sub_sub_cat_list', [App\Http\Controllers\Admin\SubSubcatController::class, 'sub_sub_cat_list']);
            Route::get('admin/edit_sub_sub_cat/{id}', [App\Http\Controllers\Admin\SubSubcatController::class, 'edit_sub_sub_cat']);
            Route::post('admin/update_sub_sub_cat/{id}/{prev_img}/{prev_cat_name}', [App\Http\Controllers\Admin\SubSubcatController::class, 'admin.update_sub_sub_cat']);
            Route::post('admin/delete_sub_sub_cat/', [App\Http\Controllers\Admin\SubSubcatController::class, 'delete_sub_sub_cat'])->name('admin.subsubcat_delete');
    
    
            // Rout for category ----------------------- ended 
    
    
            // Rout for banners -----------------------
            Route::get('admin/create_banner', [App\Http\Controllers\Admin\bannerController::class, 'create_banner']);
            Route::post('admin/insert_banner', [App\Http\Controllers\Admin\bannerController::class, 'insert_banner']);
            Route::get('admin/banner_list', [App\Http\Controllers\Admin\bannerController::class, 'banner_list']);
            Route::get('admin/edit_banner/{id}', [App\Http\Controllers\Admin\bannerController::class, 'edit_banner']);
            Route::post('admin/update_banner/{id}/{prev_img}', [App\Http\Controllers\Admin\bannerController::class, 'update_banner']);
            Route::post('admin/delete_banner/', [App\Http\Controllers\Admin\bannerController::class, 'delete_banner'])->name('banner_delete');
            // Rout for banners ----------------------- ended 
    
            // Rout for sub banners -----------------------
            Route::get('admin/create_sub_banner', [App\Http\Controllers\Admin\subBannerController::class, 'create_sub_banner']);
            Route::post('admin/insert_sub_banner', [App\Http\Controllers\Admin\subBannerController::class, 'insert_sub_banner']);
            Route::get('admin/sub_banner_list', [App\Http\Controllers\Admin\subBannerController::class, 'sub_banner_list']);
            Route::get('admin/edit_sub_banner/{id}', [App\Http\Controllers\Admin\subBannerController::class, 'edit_sub_banner']);
            Route::post('admin/update_sub_banner/{id}/{prev_img}', [App\Http\Controllers\Admin\subBannerController::class, 'update_sub_banner']);
            Route::post('admin/delete_sub_banner/', [App\Http\Controllers\Admin\subBannerController::class, 'delete_sub_banner'])->name('subbanner_delete');
            // Rout for sub banners ----------------------- ended 
    
    
            // Rout for special offers  -----------------------
            Route::get('admin/edit_special_offer', [App\Http\Controllers\Admin\specialOfferController::class, 'edit_special_offer']);
            Route::post('admin/update_special_offer/{id}/{prev_img}', [App\Http\Controllers\Admin\specialOfferController::class, 'update_special_offer']);
            // Rout for special offers  ----------------------- ended 
    
    
    
    
            // Rout for infos -----------------------
            Route::get('admin/info_list', [App\Http\Controllers\Admin\infoController::class, 'info_list']);
            Route::get('admin/edit_info/{id}', [App\Http\Controllers\Admin\infoController::class, 'edit_info']);
            Route::post('admin/update_info/{id}/{prev_logo}', [App\Http\Controllers\Admin\infoController::class, 'update_info']);
            // Rout for infos ----------------------- ended 
    
    
    
            // Rout for social links -----------------------
            Route::get('admin/edit_social', [App\Http\Controllers\Admin\soicalController::class, 'edit_social']);
            Route::post('admin/update_social/{id}', [App\Http\Controllers\Admin\soicalController::class, 'update_soial']);
            // Rout for social links ----------------------- ended 
    
    
            // Rout for  links -----------------------
            Route::get('admin/create_link', [App\Http\Controllers\Admin\linkController::class, 'create_link']);
            Route::post('admin/insert_link', [App\Http\Controllers\Admin\linkController::class, 'insert_link']);
            Route::get('admin/link_list', [App\Http\Controllers\Admin\linkController::class, 'link_list']);
            Route::post('admin/delete_link', [App\Http\Controllers\Admin\linkController ::class, 'delete_link'])->name('link_delete');
            // Rout for  links ----------------------- ended 
    
            Route::get('admin/upload', [App\Http\Controllers\Admin\productController::class, 'upload_product']);
            Route::post('admin/insert_product', [App\Http\Controllers\Admin\productController::class, 'insert_product']);
            Route::get('/admin/product_list', [App\Http\Controllers\Admin\productController::class, 'product_list']);
            Route::get('admin/product_view', [App\Http\Controllers\Admin\productController::class, 'product_view']);
            Route::get('admin/product_edit/{id}', [App\Http\Controllers\Admin\productController::class, 'product_edit']);
            Route::post('admin/product_update/{id}/{prev_image1}/{prev_image2}/{prev_image3}/{prev_image4}', [App\Http\Controllers\Admin\productController::class, 'product_update']);
            Route::post('admin/product_delete/', [App\Http\Controllers\Admin\productController::class, 'product_delete'])->name('product_delete');
            Route::get('admin/add_product_page/{id}', [App\Http\Controllers\Admin\productController::class, 'add_product_page']);
            Route::post('admin/add_product', [App\Http\Controllers\Admin\productController::class, 'add_product']);
    
    
    
    
    
            // Route for account controller -------------------------------------------
            Route::get('admin/orders', [App\Http\Controllers\Admin\HomeController::class, 'orders']);
            Route::get('admin/invoice_list', [App\Http\Controllers\Admin\HomeController::class, 'invoice_list']);
            Route::get('admin/local_sell_page', [App\Http\Controllers\Admin\HomeController::class, 'local_sell_page']);


            Route::get('admin/accept/{order_id}', [App\Http\Controllers\Admin\reportController::class, 'accept']);
            Route::get('admin/user_list', [App\Http\Controllers\Admin\HomeController::class, 'user_list']);
            // ROut for make feature has ended 
    
    
            // ROute for account controller 
            Route::get('admin/delivered/{invoice_no}/{user_id}',[App\Http\Controllers\Admin\reportController::class, 'delivered']);
            Route::get('admin/inprocess/{invoice_no}/{user_id}',[App\Http\Controllers\Admin\reportController::class, 'inprocess']);


            Route::get('admin/reports',[App\Http\Controllers\Admin\reportController::class, 'reports']);
                    // Rout for make featured 
                    Route::post('admin/make_featured',[App\Http\Controllers\Admin\productController::class, 'make_featured']);
                    Route::get('admin/order_details/{id}/{user_id}',[App\Http\Controllers\Admin\HomeController::class, 'order_details']);
                    Route::get('admin/invoice_view/{id}/{user_id}',[App\Http\Controllers\Admin\HomeController::class, 'invoice_view       ']);

                    
                    Route::get('admin/print/{id}/{user_id}',[App\Http\Controllers\Admin\HomeController::class, 'order_details']);
                    Route::get('admin/reloader_list', [App\Http\Controllers\Admin\HomeController::class, 'reloader_list']);
                    Route::get('admin/reloader_approve/{user_id}/{amount}', [App\Http\Controllers\Admin\HomeController::class, 'reloader_approve']);
                    Route::get('admin/withdraw_list', [App\Http\Controllers\Admin\HomeController::class, 'withdraw_list']);
                    Route::get('admin/withdraw_approve/{id}', [App\Http\Controllers\Admin\HomeController::class, 'withdraw_approve']);


                    // ROute for admin conbtroller
                    Route::get('admin/create_admin_page', [App\Http\Controllers\Admin\adminController::class, 'create_admin_page']);
                    Route::post('admin/create_admin', [App\Http\Controllers\Admin\adminController::class, 'create_admin']);
                    Route::post('admin/delete_admin', [App\Http\Controllers\Admin\adminController::class, 'delete_admin'])->name('admin.admin_delete');



    

    });
