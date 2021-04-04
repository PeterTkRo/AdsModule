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
            return Banners::active()->where('id',$bannerId)->with('bannersI18N')->first();
        }
        return null;
    }

    /**
     * @param array $criteria
     * @param integer $paginate
     * @return array|null
     */
    public function getBannerList(array $criteria, int $paginate): ?array
    {
        return Banners::active()->where($criteria)->with('bannersI18N')->paginate($paginate);
    }
}