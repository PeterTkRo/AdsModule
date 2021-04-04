<?php

namespace Ivvy\Ads\Repositories;

use Ivvy\Ads\Models\Banners;

class BannerRepository implements BannerRepositoryInterface
{
    /**
     * @param int|null $bannerId
     * @return Banners|null
     */
    public function getBanner(?int $bannerId) : ?Banners
    {
        if ($bannerId) {
            return Banners::where('id',$bannerId)->with('bannersI18N')->first();
        }
        return null;
    }

    /**
     * @param array $criteria
     * @param integer $paginate
     * @return object|null
     */
    public function getBannerList(array $criteria, int $paginate): ?object
    {
        return Banners::where($criteria)->with('bannersI18N')->paginate($paginate);
    }
}