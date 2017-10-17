<?php

namespace App\Contracts;

interface RepositoryInterface
{
    /**
     * Get all the resources.
     *
     * @return json array
     */
    public function all();

    /**
     * Get all resources with filters in the storage.
     *
     * @return json object array
     */
    public function allWithFilters($request = null);

    /**
     * Create pagination for the resouces.
     *
     * @param  integer $length
     * @return json array
     */
    public function paginate($length);

    /**
     * Create pagination with filters for the resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer                   $length
     * @param  boolean                   $removePage
     * @param  string                    $orderBy
     * @return array json object
     */
    public function paginateWithFilters($request = null, $length = 10, $removePage = false, $orderBy = 'desc');

    /**
     * Create pagination with filters and join users from the resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer                   $length
     * @param  boolean                   $removePage
     * @param  string                    $orderBy
     * @return array json object
     */
    public function paginateWithFiltersAndUsers($request = null, $length = 10, $removePage = false, $orderBy = 'desc');

    /**
     * Find the resource using the specified id or else fail.
     *
     * @param  int $id
     * @return json array
     */
    public function findOrFail($id);

    /**
     * Find the resource using the specified id or else fail with user.
     *
     * @param  int $id
     * @return json object
     */
    public function findOrFailWithUser($id);

    /**
     * Find the resource using the specified slug.
     *
     * @param  string $id
     * @return json object
     */
    public function findBySlug($slug);

    /**
     * Find the resource using the specified slug or else fail with user.
     *
     * @param  string $id
     * @return json object
     */
    public function findBySlugWithUser($slug);

    /**
     * Get resources but limit it to a specified amount.
     *
     * @param  int $limit
     * @return json object
     */
    public function limit($limit);

    /**
     * Store the resource in storage.
     *
     * @param  json object $request
     * @return boolean
     */
    public function store($request);

    /**
     * Update the specified resource in storage.
     *
     * @param  json object $request
     * @param  int $id
     * @return boolean
     */
    public function update($request, $id);

    /**
     * Delete the specified resource in storage.
     *
     * @param  int $id
     * @return boolean
     */
    public function destroy($id);

    /**
     * Search the specified data from the storage.
     *
     * @param  string $column
     * @param  string $key
     * @return boolean
     */
    public function search($column, $key);

    /**
     * Retrieve search url.
     *
     * @param  \Illuminate\Http\Request $request
     * @return string
     */
    public function getSearchUrl($request);

    /**
     * Check if the user is authorize for certain ability.
     *
     * @param  string $ability
     * @return boolean
     */
    public function authorize($ability);

    /**
     * Retrieve archived resources for the model.
     *
     * @return json object array
     */
    public function archives();

    /**
     * Upload image
     *
     * @return null
     */
    public function storeImage($request);
}
