<?php

namespace App\Http\Responses;

use Illuminate\Support\Collection;

abstract class AbstractResponseBuilder
{
    /**
     * Whether elements in an iterable should be treated as individual objects to transform
     *
     * @var bool
     */
    protected static bool $shouldIterateIterable = true;

    public int $status = 200;

    /**
     * Build and return the transformed data in a response
     *
     * @param $data
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public static function build($data)
    {
        $static = new static();

        if (! is_iterable($data) || ! static::$shouldIterateIterable) {
            return response($static->transform($data), $static->status);
        }

        $collection = new Collection();
        foreach ($data as $item)
        {
            $collection->push($static->transform($item));
        }

        return response($collection, $static->status);
    }

    /**
     * Transform the data to the desired formatting
     *
     * @param $data
     * @return array
     */
    public abstract function transform($data): array;

    private function __construct() {}
}
