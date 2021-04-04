<?php

namespace Ivvy\Ads\Traits;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

trait WebResponseTrait
{
    /**
     * @param string $view
     * @param array $params
     * @return Factory|Application|View
     */
    public function response(string $view, array $params = [])
    {
        return view($view, $params);
    }

    /**
     * @param string $route
     * @param array $param
     * @param string|null $message
     * @return RedirectResponse
     */
    public function redirect(string $route, array $param = [], ?string $message = null): RedirectResponse
    {
        $redirect = Redirect::route($route, $param);
        if ($message) {
            $redirect->with('message', $message);
        }
        return $redirect;
    }
}