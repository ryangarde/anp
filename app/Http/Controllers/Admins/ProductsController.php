<?php

namespace App\Http\Controllers\Admins;

use App\Contracts\CategoryInterface;
use App\Contracts\ProducerInterface;
use App\Contracts\ProductInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        return view('admins.products.index', compact('categories', 'producers', 'products', 'searchUrl'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get all categories
        $categories = $this->category->all();

        // Get all producers
        $producers = $this->producer->all();

        return view('admins.products.create', compact('categories', 'producers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate all fields.
        $this->validate($request, [
            'producer_id' => 'required|integer',
            'category_id' => 'required|integer',
            'image'       => 'required|image',
            'name'        => 'required|min:2|max:255',
            'description' => 'required|min:2|max:500',
            'price'       => 'required|numeric',
            'retail_size' => 'required'
        ]);

        // If validation passed add the product.
        $this->product->store(request());

        // After addding the product, redirect to products page with a success message.
        return redirect()->route('products.index')->with('message', 'Product successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->product->findOrFailWithProducerAndCategory($id);

        return view('admins.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // If authorize find resource.
        $product = $this->product->findOrFail($id);

        // Get all categories
        $categories = $this->category->all();

        // Get all producers
        $producers = $this->producer->all();

        // If authorize pass the news object to the view.
        return view('admins.products.edit', compact('product', 'categories', 'producers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate all fields.
        $this->validate($request, [
            'producer_id' => 'required|integer',
            'category_id' => 'required|integer',
            'image'       => 'image',
            'name'        => 'required|min:2|max:255',
            'description' => 'required|min:2|max:500',
            'price'       => 'required|numeric'
        ]);

        // If authorize find the news resource using id.
        $product = $this->product->findOrFail($id);

        // If authorize fill the fields and save.
        $product->fill($request->all())->save();

        // After updating the product redirect to edit page with a success message.
        return redirect()->route('products.show', $product->id)->with('message', 'Product successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // If authorize delete the news.
        $this->product->findOrFail($id)->delete();

        // After creating the post redirect to news page with a success message.
        return redirect()->route('products.index')->with('message', 'Product successfully deleted');
    }
}
