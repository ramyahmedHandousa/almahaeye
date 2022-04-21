
<section class="review">
    <div class="container">
        <!-- section title -->
        <div class="sec-title">
            <h3 class="title">التقيمات</h3>
        </div>
        <!-- review info -->
        <div class="info">
            <div class="total-info">
                <div class="total">{{$countRatingProducts?->avg_rate}} </div>
                <div class="stars ">
                    <i class="fas fa-star yellow"></i>
                    <i class="fas fa-star yellow"></i>
                    <i class="fas fa-star yellow"></i>
                    <i class="fas fa-star yellow"></i>
                    <i class="fas fa-star"></i>
                </div>
                <small>استنادا إلى {{$countRatingProducts?->count}} تقييم</small>
            </div>
            <div class="total-details">
                <ul>
                    <li>
                        <span>5 <i class="fas fa-star"></i></span>
                        <span class="bar">
                                <span style="width: 80%;"></span>
                            </span>
                        <span>{{$countRatingProducts?->five}}</span>
                    </li>
                    <li>
                        <span>4 <i class="fas fa-star"></i></span>
                        <span class="bar">
                                <span style="width: 60%;"></span>
                            </span>
                        <span>{{$countRatingProducts?->four}}</span>
                    </li>
                    <li>
                        <span>3 <i class="fas fa-star"></i></span>
                        <span class="bar">
                                <span style="width: 15%;"></span>
                            </span>
                        <span>{{$countRatingProducts?->three}}</span>
                    </li>
                    <li>
                        <span>2 <i class="fas fa-star"></i></span>
                        <span class="bar">
                                <span style="width: 42%;"></span>
                            </span>
                        <span>{{$countRatingProducts?->two}}</span>
                    </li>
                    <li>
                        <span>1 <i class="fas fa-star"></i></span>
                        <span class="bar">
                                <span style="width: 13%;"></span>
                            </span>
                        <span>{{$countRatingProducts?->one}}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- section comments -->
<section class="comments">
    <div class="container">
        <!-- section title -->
        <div class="sec-title">
            <h3 class="title">التعليقات</h3>
        </div>
        <!-- members-comments -->
        <div class="members-comments">

            @foreach($rating as $rate)
                <!-- comment -->
                    <div class="comment">
                <div class="writer-img">
                    <div class="img"><img src="{{ $rate?->user?->getFirstMediaUrl('master_image') ? : asset('website/templates/images/avatar.png')}}"></div>
                </div>
                <div class="comment-details">
                    <div class="comment-time">{{$rate->created_at?->diffForHumans()}}</div>
                    <h5 class="writer-name">{{$rate->user?->name}}</h5>
                    @if($rate->rate)
                    <div class="stars">
                        <i class="fas fa-star @if($rate->rate > 1) yellow @endif"></i>
                        <i class="fas fa-star @if($rate->rate > 2) yellow @endif"></i>
                        <i class="fas fa-star @if($rate->rate > 3) yellow @endif"></i>
                        <i class="fas fa-star @if($rate->rate > 4) yellow @endif"></i>
                        <i class="fas fa-star @if($rate->rate > 5) yellow @endif"></i>
                    </div>
                    @endif
                    @if($rate->comment)
                        <div class="comment-text">
                            <p> {!! $rate->comment !!}</p>
                        </div>
                    @endif
                </div>
            </div>
                <!-- comment -->
            @endforeach

        </div>
        <!-- comment form -->
        <div class="sec-title">
            <h3 class="title">أضف تعليق و تقييم</h3>
        </div>


        <form class="row" method="post" id="rate-product" action="#">
            <!-- rating -->
            <div class="form-group col-12">
                <label>قيم المنتج</label>
                <div class='starrr' id='rating'>
                    <input id="rate_value" name="rate_value" class="kv-rtl-theme-fas-star rating-loading" dir="rtl" value="0"  data-size="xs">
                </div>
                <span class='rating-choice-text'>
                        تقييمك هو : <span class='rating-choice'></span>
                </span>
            </div>
            <!-- Message -->
            <div class="form-group col-12">
                <label>نص التعليق</label>
                <textarea class="form-control my_comment_rate" name="comment" id="form-control-message" placeholder="التعليق ..." ></textarea>
            </div>
            <!-- submit -->
            <div class="col-lg-3">
                <button class="btn" type="submit">
                    <div class="icon">
                        <i class="fas fa-paper-plane"></i>
                    </div>
                    أضف تعليق
                </button>
            </div>
        </form>
    </div>
</section>
