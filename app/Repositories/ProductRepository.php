<?php

namespace App\Repositories;

use App\Contracts\ProductInterface;
use App\Contracts\ProductRetailSizeInterface;
use App\Contracts\ImageInterface;
use App\Product;
use App\ProductRetailSize;


class ProductRepository extends Repository implements ProductInterface
{
    protected $productRetailSize;

    protected $image;
    /**
     * Create new instance of product repository.
     *
     * @param Product $product Product repository.
     */
    public function __construct(Product $product, ProductRetailSize $productRetailSize, ImageInterface $image)
    {
        parent::__construct($product);
        $this->product = $product;
        $this->productRetailSize = $productRetailSize;
        $this->image = $image;
    }

    /**
     * Store the data in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return boolean
     */
    public function store($request)
    {

        $model = $this->model->create($request->all());

        $model->productRetailSizes()->create($request->all());
        return $model->images()->create($request->all());
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
            ->with('producer', 'productRetailSizes', 'images')
            ->orderBy('created_at', $orderBy)
            ->paginate($length)
            ->withPath(
                $this->model->createPaginationUrl($request, $removePage)
            );
    }

    /**
     * Find the resource using the specified id or else fail with category.
     *
     * @param  int $id
     * @return json object
     */
    public function findOrFailWithCategory($id)
    {
        return $this->model->with('category')->findOrFail($id);
    }

    /**
     * Find the resource using the specified id or else fail with producer and category.
     *
     * @param  int $id
     * @return json object
     */
    public function findOrFailWithProducerAndCategory($id)
    {
        return $this->model->with('category', 'producer','images','productRetailSizes.retailSize')->findOrFail($id);
    }

}
