<?php

namespace App\Repositories;

use App\ProductRetailSize;
use App\Contracts\ProductRetailSizeInterface;

class ProductRetailSizeRepository extends Repository implements ProductRetailSizeInterface
{
    /**
     * Create new instance of category repository.
     *
     * @param Category $category Category repository.
     */
    public function __construct(ProductRetailSize $productRetailSize)
    {
        parent::__construct($productRetailSize);
        $this->productRetailSize = $productRetailSize;
    }

    public function findOrFailWithProductDelete($id)
    {
        return $this->model->where('product_id', $id)
                    ->delete();
    }
}
