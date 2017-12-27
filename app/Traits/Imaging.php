<?php

/*
 * This file is part of Imaging.
 *
 * (c) Gether Kestrel B. Medel <dus.medel22@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/*
|--------------------------------------------------------------------------
| Auto filtering with pagination and archiving for models
|--------------------------------------------------------------------------
|
| Here is where all the filtering logic happens, from filtering the
| current model to filtering other models and entrust
|
|
*/

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

trait Imaging
{
    public static function insertImage($model, $storagePath = 'public/images')
    {
        if (request()->hasFile('image')) {
            $model->image = self::storeImage(request()->image, $storagePath);

            return true;
        }

        if (request()->hasFile('picture')) {
            $model->picture = self::storeImage(request()->picture, $storagePath);

            return true;
        }

        if (request()->hasFile('photo')) {
            $model->photo = self::storeImage(request()->photo, $storagePath);

            return true;
        }

        return false;
    }

    public static function storeImage(& $image, $storagePath)
    {
        $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
//
//        $image->storeAs($storagePath, $imageName);

        $img = Image::make($image)->resize(1366, 768);
        $img->save(storage_path('app/public/images/'. $imageName), 70);


        return $imageName;
    }

    public static function deleteImage($model)
    {
        if ($model->image != null) {
            Storage::delete($model->image);

            return true;
        }

        if ($model->picture  != null) {
            Storage::delete($model->picture);

            return true;
        }

        if ($model->photo != null) {
            Storage::delete($model->photo);

            return true;
        }

        return false;
    }

    public static function updateImage($model)
    {
        self::deleteImage($model->findorFail($model->id));
        self::insertImage($model);
    }
}
