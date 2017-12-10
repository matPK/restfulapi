<?php
/**
 * Created by PhpStorm.
 * User: Matheus
 * Date: 25/11/2017
 * Time: 15:41
 */

namespace App\Traits;

use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

trait ApiResponser
{
    /**
     * Sends a successful HTTP response.
     *
     * @param  array $data
     * @param  int $code
     * @return Response
     */
    private function successResponse($data, $code)
    {
        return response()->json($data, $code);
    }

    /**
     * Sends a successful deletion HTTP response.
     *
     * @return Response
     */
    protected function deleteResponse()
    {
        return $this->successResponse(['data' => null], 204);
    }

    /**
     * Sends a successful HTTP response.
     *
     * @param  mixed $message
     * @param  int $code
     * @return Response
     */
    protected function errorResponse($message, $code)
    {
        return response()->json([
            'error' => $message,
            'code' => $code,
        ], $code);
    }

    /**
     * Sends a successful HTTP response.
     *
     * @param Collection $collection
     * @param  int $code
     * @return Response
     */
    protected function showAll(Collection $collection, $code = 200)
    {
        return $this->successResponse(['data' => $collection], $code);
    }

    /**
     * Sends a successful HTTP response.
     *
     * @param Model $model
     * @param  int $code
     * @return Response
     */
    protected function showOne(Model $model, $code = 200)
    {
        return $this->successResponse(['data' => $model], $code);
    }
}