<?php

namespace App\Repositories;

use App\Contracts\CategoryInterface;
use App\Category;

class CategoryRepository extends Repository implements CategoryInterface
{
    /**
     * Create new instance of category repository.
     *
     * @param Category $category Category repository.
     */
    public function __construct(Category $category)
    {
        parent::__construct($category);
        $this->category = $category;
    }
}
