<?php


namespace Ivvy\Ads\Actions;


use App\Modules\BannersModule\Models\BannersI18N;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ivvy\Ads\Exceptions\AdsException;
use Ivvy\Ads\Models\Banners;
use Ivvy\Ads\Repositories\BannerRepositoryInterface;

class ChangeBannerStatusAction
{

    /**
     * @param Request $request
     * @param BannerRepositoryInterface $bannerRepository
     * @return bool|null
     */
    public static function run(Request $request, BannerRepositoryInterface $bannerRepository): ?bool
    {
        $banner = $bannerRepository->getBanner($request->item_id);
        if ($banner) {
            try {
                $banner->active = $request->active;
                $banner->updated_by = Auth::id();
                $banner->updated_at = date('Y-m-d H:i:s');
                $banner->save();
            } catch (AdsException $exception) {
                $exception->log();
                return false;
            }
        }
        return true;
    }
}