<?php

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

require __DIR__ . '/auth.php';

Route::get('/', [
    'uses' => 'Ecommerce\WelcomeController@welcome',
    'as' => 'welcome',
]);

Route::get('/ajax/distributor/{distributor}/upazila/get', [
    'uses' => 'Ecommerce\WelcomeController@getUpazilaByDistributor',
    'as' => 'getUpazilaByDistributor',
]);
Route::get('/ajax/depo/{depo}/district/get', [
    'uses' => 'Ecommerce\WelcomeController@getDistrictByDepo',
    'as' => 'getDistrictByDepo',
]);


Route::get('/dashboard', function () {
    // return view('dashboard');
    return redirect()->route('welcome');
})->middleware(['auth'])->name('dashboard');

Route::get('select/user', [
    'uses' => 'User\UserDashboardController@selectUser',
    'as' => 'user.selectUser',
]);
Route::get('/api/check-login', '\App\Http\Controllers\Api\Auth\UserAuthController@checkAuth');

Route::prefix('api')->middleware(['auth'])->namespace('\App\Http\Controllers\Api')->group(function () {
    Route::get('/my-info', 'User\UserController@getInfo');
    Route::post('/update-profile', 'User\UserController@updateProfile');
    Route::post('/profile-picture/upload', 'User\UserController@uploadProfilePicture');
});
// ecommerce routes
Route::prefix('api')->namespace('\App\Http\Controllers\Api\Ecommerce')->group(function () {
    Route::get('/products', 'IndexController@index');
    Route::get('/products/recently-viewed', 'IndexController@recentlyViewedProducts');
    Route::get('/products/best-deals', 'IndexController@recentlyViewedProducts');
    Route::get('/product/{product}/details', 'IndexController@getProduct');
    Route::get('/categories/get', 'IndexController@getCategories');
    Route::get('/category/{category}', 'IndexController@getSubCategories');
    Route::post('/cart/add/product/{product}', 'CartController@addToCart');
    Route::post('/cart/remove/product/{product}', 'CartController@removeCart');
    Route::get('/product/{product}/cart/get', 'CartController@getProductCart');
    Route::get('/carts/get', 'CartController@getCarts');
    Route::get('/order/{order}/details', 'CartController@getOrderDetails')->middleware(['auth']);
    Route::post('/oder/place', 'CartController@placeOrder')->middleware(['auth']);
    Route::post('/oder/payment', 'CartController@payment')->middleware(['auth']);
    Route::post('/oder/payment-method', 'CartController@paymentMethod')->middleware(['auth']);
    Route::get('/my-orders', 'CustomerOrderController@myOrders')->middleware(['auth']);
    Route::get('/my-order/{order}', 'CustomerOrderController@myOrderDetails')->middleware(['auth']);
    Route::post('/my-order/{order}/make-payment', 'CustomerOrderController@makePayment')->middleware(['auth']);
});

