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
     * Sorts the data of the response
     *
     * @param Collection $collection
     * @param string $transformer [A transformer class]
     * @return Collection
     */
    protected function sortData(Collection $collection, $transformer)
    {
        if (request()->has('sort_by')) {
            $attribute = $transformer::originalAttribute(request()->sort_by);
            $collection = $collection->sortBy->{$attribute};
        }
        return $collection;
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
        if ($collection->isEmpty()) {
            return $this->successResponse($collection, $code);
        }

        $transformer = $collection->first()->transformer;

        $collection = $this->filterData($collection, $transformer);
        $collection = $this->sortData($collection, $transformer);

        $collection = $this->transformData($collection, $transformer);

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

    /**
     * Transforms the data using the specified Transformer.
     *
     * @param mixed $data [a collection or instance of a model]
     * @param string $transformer
     * @return array
     */
    protected function transformData($data, $transformer)
    {
        $transformation = fractal($data, new $transformer);
        return $transformation->toArray();
    }

    /**
     * Filters the data.
     *
     * @param Collection $collection [an instance of a laravel collection]
     * @param string $transformer
     * @return Collection
     */
    protected function filterData($collection, $transformer)
    {
        foreach (request()->query() as $query => $value) {
            $attribute = $transformer::originalAttribute($query);

            if (isset($attribute, $value)) {
                $collection = $collection->where($attribute, $value);
            }
        }
        return $collection;
    }
}