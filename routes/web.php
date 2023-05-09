<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\MenusController;
use App\Http\Controllers\SubMenusController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\TablesController;
use App\Http\Controllers\ChefsController;

use App\Http\Controllers\AboutUsController;

use App\Http\Controllers\OrderController;

use App\Http\Controllers\ChatController;

use App\Http\Controllers\WebNotificationController;
use App\Http\Controllers\RestaurentWebsiteController;

//Route::group(['middleware' => 'prevent-back-history'],function(){
   Route::get('/qrcode', 'App\Http\Controllers\QRCodeController@index')->name('home.index');

   Route::post('user/signup/store',[WebsiteController::class,'user_signup_store'])->name('user/signup/store');
   
   Route::get('customlogout',[WebsiteController::class,'logout'])->name('customlogout');
   
   
   
Route::get('/',[RestaurentWebsiteController::class,'index']);
      
Auth::routes();
Route::post('logins',[WebsiteController::class,'login'])->name('logins');

Route::get('thenkYou',[WebsiteController::class,'thenkYou']);

//Login
Route::get('/', [LoginController::class, 'index'])->name('userlogin');

//Route::post('/loginCheck', [LoginController::class, 'checkLogin'])->name('admin/loginCheck');
Route::get('/forgot-password', [LoginController::class, 'forgotPassword']);
Route::post('/forgot-password', [LoginController::class, 'forgotPassword'])->name('forgot-password');

Route::get('/resetpassword/{token}', [LoginController::class, 'resetpassword']);
Route::post('/resetpassword', [LoginController::class, 'resetpassword'])->name('admin/resetpassword');
Route::any('/{tblid}', [App\Http\Controllers\WebsiteController::class, 'index']);

Route::group(['middleware' => ['is_customer']], function(){
   Route::any('{tblid}/about', [App\Http\Controllers\WebsiteController::class, 'about'])->name('about');
   Route::any('{tblid}/service', [App\Http\Controllers\WebsiteController::class, 'service'])->name('service');
   Route::any('{tblid}/menu', [App\Http\Controllers\WebsiteController::class, 'menu'])->name('menu');
   Route::any('{tblid}/booking', [App\Http\Controllers\WebsiteController::class, 'booking'])->name('booking');
   Route::any('{tblid}/team', [App\Http\Controllers\WebsiteController::class, 'team'])->name('team');
   Route::any('{tblid}/testimonial', [App\Http\Controllers\WebsiteController::class, 'testimonial'])->name('testimonial');
   Route::any('{tblid}/contact', [App\Http\Controllers\WebsiteController::class, 'contact'])->name('contact');
   Route::any('{tblid}/getsub_menu_by_menu_id', [App\Http\Controllers\WebsiteController::class, 'getsub_menu_by_menu_id'])->name('getsub_menu_by_menu_id');
   Route::any('{tblid}/cartItem', [App\Http\Controllers\WebsiteController::class, 'cartItem'])->name('cartItem');
   Route::any('{tblid}/add_tocart', [App\Http\Controllers\OrderController::class, 'add_tocart'])->name('add_tocart');
   Route::any('{tblid}/cartItemList', [App\Http\Controllers\WebsiteController::class, 'cartItemList'])->name('cartItemList');
   Route::any('{tblid}/CartItemIncDec', [App\Http\Controllers\OrderController::class, 'CartItemIncDec'])->name('CartItemIncDec');
   Route::any('{tblid}/remove_cartItem', [App\Http\Controllers\OrderController::class, 'remove_cartItem'])->name('remove_cartItem');
   Route::any('{tblid}/checkout', [App\Http\Controllers\OrderController::class, 'checkout'])->name('checkout');
   Route::any('{tblid}/shipping_address',[App\Http\Controllers\WebsiteController::class,'shipping_address'])->name('website.shipping_address');

   Route::any('{tblid}/payment_proceed',[App\Http\Controllers\RazorpayController::class,'formPage'])->name('website.payment');
});