Route::prefix('api/agent')->namespace('\App\Http\Controllers\Api\Agent')->group(function () {
    Route::get('agentships/get', 'AgentDashboardController@getAgentships');
    Route::get('/{agent}/dashboard/info', 'AgentDashboardController@getAgentDashboardInfo');
    Route::post('/{agent}/user/save', 'AgentDashboardController@saveUser');
    Route::prefix('{agent}/ecommerce')->group(function () {
        Route::resource('product', Ecommerce\AgentProductController::class);
        Route::get('/orders', 'Ecommerce\AgentOrderController@index');
        Route::get('/order/{order}/details', 'Ecommerce\AgentOrderController@orderDetails');
        Route::get('/order/{order}/shipments', 'Ecommerce\AgentOrderController@orderShipments');
        Route::get('/shipment/returns', 'Ecommerce\AgentReturnController@returnList');
        Route::get('/shipment/return/{return}', 'Ecommerce\AgentReturnController@returnDetails');
        Route::post('/order/{order}/shipment/{shipment}/collected', 'Ecommerce\AgentOrderController@orderShipmentCollected');
        Route::post('/order/{order}/shipment/{shipment}/delivered', 'Ecommerce\AgentOrderController@orderShipmentDelivered');
        Route::get('/order/{order}/shipment/{shipment}', 'Ecommerce\AgentOrderController@orderShipmentDetails');
        Route::post('/order/{order}/shipment/{shipment}/return', 'Ecommerce\AgentOrderController@orderShipmentReturnPost');
        Route::post('/order/place', 'Ecommerce\AgentOrderController@orderPlace');
        Route::get('/shop/{source}/products/published', 'Ecommerce\AgentProductController@getPublishedProducts');
        Route::get('product/{product}/details', 'Ecommerce\AgentProductController@productDetails');
        Route::post('product/feature-image/upload',  'Ecommerce\AgentProductController@productFeatureImageChange');
        Route::post('product-info/save',  'Ecommerce\AgentProductController@store');
        Route::get('/categories/get',  'Ecommerce\AgentProductController@getCategories');
        Route::post('/product/category/save',  'Ecommerce\AgentProductController@productCategorySave');
        Route::post('/product/category/remove',  'Ecommerce\AgentProductController@productCategoryRemove');
        Route::get('/product/category/check',  'Ecommerce\AgentProductController@productHasCategories');
        Route::get('/product/owner/search',  'Ecommerce\AgentProductController@productOwnerSearch');
        Route::get('/shop/search',  'Ecommerce\AgentSourceController@shopSearch');
        Route::get('/product/owner/{user}/sources/get',  'Ecommerce\AgentSourceController@getSourcesByUser');
        Route::get('/markets/get', 'Ecommerce\AgentSourceController@getMarketsByAgent');
        Route::post('/product/owner/{user}/source/save', 'Ecommerce\AgentSourceController@store');
        Route::post('/shop/save', 'Ecommerce\AgentSourceController@storeShop');
        Route::post('/product/submit', 'Ecommerce\AgentProductController@submitProduct');
        Route::get('/sales-list/get', 'Ecommerce\AgentProductController@getSalesList');
        Route::get('/sales-list/{list}/products/get', 'Ecommerce\AgentProductController@getSalesListProducts');
        Route::get('/users/get', 'Ecommerce\AgentSourceController@getUsers');
        Route::get('/sources/get', 'Ecommerce\AgentSourceController@getSources');
        Route::get('/shop/search', 'Ecommerce\AgentSourceController@searchSources');
        Route::get('shop/{source}/products/list/search', 'Ecommerce\AgentProductController@searchProductList');
        Route::get('/shop/{source}/details', 'Ecommerce\AgentSourceController@shopDetails');

        Route::post('/collection/save', 'Ecommerce\AgentCollectionController@store');
        Route::get('/collection/list', 'Ecommerce\AgentCollectionController@index');
    });
});

