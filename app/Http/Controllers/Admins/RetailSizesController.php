<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\RetailSizeInterface;

class RetailSizesController extends Controller
{
    /**
     * Retail Size object.
     *
     * @var App\Contracts\RetailSizeInterface
     */
    protected $retailSize;

    /**
     * Create new instance of category controller.
     *
     * @param CategoryInterface $category Category interface
     */
    public function __construct(RetailSizeInterface $retailSize)
    {
        $this->retailSize = $retailSize;
    }


    public function index()
    {
        // Retrieve all news filter if needed.
        $retailSizes = $this->retailSize->paginateWithFilters(request());

        // Get search url for filtering.
        $searchUrl = $this->retailSize->getSearchUrl(request());

        return view('admins.retailSizes.index', compact('retailSizes', 'searchUrl'));
    }

    public function create()
    {
        return view('admins.retailSizes.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:255|unique:retail_sizes',
        ]);

        $this->retailSize->store(request());

        return redirect()->route('admins.retailSizes.index')->with('message', 'Category successfully added');
    }

    public function show($id)
    {
        $retailSize = $this->retailSize->findOrFail($id);

        return view('admins.retailSizes.show', compact('retailSize'));
    }

    public function edit($id)
    {
        $retailSize = $this->retailSize->findOrFail($id);

        return view('admins.retailSizes.edit', compact('retailSize'));
    }

    public function update(Request $request, $id)
    {
        $retailSize = $this->retailSize->findOrFail($id);
        $retailSize->fill($request->all())->save();

        return redirect()->route('admins.retailSizes.show', $retailSize->id)->with('message', 'Retail Size successfully updated');
    }

    public function destroy($id)
    {
        $this->retailSize->findOrFail($id)->delete();

        return redirect()->route('admins.retailSizes.index')->with('message', 'Retail Size successfully deleted');
    }
}