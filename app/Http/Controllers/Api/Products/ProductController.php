<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Api\MasterApiController;
use App\Http\Resources\GlobalFilterNameResource;
use App\Http\Resources\Products\ListProductResource;
use App\Http\Resources\Products\ShowProductResource;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\User;
use App\Support\Facade\Responder;
use App\traits\paginationTrait;
use Illuminate\Http\Request;

class ProductController extends MasterApiController
{
    use paginationTrait;

    public function __invoke(Request $request)
    {
        $productQuery = Product::query();

        $this->filterQuery($productQuery,$request);

        $totalCount = $productQuery->count();

        $this->pagination_query($request,$productQuery);

        $products = $productQuery->get();

        $this->checkAuthUser($products,$request);

        $data = ['total_count' => $totalCount,'data' => ListProductResource::collection($products)] ;

        return Responder::success($data);
    }

    private function checkAuthUser($queryData,$request)
    {
        if ($request->bearerToken()){
            $user = User::whereApiToken($request->bearerToken())
                ->select('id')
                ->with([
                    'favorite_products' => fn($pro) => $pro->select('id'),
                    'orders' => fn($order) => $order->where('status','cart'),
                    'orders.orderItems' => fn($orderItem) => $orderItem->select('order_id','product_id')
                ])->first();

            $cartIds =  $user['orders']?->pluck('orderItems')?->flatten()?->pluck('product_id')?->toArray();
            $favoriteIds = $user['favorite_products']?->pluck('id')?->toArray();

        }else{
            $cartIds = [];
            $favoriteIds = [];
        }

        if (count($favoriteIds) > 0){
            foreach ($queryData as $queryDatum){
                $queryDatum['in_cart'] = in_array($queryDatum['id'],$cartIds);
                $queryDatum['in_favourite'] = in_array($queryDatum['id'],$favoriteIds);
            }
        }
        return $queryData;
    }

    private function filterQuery($productQuery,$request)
    {
        $productQuery
            ->when(filled($request->q),
                    fn($q) => $q->whereTranslationLike('name', '%' . $request->q . '%'))
            ->when(filled($request->category_id),
                            fn($pro) => $pro->whereHas('category',
                                fn($category) => $category->whereHas('parent',
                                    fn($parent) => $parent->where('id',$request->category_id))))
            ->when(filled($request->brand_id),fn($pro) => $pro->where('brand_id',$request->brand_id))
            ->when(filled($request->product_type_id),fn($pro) => $pro->where('product_type_id',$request->product_type_id))
            ->when(filled($request->price),fn($pro) => $pro->where('price','>=',$request->price))
            ->when($request->discount,fn($pro) => $pro->where('discount','!=',0));

    }

    public function show(Product $product)
    {
        return Responder::success(new ShowProductResource($product));
    }


    public function getFilterData()
    {
        $brands = GlobalFilterNameResource::collection(Brand::whereHas('products')->get());

        $productTypes = GlobalFilterNameResource::collection(ProductType::whereHas('products')->get());


        $categories = GlobalFilterNameResource::collection(Category::whereHas('products')->get());

        $maxAndMinPrice = Product::selectRaw("MIN(price) AS min_price, MAX(price) AS max_price")->first();


        return Responder::success(['brands' => $brands,
            'types' => $productTypes,
            'categories' => $categories,
            'min_price' => $maxAndMinPrice?->min_price,
            'max_price' => $maxAndMinPrice?->max_price,
        ]);
    }
}
