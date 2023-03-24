<?php

use App\Http\Controllers\Admin\Be\AdminBeAuthController;
use App\Http\Controllers\Admin\Be\AdminBeCategoryHomeController;
use App\Http\Controllers\Admin\Be\AdminBeHelpController;
use App\Http\Controllers\Admin\Be\AdminBeHomeController;
use App\Http\Controllers\Admin\Be\AdminBeImageController;
use App\Http\Controllers\Admin\Be\AdminBePolicyController;
use App\Http\Controllers\Admin\Be\AdminBePriceListController;
use App\Http\Controllers\Admin\Be\AdminBePromotionController;
use App\Http\Controllers\Admin\Be\AdminBeServiceController;
use App\Http\Controllers\Admin\Be\AdminBeServiceGroupController;
use App\Http\Controllers\Admin\Be\AdminBeServiceTypeController;
use App\Http\Controllers\Admin\Fe\AdminFeAuthController;
use App\Http\Controllers\Admin\Fe\AdminFeHomeController;
use App\Http\Controllers\Admin\Fe\AdminFePolicyController;
use App\Http\Controllers\Admin\Fe\AdminFeServiceController;
use App\Http\Controllers\Admin\Fe\AdminFeThankYouController;
use App\Http\Controllers\Ceo\CeoHelpController;
use App\Http\Controllers\Ceo\CeoHireController;
use App\Http\Controllers\Ceo\CeoHomeController;
use App\Http\Controllers\Ceo\CeoOrderController;
use App\Http\Controllers\Ceo\CeoProfileController;
use App\Http\Controllers\Ceo\CeoServiceController;
use App\Http\Controllers\Core\DestroyController;
use App\Http\Controllers\Ceo\ThankyouController;
use App\Http\Controllers\Core\UploadImageController;
use App\Http\Controllers\Restaurant\RestaurantBranchController;
use App\Http\Controllers\Restaurant\RestaurantCategoryController;
use App\Http\Controllers\Restaurant\RestaurantHomeController;
use App\Http\Controllers\Restaurant\RestaurantLoginController;
use App\Http\Controllers\Restaurant\RestaurantPositionController;
use App\Http\Controllers\Restaurant\RestaurantRestaurantController;
use App\Http\Controllers\Restaurant\RestaurantDishController;
use App\Http\Controllers\Restaurant\RestaurantMenuController;
use App\Http\Controllers\Restaurant\RestaurantPersonnelController;
use App\Http\Controllers\Restaurant\RestaurantPostController;
use App\Http\Controllers\Restaurant\RestaurantPromotionController;
use App\Http\Controllers\Restaurant\RestaurantShiftController;
use App\Http\Controllers\Restaurant\RestaurantTableController;
use App\Http\Controllers\Sell\SellAuthController;
use App\Http\Controllers\Sell\SellHomeController;
use App\Http\Controllers\Sell\SellRestaurantEatController;
use App\Http\Controllers\User\Food\UserFoodAllProductController;
use App\Http\Controllers\User\Food\UserFoodCartController;
use App\Http\Controllers\User\Food\UserFoodHomeController;
use App\Http\Controllers\User\Food\UserFoodPaymentController;
use App\Http\Controllers\User\Food\UserFoodProductController;
use App\Http\Controllers\User\Food\UserFoodRestaurantController;
use App\Http\Controllers\User\Shop\UserShopCartController;
use App\Http\Controllers\User\Shop\UserShopAllProductController;
use App\Http\Controllers\User\Shop\UserShopHomeController;
use App\Http\Controllers\User\Shop\UserShopPaymentController;
use App\Http\Controllers\User\Shop\UserShopProductController;
use App\Http\Controllers\User\Shop\UserShopRestaurantController;
use App\Http\Controllers\User\UserAuthController;
use App\Http\Controllers\User\UserCartController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::post('upload/image', [UploadImageController::class, 'upload'])->name('upload.image.summernote');
Route::delete('ajax/destroy', [DestroyController::class, 'destroy'])->name('ajax.destroy');
Route::get('thankyou', [ThankyouController::class, 'index'])->name('thankyou.index');

