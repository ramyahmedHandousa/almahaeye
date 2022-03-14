
<section class="categories">
    <div class="container">
        <div class="row">
            @foreach($mainCategories as $category)
                <div class="col-lg-4">
                    <div class="category">
                        <a href="{{route('categories',$category->id)}}">
                            <img loading="lazy"  src="{{$category->getFirstMediaUrl('master_image')}}" alt="{{$category->name}}">
                            <span class="name">{{$category->name}}</span>
                        </a>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>