//admin
Route::group(['middleware' => ['myrole:admin', 'auth'], 'prefix' => 'admin'], function () {

    Route::get('/dashboard', [
        'uses' => 'Admin\AdminDashboardController@dashboard',
        'as' => 'admin.dashboard',
    ]);

    Route::get('/dashboard/chart-data/get', [
        'uses' => 'Admin\AdminDashboardController@getChartData',
        'as' => 'admin.getChartData',
    ]);

    Route::get('admins/all/', [
        'uses' => 'Admin\Role\AdminRoleController@adminsAll',
        'as' => 'admin.adminsAll',
    ]);
    Route::get('factory/all/', [
        'uses' => 'Admin\Role\AdminRoleController@factoryAll',
        'as' => 'admin.factoryAll',
    ]);

    Route::get('select/new/role', [
        'as' => 'admin.selectNewRole',
        'uses' => 'Admin\Role\AdminRoleController@selectNewRole',
    ]);

    Route::post('admin/add/new/post', [
        'uses' => 'Admin\Role\AdminRoleController@adminAddNewPost',
        'as' => 'admin.adminAddNewPost',
    ]);
    Route::post('factory/add/new/post', [
        'uses' => 'Admin\Role\AdminRoleController@factoryAddNewPost',
        'as' => 'admin.factoryAddNewPost',
    ]);

    Route::post('admin/delete/{role}', [
        'uses' => 'Admin\Role\AdminRoleController@adminDelete',
        'as' => 'admin.adminDelete',
    ]);
    Route::post('factory/delete/{role}', [
        'uses' => 'Admin\Role\AdminRoleController@factoryDelete',
        'as' => 'admin.factoryDelete',
    ]);


    // project
    // Route::get('/projects', [
    //     'uses' => 'Admin\Project\AdminProjectController@projects',
    //     'as' => 'admin.projects',
    // ]);
    // Route::get('/project/new', [
    //     'uses' => 'Admin\Project\AdminProjectController@projectNew',
    //     'as' => 'admin.project.new',
    // ]);
    // Route::post('/project/save', [
    //     'uses' => 'Admin\Project\AdminProjectController@projectSave',
    //     'as' => 'admin.project.save',
    // ]);

    //dealer depo agent roles start

    Route::get('roles/all/type/{type}', [
        'uses' => 'Admin\Role\AdminRoleController@rolesAll',
        'as' => 'admin.rolesAll',
    ]);
    Route::get('roles/search/type/{type}', [
        'uses' => 'Admin\Role\AdminRoleController@searchRoles',
        'as' => 'admin.roles.search',
    ]);

    Route::get('roles/edit/type/{type}/role/{role}', [
        'uses' => 'Admin\Role\AdminRoleController@roleEdit',
        'as' => 'admin.roleEdit',
    ]);

    Route::post('role/edit/post/type/{type}/role/{role}', [
        'uses' => 'Admin\Role\AdminRoleController@roleEditPost',
        'as' => 'admin.roleEditPost',
    ]);

    Route::post('role/delete/role/{role}/type/{type}', [
        'uses' => 'Admin\Role\AdminRoleController@roleDelete',
        'as' => 'admin.roleDelete',
    ]);

    Route::get('roles/all-type/{type}', [
        'uses' => 'Admin\Role\AdminRoleController@rolesAllType',
        'as' => 'admin.rolesAllType',
    ]);

    Route::get('role/sr/{agent}/shops', [
        'uses' => 'Admin\Role\AdminSrController@shopList',
        'as' => 'admin.sr.shops',
    ]);
    Route::get('role/sr/{agent}/orders', [
        'uses' => 'Admin\Role\AdminSrController@orderList',
        'as' => 'admin.sr.orders',
    ]);
    Route::get('role/sr/{agent}/collections', [
        'uses' => 'Admin\Role\AdminSrController@collectionList',
        'as' => 'admin.sr.collections',
    ]);
    Route::get('role/sr/{agent}/returns', [
        'uses' => 'Admin\Role\AdminSrController@returnList',
        'as' => 'admin.sr.returns',
    ]);
    Route::get('role/sr/{agent}/commissions', [
        'uses' => 'Admin\Role\AdminSrController@commissionList',
        'as' => 'admin.sr.commissions',
    ]);

    Route::post('payment-add-to-role/type/{type}/role/{role}', [
        'uses' => 'Admin\Role\AdminRoleController@paymentAddToRole',
        'as' => 'admin.paymentAddToRole',
    ]);

    Route::post('payment-receive-from-role/type/{type}/role/{role}', [
        'uses' => 'Admin\Role\AdminRoleController@paymentReceiveFromRole',
        'as' => 'admin.paymentReceiveFromRole',
    ]);

    Route::post('role/add/new/post/type/{type}', [
        'uses' => 'Admin\Role\AdminRoleController@roleAddNewPost',
        'as' => 'admin.roleAddNewPost',
    ]);
    //dealer depo agent roles end

    //depo-dist-dealer-auto-add start
    // Route::get('depo-dist-dealer-auto-add/type/{type}', [
    // 'as' => 'admin.depoDistDealerAutoAdd',
    // 'uses' => 'Admin\Role\AdminRoleController@depoDistDealerAutoAdd'
    // ]);
    //depo-dist-dealer-auto-add end

    //category start
    Route::get('ecommerce/product/categories', [
        'uses' => 'Admin\Ecommerce\AdminProductCategoryController@productCategories',
        'as' => 'admin.productCategories',
    ]);
    Route::get('ecommerce/product/categories/update/by/jstree/type/{type}', [
        'uses' => 'Admin\Ecommerce\AdminProductCategoryController@updateCategoriesByJsTree',
        'as' => 'admin.updateCategoriesByJsTree',
    ]);
    Route::post('ecommerce/product/category/update/category/{cat}', [
        'uses' => 'Admin\Ecommerce\AdminProductCategoryController@categoryUpdatePost',
        'as' => 'admin.categoryUpdatePost',
    ]);
//category end

// ecommerce
Route::prefix('/manage')->group(function () {
    Route::get('/products', [
        'uses' => 'Admin\Ecommerce\AdminProductController@index',
        'as' => 'admin.ecommerce.products',
    ]);
    Route::get('/product/create', [
        'uses' => 'Admin\Ecommerce\AdminProductController@create',
        'as' => 'admin.ecommerce.product.create',
    ]);
    Route::post('/product/store', [
        'uses' => 'Admin\Ecommerce\AdminProductController@store',
        'as' => 'admin.ecommerce.product.store',
    ]);
    Route::get('/product/{product}', [
        'uses' => 'Admin\Ecommerce\AdminProductController@show',
        'as' => 'admin.ecommerce.product',
    ]);
    Route::get('/product/{product}/edit', [
        'uses' => 'Admin\Ecommerce\AdminProductController@edit',
        'as' => 'admin.ecommerce.product.edit',
    ]);
    Route::post('/product/update/{product?}', [
        'uses' => 'Admin\Ecommerce\AdminProductController@update',
        'as' => 'admin.ecommerce.product.update',
    ]);
    Route::post('/product/{product}/publish', [
        'uses' => 'Admin\Ecommerce\AdminProductController@publish',
        'as' => 'admin.ecommerce.product.publish',
    ]);
    Route::post('/product/{product}/price/update/{price?}', [
        'uses' => 'Admin\Ecommerce\AdminProductController@priceUpdate',
        'as' => 'admin.ecommerce.product.priceUpdate',
    ]);
    Route::get('/orders', [
        'uses' => 'Admin\Ecommerce\AdminOrderController@index',
        'as' => 'admin.ecommerce.orders',
    ]);
    Route::get('/order/{order}', [
        'uses' => 'Admin\Ecommerce\AdminOrderController@show',
        'as' => 'admin.ecommerce.order',
    ]);
    Route::post('/order/{order}', [
        'uses' => 'Admin\Ecommerce\AdminOrderController@orderOrderStatusUpdate',
        'as' => 'admin.ecommerce.orderOrderStatusUpdate',
    ]);
    Route::get('/shipment/returns', [
        'uses' => 'Admin\Ecommerce\AdminOrderController@returnList',
        'as' => 'admin.ecommerce.shipment.returns',
    ]);
    Route::get('/shipment/return/{return}', [
        'uses' => 'Admin\Ecommerce\AdminOrderController@returnShow',
        'as' => 'admin.ecommerce.shipment.return',
    ]);
    Route::post('/shipment/return/{return}/status/{status}', [
        'uses' => 'Admin\Ecommerce\AdminOrderController@returnStatusUpdate',
        'as' => 'admin.ecommerce.shipment.return.statusUpdate',
    ]);
    Route::get('/users', [
        'uses' => 'Admin\Ecommerce\AdminUserController@index',
        'as' => 'admin.ecommerce.users',
    ]);
    Route::get('/user/{user}', [
        'uses' => 'Admin\Ecommerce\AdminUserController@show',
        'as' => 'admin.ecommerce.user.edit',
    ]);
    Route::post('/user/{user}', [
        'uses' => 'Admin\Ecommerce\AdminUserController@update',
        'as' => 'admin.ecommerce.user.update',
    ]);
    Route::post('/user/{user}/password', [
        'uses' => 'Admin\Ecommerce\AdminUserController@updatePassword',
        'as' => 'admin.ecommerce.user.password',
    ]);
    Route::get('/sales-list', [
        'uses' => 'Admin\Ecommerce\AdminSalesListController@index',
        'as' => 'admin.ecommerce.salesLists',
    ]);
    Route::get('/sales-list/crate', [
        'uses' => 'Admin\Ecommerce\AdminSalesListController@create',
        'as' => 'admin.ecommerce.salesList.create',
    ]);
    Route::get('/sales-list/{list}/edit', [
        'uses' => 'Admin\Ecommerce\AdminSalesListController@edit',
        'as' => 'admin.ecommerce.salesList.edit',
    ]);
    Route::post('sales-list/store/{list?}', [
        'uses' => 'Admin\Ecommerce\AdminSalesListController@store',
        'as' => 'admin.ecommerce.salesList.store',
    ]);
    Route::delete('sales-list/{list}/delete', [
        'uses' => 'Admin\Ecommerce\AdminSalesListController@destroy',
        'as' => 'admin.ecommerce.salesList.destroy',
    ]);
    Route::get('/sales-list/product/search', [
        'uses' => 'Admin\Ecommerce\AdminSalesListController@searchProduct',
        'as' => 'admin.ecommerce.salesList.product.search',
    ]);
    Route::get('/sales-list/item/{listItem}/product/{product}/detach', [
        'uses' => 'Admin\Ecommerce\AdminSalesListController@detachProduct',
        'as' => 'admin.ecommerce.salesList.product.detach',
    ]);
    Route::get('/shop', [
        'uses' => 'Admin\Ecommerce\AdminSourceController@index',
        'as' => 'admin.shops',
    ]);
    Route::get('/shop/{shop}/orders', [
        'uses' => 'Admin\Ecommerce\AdminSourceController@orderList',
        'as' => 'admin.shop.orders',
    ]);
    Route::get('/shop/{shop}/collections', [
        'uses' => 'Admin\Ecommerce\AdminSourceController@collectionList',
        'as' => 'admin.shop.collections',
    ]);
    Route::get('/shop/{shop}/returns', [
        'uses' => 'Admin\Ecommerce\AdminSourceController@retutnList',
        'as' => 'admin.shop.returns',
    ]);
    Route::get('/shop/{shop}/comissions', [
        'uses' => 'Admin\Ecommerce\AdminSourceController@comissionList',
        'as' => 'admin.shop.comissions',
    ]);
    Route::get('/shop/{shop}/edit', [
        'uses' => 'Admin\Ecommerce\AdminSourceController@edit',
        'as' => 'admin.shop.edit',
    ]);
    Route::post('/shop/{shop}/update', [
        'uses' => 'Admin\Ecommerce\AdminSourceController@update',
        'as' => 'admin.shop.update',
    ]);
    Route::get('/collections', [
        'uses' => 'Admin\Ecommerce\AdminCollectionController@index',
        'as' => 'admin.collections',
    ]);
    Route::get('/collection/{collection}', [
        'uses' => 'Admin\Ecommerce\AdminCollectionController@edit',
        'as' => 'admin.collection.edit',
    ]);
    Route::post('/collection/{collection}/varify', [
        'uses' => 'Admin\Ecommerce\AdminCollectionController@update',
        'as' => 'admin.collection.varify',
    ]);
});
// ecommerce

/// report
    Route::get('/report/{type}', [
        'uses' => 'Admin\AdminReportController@index',
        'as' => 'admin.report',
    ]);

    Route::get('/commissions', [
        'uses' => 'Admin\AdminReportController@commissionList',
        'as' => 'admin.commissionList',
    ]);

    Route::get('/search/{type}', [
        'uses' => 'Admin\AdminSearchController@search',
        'as' => 'admin.search',
    ]);

});