Route::group(['middleware' => ['is_admin']], function(){

    Route::get('/admin/dashboard', [LoginController::class, 'dashboard'])->name('admin/dashboard');
    Route::any('/admin/settings', [LoginController::class, 'settings'])->name('admin/settings');
    Route::any('admin/change_password', [LoginController::class, 'change_password'])->name('admin/change_password');
    
    Route::get('admin/dashboard/data', [HomeController::class, 'data'])->name('admin.dashboard.data');
    Route::get('admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/prodile', [LoginController::class, 'prodile'])->name('admin.prodile');

    //Menu /Category
    Route::any('admin/menu/data', [App\Http\Controllers\MenusController::class, 'data'])->name('admin/menu/data');
    Route::any('admin/menu', [App\Http\Controllers\MenusController::class, 'index'])->name('admin.menu');
    Route::any('admin/menu/create', [App\Http\Controllers\MenusController::class, 'create'])->name('admin.menu.create');
    Route::any('admin/menu/edit/{id}', [App\Http\Controllers\MenusController::class, 'edit'])->name('admin.menu.edit');
    Route::any('admin/menu/store', [App\Http\Controllers\MenusController::class, 'store'])->name('admin.menu.store');
    Route::any('admin/menu/update', [App\Http\Controllers\MenusController::class, 'update'])->name('admin.menu.update');
    Route::any('admin/menu/status_change', [App\Http\Controllers\MenusController::class, 'status_change'])->name('admin.menu.status_change');

    //Sub Category
    Route::any('admin/sub_menu/data', [App\Http\Controllers\SubMenusController::class, 'data'])->name('admin/sub_menu/data');
    
    Route::any('admin/sub_menu', [App\Http\Controllers\SubMenusController::class, 'index'])->name('admin.sub_menu');
    Route::any('admin/sub_menu/create', [App\Http\Controllers\SubMenusController::class, 'create'])->name('admin.sub_menu.create');
    Route::any('admin/sub_menu/edit/{id}', [App\Http\Controllers\SubMenusController::class, 'edit'])->name('admin.sub_menu.edit');
    Route::any('admin/sub_menu/show/{id}', [App\Http\Controllers\SubMenusController::class, 'show'])->name('admin.sub_menu.show');
    Route::any('admin/sub_menu/store', [App\Http\Controllers\SubMenusController::class, 'store'])->name('admin.sub_menu.store');
    Route::any('admin/sub_menu/update', [App\Http\Controllers\SubMenusController::class, 'update'])->name('admin.sub_menu.update');
    Route::any('admin/sub_menu/status_change', [App\Http\Controllers\SubMenusController::class, 'status_change'])->name('admin.sub_menu.status_change');
    Route::any('admin/sub_menu/get_menu_by_restaurent_id', [App\Http\Controllers\SubMenusController::class, 'get_menu_by_restaurent_id'])->name('admin.sub_menu.get_menu_by_restaurent_id');
      
    //Customer Register
    Route::any('admin/customer/data', [App\Http\Controllers\CustomerController::class, 'data'])->name('admin/customer/data');
   

    Route::any('admin/customer', [App\Http\Controllers\CustomerController::class, 'customer_list'])->name('admin/customer');
    Route::any('admin/customer/create', [App\Http\Controllers\CustomerController::class, 'create'])->name('admin.customer.create');
    Route::any('admin/customer/store', [App\Http\Controllers\CustomerController::class, 'store'])->name('admin.customer.store');
    Route::any('admin/customer/index', [App\Http\Controllers\CustomerController::class, 'index'])->name('admin.customer.index');
    Route::any('admin/customer/edit/{id}', [App\Http\Controllers\CustomerController::class, 'edit'])->name('admin.customer.edit');
    Route::any('admin/customer/show/{id}', [App\Http\Controllers\CustomerController::class, 'show'])->name('admin.customer.show');
    Route::any('admin/customer/update', [App\Http\Controllers\CustomerController::class, 'update'])->name('admin.customer.update');
    Route::any('admin/customer/status_change', [App\Http\Controllers\CustomerController::class, 'status_change'])->name('admin.customer.status_change');
    
    //Branch
    Route::any('admin/branch/{id}', [App\Http\Controllers\CustomerController::class, 'branch_list'])->name('admin.branch');
    Route::any('admin/customerBranch/data', [App\Http\Controllers\CustomerController::class, 'branchdata'])->name('admin/customerBranch/data');
    Route::any('admin/branch_status_change', [App\Http\Controllers\CustomerController::class, 'branch_status_change'])->name('admin.branch.branch_status_change');
   
    
    //Manager
    Route::any('admin/manager/{id}', [App\Http\Controllers\ManagerController::class, 'index'])->name('admin.manager');
    Route::any('admin/manager', [App\Http\Controllers\ManagerController::class, 'managerdata'])->name('admin.managerdata');
    Route::any('admin/managerstatus_change', [App\Http\Controllers\ManagerController::class, 'status_change'])->name('admin.managerstatus_change');
    
       //Chefs
    Route::any('admin/chefs/data', [App\Http\Controllers\ChefsController::class, 'adminData'])->name('admin/chefs/data');
    Route::any('admin/chefs', [App\Http\Controllers\ChefsController::class, 'index'])->name('admin.chefs');
    Route::any('admin/chefs/status_change', [App\Http\Controllers\ChefsController::class, 'status_change'])->name('admin.chefs.status_change');
    
    //Chat
    Route::any('admin/chat', [App\Http\Controllers\ChatController::class, 'index'])->name('admin.chat');
   
    //restaurentGraph
    Route::any('admin/restaurentGraph', [App\Http\Controllers\HomeController::class, 'restaurentGraph'])->name('admin.restaurentGraph');
    
      //Logout Admin Panel
      Route::get('/admin/logout', [LoginController::class, 'logout']);
//});


});
Route::any('/restaurent/settings', [LoginController::class, 'settings'])->name('restaurent/settings');
Route::any('settings', [LoginController::class, 'settings'])->name('settings');

