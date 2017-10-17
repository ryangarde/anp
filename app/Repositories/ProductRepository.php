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
}
