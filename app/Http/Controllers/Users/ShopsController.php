<?php

namespace App\Http\Controllers\Users;

use App\Contracts\CategoryInterface;
use App\Contracts\ProducerInterface;
use App\Contracts\ProductInterface;
use App\Contracts\UserInterface;
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
     * User object.
     *
     * @var App\Contracts\UserInterface
     */
    protected $user;

    /**
     * Create new instance of product controller.
     *
     * @param CategoryInterface $category Category interface
     * @param ProducerInterface $producer Producer interface
     * @param ProductInterface  $product  Product interface
     * @param UserInterface     $user     User interface
     */
    public function __construct(
        CategoryInterface $category,
        ProducerInterface $producer,
        ProductInterface $product,
        UserInterface $user
    ) {
        $this->category = $category;
        $this->producer = $producer;
        $this->product  = $product;
        $this->user = $user;
    }

    public function index()
    {
        // Retrieve all categories
        $categories = $this->category->all();

        // Retrieve all producers
        $producers = $this->producer->all();

        // Retrieve all products, filter if needed
        $products = $this->product->paginateWithFiltersAndProducer(request(), 9);

        // Get search url for filtering
        $searchUrl = $this->product->getSearchUrl(request());

        // Return view and pass variables.
        return view('users.shop.index', compact('categories', 'producers', 'products', 'searchUrl'));
    }
}
