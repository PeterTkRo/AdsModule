<?php

namespace Ivvy\Ads\Actions;

use Illuminate\Http\Request;
use Ivvy\Ads\Models\Banners;
use Ivvy\Ads\Repositories\BannerRepositoryInterface;

class GetBannerAction
{
    /**
     * @param Request $request
     * @param BannerRepositoryInterface $bannerRepository
     * @return Banners|null
     */
    public static function run(Request $request, BannerRepositoryInterface $bannerRepository): ?Banners
    {
        return $bannerRepository->getBanner($request->bannerId);
    }
}