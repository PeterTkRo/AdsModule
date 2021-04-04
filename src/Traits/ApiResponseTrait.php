<?php

namespace Ivvy\Ads\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    /**
     * @param $message
     * @param int $status
     * @param array $headers
     * @param int $options
     * @return JsonResponse
     */
    public function json($message, $status = 200, array $headers = [], $options = 0): JsonResponse
    {
        return new JsonResponse($message, $status, $headers, $options);
    }

    /**
     * @param null $message
     * @param int $status
     * @param array $headers
     * @param int $options
     * @return JsonResponse
     */
    public function notFound($message = null, $status = 404, array $headers = [], $options = 0): JsonResponse
    {
        return $this->json($message, $status, $headers, $options);
    }

    /**
     * @param null $message
     * @param int $status
     * @param array $headers
     * @param int $options
     * @return JsonResponse
     */
    public function error($message = null, $status = 500, array $headers = [], $options = 0): JsonResponse
    {
        return $this->json($message, $status, $headers, $options);
    }
}