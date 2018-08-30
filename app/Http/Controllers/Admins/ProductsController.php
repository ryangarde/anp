<?php

namespace App\Http\Controllers\Admins;

use App\Contracts\CategoryInterface;
use App\Contracts\ProducerInterface;
use App\Contracts\ProductInterface;
use App\Contracts\RetailSizeInterface;
use App\Contracts\ImageInterface;
use App\Contracts\ProductRetailSizeInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductRetailSize;

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
     * Retail Size object.
     *
     * @var \App\Contracts\RetailSizeInterface
     */
    protected $retailSize;

    /**
     * Product Retail Size object.
     *
     * @var \App\Contracts\ProductRetailSizeInterface
     */
    protected $productRetailSize;

    /**
     * Image object.
     *
     * @var \App\Contracts\ImageInterface
     */
    protected $image;

    /**
     * Create new instance of product controller.
     *
     * @param CategoryInterface $category Category interface
     * @param ProducerInterface $producer Producer interface
     * @param ProductInterface  $product  Product interface
     * @param RetailSizeInterface  $retailSize  RetailSize interface
     * @param ProductRetailSizeInterface  $productRetailSize  ProductRetailSize interface
     */
    public function __construct(
        CategoryInterface $category,
        ProducerInterface $producer,
        ProductInterface $product,
        RetailSizeInterface $retailSize,
        ProductRetailSizeInterface $productRetailSize,
        ImageInterface $image
    ) {
        $this->category = $category;
        $this->producer = $producer;
        $this->product = $product;
        $this->retailSize  = $retailSize;
        $this->productRetailSize  = $productRetailSize;
        $this->image = $image;
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

        // Get all retail sizes
        $retailSizes = $this->retailSize->all();

        return view('admins.products.create', compact('categories', 'producers','retailSizes'));
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
            'name'        => 'required|min:2|max:255',
            'description' => 'required|min:2|max:500',
            'price'       => 'required|numeric',
            'image'       => 'required',
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
        $retailSizes = $this->retailSize->all();

        return view('admins.products.show', compact('product','retailSizes'));
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

        // Get all retail sizes
        $retailSizes = $this->retailSize->all();

        // If authorize pass the news object to the view.
        return view('admins.products.edit', compact('product', 'categories', 'producers', 'retailSizes'));
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
        $product->retailSizes()->attach($request->retail_size_id);
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
        $this->productRetailSize->findOrFailWithProductDelete($id);
        $this->product->findOrFail($id)->delete();

        // After creating the post redirect to news page with a success message.
        return redirect()->route('products.index')->with('message', 'Product successfully deleted');
    }

    public function addRetail(Request $request, $id)
    {
        $product = $this->product->findOrFail($id);
        // If authorize fill the fields and save.

        $productRetailSizes = ProductRetailSize::where('product_id',$id)->where('retail_size_id',$request->retail_size_id)->first();
        if (empty($productRetailSizes)) {
            $product->productRetailSizes()->create($request->all());
        } else {
            return back()->with('message','Retail size already exists');
        }

        return back()->with('message','Retail size successfully added');
    }

    public function addImage(Request $request, $id)
    {
        $product = $this->product->findOrFail($id);

        // If authorize fill the fields and save.
        $product->images()->create($request->all());

        return back();
    }
}
