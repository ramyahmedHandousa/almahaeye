<?php

namespace App\Http\Resources\Products;

use App\Http\Resources\User\UserFilterResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RatingProductResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'rate'      => $this->rate,
            'comment'   => $this->comment,
            'user'      => new UserFilterResource($this->user),

            $this->mergeWhen(count($this->children)> 0 ,[
                'replies' => RatingProductResource::collection($this->children)
            ])

        ];
    }
}