Route::prefix('restaurant')->group(function () {
    /*
        |--------------------------------------------------------------------------
        | Common Routes
        |--------------------------------------------------------------------------
        */
    Route::get('/login', [RestaurantLoginController::class, 'index'])->name('restaurant.login');
    Route::post('/login', [RestaurantLoginController::class, 'authenticate'])->name('restaurant.post.login');
    Route::post('/logout', [RestaurantLoginController::class, 'logout'])->name('restaurant.post.logout');
    Route::middleware(['restaurant_shop'])->group(function () {
        Route::middleware(['restaurant_ceo'])->group(function () {
            //restaurant
            Route::prefix('/restaurant')->group(function () {
                Route::get('/edit', [RestaurantRestaurantController::class, 'edit'])->name('restaurant.restaurant.edit');
                Route::post('/update', [RestaurantRestaurantController::class, 'update'])->name('restaurant.restaurant.update');
                Route::post('/upload', [RestaurantRestaurantController::class, 'upload'])->name('restaurant.restaurant.upload');
                Route::get('/remove', [RestaurantRestaurantController::class, 'remove'])->name('restaurant.restaurant.remove');
                Route::post('/change-password', [RestaurantRestaurantController::class, 'changePassword'])->name('restaurant.restaurant.changePassword');
            });
            //branch
            Route::prefix('/branch')->group(function () {
                Route::get('/', [RestaurantBranchController::class, 'index'])->name('restaurant.branch.index');
                Route::get('/create', [RestaurantBranchController::class, 'create'])->name('restaurant.branch.create');
                Route::post('/store', [RestaurantBranchController::class, 'store'])->name('restaurant.branch.store');
                Route::get('/edit/{id}', [RestaurantBranchController::class, 'edit'])->name('restaurant.branch.edit');
                Route::post('/update/{id}', [RestaurantBranchController::class, 'update'])->name('restaurant.branch.update');
                Route::get('/show/{id}', [RestaurantBranchController::class, 'show'])->name('restaurant.branch.show');
                Route::post('/upload', [RestaurantBranchController::class, 'upload'])->name('restaurant.branch.upload');
                Route::get('/remove', [RestaurantBranchController::class, 'remove'])->name('restaurant.branch.remove');
            });
            Route::prefix('/table')->group(function () {
                Route::get('/{id}', [RestaurantTableController::class, 'index'])->name('restaurant.table.index');
                Route::get('/table/show', [RestaurantTableController::class, 'show'])->name('restaurant.table.show');
                Route::post('/table/store/{branch_id}', [RestaurantTableController::class, 'store'])->name('restaurant.table.store');
                Route::post('/table/update/{branch_id}/{id}', [RestaurantTableController::class, 'update'])->name('restaurant.table.update');
            });
            //position
            Route::prefix('/position')->group(function () {
                Route::get('/', [RestaurantPositionController::class, 'index'])->name('restaurant.position.index');
                Route::get('/store', [RestaurantPositionController::class, 'store'])->name('restaurant.position.store');
                Route::get('/update/{id}', [RestaurantPositionController::class, 'update'])->name('restaurant.position.update');
                Route::get('/show', [RestaurantPositionController::class, 'show'])->name('restaurant.position.show');
            });
            //shift
            Route::prefix('/shift')->group(function () {
                Route::get('/', [RestaurantShiftController::class, 'index'])->name('restaurant.shift.index');
                Route::post('/store', [RestaurantShiftController::class, 'store'])->name('restaurant.shift.store');
                Route::post('/update', [RestaurantShiftController::class, 'update'])->name('restaurant.shift.update');
                Route::post('/destroy', [RestaurantShiftController::class, 'destroy'])->name('restaurant.shift.destroy');
            });
            //promotion
            Route::prefix('/promotion')->group(function () {
                Route::get('/', [RestaurantPromotionController::class, 'index'])->name('restaurant.promotion.index');
                Route::get('/create', [RestaurantPromotionController::class, 'create'])->name('restaurant.promotion.create');
                Route::post('/store', [RestaurantPromotionController::class, 'store'])->name('restaurant.promotion.store');
                Route::get('/edit/{id}', [RestaurantPromotionController::class, 'edit'])->name('restaurant.promotion.edit');
                Route::post('/update/{id}', [RestaurantPromotionController::class, 'update'])->name('restaurant.promotion.update');
            });
        });
        Route::get('/', [RestaurantHomeController::class, 'index'])->name('restaurant.home.index');

        //personnel
        Route::prefix('/personnel')->group(function () {
            Route::middleware(['restaurant_ceo'])->group(function () {
                Route::get('/', [RestaurantPersonnelController::class, 'index'])->name('restaurant.personnel.index');
                Route::get('/create', [RestaurantPersonnelController::class, 'create'])->name('restaurant.personnel.create');
                Route::post('/store', [RestaurantPersonnelController::class, 'store'])->name('restaurant.personnel.store');
                Route::get('/givePassword/{id}', [RestaurantPersonnelController::class, 'givePassword'])->name('restaurant.personnel.givePassword');
            });
            Route::get('/edit/{id}', [RestaurantPersonnelController::class, 'edit'])->name('restaurant.personnel.edit');
            Route::post('/update/{id}', [RestaurantPersonnelController::class, 'update'])->name('restaurant.personnel.update');
            Route::post('/showDistrict', [RestaurantPersonnelController::class, 'showDistrict'])->name('restaurant.personnel.showDistrict');
            Route::post('/showCommune', [RestaurantPersonnelController::class, 'showCommune'])->name('restaurant.personnel.showCommune');
            Route::post('/showPosition', [RestaurantPersonnelController::class, 'showPosition'])->name('restaurant.personnel.showPosition');
            Route::post('/showShift', [RestaurantPersonnelController::class, 'showShift'])->name('restaurant.personnel.showShift');
            Route::post('/change-password', [RestaurantPersonnelController::class, 'changePassword'])->middleware(['restaurant_personnel'])->name('restaurant.personnel.changePassword');
            Route::prefix('/timekeeping')->group(function () {
                Route::get('/{id}', [RestaurantPersonnelController::class, 'timekeeping'])->name('restaurant.personnel.timekeeping');
                Route::post('/check/{id}', [RestaurantPersonnelController::class, 'check'])->name('restaurant.personnel.check');
            });
        });
        
        Route::middleware(['restaurant'])->group(function () {
            
        });
        //dish
        Route::prefix('/dish')->group(function () {
            Route::get('/', [RestaurantDishController::class, 'index'])->name('restaurant.dish.index');
            Route::get('/create', [RestaurantDishController::class, 'create'])->name('restaurant.dish.create');
            Route::post('/store', [RestaurantDishController::class, 'store'])->name('restaurant.dish.store');
            Route::get('/edit/{id}', [RestaurantDishController::class, 'edit'])->name('restaurant.dish.edit');
            Route::post('/update/{id}', [RestaurantDishController::class, 'update'])->name('restaurant.dish.update');
            Route::post('/showMenu', [RestaurantDishController::class, 'showMenu'])->name('restaurant.dish.showMenu');
            Route::post('/storeMenu', [RestaurantDishController::class, 'storeMenu'])->name('restaurant.dish.storeMenu');
            Route::post('/updateMenu', [RestaurantDishController::class, 'updateMenu'])->name('restaurant.dish.updateMenu');
            Route::post('/destroyMenu', [RestaurantDishController::class, 'destroyMenu'])->name('restaurant.dish.destroyMenu');
            Route::prefix('/menu')->group(function () {
                Route::get('/', [RestaurantDishController::class, 'menu'])->name('restaurant.menu');
                Route::get('/item-{id}', [RestaurantMenuController::class, 'index'])->name('restaurant.menu.index');
                Route::get('/item/show', [RestaurantMenuController::class, 'itemShow'])->name('restaurant.menu.itemShow');
                Route::post('/itemStore/{menu_id}', [RestaurantMenuController::class, 'itemStore'])->name('restaurant.menu.itemStore');
                Route::post('/itemUpdate/{menu_id}/{id}', [RestaurantMenuController::class, 'itemUpdate'])->name('restaurant.menu.itemUpdate');
            });
        });
        //category
        Route::prefix('/category')->group(function () {
            Route::get('/', [RestaurantCategoryController::class, 'index'])->name('restaurant.category.index');
            Route::post('/store', [RestaurantCategoryController::class, 'store'])->name('restaurant.category.store');
            Route::post('/update/{id}', [RestaurantCategoryController::class, 'update'])->name('restaurant.category.update');
            Route::get('/show', [RestaurantCategoryController::class, 'show'])->name('restaurant.category.show');
        });

        //post
        Route::prefix('/post')->group(function () {
            Route::get('/', [RestaurantPostController::class, 'index'])->name('restaurant.post.index');
            Route::get('/create', [RestaurantPostController::class, 'create'])->name('restaurant.post.create');
            Route::post('/store', [RestaurantPostController::class, 'store'])->name('restaurant.post.store');
            Route::get('/edit/{id}', [RestaurantPostController::class, 'edit'])->name('restaurant.post.edit');
            Route::post('/update/{id}', [RestaurantPostController::class, 'update'])->name('restaurant.post.update');
        });
    });
});

