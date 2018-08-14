<?php

namespace App\Http\Controllers\Admins;

use App\Contracts\ProducerInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProducersController extends Controller
{
    /**
     * Producer object.
     *
     * @var App\Contracts\ProducerInterface
     */
    protected $producer;

    /**
     * Create new instance of producer controller.
     *
     * @param ProducerInterface $producer Producer interface
     */
    public function __construct(ProducerInterface $producer)
    {
        $this->producer = $producer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all news filter if needed.
        $producers = $this->producer->paginateWithFilters(request());

        // Get search url for filtering.
        $searchUrl = $this->producer->getSearchUrl(request());

        // Retrieve Archives
        //$archives = $this->producer->archives();

        // Get current path for archives
        $path = request()->path();

        // Return view and pass variables.
        return view('admins.producers.index', compact('producers', 'searchUrl', 'archives', 'path'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$this->news->authorize('create');
        return view('admins.producers.create');
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
            'name'    => 'required|min:2|max:255',
            'website' => 'max:255',
            'description' => 'required|min:2'
        ]);

        // If validation passed add the product.
        $this->producer->store(request());

        // After addding the product, redirect to products page with a success message.
        return redirect()->route('producers.index')->with('message', 'Producer successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producer = $this->producer->findOrFail($id);

        return view('admins.producers.show', compact('producer'));
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
        $producer = $this->producer->findOrFail($id);

        // If authorize pass the news object to the view.
        return view('admins.producers.edit', compact('producer'));
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

        $this->validate($request, [
            'name'    => 'required|min:2|max:255',
            'website' => 'max:255'
        ]);

        // If authorize find the news resource using id.
        $producer = $this->producer->findOrFail($id);

        // If authorize fill the fields and save.
        $producer->fill($request->all())->save();

        // After updating the category redirect to edit page with a success message.
        return redirect()->route('producers.show', $producer->id)->with('message', 'Producer successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Check if news is owned by the current user.
        // $this->news->authorize('delete');

        // If authorize delete the news.
        $this->producer->findOrFail($id)->delete();

        // After creating the post redirect to news page with a success message.
        return redirect()->route('producers.index')->with('message', 'Producer successfully deleted');
    }
}
