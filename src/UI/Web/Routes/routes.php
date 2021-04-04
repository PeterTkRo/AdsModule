<?php

use Illuminate\Support\Facades\Route;

\App\Http\Middleware\LocaleMiddlewareAdmin::getLocale();
Route::group(['namespace' => 'Ivvy\Ads\Web\Controllers\Admin', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['web']], function () {
    Route::group(['prefix' => 'banners', 'as' => 'Banners.'], function () {
        Route::get('list', 'BannersModuleController@index')->name('list');
        Route::get('banner-{bannerID}', 'BannersModuleController@update')->name('editBanner');
        Route::post('banner-{bannerID}', 'BannersModuleController@update')->name('editBanner');
        Route::post('new-banner', 'BannersModuleController@create')->name('addBanner');
        Route::get('new-banner', 'BannersModuleController@create')->name('addBanner');
        Route::get('change-status-banner', 'BannersModuleController@changeBannerStatusByIdAjax')->name('changeStatusByIdAjax');
        Route::get('remove-banner', 'BannersModuleController@removeBannerByIdAjax')->name('removeByID');
    });
});