Route::prefix('sell')->group(function () {
    Route::get('/login', [SellAuthController::class, 'index'])->name('sell.login');
    Route::post('/login', [SellAuthController::class, 'authenticate'])->name('sell.post.login');
    Route::post('/logout', [SellAuthController::class, 'logout'])->name('sell.post.logout');
    Route::middleware(['sell'])->group(function () {
        Route::get('/branch', [SellAuthController::class, 'branch'])->name('sell.branch');
        Route::post('/branchpost', [SellAuthController::class, 'branchPost'])->name('sell.post.branch');
        Route::post('/changeBranch', [SellAuthController::class, 'changeBranch'])->name('sell.post.changeBranch');
        Route::middleware(['check_branch'])->group(function () {
            Route::get('/', [SellHomeController::class, 'index'])->name('sell.home.index');
            Route::prefix('restaurant')->group(function () {
                Route::prefix('eat')->group(function () {
                    Route::get('/', [SellRestaurantEatController::class, 'index'])->name('sell.restaurant.eat.index');
                    Route::post('/create/{table_id}', [SellRestaurantEatController::class, 'create'])->name('sell.restaurant.eat.create');
                    Route::get('/edit/{table_id}', [SellRestaurantEatController::class, 'edit'])->name('sell.restaurant.eat.edit');
                    Route::post('/add-table', [SellRestaurantEatController::class, 'addTable'])->name('sell.restaurant.eat.addTable');
                    Route::post('/add-status', [SellRestaurantEatController::class, 'addStatus'])->name('sell.restaurant.eat.addStatus');
                    Route::post('/show-dish', [SellRestaurantEatController::class, 'showDish'])->name('sell.restaurant.eat.showDish');
                    Route::post('/add-dish', [SellRestaurantEatController::class, 'addDish'])->name('sell.restaurant.eat.addDish');
                    Route::post('/delete-dish', [SellRestaurantEatController::class, 'deleteDish'])->name('sell.restaurant.eat.deleteDish');
                    Route::post('/quantity', [SellRestaurantEatController::class, 'quantity'])->name('sell.restaurant.eat.quantity');
                    Route::post('/show-item', [SellRestaurantEatController::class, 'showItem'])->name('sell.restaurant.eat.showItem');
                    Route::post('/save-item', [SellRestaurantEatController::class, 'saveItem'])->name('sell.restaurant.eat.saveItem');
                    Route::post('/delete-order', [SellRestaurantEatController::class, 'deleteOrder'])->name('sell.restaurant.eat.deleteOrder');
                    Route::get('/payment/{order_id}', [SellRestaurantEatController::class, 'payment'])->name('sell.restaurant.eat.payment');
                    Route::post('/add-promotion/{order_id}', [SellRestaurantEatController::class, 'addPromotion'])->name('sell.restaurant.eat.addPromotion');
                    Route::post('/pay/{order_id}', [SellRestaurantEatController::class, 'pay'])->name('sell.restaurant.eat.pay');
                    Route::get('/order', [SellRestaurantEatController::class, 'order'])->name('sell.restaurant.eat.order');
                    Route::get('/print/{id}', [SellRestaurantEatController::class, 'print'])->name('sell.restaurant.eat.print');
                });
            });
        });
    });
});

