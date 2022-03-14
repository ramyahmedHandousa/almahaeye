
<!-- start slider -->
@include('website.layouts.sections.slider')
<!-- end slider -->

<!-- start categories section -->
@include('website.layouts.sections.main-categories',['mainCategories' => $mainCategories ?? []])
<!-- end categories section -->



@include('website.layouts.sections.products-most-order',['productsMostOrder' => $productsMostOrder ?? []])



@include('website.layouts.sections.filter-categories-have-products',['categoriesHaveProducts' => $categoriesHaveProducts ?? [] ])
