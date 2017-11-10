<?php

namespace App\Repositories;

use App\Category;
use App\Contracts\CategoryInterface;

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
