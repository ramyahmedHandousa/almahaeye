<?php

namespace App\traits;

trait ImageUploadMedia
{
    public function upload_image($model ,$request)
    {
        if ($request->hasFile('image')):
            $model->clearMediaCollection('master_image');
            $model->addMedia($request->image)->toMediaCollection('master_image');
        endif;
    }

    public function upload_multi_images($model ,$request)
    {
        if ($request->images):
            foreach ($request->images as $key =>  $image){

                $media_image = $model->media()->where('id', '=', $key)->first();
                if ($media_image) {
                    $media_image->delete();
                }
                $model->addMedia($image)->toMediaCollection();
            }
        endif;
    }
}