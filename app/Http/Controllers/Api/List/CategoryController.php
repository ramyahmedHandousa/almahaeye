<?php

namespace App\Http\Controllers\Api\List;

use App\Http\Controllers\Api\MasterApiController;
use App\Http\Resources\List\CategoryFilterResource;
use App\Models\Category;
use App\Support\Facade\Responder;
use Illuminate\Http\Request;

class CategoryController extends MasterApiController
{
    public function __invoke(Request $request)
    {
        $categoryQuery = Category::query();

        if ($request->categoryId){

            $categoryQuery->where('parent_id','=',$request->categoryId);

        }else{

            $categoryQuery->whereNull('parent_id');
        }

        return Responder::success(CategoryFilterResource::collection($categoryQuery->get()));
    }
}