//admin
Route::group(['middleware' => ['myrole:factory', 'auth'], 'prefix' => 'factory'], function () {
    Route::get('/', [
        'uses' => 'Factory\FactoryDashboardController@index',
        'as' => 'factory.dashboard',
    ]);
    Route::get('/orders/confirmed', [
        'uses' => 'Factory\FactoryOrderController@index',
        'as' => 'factory.orders',
    ]);
    Route::get('/order/{order}/process', [
        'uses' => 'Factory\FactoryOrderController@process',
        'as' => 'factory.order.process',
    ]);
    Route::post('/order/{order}/process', [
        'uses' => 'Factory\FactoryOrderController@processSave',
        'as' => 'factory.order.process.save',
    ]);
    Route::get('/orders/processing', [
        'uses' => 'Factory\FactoryOrderController@ordersProcessing',
        'as' => 'factory.orders.processing',
    ]);
    Route::post('/order/{shipment}/ready-to-ship', [
        'uses' => 'Factory\FactoryOrderController@readyToShipSave',
        'as' => 'factory.order.readyToShip',
    ]);
    Route::get('/orders/ready-to-ship', [
        'uses' => 'Factory\FactoryOrderController@ordersReadyToShip',
        'as' => 'factory.orders.readyToShip',
    ]);
    Route::post('/order/{shipment}/ship', [
        'uses' => 'Factory\FactoryOrderController@shipSave',
        'as' => 'factory.order.ship',
    ]);
    Route::get('/orders/shipped', [
        'uses' => 'Factory\FactoryOrderController@ordersShipped',
        'as' => 'factory.orders.shipped',
    ]);
    Route::get('/orders/incomplete', [
        'uses' => 'Factory\FactoryOrderController@ordersIncomplete',
        'as' => 'factory.orders.incomplete',
    ]);

    Route::get('/products', [
        'uses' => 'Factory\FactoryProductController@index',
        'as' => 'factory.products',
    ]);
    Route::get('/product/{product}', [
        'uses' => 'Factory\FactoryProductController@show',
        'as' => 'factory.product.view',
    ]);
    Route::get('/replacements', [
        'uses' => 'Factory\FactoryReplacementController@index',
        'as' => 'factory.replacements',
    ]);
    Route::get('/replacement/{replace}/process', [
        'uses' => 'Factory\FactoryReplacementController@process',
        'as' => 'factory.replacement.process',
    ]);
    Route::post('/replacement/{replace}/process/save', [
        'uses' => 'Factory\FactoryReplacementController@processSave',
        'as' => 'factory.replacement.process.save',
    ]);

});

