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
     * Sends an error message.
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
     * Sends a successful HTTP response containing a collection.
     *
     * @param Collection $collection
     * @param  int $code
     * @return Response
     */
    protected function showAll(Collection $collection, $code = 200)
    {
        if (!$collection->isEmpty()) {
            $transformer = $collection->first()->transformer;
            $collection = $this->transformData($collection, $transformer);
        } else {
            $collection = ['data' => $collection];
        }
        return $this->successResponse($collection, $code);
    }

    /**
     * Sends a successful HTTP response containing a model.
     *
     * @param Model $instance
     * @param  int $code
     * @return Response
     */
    protected function showOne(Model $instance, $code = 200)
    {
        $transformer = $instance->transformer;
        $instance = $this->transformData($instance, $transformer);
        return $this->successResponse($instance, $code);
    }

    /**
     * Sends a message.
     *
     * @param string $message
     * @param  int $code
     * @return Response
     */
    protected function showMessage($message, $code = 200)
    {
        return $this->successResponse(['data' => $message], $code);
    }

    protected function transformData($data, $transformer)
    {
        $transformation = fractal($data, new $transformer);
        return $transformation->toArray();
    }
}