<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

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

        $image->storeAs($storagePath, $imageName);

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