Route::prefix('dich-vu')->group(function () {
    Route::get('/dang-nhap', [AdminFeAuthController::class, 'index'])->name('admin.fe.login');
    Route::post('/login', [AdminFeAuthController::class, 'authenticate'])->name('admin.fe.post.login');
    Route::get('/dang-ky', [AdminFeAuthController::class, 'register'])->name('admin.fe.register');
    Route::post('/registerstore', [AdminFeAuthController::class, 'store'])->name('admin.fe.post.register');
    Route::post('/logout', [AdminFeAuthController::class, 'logout'])->name('admin.fe.post.logout');
    Route::get('/', [AdminFeHomeController::class, 'index'])->name('admin.fe.home.index');
    Route::prefix('/chinh-sach-{id}-{name_link}')->group(function () {
        Route::get('/', [AdminFePolicyController::class, 'index'])->name('admin.fe.policy.index');
    });
    Route::prefix('/{id}-{name_link}')->group(function () {
        Route::get('/', [AdminFeServiceController::class, 'index'])->name('admin.fe.service.index');
        Route::get('/dang-ky', [AdminFeServiceController::class, 'hire'])->name('admin.fe.service.hire');
        Route::middleware(['ceo'])->group(function () {
            Route::get('/dang-ky/{service_charge_id}', [AdminFeServiceController::class, 'create'])->name('admin.fe.service.create');
            Route::get('/cam-on', [AdminFeThankYouController::class, 'index'])->name('admin.fe.service.thankyou');
        });
    });
});

