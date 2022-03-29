
<div class="slider">

    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">

            <div class="carousel-inner">
                @foreach($sliders as $key => $slider)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <a href="#">
                            <img loading="lazy" src="{{$slider->getFirstMediaUrl('master_image')}}" alt="banner-{{$slider->id}}">
                        </a>
                    </div>
                    <div class="carousel-item">
                            <a href="#">
                                <img loading="lazy"  src="{{$slider->getFirstMediaUrl('master_image')}}"  alt="banner-{{$slider->id}}">
                            </a>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>

    </div>
</div>
