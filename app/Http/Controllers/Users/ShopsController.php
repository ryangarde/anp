<?php

namespace App\Http\Controllers\Users;

use App\Contracts\CategoryInterface;
use App\Contracts\ProducerInterface;
use App\Contracts\ProductInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopsController extends Controller
{
    /**
     * Category object.
     *
     * @var \App\Contracts\CategoryInterface
     */
    protected $category;

    /**
     * Producer object.
     *
     * @var \App\Contracts\ProducerInterface
     */
    protected $producer;

    /**
     * Product object.
     *
     * @var \App\Contracts\ProductInterface
     */
    protected $product;

    /**
     * Create new instance of product controller.
     *
     * @param CategoryInterface $category Category interface
     * @param ProducerInterface $producer Producer interface
     * @param ProductInterface  $product  Product interface
     */
    public function __construct(
        CategoryInterface $category,
        ProducerInterface $producer,
        ProductInterface $product
    ) {
        $this->category = $category;
        $this->producer = $producer;
        $this->product  = $product;
    }

    public function index()
    {
        // Retrieve all categories
        $categories = $this->category->all();

        // Retrieve all producers
        $producers = $this->producer->all();

        // Retrieve all products, filter if needed.
        $products = $this->product->paginateWithFiltersAndProducer(request());

        // Get search url for filtering.
        $searchUrl = $this->product->getSearchUrl(request());

        // Return view and pass variables.
        return view('users.shop.index', compact('categories', 'producers', 'products', 'searchUrl'));
    }
}