Route::prefix('ceo')->group(function () {
    Route::prefix('/hire')->group(function () {
        Route::post('/checkEmail', [CeoHireController::class, 'checkEmail'])->name('ceo.hire.checkEmail');
    });
    Route::middleware(['ceo'])->group(function () {
        Route::get('/', [CeoHomeController::class, 'index'])->name('ceo.home.index');
        //hire
        Route::prefix('/hire')->group(function () {
            Route::get('/', [CeoHireController::class, 'index'])->name('ceo.hire.index');
            Route::post('/showService', [CeoHireController::class, 'showService'])->name('ceo.hire.showService');
            Route::post('/showServiceType', [CeoHireController::class, 'showServiceType'])->name('ceo.hire.showServiceType');
            Route::post('/showServiceCharge', [CeoHireController::class, 'showServiceCharge'])->name('ceo.hire.showServiceCharge');
            Route::get('/create/{id}', [CeoHireController::class, 'create'])->name('ceo.hire.create');
            Route::get('/print', [CeoHireController::class, 'print'])->name('ceo.hire.print');
            Route::post('/updateProfile', [CeoHireController::class, 'updateProfile'])->name('ceo.hire.updateProfile');
            Route::post('/showPromotion', [CeoHireController::class, 'showPromotion'])->name('ceo.hire.showPromotion');
        });
        //profile
        Route::prefix('/profile')->group(function () {
            Route::get('/', [CeoProfileController::class, 'show'])->name('ceo.profile.show');
            Route::post('/update', [CeoProfileController::class, 'update'])->name('ceo.profile.update');
            Route::post('/changePassword', [CeoProfileController::class, 'changePassword'])->name('ceo.profile.changePassword');
        });
        //service
        Route::prefix('/service')->group(function () {
            Route::get('/', [CeoServiceController::class, 'index'])->name('ceo.service.index');
            Route::get('/show/{id}', [CeoServiceController::class, 'show'])->name('ceo.service.show');
        });
        //order
        Route::prefix('/order')->group(function () {
            Route::get('/', [CeoOrderController::class, 'index'])->name('ceo.order.index');
            Route::get('/print/{id}', [CeoOrderController::class, 'print'])->name('ceo.order.print');
        });
        //help
        Route::prefix('/help')->group(function () {
            Route::get('/', [CeoHelpController::class, 'index'])->name('ceo.help.index');
            Route::get('/create', [CeoHelpController::class, 'create'])->name('ceo.help.create');
            Route::post('/store', [CeoHelpController::class, 'store'])->name('ceo.help.store');
            Route::post('/show', [CeoHelpController::class, 'show'])->name('ceo.help.show');
        });
    });
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminBeAuthController::class, 'index'])->name('admin.login');
    Route::post('/login', [AdminBeAuthController::class, 'authenticate'])->name('admin.post.login');
    Route::post('/logout', [AdminBeAuthController::class, 'logout'])->name('admin.post.logout');
    Route::middleware(['admin'])->group(function () {
        Route::get('/', [AdminBeHomeController::class, 'index'])->name('admin.home.index');
        //service
        Route::prefix('/service')->group(function () {
            Route::get('/', [AdminBeServiceController::class, 'index'])->name('admin.service.index');
            Route::get('/create', [AdminBeServiceController::class, 'create'])->name('admin.service.create');
            Route::post('/store', [AdminBeServiceController::class, 'store'])->name('admin.service.store');
            Route::get('/edit/{id}', [AdminBeServiceController::class, 'edit'])->name('admin.service.edit');
            Route::post('/update/{id}', [AdminBeServiceController::class, 'update'])->name('admin.service.update');
        });
        //service_group
        Route::prefix('/service_group')->group(function () {
            Route::get('/', [AdminBeServiceGroupController::class, 'index'])->name('admin.service_group.index');
            Route::post('/store', [AdminBeServiceGroupController::class, 'store'])->name('admin.service_group.store');
            Route::post('/update/{id}', [AdminBeServiceGroupController::class, 'update'])->name('admin.service_group.update');
            Route::get('/show', [AdminBeServiceGroupController::class, 'show'])->name('admin.service_group.show');
        });
        //service_type
        Route::prefix('/service_type')->group(function () {
            Route::get('/index/{id}', [AdminBeServiceTypeController::class, 'index'])->name('admin.service_type.index');
            Route::post('/show', [AdminBeServiceTypeController::class, 'show'])->name('admin.service.show');
            Route::post('/storeServiceCharge', [AdminBeServiceTypeController::class, 'storeServiceCharge'])->name('admin.service.storeServiceCharge');
            Route::post('/updateServiceCharge', [AdminBeServiceTypeController::class, 'updateServiceCharge'])->name('admin.service.updateServiceCharge');
            Route::post('/destroyServiceCharge', [AdminBeServiceTypeController::class, 'destroyServiceCharge'])->name('admin.service.destroyServiceCharge');
            Route::get('/updateShowHome/{id}', [AdminBeServiceController::class, 'updateShowHome'])->name('admin.service.updateShowHome');
            Route::get('/create/{id_service}', [AdminBeServiceTypeController::class, 'create'])->name('admin.service_type.create');
            Route::post('/store/{id_service}', [AdminBeServiceTypeController::class, 'store'])->name('admin.service_type.store');
            Route::get('/edit/{id_service}/{id}', [AdminBeServiceTypeController::class, 'edit'])->name('admin.service_type.edit');
            Route::post('/update/{id_service}/{id}', [AdminBeServiceTypeController::class, 'update'])->name('admin.service_type.update');
        });
        //price_list
        Route::prefix('/price_list')->group(function () {
            Route::get('/', [AdminBePriceListController::class, 'index'])->name('admin.price_list.index');
            Route::get('/create', [AdminBePriceListController::class, 'create'])->name('admin.price_list.create');
            Route::post('/store', [AdminBePriceListController::class, 'store'])->name('admin.price_list.store');
            Route::get('/edit/{id}', [AdminBePriceListController::class, 'edit'])->name('admin.price_list.edit');
            Route::post('/update/{id}', [AdminBePriceListController::class, 'update'])->name('admin.price_list.update');
        });
        //policy
        Route::prefix('/policy')->group(function () {
            Route::get('/', [AdminBePolicyController::class, 'index'])->name('admin.policy.index');
            Route::get('/create', [AdminBePolicyController::class, 'create'])->name('admin.policy.create');
            Route::post('/store', [AdminBePolicyController::class, 'store'])->name('admin.policy.store');
            Route::get('/edit/{id}', [AdminBePolicyController::class, 'edit'])->name('admin.policy.edit');
            Route::post('/update/{id}', [AdminBePolicyController::class, 'update'])->name('admin.policy.update');
        });
        //promotion
        Route::prefix('/promotion')->group(function () {
            Route::get('/', [AdminBePromotionController::class, 'index'])->name('admin.promotion.index');
            Route::get('/create', [AdminBePromotionController::class, 'create'])->name('admin.promotion.create');
            Route::post('/store', [AdminBePromotionController::class, 'store'])->name('admin.promotion.store');
            Route::get('/edit/{id}', [AdminBePromotionController::class, 'edit'])->name('admin.promotion.edit');
            Route::post('/update/{id}', [AdminBePromotionController::class, 'update'])->name('admin.promotion.update');
        });
        //help
        Route::prefix('/help')->group(function () {
            Route::get('/', [AdminBeHelpController::class, 'index'])->name('admin.help.index');
            Route::post('/show', [CeoHelpController::class, 'show'])->name('admin.help.show');
            Route::post('/store', [AdminBeHelpController::class, 'store'])->name('admin.help.store');
            Route::get('/updateShowHome/{id}', [AdminBeHelpController::class, 'updateShowHome'])->name('admin.help.updateShowHome');
        });
        //category
        Route::prefix('/category')->group(function () {
            Route::get('/', [AdminBeCategoryHomeController::class, 'index'])->name('admin.category.index');
            Route::post('/store', [AdminBeCategoryHomeController::class, 'store'])->name('admin.category.store');
            Route::post('/update/{id}', [AdminBeCategoryHomeController::class, 'update'])->name('admin.category.update');
            Route::get('/show', [AdminBeCategoryHomeController::class, 'show'])->name('admin.category.show');
        });
        //image
        Route::prefix('/image')->group(function () {
            Route::get('/', [AdminBeImageController::class, 'index'])->name('admin.image.index');
            Route::post('/store', [AdminBeImageController::class, 'store'])->name('admin.image.store');
            Route::post('/update/{id}', [AdminBeImageController::class, 'update'])->name('admin.image.update');
            Route::get('/show', [AdminBeImageController::class, 'show'])->name('admin.image.show');
        });
    });
});

