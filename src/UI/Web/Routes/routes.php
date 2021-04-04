<?php

use Illuminate\Support\Facades\Route;

\App\Http\Middleware\LocaleMiddlewareAdmin::getLocale();
Route::group(['namespace' => 'Ivvy\Ads\Web\Controllers', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['web']], function () {
    Route::group(['prefix' => 'banners', 'as' => 'Banners.'], function () {
        Route::get('list', 'AdminController@index')->name('list');
        Route::get('banner-{bannerID}', 'AdminController@update')->name('editBanner');
        Route::post('banner-{bannerID}', 'AdminController@update')->name('editBanner');
        Route::post('new-banner', 'AdminController@create')->name('addBanner');
        Route::get('new-banner', 'AdminController@create')->name('addBanner');
        Route::get('change-status-banner', 'AdminController@changeBannerStatusByIdAjax')->name('changeStatusByIdAjax');
        Route::get('remove-banner', 'AdminController@removeBannerByIdAjax')->name('removeByID');
    });
});