//dealer
Route::group(['middleware' => ['myrole:dealer', 'auth'], 'prefix' => 'dealer'], function () {
    Route::get('/', [
        'uses' => 'Dealer\DealerDashboardController@index',
        'as' => 'dealer.index',
    ]);

    Route::get('dashboard/dealer/{dealer}', [
        'uses' => 'Dealer\DealerDashboardController@dashboard',
        'as' => 'dealer.dashboard',
    ]);
    Route::get('all-markets/dealer/{dealer}', [
        'uses' => 'Dealer\DealerMarketController@allMarkets',
        'as' => 'dealer.allMarkets',
    ]);

    Route::post('add-new-market-post/dealer/{dealer}', [
        'uses' => 'Dealer\DealerMarketController@addNewMarketPost',
        'as' => 'dealer.addNewMarketPost',
    ]);

    Route::get('market-edit/dealer/{dealer}/market/{market}', [
        'uses' => 'Dealer\DealerMarketController@marketEdit',
        'as' => 'dealer.marketEdit',
    ]);

    Route::post('market-edit-post/dealer/{dealer}/market/{market}', [
        'uses' => 'Dealer\DealerMarketController@marketEditPost',
        'as' => 'dealer.marketEditPost',
    ]);

    Route::get('all-agents/dealer/{dealer}', [
        'uses' => 'Dealer\DealerRoleController@allAgents',
        'as' => 'dealer.allAgents',
    ]);

    Route::post('new-agent/post/dealer/{dealer}', [
        'uses' => 'Dealer\DealerRoleController@newAgentPost',
        'as' => 'dealer.newAgentPost',
    ]);

    Route::get('agent-edit/dealer/{dealer}/agent/{agent}', [
        'uses' => 'Dealer\DealerRoleController@agentEdit',
        'as' => 'dealer.agentEdit',
    ]);

    Route::post('agent-edit-post/dealer/{dealer}/agent/{agent}', [
        'uses' => 'Dealer\DealerRoleController@agentEditPost',
        'as' => 'dealer.agentEditPost',
    ]);

    Route::get('all-leads/dealer/{dealer}/status/{status}', [
        'uses' => 'Dealer\DealerLeadController@allLeads',
        'as' => 'dealer.allLeads',
    ]);

    Route::get('lead-single-edit/dealer/{dealer}/lead/{lead}', [
        'uses' => 'Dealer\DealerLeadController@leadSingleEdit',
        'as' => 'dealer.leadSingleEdit',
    ]);

    // //fi of lead
    // Route::get('lead-feature-img/delete/dealer/{dealer}/lead/{lead}', [
    //     'uses' =>'Dealer\DealerLeadController@leadFeatureImageDelete',
    //     'as' => 'dealer.leadFeatureImageDelete'
    // ]);

    // Route::post('lead-feature-image/change/dealer/{dealer}/lead/{lead}', [
    //     'uses' =>'Dealer\DealerLeadController@leadFeatureImageChange',
    //     'as' => 'dealer.leadFeatureImageChange'
    // ]);

    // Route::get('lead-source-change/dealer/{dealer}/lead/{lead}', [
    //     'uses' =>'Dealer\DealerLeadController@leadSourceChange',
    //     'as' => 'dealer.leadSourceChange'
    // ]);

    // Route::post('lead-info-update/dealer/{dealer}/lead/{lead}', [
    //     'uses' =>'Dealer\DealerLeadController@leadInfoUpdate',
    //     'as' => 'dealer.leadInfoUpdate'
    // ]);

    // //extra image

    // Route::post('lead-feature-image/change/dealer/{dealer}/lead/{lead}', [
    //     'uses' =>'Dealer\DealerLeadController@leadFeatureImageChange',
    //     'as' => 'dealer.leadFeatureImageChange'
    // ]);

    // Route::get('lead-extra-image-change/modal-open/dealer/{dealer}/lead/{lead}', [
    //     'uses' =>'Dealer\DealerLeadController@leadExtraImageChangeModalOpen',
    //     'as' => 'dealer.leadExtraImageChangeModalOpen'
    // ]);

    // Route::post('lead-extra-image/change-post/dealer/{dealer}/lead/{lead}', [
    //     'uses' =>'Dealer\DealerLeadController@leadExtraImageChangePost',
    //     'as' => 'dealer.leadExtraImageChangePost'
    // ]);

    // Route::get('lead-extra-img/delete/dealer/{dealer}/media/{media}', [
    //     'uses' =>'Dealer\DealerLeadController@leadExtraImageDelete',
    //     'as' => 'dealer.leadExtraImageDelete'
    // ]);

    // Route::get('all-orders/dealer/{dealer}/status/{status}', [
    //     'uses' =>'Dealer\DealerOrderController@allOrders',
    //     'as' => 'dealer.allOrders'
    // ]);

    // Route::get('order-single-edit/dealer/{dealer}/order/{order}', [
    //     'uses' =>'Dealer\DealerOrderController@orderSingleEdit',
    //     'as' => 'dealer.orderSingleEdit'
    // ]);

    // Route::get('order-item-single-cancel/dealer/{dealer}/item/{item}', [
    //     'uses' =>'Dealer\DealerOrderController@orderItemSingleCancel',
    //     'as' => 'dealer.orderItemSingleCancel'
    // ]);

    // Route::post('order-info-update/dealer/{dealer}/order/{order}', [
    //     'uses' =>'Dealer\DealerOrderController@orderInfoUpdate',
    //     'as' => 'dealer.orderInfoUpdate'
    // ]);

    // Route::get('all-lead-orders/dealer/{dealer}/status/{status}', [
    //     'uses' =>'Dealer\DealerOrderController@allLeadOrders',
    //     'as' => 'dealer.allLeadOrders'
    // ]);

    // Route::get('lead-order-make-chanage/dealer/{dealer}/item/{item}/status/{status}', [
    //     'uses' =>'Dealer\DealerOrderController@leadOrderMakeChange',
    //     'as' => 'dealer.leadOrderMakeChange'
    // ]);

    // Route::get('lead-order-collect-delivered/dealer/{dealer}/item/{item}/status/{status}', [
    //     'uses' =>'Dealer\DealerOrderController@leadOrderCollectDelivered',
    //     'as' => 'dealer.leadOrderCollectDelivered'
    // ]);

    // Route::get('order-delivered/dealer/{dealer}/order/{order}', [
    //     'uses' =>'Dealer\DealerOrderController@orderDelivered',
    //     'as' => 'dealer.orderDelivered'
    // ]);

    // Route::post('order-payment-submit/dealer/{dealer}/order/{order}', [
    //     'uses' =>'Dealer\DealerOrderController@orderPaymentSubmit',
    //     'as' => 'dealer.orderPaymentSubmit'
    // ]);

});

