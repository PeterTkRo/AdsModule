<?php

namespace Ivvy\Ads\Actions;

use Illuminate\Http\Request;
use Ivvy\Ads\Exceptions\AdsException;
use Ivvy\Ads\Repositories\BannerRepositoryInterface;

class RemoveBannerAction
{
    /**
     * @param Request $request
     * @param BannerRepositoryInterface $bannerRepository
     * @return bool
     */
    public static function run(Request $request, BannerRepositoryInterface $bannerRepository): bool
    {
        foreach ($request->item_id as $bannerId) {
            $banner = $bannerRepository->getBanner($bannerId);
            if ($banner) {
                try {
                    $banner->delete();
                } catch (AdsException $exception) {
                    $exception->log();
                    return false;
                }
            }
        }
        return true;
    }
}