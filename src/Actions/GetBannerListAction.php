<?php

namespace Ivvy\Ads\Actions;

use Illuminate\Http\Request;
use Ivvy\Ads\Repositories\BannerRepositoryInterface;

class GetBannerListAction
{
    /**
     * @param Request $request
     * @param BannerRepositoryInterface $bannerRepository
     * @return object|null
     */
    public static function run(Request $request, BannerRepositoryInterface $bannerRepository): ?object
    {
        return $bannerRepository->getBannerList($request->criteria ?? [], config('banner.settings.paginate'));
    }
}