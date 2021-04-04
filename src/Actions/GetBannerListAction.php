<?php

namespace Ivvy\Ads\Actions;

use Illuminate\Http\Request;
use Ivvy\Ads\Repositories\BannerRepositoryInterface;

class GetBannerListAction
{
    /**
     * @param Request $request
     * @param BannerRepositoryInterface $bannerRepository
     * @return array|null
     */
    public static function run(Request $request, BannerRepositoryInterface $bannerRepository): ?array
    {
        return $bannerRepository->getBannerList($request->criteria ?? [], config('banner.setting.paginate'));
    }
}