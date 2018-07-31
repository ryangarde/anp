<?php

namespace App\Repositories;

use App\Contracts\RepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

abstract class Repository implements RepositoryInterface
{
    /**
     * Main repository model
     *
     * @var $model
     */
    protected $model;

    /**
     * Create a new repository instance.
     *
     * @param object $model Main repository model
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Get all resources with filters in the storage.
     *
     * @return array json object
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Get all resources with filters in the storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array json object
     */
    public function allWithFilters($request = null)
    {
        return $this->model->filter($request)->get();
    }

    /**
     * Create pagination for the resources.
     *
     * @param  integer $length
     * @return array json object
     */
    public function paginate($length = 15)
    {
        return $this->model->paginate($length);
    }

    /**
     * Create pagination with filters for the resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer                   $length
     * @param  string                    $orderBy
     * @param  boolean                   $removePage
     * @return array json object
     */
    public function paginateWithFilters(
        $request = null,
        $length = 10,
        $orderBy = 'desc',
        $removePage = true
    ) {
        return $this->model->filter($request)
            ->orderBy('created_at', $orderBy)
            ->paginate($length)
            ->withPath(
                $this->model->createPaginationUrl($request, $removePage)
            );
    }

    /**
     * Create pagination with filters and join users from the resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer                   $length
     * @param  boolean                   $removePage
     * @param  string                    $orderBy
     * @return array json object
     */
    public function paginateWithFiltersAndUsers($request = null, $length = 10, $removePage = false, $orderBy = 'desc')
    {
        return $this->model->filter($request)
            ->with('user')
            ->orderBy('created_at', $orderBy)
            ->paginate($length)
            ->withPath(
                $this->model->createPaginationUrl($request, $removePage)
            );
    }

    /**
     * Find the resource using the specified id or else fail.
     *
     * @param  int $id
     * @return json object
     */
    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Find the resource using the specified id or else fail with user.
     *
     * @param  int $id
     * @return json object
     */
    public function findOrFailWithUser($id)
    {
        return $this->model->where('id', $id)
            ->with('user')
            ->first();
    }

    /**
     * Find the resource using the specified slug.
     *
     * @param  string $id
     * @return json object
     */
    public function findBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    /**
     * Find the resource using the specified slug or else fail with user.
     *
     * @param  string $id
     * @return json object
     */
    public function findBySlugWithUser($slug)
    {
        return $this->model->where('slug', $slug)->with('user')->first();
    }

    /**
     * Get resources but limit it to a specified amount.
     *
     * @param  int $limit
     * @return array json object
     */
    public function limit($limit)
    {
        return $this->model->limit($limit)->get();
    }

    /**
     * Store the data in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return boolean
     */
    public function store($request)
    {
        return $this->model->create($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return boolean
     */
    public function update($request, $id)
    {
        $model = $this->model->findOrFail($id);
        $model->fill($request->all());

        return $model->save();
    }

    /**
     * Remove the specified resource from the storage.
     *
     * @param  int $id
     * @return boolean
     */
    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * Search the specified data from the storage.
     *
     * @param  string $column
     * @param  string $key
     * @return boolean
     */
    public function search($column, $key)
    {
        return $this->model->where($column, 'LIKE', '%' . $key .'%')->get();
    }

    /**
     * Retrieve search url.
     *
     * @param  \Illuminate\Http\Request $request
     * @return string
     */
    public function getSearchUrl($request)
    {
        return $this->model->createPaginationUrl($request);
    }

    /**
     * Check if the user is authorize for certain ability.
     *
     * @param  string $ability
     * @return boolean
     */
    public function authorize($ability, $guard = null)
    {
        if ($guard !== null) {
            return auth()->guard($guard)->user()->can($ability, $this->model);
        }

        return auth()->user()->can($ability, $this->model);
    }

    /**
     * Retrieve archived resources for the model.
     *
     * @return array json object
     */
    public function archives()
    {
        return $this->model->archives();
    }

    /**
     * Storage uploaded image
     *
     * @param  \Illuminate\Http\Request $request
     * @return string
     */
    public function storeImage($request, $storePath = 'storage/images/')
    {
        if (request()->hasFile('image')) {
            $request->file('image')->storeAs($storePath, $request->file('image')->getClientOriginalName());
            return $request->file('image')->getClientOriginalName();
        }

        if (request()->hasFile('picture')) {
            $request->file('picture')->storeAs($storePath, $request->file('picture')->getClientOriginalName());
            return $request->file('picture')->getClientOriginalName();
        }

        if (request()->hasFile('photo')) {
            $request->file('photo')->storeAs($storePath, $request->file('photo')->getClientOriginalName());
            return $request->file('photo')->getClientOriginalName();
        }
    }

    /**
     * Retrieve latest resources using specified category.
     *
     * @param $cat
     * @return array json object
     */
    public function getUsingCategory($category, $field = 'category')
    {
        return $this->news->where($field, $category)->latest()->limit(4)->get();
    }
}
