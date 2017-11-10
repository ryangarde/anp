<?php

namespace App\Contracts;

interface ProductInterface
{
    /**
     * Create pagination with filters and join producers from the resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer                   $length
     * @param  boolean                   $removePage
     * @param  string                    $orderBy
     * @return array json object
     */
    public function paginateWithFiltersAndProducer(
        $request = null,
        $length = 10,
        $removePage = false,
        $orderBy = 'desc'
    );

    /**
     * Find the resource using the specified id or else fail with category.
     *
     * @param  int $id
     * @return json object
     */
    public function findOrFailWithCategory($id);

    /**
     * Find the resource using the specified id or else fail with producer and category.
     *
     * @param  int $id
     * @return json object
     */
    public function findOrFailWithProducerAndCategory($id);
}
