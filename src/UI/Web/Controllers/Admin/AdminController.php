<?php

namespace Ivvy\Ads\UI\Web\Controllers\Admin;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Ivvy\Ads\Actions\CreateUpdateBannerAction;
use Ivvy\Ads\Actions\GetBannerAction;
use Ivvy\Ads\Actions\GetBannerListAction;
use Ivvy\Ads\Repositories\BannerRepository;
use Ivvy\Ads\Traits\WebResponseTrait;

class AdminController extends Controller
{

    use WebResponseTrait;

    protected BannerRepository $bannerRepository;

    public function __construct()
    {
        $this->bannerRepository = new BannerRepository();
    }

    /**
     * Display a listing of the Banners.
     *
     * @param Request $request
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $banners = GetBannerListAction::run($request, $this->bannerRepository);

        return $this->response('Ads::Admin.banners.list', ['banners' => $banners]);
    }

    /**
     * Show the form for creating a Banner
     *
     * @param Request $request
     *
     * @return Factory|View|RedirectResponse
     */
    public function create(Request $request)
    {
        $tempArray['allLanguages'] = ['ua'];
        if ($request->post()) {
            $banner = CreateUpdateBannerAction::run($request, $tempArray['allLanguages'], $this->bannerRepository);
            if ($banner) {
                return $this->redirect('admin.Banners.editBanner', ['bannerID' => $banner->id],'The product was successfully created');
            }
        }
        return $this->response('Ads::Admin.banners.banner-page', $tempArray);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Request $request
     * @param int $bannerID
     * @return Factory|View|RedirectResponse
     */
    public function update(Request $request, int $bannerID)
    {
        $request->bannerId = $bannerID;
        $banner = GetBannerAction::run($request, $this->bannerRepository);
        $tempArray['banner'] = $banner;
        $tempArray['allLanguages'] = ['ua'];
        if ($request->post()) {
            $bannerFresh = CreateUpdateBannerAction::run($request, $tempArray['allLanguages'], $this->bannerRepository);
            if ($bannerFresh) {
                return $this->redirect('admin.Banners.editBanner', ['bannerID' => $bannerFresh->id],'The product was successfully updated');
            }
        }
        return $this->response('Ads::Admin.banners.banner-page', $tempArray);
    }
}