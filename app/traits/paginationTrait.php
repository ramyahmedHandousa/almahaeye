<?php


namespace App\traits;


trait paginationTrait
{

    public function pagination_query($request ,$query ){

        $pageSize = $request->pageSize ?: 10;
        $skipCount = $request->skipCount;
        $currentPage = $request->get('take', 1); // Default to 1
        $query->skip($skipCount + (($currentPage - 1) * $pageSize));
        $query->take($pageSize);
        return $query->latest();
    }

    public function pagination_query_update_at($request ,$query ){

        $pageSize = $request->pageSize ?: 10;
        $skipCount = $request->skipCount;
        $currentPage = $request->get('take', 1); // Default to 1
        $query->skip($skipCount + (($currentPage - 1) * $pageSize));
        $query->take($pageSize);
        return $query->latest('updated_at');
    }

}
