<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\CategoryInterface;

class CategoriesController extends Controller
{
    /**
     * Category object.
     *
     * @var App\Contracts\CategoryInterface
     */
    protected $category;

    /**
     * Create new instance of category controller.
     *
     * @param CategoryInterface $category Category interface
     */
    public function __construct(CategoryInterface $category)
    {
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all news filter if needed.
        $categories = $this->category->paginateWithFilters(request());

        // Get search url for filtering.
        $searchUrl = $this->category->getSearchUrl(request());

        // Retrieve Archives
        $archives = $this->category->archives();

        // Get current path for archives
        $path = request()->path();

        // Return view and pass variables.
        return view('admins.categories.index', compact('categories', 'searchUrl', 'archives', 'path'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$this->news->authorize('create');
        return view('admins.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Check if user is logged in.
        //$this->news->authorize('create');

        // Validate all fields.
        $this->validate($request, [
            'name' => 'required|min:2|max:255',
            'description' => 'required|min:2'
        ]);

        // If validation passed add the product.
        $this->category->store(request());

        // After addding the product, redirect to products page with a success message.
        return redirect()->route('categories.index')->with('message', 'Category successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->category->findOrFail($id);

        return view('admins.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Check if post is owned by the current user.
        //$this->news->authorize('update');

        // If authorize find resource.
        $category = $this->category->findOrFail($id);

        // If authorize pass the news object to the view.
        return view('admins.categories.edit', compact('category'));
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
        // Check if news is owned by the current user.
        //$this->news->authorize('update');

        // If authorize find the news resource using id.
        $category = $this->category->findOrFail($id);

        // If authorize fill the fields and save.
        $category->fill($request->all())->save();

        // After updating the category redirect to edit page with a success message.
        return redirect()->route('categories.show', $category->id)->with('message', 'Category successfully updated');
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
        $this->category->findOrFail($id)->delete();

        // After creating the post redirect to news page with a success message.
        return redirect()->route('categories.index')->with('message', 'Category successfully deleted');
    }
}
