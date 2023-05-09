<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ApiController;

    Route::post('/custom_order_request', [ApiController::class, 'custom_order_request'])->name('/api/custom_order_request');
    Route::post('/custom_order_request_status', [ApiController::class, 'custom_order_request_status'])->name('/api/custom_order_request_status');

    Route::post('/signUp', [ApiController::class, 'signUp'])->name('/api/signUp');
    Route::post('/resendOtp', [ApiController::class, 'resendOtp'])->name('/api/resendOtp');
    Route::post('/verifyOtp', [ApiController::class, 'verifyOtp'])->name('/api/verifyOtp');
    Route::post('/setPassword', [ApiController::class, 'setPassword'])->name('/api/setPassword');
    Route::post('/login', [ApiController::class, 'login'])->name('/api/login');
    Route::post('/forgetPassword', [ApiController::class, 'forgetPassword'])->name('/api/forgetPassword');
    Route::post('/completeProfile', [ApiController::class, 'completeProfile'])->name('/api/completeProfile');
    Route::post('/homeScreen', [ApiController::class, 'homeScreen'])->name('/api/homeScreen');
    Route::post('/productRecentView', [ApiController::class, 'productRecentView'])->name('/api/productRecentView');
    Route::post('/favoriteProduct', [ApiController::class, 'favoriteProduct'])->name('/api/favoriteProduct');
    Route::post('/get_productDetailsById', [ApiController::class, 'get_productDetailsById'])->name('/api/get_productDetailsById');
    Route::post('/addItemToCart', [ApiController::class, 'addItemToCart'])->name('/api/addItemToCart');
    Route::post('/removeItemToCart', [ApiController::class, 'removeItemToCart'])->name('/api/removeItemToCart');
    Route::post('/get_favoriteProduct', [ApiController::class, 'get_favoriteProduct'])->name('/api/get_favoriteProduct');
    Route::post('/get_sub_category_by_category_id', [ApiController::class, 'get_sub_category_by_category_id'])->name('/api/get_sub_category_by_category_id');

    Route::post('/get_sub_category_by_category_id_and_filter', [ApiController::class, 'get_sub_category_by_category_id_and_filter'])->name('/api/get_sub_category_by_category_id_and_filter');
   
    
    Route::post('/introScreen', [ApiController::class, 'introScreen'])->name('/api/introScreen');
    Route::post('/add_address', [ApiController::class, 'add_address'])->name('/api/add_address');
    Route::post('/update_address', [ApiController::class, 'update_address'])->name('/api/update_address');
    Route::post('/delete_address', [ApiController::class, 'delete_address'])->name('/api/delete_address');

    Route::post('/get_all_address', [ApiController::class, 'get_all_address'])->name('/api/get_all_address');
    Route::post('/get_user_details_by_id', [ApiController::class, 'get_user_details_by_id'])->name('/api/get_user_details_by_id');
    Route::post('/updateProfile', [ApiController::class, 'updateProfile'])->name('/api/updateProfile');
    
    Route::post('/change_password', [ApiController::class, 'change_password'])->name('/api/change_password');
    Route::post('/get_cart_items', [ApiController::class, 'get_cart_items'])->name('/api/get_cart_items');

    Route::post('/address_is_default', [ApiController::class, 'address_is_default'])->name('/api/address_is_default');

    Route::post('/cartItemQtyIncDec', [ApiController::class, 'cartItemQtyIncDec'])->name('/api/cartItemQtyIncDec');
    Route::post('/get_promocode', [ApiController::class, 'get_promocode'])->name('/api/get_promocode');
    Route::post('/apply_coupon_code', [ApiController::class, 'apply_coupon_code'])->name('/api/apply_coupon_code');

    Route::post('/checkout_pay_now', [ApiController::class, 'checkout_pay_now'])->name('/api/checkout_pay_now');

    //Route::post('/homeScreenbuy', [ApiController::class, 'homeScreenbuy'])->name('/api/homeScreenbuy');

    Route::post('/my_order', [ApiController::class, 'my_order'])->name('/api/my_order');
    Route::post('/cancel_order', [ApiController::class, 'cancel_order'])->name('/api/cancel_order');
    Route::post('/get_order_details_by_order_id', [ApiController::class, 'get_order_details_by_order_id'])->name('/api/get_order_details_by_order_id');
    Route::post('/re_order', [ApiController::class, 're_order'])->name('/api/re_order');
    Route::post('/download_order_receipt', [ApiController::class, 'download_order_receipt'])->name('/api/download_order_receipt');
   
    Route::post('/get_all_notification', [ApiController::class, 'get_all_notification'])->name('/api/get_all_notification');
    Route::post('/single_read_notification', [ApiController::class, 'single_read_notification'])->name('/api/single_read_notification');
    Route::post('/all_read_notification', [ApiController::class, 'all_read_notification'])->name('/api/all_read_notification');

    Route::post('/all_unread_notification', [ApiController::class, 'all_unread_notification'])->name('/api/all_unread_notification');


    Route::post('/single_delete_notification', [ApiController::class, 'single_delete_notification'])->name('/api/single_delete_notification');
    Route::post('/delete_all_notification', [ApiController::class, 'delete_all_notification'])->name('/api/delete_all_notification');

    Route::post('/order_rating', [ApiController::class, 'order_rating'])->name('/api/order_rating');
    Route::post('/settings', [ApiController::class, 'settings'])->name('/api/settings');
    Route::post('/product_all_attr', [ApiController::class, 'product_all_attr'])->name('/api/product_all_attr');

    Route::post('/get_subCategoryby_multiplr_categoryId', [ApiController::class, 'get_subCategoryby_multiplr_categoryId'])->name('/api/get_subCategoryby_multiplr_categoryId');// multiple catagory selected

    Route::post('/get_stone_by_stone_type_id', [ApiController::class, 'get_stone_by_stone_type_id'])->name('/api/get_stone_by_stone_type_id');
    
    Route::post('/add_product', [ApiController::class, 'add_product'])->name('/api/add_product');
    Route::post('/manage_product_list', [ApiController::class, 'manage_product_list'])->name('/api/manage_product_list');
    Route::post('/edit_product', [ApiController::class, 'edit_product'])->name('/api/edit_product');
    Route::post('/update_product', [ApiController::class, 'update_product'])->name('/api/update_product');
    Route::post('/delete_product_image', [ApiController::class, 'delete_product_image'])->name('/api/delete_product_image');

    Route::post('/image_upload_temp', [ApiController::class, 'image_upload_temp'])->name('/api/image_upload_temp');
    Route::post('/order_request', [ApiController::class, 'order_request'])->name('/api/order_request');
    Route::post('/order_status_manage', [ApiController::class, 'order_status_manage'])->name('/api/order_status_manage');

    Route::post('/product_active_inactive', [ApiController::class, 'product_active_inactive'])->name('/api/product_active_inactive');
    Route::post('/get_catagory', [ApiController::class, 'get_catagory'])->name('/api/get_catagory');
    Route::post('/get_sub_catagory_by_category_id', [ApiController::class, 'get_sub_catagory_by_category_id'])->name('/api/get_sub_catagory_by_category_id');
    Route::post('/get_product_by_sub_category', [ApiController::class, 'get_product_by_sub_category'])->name('/api/get_product_by_sub_category');
    Route::post('/manage_stock', [ApiController::class, 'manage_stock'])->name('/api/manage_stock');
    Route::post('/get_product_polish_style', [ApiController::class, 'get_product_polish_style'])->name('/api/get_product_polish_style');
    Route::post('/get_product_jewellery_style', [ApiController::class, 'get_product_jewellery_style'])->name('/api/get_product_jewellery_style');
    Route::get('/add_product_user_notification', [ApiController::class, 'add_product_user_notification'])->name('/api/add_product_user_notification');

    
    //
    
    
    