<!-- Main Container  -->
<x-layouts.app>
    <script>
        function onOpenPopup(){
            $('#popupTiktok').modal('show');
        }
    </script>
    <div style="margin-top:20px ">
        {{-- popup  --}}

    <div class="container product-detail">
        <div class="row">
            <div id="content" class="col-md-9 col-sm-12 col-xs-12">
                <a href="javascript:void(0)" class="open-sidebar hidden-lg hidden-md"><i class="fa fa-bars"></i> More Info</a>
                <div class="sidebar-overlay "></div>
                @if(session()->has('success'))
                <div class="alert alert-success alert-dismissable">
                    <a class="panel-close close" data-dismiss="alert">×</a>
                    <i class="fa fa-shopping-cart"></i>Success! {{session()->get('success')}}
                </div>
                @endif
                <div class="product-view product-detail">
                    <div class="product-view-inner clearfix">
                        <div class="content-product-left  col-md-5 col-sm-6 col-xs-12">
                            <div class="so-loadeding"></div>
                            @if(count($product_images)==1)
                            <div class="large-image class-honizol mainUpperImg">
                                <img class="product-image-zoom" style="height: 400px" src="{{asset('images/'.$product_images[0])}}" data-zoom-image="{{asset('images/'.$product_images[0])}}" title="{{$product->name}}" alt="{{$product->name}}">
                            </div>
                            @else
                            <div class="large-image class-honizol mainUpperImg">
                                <img class="product-image-zoom" style="height:400px" src="{{asset('images/'.$product_images[0])}}" data-zoom-image="{{asset('images/'.$product_images[0])}}" title="{{$product->name}}">
                            </div>

                            <div id="thumb-slider" class="full_slider category-slider-inner products-list yt-content-slider" data-rtl="no" data-autoplay="no" data-pagination="no" data-delay="4" data-speed="0.6" data-margin="10" data-items_column0="3" data-items_column1="3" data-items_column2="3" data-items_column3="3" data-items_column4="2" data-arrows="yes" data-lazyload="yes" data-loop="no" data-hoverpause="yes">
                                @php $reverse=array_reverse($product_images); @endphp
                                @foreach($reverse as $index=>$img)
                                <div class="owl2-item">
                                    <div class="image-additional">
                                        <a data-index="{{$index}}" class="img thumbnail" data-image="{{asset('images/'.$img)}}" title="{{$product->name}}">
                                            <img src="{{asset('images/'.$img)}}" title="{{$product->name}}" alt="{{$product->name}}">
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                            @if($product->video_url != null)
                            <div class="modal popupmodal popheight fade in" id="popupTiktok" tabindex="-1" role="dialog" aria-hidden="true" >
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div style="padding: 8px">
                                            <?php
                                            $videourl = $product->video_url;
                                            $uri_segments = explode('/',$videourl);
                                            $video_ids = $uri_segments[5];
                                            $video_id = substr($video_ids,0, strpos($video_ids,'?'));
                                             ?>
                                            <blockquote class="tiktok-embed" cite="{{$product->video_url}}" data-video-id="{{$video_id}}" style="max-width: 605px;min-width: 325px; border-left: none;" >
                                                <section>
                                                 </section>
                                            </blockquote>
                                            <script async src="https://www.tiktok.com/embed.js"></script>
                                        </div>
                                        <div class="crossbutton">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="donotshowAgain()">
                                            <span class="fa fa-times"><span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <?php $image = explode(',', $product->filename)  ?>
                                <hr />
                                <div class="owl2-item">
                                    <h6>Videos</h6>
                                    <div class="image-additional itemTiktok" onclick="onOpenPopup()">
                                        <i class="fa fa-play"></i>
                                        <img src="{{asset('images/'.$image[0])}}" title="{{$product->name}}" style="width: 78.667px">
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="content-product-right col-md-7 col-sm-6 col-xs-12">
                            @if(isset($first_parent->title))<a href="{{url('category/'.$first_parent->urltitle)}}" class="text-primary">{{$first_parent->title}}</a> > @endif
                            @if(isset($second_parent->title))<a href="{{url('category/'.$second_parent->urltitle)}}" class="text-primary">{{$second_parent->title}}</a> > @endif
                            @if(isset($product_cat->title))<a href="{{url('category/'.$product_cat->urltitle)}}" class="text-primary">{{$product_cat->title}}</a>@endif
                        </div>
                        <div class="content-product-right col-md-7 col-sm-6 col-xs-12">
                            <div class="title-product">
                                <h1>{{$product->name}}</h1>
                            </div>
                            <div class="box-review">
                                @if($count_reviews==0) @php $overall_review=0; @endphp
                                @else @php $overall_review=round($total_rating/$count_reviews); @endphp
                                @endif
                                <div class="rating">
                                    <div class="rating-box">
                                        @for($i=0; $i<$overall_review;$i++) <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>@endfor
                                        @for($i=0; $i<(5-$overall_review);$i++) <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>@endfor
                                    </div>
                                </div>
                                <a class="reviews_button">{{$count_reviews}} reviews</a> @if(Auth::check()) / <a class="write_review_button" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">Write a review</a>@endif
                            </div>

                            <div class="product_page_price price">
                                <span class="price-new"><span id="price-special">Rs {{$product->price}}</span></span>
                            </div>
                            <div class="product-box-desc">
                                <div class="inner-box-desc">
                                    @if($product->brand)<div class="brand"><span>Brand: </span><a href="#">{{$product->brand->name}}</a></div>@endif
                                    <div class="stock"><span>Availability:</span>
                                        @if ($product->hot_deal)
                                            @if($product->stock<50)<i class="fa fa-check-square-o" style="color: green"></i>In Stock 50 @else In Stock {{$product->stock}} @endif</div>
                                        @else
                                            @if($product->stock>0)<i class="fa fa-check-square-o" style="color: green"></i>In Stock {{$product->stock}} @else <span style="color:red">Available</span> @endif</div>
                                        @endif
                                    @if($product->in_free==1 || $product->all_free==1)<div class="stock"><span>Delivery:</span><span style="color:green">@if($product->in_free==1) Free Inside Valley @else Free All Over Nepal @endif</span></div>@endif
                                </div>
                            </div>
                            <div class="short_description form-group">
                                <h3>OverView</h3>
                            </div>
                            <div id="product">
                                <div class="box-cart clearfix">
                                    <form class="form-group box-info-product" method="POST">
                                        @csrf
                                        @if($colors->isNotEmpty())
                                        <div>
                                            Colors:
                                            <div style="display: flex;">
                                                @foreach($colors as $index=>$color)
                                                <label class="colorcombination">{{$color->name}}
                                                    <input type="radio" name="color" value="{{$color->id}}" @if($index==0) checked @endif>
                                                    <span class="checkmark"></span>
                                                </label>
                                                @endforeach
                                            </div>
                                        </div>
                                        <hr>
                                        @endif

                                        @if($sizes->isNotEmpty())
                                        <div>
                                            <label>Size:</label>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <select name="size" class="form-control">
                                                        @foreach($sizes as $index=>$size)
                                                        <option value="{{$size->id}}" @if($index==0) selected @endif>{{$size->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        @endif
                                            <div class="option quantity">
                                                <div class="input-group quantity-control" unselectable="on" style="user-select: none;">
                                                    <input class="form-control" type="text" name="quantity" value="1" min="1">
                                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                                    <input type="hidden" name="slug" value="{{$product->urlname}}">
                                                    <span class="input-group-addon product_quantity_down fa fa-caret-down"></span>
                                                    <span class="input-group-addon product_quantity_up fa fa-caret-up"></span>
                                                </div>
                                            </div>
                                            <div class="cart">
                                                <button type="submit" class="btn btn-success" formaction="{{url('add-to-cart/buy')}}">Buy Now</button>
                                                <button type="submit" class="btn btn-default" data-toggle="tooltip" title="" data-original-title="Add to cart" formaction="{{url('add-to-cart/cart')}}">Add To Cart</button>
                                            </div>

                                        <div class="add-to-links wish_comp">
                                            <ul class="blank">
                                                <li class="wishlist">
                                                    <a href="{{route('add.wishlist',['id'=>$product->id])}}"><i class="fa fa-heart"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                        @error('quantity')<div style="margin-top:5px; color:red">{{$message}}</div>@enderror
                                    </form>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-attribute module">
                    <div class="row content-product-midde clearfix">
                        <div class="col-xs-12">
                            <div class="producttab ">
                                <div class="tabsslider  ">
                                    <ul class="nav nav-tabs font-sn">
                                        <li class="active"><a href="#tab-feature" data-toggle="tab">Features</a></li>
                                        <li><a data-toggle="tab" href="#tab-description">Description</a></li>
                                        <li><a href="#tab-review" data-toggle="tab">Review</a></li>
                                        <li><a href="#tab-qa" data-toggle="tab">Question and Answer</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab-feature">
                                            <h4>Features</h4>
                                            <div>
                                                {{ $product->features }}
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab-description">
                                            {!! $product->description !!}
                                        </div>

                                        <div class="tab-pane" id="tab-review">
                                            @if(Auth::check())
                                                <form class="form-horizontal" id="form-review" method="POST" action="{{url('add-review')}}">
                                                    <input type="hidden" name="product_id" value="{{$product->id}}" />
                                                    <input type="hidden" name="slug" value="{{$product->urlname}}" />
                                                    @csrf
                                                    <h2>Write a review</h2>
                                                    <div class="form-group required">
                                                        <div class="col-sm-12">
                                                            <label class="control-label" for="input-review">Your Review</label>
                                                            <textarea name="comment" rows="5" id="input-review" class="form-control"></textarea>
                                                            @error('comment')<div style="color: red">{{$message}}</div>@enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group required">
                                                        <div class="col-sm-12">
                                                            <label class="control-label">Rating</label>
                                                            &nbsp;&nbsp;&nbsp; Bad&nbsp;
                                                            <input type="radio" name="rating" value="1">
                                                            &nbsp;
                                                            <input type="radio" name="rating" value="2">
                                                            &nbsp;
                                                            <input type="radio" name="rating" value="3">
                                                            &nbsp;
                                                            <input type="radio" name="rating" value="4">
                                                            &nbsp;
                                                            <input type="radio" name="rating" value="5">
                                                            &nbsp;Good
                                                        </div>
                                                    </div>
                                                    @error('rating')<div style="color: red">{{$message}}</div>@enderror
                                                    <button type="submit"  data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-thumbs-up"></i> Submit</button>
                                                </form>
                                             @endif

                                            <div class="ratingsandreviews">
                                                <h3>Ratings and Reviews of {{$product->name}}</h3>
                                                <hr />
                                                <div class="firstsection-ratings">
                                                    <div class="leftsideratings">
                                                        <h1>
                                                            @if($count_reviews==0) @php $overall_review=0; @endphp
                                                                @else @php $overall_review=round($total_rating/$count_reviews); @endphp
                                                            @endif
                                                            {{$overall_review}}/5
                                                        </h1>
                                                        <div class="starmain">
                                                            @for($i=0; $i<$overall_review;$i++)
                                                                <span class="fa fa-star checked-star"></span>
                                                            @endfor
                                                            @for($i=0; $i<(5-$overall_review);$i++)
                                                                <span class="fa fa-star"></span>
                                                            @endfor
                                                        </div>
                                                        <small>
                                                            <b>{{$count_reviews}}</b> Ratings
                                                        </small>
                                                    </div>
                                                    <div class="rightsideratings">
                                                        @foreach($per_count_reviews as $per)
                                                            @if($per->rating==5)
                                                                <div class="ratings-five">
                                                                    <div class="first-star">
                                                                        <span class="fa fa-star checked-star"></span>
                                                                        <span class="fa fa-star checked-star"></span>
                                                                        <span class="fa fa-star checked-star"></span>
                                                                        <span class="fa fa-star checked-star"></span>
                                                                        <span class="fa fa-star checked-star"></span>
                                                                    </div>
                                                                    <div class="num-rating">
                                                                        {{$per->count}}
                                                                    </div>
                                                                </div>
                                                            @elseif($per->rating==4)
                                                                <div class="ratings-five">
                                                                    <div class="first-star">
                                                                        <span class="fa fa-star checked-star"></span>
                                                                        <span class="fa fa-star checked-star"></span>
                                                                        <span class="fa fa-star checked-star"></span>
                                                                        <span class="fa fa-star checked-star"></span>
                                                                        <span class="fa fa-star "></span>
                                                                    </div>
                                                                    <div class="num-rating">
                                                                        {{$per->count}}
                                                                    </div>
                                                                </div>
                                                                @elseif($per->rating==3)
                                                                    <div class="ratings-five">
                                                                        <div class="first-star">
                                                                            <span class="fa fa-star checked-star"></span>
                                                                            <span class="fa fa-star checked-star"></span>
                                                                            <span class="fa fa-star checked-star"></span>
                                                                            <span class="fa fa-star"></span>
                                                                            <span class="fa fa-star"></span>
                                                                        </div>
                                                                        <div class="num-rating">
                                                                            {{$per->count}}
                                                                        </div>
                                                                    </div>
                                                                    @elseif($per->rating==2)
                                                                        <div class="ratings-five">
                                                                            <div class="first-star">
                                                                                <span class="fa fa-star checked-star"></span>
                                                                                <span class="fa fa-star checked-star"></span>
                                                                                <span class="fa fa-star"></span>
                                                                                <span class="fa fa-star"></span>
                                                                                <span class="fa fa-star"></span>
                                                                            </div>
                                                                            <div class="num-rating">
                                                                                {{$per->count}}
                                                                            </div>
                                                                        </div>
                                                                        @else
                                                                        <div class="ratings-five">
                                                                            <div class="first-star">
                                                                                <span class="fa fa-star checked-star"></span>
                                                                                <span class="fa fa-star"></span>
                                                                                <span class="fa fa-star"></span>
                                                                                <span class="fa fa-star"></span>
                                                                                <span class="fa fa-star"></span>
                                                                            </div>
                                                                            <div class="num-rating">
                                                                                {{$per->count}}
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                             @endforeach
                                                        </div>
                                                    </div>
                                                @if($user_reviews->isNotEmpty())
                                                    <h4>Product Reviews</h4>
                                                    <hr />
                                                    @foreach($user_reviews as $row)
                                                        <div class="ratingsview">
                                                            <div class="eutaratingsection">
                                                                <div class="starview">
                                                                    @for($i=1;$i<=$row->rating;$i++)
                                                                        <span class="fa fa-star checked-star"></span>
                                                                    @endfor

                                                                    @for($i=1;$i<=5-$row->rating;$i++)
                                                                        <span class="fa fa-star"></span>
                                                                    @endfor
                                                                </div>
                                                                <div class="sectonsection">
                                                                    <h5>{{$row->client->name}}</h5>
                                                                    <span class="label label-success"><span class="glyphicon glyphicon-ok"></span>Verified Purchase</span>
                                                                </div>
                                                                <small>
                                                                    {{$row->created_at}}
                                                                </small>
                                                                <div>
                                                                    {{$row->comment}}
                                                                </div>
                                                            </div>
                                                            <hr />
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tab-qa">
                                            @if(Auth::check())
                                                <h5>Questions about this product</h5>
                                                <form method="POST" action="{{url('question')}}">
                                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                                    <input type="hidden" name="vendor_id" value="{{$product->retailerId}}">
                                                    @csrf
                                                    <textarea class="form-control" rows="5" placeholder="Enter Your Questions" name="question"></textarea>
                                                    @error('question')<div style="color: red">* {{$message}}</div> @enderror
                                                    <div>
                                                        <small>Your questions should not contain contact information such as email, phone or external web links.</small>
                                                    </div>
                                                    <button class="btn btn-success" style="margin-top:10px">Ask Question <i class="glyphicon glyphicon-chevron-right"></i></button>
                                                </form>
                                                <hr />
                                            @endif

                                            @if($my_questions->isNotEmpty())
                                                <div class="questiontab">
                                                    <h5>My Questions</h5>
                                                    <hr style="width: 20%; margin-left: 0;" />
                                                    @foreach($my_questions as $row)
                                                        <div class="myquestion">
                                                            <div class="ques-prod">
                                                                <div class="ques-prod-que">Q</div>
                                                                <div class="ques-one">
                                                                    <div class="mainques">
                                                                        {{$row->question}}
                                                                    </div>
                                                                    <div class="ques-desc">
                                                                        <span class="label label-success">{{$row->client->name}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @if($row->answer!=null || $row->answer!="")
                                                                <div class="ques-prod-answer">
                                                                    <div class="ques-prod-que">A</div>
                                                                    <div class="ques-one">
                                                                        <div class="mainques">
                                                                            {{$row->answer}}
                                                                        </div>
                                                                        @if(isset($vendor_name->name))
                                                                            <div class="ques-desc">
                                                                                <span class="label label-primary">{{$vendor_name->name}}</span>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif

                                            @if($other_questions->isNotEmpty())
                                                <div>
                                                    <hr />
                                                    <h5>Other questions answered by the Dealer </h5>
                                                    @foreach($other_questions as $row)
                                                        <div>
                                                            <hr style="width: 40%; margin-left: 0;" />
                                                            <div class="otherquestions">
                                                                <div class="ques-prod">
                                                                    <div class="ques-prod-que">Q</div>
                                                                    <div class="ques-one">
                                                                        <div class="mainques">
                                                                            {{$row->question}}
                                                                        </div>
                                                                        <div class="ques-desc">
                                                                            <span class="label label-success">{{$row->client->name}}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if($row->answer!=null || $row->answer!="")
                                                                    <div class="ques-prod-answer">
                                                                        <div class="ques-prod-que">A</div>
                                                                        <div class="ques-one">
                                                                            <div class="mainques">
                                                                                {{$row->answer}}
                                                                            </div>
                                                                            @if(isset($vendor_name->name))
                                                                                <div class="ques-desc">
                                                                                    <span class="label label-primary">{{$vendor_name->name}}</span>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(count($related_products)>0)
                <div class="content-product-bottom bottom-product clearfix">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#product-related">Related Products</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="product-related" class="tab-pane fade in active">
                            <div class="clearfix module horizontal">
                                <div class="products-category">
                                    <div class="category-slider-inner products-list yt-content-slider releate-products grid" data-rtl="no" data-autoplay="no" data-pagination="no" data-delay="4" data-speed="0.6" data-margin="30" data-items_column0="3" data-items_column1="3" data-items_column2="2" data-items_column3="2" data-items_column4="1" data-arrows="yes" data-lazyload="yes" data-loop="no" data-hoverpause="yes">
                                        @foreach($related_products as $related)
                                        <div class="product-layout">
                                            <div class="product-item-container">
                                                <div class="left-block">
                                                    <div class="product-image-container ">
                                                        <a href="{{url('product/'.$related->urlname)}}" title="{{$related->name}}">
                                                            <img style="height: 220px;" src="{{asset('images/'.$related->filename)}}" alt="{{$related->name}}" title="{{$related->name}}" class="img-1 img-responsive">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="right-block">
                                                    <div class="caption">
                                                        <h4><a href="#">{{$related->name}}</a></h4>
                                                        <div class="total-price clearfix" style="visibility: hidden; display: block;">
                                                            <div class="price price-left">
                                                                <span class="price-new">Rs {{$related->price}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="description hidden">
                                                            <p>{{$related->urlname}} </p>
                                                        </div>
                                                    </div>
                                                    <div class="button-group">
                                                        <div class="button-inner so-quickview">
                                                            <a class="wishlist btn-button" type="button" data-toggle="tooltip" title="" data-original-title="Add to Wish List" href="{{route('add.wishlist',['id'=>$related->id])}}"><i class="fa fa-heart-o"></i></a>
                                                            {{-- <a class="addToCart btn-button" type="button" data-toggle="tooltip" title="" data-original-title="Add to Cart" href="{{route('add.cart',['id'=>$related->id])}}"><span class="hidden">Add to Cart </span></a> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-md-3 col-sm-4 col-xs-12 content-aside left_column sidebar-offcanvas">
                <span id="close-sidebar" class="fa fa-times"></span>
                <div class="module category-style">
                    <h3 class="modtitle"><span>Information </span></h3>
                    <div style="padding: 10px; display:flex;">
                        <i class="fa fa-truck" style="font-size:25px;color:#FE8C69"></i>
                        <div style="padding-left: 10px">
                            <span style="font-size: 18px">Free Shipping </span>
                            <p>Free express shipping on orders over Rs 3000 2-3 Business Days</p>
                        </div>
                    </div>

                    <div style="padding: 10px; display:flex">
                        <i class="fa fa-check-circle" style="font-size:25px;color:#FE8C69"></i>
                        <div style="padding-left: 10px">
                            <span style="font-size: 18px">Secure Shopping </span>
                            <p>We are committed to protecting the security of your information</p>
                        </div>
                    </div>

                    <div style="padding: 10px; display:flex">
                        <i class="fa fa-clock-o" style="font-size:25px;color:#FE8C69"></i>
                        <div style="padding-left: 10px">
                            <span style="font-size: 18px">Estimated Devlivery </span>
                            <p>Kathmandu Valley: 1 to 3 Days</p>
                        </div>
                    </div>

                    <div style="padding: 10px; display:flex">
                        <i class="fa fa-list-alt" style="font-size:25px;color:#FE8C69"></i>
                        <div style="padding-left: 10px">
                            <span style="font-size: 18px">Quality Checked </span>
                            <p>We are providing top quality products and service.</p>
                        </div>
                    </div>
                </div>

                @if($product->retailer)
                @php $retailer=DB::table('users')->where('retailer_id',$product->retailer->id)->first();@endphp
                <div class="module category-style">
                    <h3 class="modtitle"><span>Seller Details </span></h3>
                    <div style="padding:10px">
                        <h5>Sold By :</h5>
                        <p style="color:#FE8C69 ">{{$retailer->name}} @if($product->retailer->verified==1)<i class="fa fa-check-circle" style="color: green"></i></p>@endif
                    </div>
                    @if($product->retailer->verified==1)
                    <div class="row" style="padding-left:10px ">
                        <div class="col-lg-7 col-md-7">
                            <h5>Verified By :</h5>
                            <p>Mero Shopping <i class="fa fa-check-circle" style="color: green"></i></p>
                        </div>
                    </div>
                    @endif
                </div>
                @endif
                @if($best_sellers->isNotEmpty())
                    <x-front.best-sellers :best="$best_sellers" />
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
<!-- //Main Container -->
