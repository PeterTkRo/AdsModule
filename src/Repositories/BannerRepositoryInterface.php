<?php


namespace Ivvy\Ads\Repositories;


use Ivvy\Ads\Models\Banners;

interface BannerRepositoryInterface
{
    /**
     * @param int $bannerId
     * @return Banners|null
     */
    public function getBanner(int $bannerId) : ?Banners ;

    /**
     * @param array $criteria
     * @param int $paginate
     * @return object|null
     */
    public function getBannerList(array $criteria, int $paginate) : ?object ;
}