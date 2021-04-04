<?php

namespace Ivvy\Ads\Actions;

use App\Modules\BannersModule\Models\BannersI18N;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ivvy\Ads\Exceptions\AdsException;
use Ivvy\Ads\Models\Banners;
use Ivvy\Ads\Repositories\BannerRepositoryInterface;

class CreateUpdateBannerAction
{

    /**
     * @param Request $request
     * @param array $languages
     * @param BannerRepositoryInterface $bannerRepository
     * @return Banners|null
     */
    public static function run(Request $request, array $languages, BannerRepositoryInterface $bannerRepository): ?Banners
    {
        $banner = $bannerRepository->getBanner($request->bannerId);
        if (!$banner) {
            $banner = new Banners();
        }
        try {
            $banner->load($request->all());
            $banner->save();
            foreach ($languages as $language) {
                $bannerI18N = new BannersI18N();
                $bannerI18N->banner_id = $banner->id;
                $description_col = 'description_' . $language;
                $bannerI18N->description = $request->$description_col;
                $bannerI18N->local = $language;
                $bannerI18N->created_by = Auth::id();
                $bannerI18N->updated_by = Auth::id();
                $bannerI18N->save();
            }
        } catch (AdsException $exception) {
            $exception->log();
            return null;
        }
            return $banner;
    }
}