/**
 *-------------------------------
 * Agent Routes
 *-------------------------------
 */
Route::group(['middleware' => ['myrole:agent', 'auth'], 'prefix' => 'agent'], function () {

    Route::get('/', [
        'uses' => 'Agent\AgentDashboardController@index',
        'as' => 'agent.index',
    ]);
    Route::get('/{agent}', [
        'uses' => 'Agent\AgentDashboardController@ecommerceIndex',
        'as' => 'agent.ecommerce.index',
    ]);
    Route::get('dashboard/agent/{agent}', [
        'uses' => 'Agent\AgentDashboardController@dashboard',
        'as' => 'agent.dashboard',
    ]);

    Route::get('products/get', function () {
        return 1;
    });

    // Route::get('create/new-lead/agent/{agent}', [
    //     'uses' =>'Agent\AgentLeadController@createNewLead',
    //     'as' => 'agent.createNewLead'
    // ]);

    // Route::get('all-leads/agent/{agent}', [
    //     'uses' =>'Agent\AgentLeadController@allLeads',
    //     'as' => 'agent.allLeads'
    // ]);

    // Route::post('lead-feature-image/change/agent/{agent}/lead/{lead}', [
    //     'uses' =>'Agent\AgentLeadController@leadFeatureImageChange',
    //     'as' => 'agent.leadFeatureImageChange'
    // ]);

    // Route::get('lead-extra-image-change/modal-open/agent/{agent}/lead/{lead}', [
    //     'uses' =>'Agent\AgentLeadController@leadExtraImageChangeModalOpen',
    //     'as' => 'agent.leadExtraImageChangeModalOpen'
    // ]);

    // Route::post('lead-extra-image/change-post/agent/{agent}/lead/{lead}', [
    //     'uses' =>'Agent\AgentLeadController@leadExtraImageChangePost',
    //     'as' => 'agent.leadExtraImageChangePost'
    // ]);

    // Route::get('lead-extra-img/delete/agent/{agent}/media/{media}', [
    //     'uses' =>'Agent\AgentLeadController@leadExtraImageDelete',
    //     'as' => 'agent.leadExtraImageDelete'
    // ]);

    // Route::get('lead-feature-img/delete/agent/{agent}/lead/{lead}', [
    //     'uses' =>'Agent\AgentLeadController@leadFeatureImageDelete',
    //     'as' => 'agent.leadFeatureImageDelete'
    // ]);

    // Route::get('lead-owner-modal-open/agent/{agent}/lead/{lead}', [
    //     'uses' =>'Agent\AgentUserController@leadOwnerModalOpen',
    //     'as' => 'agent.leadOwnerModalOpen'
    // ]);

    // Route::get('lead-owner-id-add/agent/{agent}/lead/{lead}', [
    //     'uses' =>'Agent\AgentUserController@leadOwnerIdAdd',
    //     'as' => 'agent.leadOwnerIdAdd'
    // ]);

    // Route::post('lead-owner-user-create/agent/{agent}/lead/{lead}', [
    //     'uses' =>'Agent\AgentUserController@leadOwnerUserCreate',
    //     'as' => 'agent.leadOwnerUserCreate'
    // ]);

    // Route::post('lead-source-create/agent/{agent}/lead/{lead}', [
    //     'uses' =>'Agent\AgentUserController@leadSourceCreatePost',
    //     'as' => 'agent.leadSourceCreatePost'
    // ]);

    // Route::get('lead-source-change/agent/{agent}/lead/{lead}', [
    //     'uses' =>'Agent\AgentUserController@leadSourceChange',
    //     'as' => 'agent.leadSourceChange'
    // ]);

    // Route::get('lead-info-modal-open/agent/{agent}/lead/{lead}', [
    //     'uses' =>'Agent\AgentLeadController@leadInfoModalOpen',
    //     'as' => 'agent.leadInfoModalOpen'
    // ]);

    // Route::post('lead-info-update/agent/{agent}/lead/{lead}', [
    //     'uses' =>'Agent\AgentLeadController@leadInfoUpdate',
    //     'as' => 'agent.leadInfoUpdate'
    // ]);

    // Route::post('lead-description-update/agent/{agent}/lead/{lead}', [
    //     'uses' =>'Agent\AgentLeadController@leadDescriptionUpdate',
    //     'as' => 'agent.leadDescriptionUpdate'
    // ]);

    // Route::get('lead-final-submit/agent/{agent}/lead/{lead}', [
    //     'uses' =>'Agent\AgentLeadController@leadFinalSubmit',
    //     'as' => 'agent.leadFinalSubmit'
    // ]);
});

//vue layout routes
Route::get('/agent/{agent}/ecommerce/{slug2?}/{slug3?}/{slug4?}/{slug5?}/{slug6?}/{slug7?}/{slug8?}/{slug9?}', [
    'uses' => 'Agent\AgentDashboardController@ecommerceIndex',
])->middleware('auth');
Route::get('/agent/{slug1?}/{slug2?}/{slug3?}/{slug4?}/{slug5?}/{slug6?}/{slug7?}/{slug8?}/{slug9?}', [
    'uses' => 'Agent\AgentDashboardController@index',
])->middleware('auth');
// Route::get('/dealer/ecommerce/{slug2?}/{slug3?}/{slug4?}/{slug5?}', [
//     'uses' => 'Dealer\DealerDashboardController@ecommerceIndex',
//     'as' => 'dealer.index',
// ]);
// Route::get('/dealer/{slug1?}/{slug2?}/{slug3?}/{slug4?}/{slug5?}', [
//     'uses' => 'Dealer\DealerDashboardController@index',
//     'as' => 'dealer.index',
// ]);
Route::any('/{slug1?}/{slug2?}/{slug3?}/{slug4?}/{slug5?}', [
    'uses' => 'Ecommerce\WelcomeController@welcome',
])->middleware('auth');
