<?php

namespace App\Repositories;

use App\Image;
use App\Contracts\ImageInterface;

class ImageRepository extends Repository implements ImageInterface
{
    /**
     * Create new instance of image repository.
     *
     * @param Image $image Image repository.
     */
    public function __construct(Image $image)
    {
        parent::__construct($image);
        $this->image = $image;

    }

    /**
     * Find the resource using the specified id or else fail with product.
     *
     * @param  int $id
     * @return json object
     */
    public function findOrFailWithProduct($id)
    {
        return $this->model->with('product')->findOrFail($id);
    }


}
