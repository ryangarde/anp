<?php

namespace App\Repositories;

use App\Contracts\ProductInterface;
use App\Product;

class ProductRepository extends Repository implements ProductInterface
{
    /**
     * Create new instance of product repository.
     *
     * @param Product $product Product repository.
     */
    public function __construct(Product $product)
    {
        parent::__construct($product);
        $this->product = $product;
    }

    public function filterCategory($id)
    {
        return $this->product->where('category_id', $id)->paginate(15);
    }

    /**
     * Create pagination with filters and join producers from the resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer                   $length
     * @param  boolean                   $removePage
     * @param  string                    $orderBy
     * @return array json object
     */
    public function paginateWithFiltersAndProducer(
        $request = null,
        $length = 10,
        $removePage = false,
        $orderBy = 'desc'
    ) {
        return $this->model->filter($request)
            ->with('producer')
            ->orderBy('created_at', $orderBy)
            ->paginate($length)
            ->withPath(
                $this->model->createPaginationUrl($request, $removePage)
            );
    }

    /**
     * Find the resource using the specified id or else fail with producer and category.
     *
     * @param  int $id
     * @return json object
     */
    public function findOrFailWithProducerAndCategory($id)
    {
        return $this->model->with('category', 'producer')->findOrFail($id);
    }
}