Route::prefix('food')->group(function () {
    Route::get('/', [UserFoodHomeController::class, 'index'])->name('user.food.home.index');
    Route::get('/tat-ca-mon-an', [UserFoodAllProductController::class, 'index'])->name('user.food.allProduct.index');
    Route::prefix('/mon-an')->group(function () {
        Route::get('/', [UserFoodProductController::class, 'index'])->name('user.food.product.index');
        Route::get('/{id}-{name_link}', [UserFoodProductController::class, 'show'])->name('user.food.product.show');
    });
    Route::prefix('/nha-hang')->group(function () {
        Route::get('/{id}', [UserFoodRestaurantController::class, 'index'])->name('user.food.restaurant.index');
        Route::get('/tin-tuc/{id}-{name_link}', [UserFoodRestaurantController::class, 'post'])->name('user.food.restaurant.post');
    });
    Route::middleware(['user'])->group(function () {
        Route::get('/gio-hang', [UserFoodCartController::class, 'index'])->name('user.food.cart');
        Route::get('/thanh-toan', [UserFoodPaymentController::class, 'index'])->name('user.food.payment');
    });
});

Route::get('/', [UserShopHomeController::class, 'index'])->name('user.home.index');
Route::get('/tat-ca-san-pham', [UserShopAllProductController::class, 'index'])->name('user.allProduct.index');
Route::prefix('/san-pham')->group(function () {
    Route::get('/', [UserShopProductController::class, 'index'])->name('user.product.index');
    Route::get('/{id}-{name_link}', [UserShopProductController::class, 'show'])->name('user.product.show');
});
Route::prefix('/shop')->group(function () {
    Route::get('/{id}', [UserShopRestaurantController::class, 'index'])->name('user.restaurant.index');
    Route::get('/tin-tuc/{id}-{name_link}', [UserShopRestaurantController::class, 'post'])->name('user.restaurant.post');
});
Route::middleware(['user'])->group(function () {
    Route::get('/gio-hang', [UserShopCartController::class, 'index'])->name('user.cart');
    Route::get('/thanh-toan', [UserShopPaymentController::class, 'index'])->name('user.payment');
});

