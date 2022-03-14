
<div id="header">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="{{url('/')}}">
                <img loading="lazy" src="{{asset('website/templates/images/logo.svg')}}" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{url('/')}}">الرئيسية</a>
                    </li>
                    @foreach($mainCategories as $category)
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('categories')}}">{{$category->name}}</a>
                        </li>
                    @endforeach
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/search'.'?discount=true')}}">العروض</a>
                    </li>
                </ul>
                <form class="search" action="{{url('/search')}}">
                    <input class="form-control" name="q"  type="text" placeholder="ابحث باسم المنتج ">
                </form>
                <ul class="navbar-nav">
                    <li class="nav-item wishlist active">
                        <a class="nav-link"

                           @if(session('wishlist') && count(session('wishlist')) == 0)
                                onclick="window.localStorage.removeItem('wishlist')"
                           @endif

                           href="{{route('my-favorite-products.index')}}">
                            <span class="bubble">0</span>
                            <span class="icon"><i class="fas fa-heart"></i></span>
                            التمنى
                        </a>
                    </li>
                    <li class="nav-item basket cart-basket active">
                        <a class="nav-link"

                            @if(session('cart') && count(session('cart')) == 0)
                                onclick="window.localStorage.removeItem('cart')"
                           @endif
                           href="{{route('cart.index')}}">
                            <span class="bubble">0</span>
                            <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" id="Group_807" data-name="Group 807"
                                         width="17.842" height="16" viewBox="0 0 17.842 16">
                                        <path id="Path_2807" data-name="Path 2807"
                                              d="M14.484,6.708a.712.712,0,0,0,.75-.667v-2.6a2.254,2.254,0,0,1,2.372-2.108,2.255,2.255,0,0,1,2.372,2.108v2.6a.755.755,0,0,0,1.5,0v-2.6A3.68,3.68,0,0,0,17.605,0a3.68,3.68,0,0,0-3.871,3.442v2.6A.712.712,0,0,0,14.484,6.708Z"
                                              transform="translate(-8.663)" fill="#a1a1a1" />
                                        <path id="Path_2808" data-name="Path 2808"
                                              d="M17.755,15.631H13.774v.831a1.425,1.425,0,0,1-1.5,1.333,1.426,1.426,0,0,1-1.5-1.333v-.831H7.531v.831a1.425,1.425,0,0,1-1.5,1.333,1.425,1.425,0,0,1-1.5-1.333v-.831H.506c-.207,0-.335.145-.286.324l2.624,9.5a1.52,1.52,0,0,0,1.412.967h9.749a1.522,1.522,0,0,0,1.413-.967l2.623-9.5C18.09,15.776,17.962,15.631,17.755,15.631Z"
                                              transform="translate(-0.21 -10.421)" fill="#a1a1a1" />
                                    </svg>
                                </span>
                            السلة
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
