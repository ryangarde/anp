<?php

/*
 * This file is part of filter other models.
 *
 * (c) Gether Kestrel B. Medel <dus.medel22@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/*
|--------------------------------------------------------------------------
| Filter other models
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

namespace App\Traits;

trait FilterOtherModels
{
    private $keyValue = [];
    private $check = false;

    public function filterOtherModels(& $query, & $request)
    {
        foreach ($request->all() as $key => $value) {
            // Check if the the column is not valid and if filtering from other model is specified.
            if (! in_array($this->convertToColumn($key), $this->fillable) && self::checkFilterFromOtherModels($key)) {
                // Check if this model has relation with the specified model.
                if (method_exists($this, self::convertToRelationship($key))) {
                    // Check for not array value
                    if (strpos($key, 'searchColumn') !== false && strpos($key, 'FromModel') !== false && ! is_array($value) && $value !== null) {
                        $this->check = true;
                        $keyValue[$key] = $value;
                    }

                    // Check if value is array
                    if (strpos($key, 'searchArrayColumn') !== false && strpos($key, 'FromModel') !== false && is_array($value)) {
                        foreach ($value as $arrayValue) {
                            $this->check = true;
                            $keyValue[$key] = $value;
                        }
                    }
                }
            }
        }

        if ($this->check) {
            $query->whereHas(self::convertToRelationship($key), function ($query) use ($keyValue) {
                $query->where(function ($query) use ($keyValue) {
                    foreach ($keyValue as $key => $value) {
                        if (! is_array($value)) {
                            $query->orWhere($this->convertToColumn($key), 'LIKE', '%' . $value . '%');
                        }

                        if (is_array($value)) {
                            foreach ($value as $arrayValue) {
                                $query->orWhere($this->convertToColumn($key), 'LIKE', '%' . $arrayValue . '%');
                            }
                        }
                    }
                });
            });
        }
    }

    /**
     * check if need to filter from other models.
     *
     * @param  string $key
     * @return boolean
     */
    public function checkFilterFromOtherModels($key)
    {
        if (strpos($key, 'FromModel') !== false || strpos($key, 'Model') !== false) {
            return true;
        }

        return false;
    }

    /**
     * Convert key string to model relationship.
     *
     * @param  string $key
     * @return string
     */
    public function convertToRelationship($key)
    {
        return strtolower(preg_replace('/.+?(?:FromModel)|.+?(?:Model)/', '', $key));
    }
}