Route::any('restaurent/change_password', [LoginController::class, 'change_password'])->name('restaurent/change_password');
   
Route::group(['middleware' => ['is_restaurent']], function(){
   Route::any('restaurent/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('restaurent.dashboard');
   Route::any('admin/restaurentOrderGraph', [App\Http\Controllers\HomeController::class, 'restaurentOrderGraph'])->name('restaurent.restaurentOrderGraph');
    

   //Branch  Management
   Route::any('restaurent/branch/data', [App\Http\Controllers\BranchController::class, 'branchdata'])->name('restaurent/branch/data');
   Route::any('restaurent/branch', [App\Http\Controllers\BranchController::class, 'index'])->name('restaurent.branch');
   Route::any('restaurent/branch/create', [App\Http\Controllers\BranchController::class, 'create'])->name('restaurent.branch.create');
   Route::any('restaurent/branch/edit/{id}', [App\Http\Controllers\BranchController::class, 'edit'])->name('restaurent.branch.edit');
   Route::any('restaurent/branch/show/{id}', [App\Http\Controllers\BranchController::class, 'show'])->name('restaurent.branch.show');
   Route::any('restaurent/branch/store', [App\Http\Controllers\BranchController::class, 'store'])->name('restaurent.branch.store');
   Route::any('restaurent/branch/update', [App\Http\Controllers\BranchController::class, 'update'])->name('restaurent.branch.update');
   Route::any('restaurent/branch/status_change', [App\Http\Controllers\BranchController::class, 'status_change'])->name('restaurent.branch.status_change');


   //Banner Manager
   Route::any('restaurent/banner/data', [App\Http\Controllers\BannersController::class, 'data'])->name('restaurent/banner/data');
   Route::any('restaurent/banner', [App\Http\Controllers\BannersController::class, 'index'])->name('restaurent.banner');
   Route::any('restaurent/banner/create', [App\Http\Controllers\BannersController::class, 'create'])->name('restaurent.banner.create');
   Route::any('restaurent/banner/edit/{id}', [App\Http\Controllers\BannersController::class, 'edit'])->name('restaurent.banner.edit');
   Route::any('restaurent/banner/show/{id}', [App\Http\Controllers\BannersController::class, 'show'])->name('restaurent.banner.show');
   Route::any('restaurent/banner/store', [App\Http\Controllers\BannersController::class, 'store'])->name('restaurent.banner.store');
   Route::any('restaurent/banner/update', [App\Http\Controllers\BannersController::class, 'update'])->name('restaurent.banner.update');
   Route::any('restaurent/banner/status_change', [App\Http\Controllers\BannersController::class, 'status_change'])->name('restaurent.banner.status_change');
   
   //Servuces Manager
   Route::any('restaurent/services/data', [App\Http\Controllers\ServicesController::class, 'data'])->name('restaurent/services/data');
   Route::any('restaurent/services', [App\Http\Controllers\ServicesController::class, 'index'])->name('restaurent.services');
   Route::any('restaurent/services/create', [App\Http\Controllers\ServicesController::class, 'create'])->name('restaurent.services.create');
   Route::any('restaurent/services/edit/{id}', [App\Http\Controllers\ServicesController::class, 'edit'])->name('restaurent.services.edit');
   Route::any('restaurent/services/show/{id}', [App\Http\Controllers\ServicesController::class, 'show'])->name('restaurent.services.show');
   Route::any('restaurent/services/store', [App\Http\Controllers\ServicesController::class, 'store'])->name('restaurent.services.store');
   Route::any('restaurent/services/update', [App\Http\Controllers\ServicesController::class, 'update'])->name('restaurent.services.update');
   Route::any('restaurent/services/status_change', [App\Http\Controllers\ServicesController::class, 'status_change'])->name('restaurent.services.status_change');
   
   //Banner Manager
   Route::any('restaurent/banner/data', [App\Http\Controllers\BannersController::class, 'data'])->name('restaurent/banner/data');
   Route::any('restaurent/banner', [App\Http\Controllers\BannersController::class, 'index'])->name('restaurent.banner');
   Route::any('restaurent/banner/create', [App\Http\Controllers\BannersController::class, 'create'])->name('restaurent.banner.create');
   Route::any('restaurent/banner/edit/{id}', [App\Http\Controllers\BannersController::class, 'edit'])->name('restaurent.banner.edit');
   Route::any('restaurent/banner/show/{id}', [App\Http\Controllers\BannersController::class, 'show'])->name('restaurent.banner.show');
   Route::any('restaurent/banner/store', [App\Http\Controllers\BannersController::class, 'store'])->name('restaurent.banner.store');
   Route::any('restaurent/banner/update', [App\Http\Controllers\BannersController::class, 'update'])->name('restaurent.banner.update');
   Route::any('restaurent/banner/status_change', [App\Http\Controllers\BannersController::class, 'status_change'])->name('restaurent.banner.status_change');
   
   //Manager  Management
   Route::any('restaurent/manager/data', [App\Http\Controllers\ManagerController::class, 'managerdata'])->name('restaurent/manager/data');
   Route::any('restaurent/manager', [App\Http\Controllers\ManagerController::class, 'index'])->name('restaurent.manager');
   Route::any('restaurent/manager/create', [App\Http\Controllers\ManagerController::class, 'create'])->name('restaurent.manager.create');
   Route::any('restaurent/manager/edit/{id}', [App\Http\Controllers\ManagerController::class, 'edit'])->name('restaurent.manager.edit');
   Route::any('restaurent/manager/show/{id}', [App\Http\Controllers\ManagerController::class, 'show'])->name('restaurent.manager.show');
   Route::any('restaurent/manager/store', [App\Http\Controllers\ManagerController::class, 'store'])->name('restaurent.manager.store');
   Route::any('restaurent/manager/update', [App\Http\Controllers\ManagerController::class, 'update'])->name('restaurent.manager.update');
   Route::any('restaurent/manager/status_change', [App\Http\Controllers\ManagerController::class, 'status_change'])->name('restaurent.manager.status_change');
   
    //Menu /Category
    Route::any('restaurent/menu/restaurentdata', [App\Http\Controllers\MenusController::class, 'restaurentdata'])->name('restaurent.menu.data');
    Route::any('restaurent/menus', [App\Http\Controllers\MenusController::class, 'index'])->name('restaurent/menus');
    Route::any('restaurent/menu/create', [App\Http\Controllers\MenusController::class, 'create'])->name('restaurent.menu.create');
    Route::any('restaurent/menu/edit/{id}', [App\Http\Controllers\MenusController::class, 'edit'])->name('restaurent.menu.edit');
    Route::any('restaurent/menu/store', [App\Http\Controllers\MenusController::class, 'store'])->name('restaurent.menu.store');
    Route::any('restaurent/menu/update', [App\Http\Controllers\MenusController::class, 'update'])->name('restaurent.menu.update');
    Route::any('restaurent/menu/status_change', [App\Http\Controllers\MenusController::class, 'status_change'])->name('restaurent.menu.status_change');

   //Sub Category
   Route::any('restaurent/sub_menu/data', [App\Http\Controllers\SubMenusController::class, 'restaurentdata'])->name('restaurent/sub_menu/data');
   Route::any('restaurent/sub_menu', [App\Http\Controllers\SubMenusController::class, 'index'])->name('restaurent.sub_menu');
   Route::any('restaurent/sub_menu/create', [App\Http\Controllers\SubMenusController::class, 'create'])->name('restaurent.sub_menu.create');
   Route::any('restaurent/sub_menu/edit/{id}', [App\Http\Controllers\SubMenusController::class, 'edit'])->name('restaurent.sub_menu.edit');
   Route::any('restaurent/sub_menu/show/{id}', [App\Http\Controllers\SubMenusController::class, 'show'])->name('restaurent.sub_menu.show');
   Route::any('restaurent/sub_menu/store', [App\Http\Controllers\SubMenusController::class, 'store'])->name('restaurent.sub_menu.store');
   Route::any('restaurent/sub_menu/update', [App\Http\Controllers\SubMenusController::class, 'update'])->name('restaurent.sub_menu.update');
   Route::any('restaurent/sub_menu/status_change', [App\Http\Controllers\SubMenusController::class, 'status_change'])->name('restaurent.sub_menu.status_change');

   //Content Manager
   Route::get('/restaurent/content', [App\Http\Controllers\ContentController::class, 'index'])->name('restaurent/content');
   Route::get('/restaurent/content/edit/{id}', [App\Http\Controllers\ContentController::class, 'edit'])->name('restaurent/emailcontent_template/edit');
   Route::get('/restaurent/content/view/{id}', [App\Http\Controllers\ContentController::class, 'view'])->name('restaurent/content/view');
   Route::any('/restaurent/content/update', [App\Http\Controllers\ContentController::class, 'update'])->name('restaurent/content/update');
   Route::any('/restaurent/content/status_change', [App\Http\Controllers\ContentController::class, 'status_change'])->name('restaurent.content.status_change');
   Route::any('/restaurent/content/data', [App\Http\Controllers\ContentController::class, 'data'])->name('restaurent/content/data');

 //Product_Manage
 Route::any('restaurent/product_manage', [App\Http\Controllers\ProductManageController::class, 'index'])->name('restaurent.product_manage');
 Route::any('restaurent/product_manage/data', [App\Http\Controllers\ProductManageController::class, 'data'])->name('restaurent/product_manage/data');
 Route::any('restaurent/product_manage/create', [App\Http\Controllers\ProductManageController::class, 'create'])->name('restaurent.product_manage.create');
 Route::any('restaurent/product_manage/edit/{id}', [App\Http\Controllers\ProductManageController::class, 'edit'])->name('restaurent.product_manage.edit');
 Route::any('restaurent/product_manage/show/{id}', [App\Http\Controllers\ProductManageController::class, 'show'])->name('restaurent.product_manage.show');
 Route::any('restaurent/product_manage/store', [App\Http\Controllers\ProductManageController::class, 'store'])->name('restaurent.product_manage.store');
 Route::any('restaurent/product_manage/update', [App\Http\Controllers\ProductManageController::class, 'update'])->name('restaurent.product_manage.update');
 Route::any('restaurent/product_manage/status_change', [App\Http\Controllers\ProductManageController::class, 'status_change'])->name('restaurent.product_manage.status_change');
 
 
 //Inventory_Manage
 Route::any('restaurent/inventory_manage', [App\Http\Controllers\InventoryManageController::class, 'index'])->name('restaurent.inventory_manage');
 Route::any('restaurent/inventory_manage/data', [App\Http\Controllers\InventoryManageController::class, 'data'])->name('restaurent/inventory_manage/data');
 Route::any('restaurent/inventory_manage/create', [App\Http\Controllers\InventoryManageController::class, 'create'])->name('restaurent.inventory_manage.create');
 Route::any('restaurent/inventory_manage/edit/{id}', [App\Http\Controllers\InventoryManageController::class, 'edit'])->name('restaurent.inventory_manage.edit');
 Route::any('restaurent/inventory_manage/show/{id}', [App\Http\Controllers\InventoryManageController::class, 'show'])->name('restaurent.inventory_manage.show');
 Route::any('restaurent/inventory_manage/store', [App\Http\Controllers\InventoryManageController::class, 'store'])->name('restaurent.inventory_manage.store');
 Route::any('restaurent/inventory_manage/update', [App\Http\Controllers\InventoryManageController::class, 'update'])->name('restaurent.inventory_manage.update');
 Route::any('restaurent/inventory_manage/status_change', [App\Http\Controllers\InventoryManageController::class, 'status_change'])->name('restaurent.inventory_manage.status_change');
 



 //warehouse_manage
 Route::any('restaurent/warehouse_manage', [App\Http\Controllers\WarehouseController::class, 'create'])->name('restaurent.warehouse_manage');
 Route::any('restaurent/warehouse_manage/store', [App\Http\Controllers\WarehouseController::class, 'store'])->name('restaurent.warehouse.store');
 Route::any('restaurent/warehouse_manage/update', [App\Http\Controllers\WarehouseController::class, 'update'])->name('restaurent.warehouse.update');
Route::get('restaurent/logout', [LoginController::class, 'logout']);

//stockDisplayRestaurent

Route::any('restaurent/stockDisplay', [App\Http\Controllers\HomeController::class, 'stockDisplay'])->name('restaurent.stockDisplay');

Route::any('restaurent/stockDisplayRestaurent', [App\Http\Controllers\HomeController::class, 'stockDisplayRestaurent'])->name('restaurent.stockDisplayRestaurent');
Route::any('restaurent/stockHistory', [App\Http\Controllers\InventoryManageController::class, 'stockHistory'])->name('restaurent.stockHistory');
Route::any('restaurent/stockHistoryRestaurent', [App\Http\Controllers\InventoryManageController::class, 'stockHistoryRestaurent'])->name('restaurent.stockHistoryRestaurent');
Route::any('restaurent/exportExcelstockHistory', [App\Http\Controllers\InventoryManageController::class, 'exportExcelstockHistory'])->name('restaurent.exportExcelstockHistory');




});
  //IsManager
Route::group(['middleware' => ['IsManager']], function(){

   Route::any('manager/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('manager.dashboard');
    //Table  Management
    Route::any('manager/table/data', [App\Http\Controllers\TablesController::class, 'data'])->name('manager/table/data');
    Route::any('manager/table', [App\Http\Controllers\TablesController::class, 'index'])->name('manager.table');
    Route::any('manager/table/create', [App\Http\Controllers\TablesController::class, 'create'])->name('manager.table.create');
    Route::any('manager/table/edit/{id}', [App\Http\Controllers\TablesController::class, 'edit'])->name('manager.table.edit');
    Route::any('manager/table/show/{id}', [App\Http\Controllers\TablesController::class, 'show'])->name('manager.table.show');
    Route::any('manager/table/store', [App\Http\Controllers\TablesController::class, 'store'])->name('manager.table.store');
    Route::any('manager/table/update', [App\Http\Controllers\TablesController::class, 'update'])->name('manager.table.update');
    Route::any('manager/table/status_change', [App\Http\Controllers\TablesController::class, 'status_change'])->name('manager.table.status_change');
    
    //Customer Query
    Route::any('manager/customer_query', [App\Http\Controllers\CustomerQueryController::class, 'index'])->name('manager.customerquery');
    Route::post('manager/send-oder-mail',[App\Http\Controllers\CustomerQueryController::class,'SendMail'])->name('manager/send-oder-mail');
    Route::post('manager/customquery',[App\Http\Controllers\CustomerQueryController::class,'data'])->name('manager.customquery.data');
   
   //Chefs
   Route::any('manager/chefs/data', [App\Http\Controllers\ChefsController::class, 'data'])->name('manager/chefs/data');
   Route::any('manager/chefs', [App\Http\Controllers\ChefsController::class, 'index'])->name('manager.chefs');
   Route::any('manager/chefs/create', [App\Http\Controllers\ChefsController::class, 'create'])->name('manager.chefs.create');
   Route::any('manager/chefs/edit/{id}', [App\Http\Controllers\ChefsController::class, 'edit'])->name('manager.chefs.edit');
   Route::any('manager/chefs/show/{id}', [App\Http\Controllers\ChefsController::class, 'show'])->name('manager.chefs.show');
   Route::any('manager/chefs/store', [App\Http\Controllers\ChefsController::class, 'store'])->name('manager.chefs.store');
   Route::any('manager/chefs/update', [App\Http\Controllers\ChefsController::class, 'update'])->name('manager.chefs.update');
   Route::any('manager/chefs/status_change', [App\Http\Controllers\ChefsController::class, 'status_change'])->name('manager.chefs.status_change');

   Route::any('manager/order/data', [App\Http\Controllers\OrderController::class, 'data'])->name('manager/order/data');
    
   Route::any('manager/order/assigndata', [App\Http\Controllers\OrderController::class, 'assigndata'])->name('manager/order/assigndata');
   Route::any('manager/order/acceptdata', [App\Http\Controllers\OrderController::class, 'acceptdata'])->name('manager/order/acceptdata');
   Route::any('manager/order/preparendata', [App\Http\Controllers\OrderController::class, 'preparendata'])->name('manager/order/preparendata');
   Route::any('manager/order/deliverndata', [App\Http\Controllers\OrderController::class, 'deliverndata'])->name('manager/order/deliverndata');
  
  
   Route::any('manager/order', [App\Http\Controllers\OrderController::class, 'index'])->name('manager.order');
   Route::any('manager/order_status_change', [App\Http\Controllers\OrderController::class, 'order_status'])->name('manager/order_status_change');
   Route::any('manager/order/edit/{id}', [App\Http\Controllers\OrderController::class, 'edit'])->name('manager.order.edit');
   Route::any('manager/order/show/{id}', [App\Http\Controllers\OrderController::class, 'show'])->name('manager.order.show');
   
   
   Route::any('manager/inventory_request', [App\Http\Controllers\WarehouseController::class, 'manager_request'])->name('manager.inventory_request');
   Route::any('manager/request_store', [App\Http\Controllers\WarehouseController::class, 'request_store'])->name('manager.request_store');
   Route::any('manager/managerrequestdata', [App\Http\Controllers\WarehouseController::class, 'managerrequestdata'])->name('manager/managerrequestdata');
   Route::get('manager/logout', [LoginController::class, 'logout']);

   Route::any('manager/custom_order', [App\Http\Controllers\ManagerController::class, 'custom_order'])->name('manager.custom_order');

   Route::any('manager/get_sub_menu', [App\Http\Controllers\ManagerController::class, 'get_sub_menu'])->name('manager.get_sub_menu');

   Route::any('manager/custom_order_store', [App\Http\Controllers\ManagerController::class, 'custom_order_store'])->name('manager.custom_order_store');

   Route::any('manager/custom_order_requestdata', [App\Http\Controllers\OrderController::class, 'custom_order_requestdata'])->name('manager/custom_order_requestdata');


  
});

 //IsChef
 Route::group(['middleware' => ['IsChef']], function(){
   Route::any('chef/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('chef.dashboard');
   Route::any('chef/order', [App\Http\Controllers\OrderController::class, 'index'])->name('chef.order');
   Route::any('chef/order/data', [App\Http\Controllers\OrderController::class, 'data'])->name('chef/order/data');
   Route::any('chef/order/assigndata', [App\Http\Controllers\OrderController::class, 'assigndata'])->name('chef/order/assigndata');
   Route::any('chef/order/acceptdata', [App\Http\Controllers\OrderController::class, 'acceptdata'])->name('chef/order/acceptdata');
 
   Route::any('chef/order/preparendata', [App\Http\Controllers\OrderController::class, 'preparendata'])->name('chef/order/preparendata');
   Route::any('chef/order/deliverndata', [App\Http\Controllers\OrderController::class, 'deliverndata'])->name('chef/order/deliverndata');
   
   Route::any('chef/order_status_change', [App\Http\Controllers\OrderController::class, 'order_status'])->name('chef/order_status_change');
   Route::any('chef/order_process_change', [App\Http\Controllers\OrderController::class, 'order_process_change'])->name('chef/order_process_change');
   Route::any('chef/order/edit/{id}', [App\Http\Controllers\OrderController::class, 'edit'])->name('chef.order.edit');
   Route::any('chef/order/show/{id}', [App\Http\Controllers\OrderController::class, 'show'])->name('chef.order.show');

      
   Route::any('chef/custom_order_request', [App\Http\Controllers\OrderController::class, 'custom_order_request'])->name('chef/custom_order_request');
   Route::any('chef/custom_order_requestdata', [App\Http\Controllers\OrderController::class, 'custom_order_requestdata'])->name('chef/custom_order_requestdata');

   Route::any('chef/custom_order_status_change', [App\Http\Controllers\OrderController::class, 'custom_order_status_change'])->name('chef/custom_order_status_change');

   
   Route::get('chef/logout', [LoginController::class, 'logout']);
});
//Iswerehousef
Route::group(['middleware' => ['IsWarehouse']], function(){
   Route::any('warehouse_manage/dashboard', [App\Http\Controllers\WarehouseController::class, 'dashboard'])->name('warehouse.dashboard');
   Route::any('warehouse_manage/data', [App\Http\Controllers\WarehouseController::class, 'data'])->name('warehouse_manage/data');
   Route::any('warehouse_manage/inventory_request', [App\Http\Controllers\WarehouseController::class, 'inventory_request'])->name('warehouse_manage/inventory_request');
   Route::post('warehouse_manage/data2',[App\Http\Controllers\WarehouseController::class, 'data2'])->name('warehouse_manage/data2');

   Route::any('warehouse_manage/inventory_request_status', [App\Http\Controllers\WarehouseController::class, 'inventory_request_status'])->name('warehouse_manage/inventory_request_status');


   Route::get('warehouse_manage/logout', [LoginController::class, 'logout']);



});