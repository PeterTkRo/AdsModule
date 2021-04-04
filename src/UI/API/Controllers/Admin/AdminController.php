<?php

namespace Ivvy\Ads\API\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController
{
    /**
     * change status (active) product AJAX
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeBannerStatusByIdAjax(Request $request)
    {
        $banner_id = $request->item_id;
        if ($banner_id != null || $banner_id != '') {

            Banners::where('id', $banner_id)->update([
                'active' => $request->active,
                'updated_by' => Auth::id(),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            return response()->json(['text' => "Banner id-$banner_id status has been changed with"]);

        } else {

            return response()->json(['error' => "Something went wrong. Try again latter"], 404);
        }
    }

    /**
     * delete Products by id or array id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeBannerByIdAjax(Request $request)
    {
        if (isset($request->item_id)){
            Banners::whereIn('id', $request->item_id)->delete();
        }
        return response()->json([
            'reload_page' => true,
            'text' => 'Products has been removed!'
        ]);
    }
}