Route::get('/dang-nhap-dang-ky', [UserAuthController::class, 'index'])->name('user.auth');
Route::post('/login', [UserAuthController::class, 'login'])->name('user.login');
Route::post('/logout', [UserAuthController::class, 'logout'])->name('user.logout');
Route::post('/register', [UserAuthController::class, 'register'])->name('user.register');
Route::get('/xac-nhan-{id}', [UserAuthController::class, 'verify'])->name('user.verify');
Route::post('/verifyStore-{id}', [UserAuthController::class, 'verifyStore'])->name('user.verify.store');

Route::middleware(['user'])->group(function () {
    Route::post('/addCart', [UserCartController::class, 'addCart'])->name('user.addCart');
    Route::post('/showCart', [UserCartController::class, 'showCart'])->name('user.showCart');
    Route::post('/updateCart', [UserCartController::class, 'updateCart'])->name('user.updateCart');
    Route::post('/deleteOneCart', [UserCartController::class, 'deleteOneCart'])->name('user.deleteOneCart');
    Route::post('/deleteAllCart', [UserCartController::class, 'deleteAllCart'])->name('user.deleteAllCart');
    Route::post('/updateProfile', [UserAuthController::class, 'updateProfile'])->name('user.updateProfile');
});

Route::get('/nguyen-hai-yen', function () {
    return view('welcome');
});
