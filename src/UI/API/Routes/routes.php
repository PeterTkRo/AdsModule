<?php

use Illuminate\Support\Facades\Route;

\App\Http\Middleware\LocaleMiddlewareAdmin::getLocale();
Route::group(['namespace' => 'Ivvy\Ads\UI\API\Controllers\Admin', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['web']], function () {
    Route::group(['prefix' => 'banners', 'as' => 'Banners.'], function () {
        Route::get('change-status-banner', 'AdminController@changeBannerStatusByIdAjax')->name('changeStatusByIdAjax');
        Route::get('remove-banner', 'AdminController@removeBannerByIdAjax')->name('removeByID');
    });
});