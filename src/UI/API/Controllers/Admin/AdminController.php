<?php

namespace Ivvy\Ads\UI\API\Controllers\Admin;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ivvy\Ads\Actions\ChangeBannerStatusAction;
use Ivvy\Ads\Actions\RemoveBannerAction;
use Ivvy\Ads\Repositories\BannerRepository;
use Ivvy\Ads\Traits\ApiResponseTrait;

class AdminController
{
    use ApiResponseTrait;

    protected BannerRepository $bannerRepository;

    public function __construct()
    {
        $this->bannerRepository = new BannerRepository();
    }

    /**
     * change status (active) product AJAX
     * @param Request $request
     * @return JsonResponse
     */
    public function changeBannerStatusByIdAjax(Request $request): JsonResponse
    {
        $result = ChangeBannerStatusAction::run($request, $this->bannerRepository);
        if ($result) {
            return $this->json(['text' => "Banner id-$request->item_id status has been changed with"]);
        } else {
            return $this->error(['error' => "Something went wrong. Try again latter"]);
        }
    }

    /**
     * delete Products by id or array id
     * @param Request $request
     * @return JsonResponse
     */
    public function removeBannerByIdAjax(Request $request): JsonResponse
    {
        $result = RemoveBannerAction::run($request, $this->bannerRepository);
        if ($result) {
            return $this->json([
                'reload_page' => true,
                'text' => 'Products has been removed!'
            ]);
        }
        return $this->error('Fail');
    }
}