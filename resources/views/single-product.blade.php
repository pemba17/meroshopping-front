<!-- Main Container  -->
<x-layouts.app>
    <div style="margin-top:20px ">
        {{-- <div class="breadcrumbs">
            <div class="container">
                <div class="title-breadcrumb">   
                    {{$product->name}}
                </div>
            </div>
        </div> --}}
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
                                    <div class="large-image class-honizol">
                                        <img class="product-image-zoom" src="{{asset('images/'.$product_images[0])}}" data-zoom-image="{{asset('images/'.$product_images[0])}}" title="{{$product->name}}" alt="{{$product->name}}">
                                    </div>
                                @else
                                    @foreach($product_images as $key=>$img)
                                        @if($key==0)
                                            <div class="large-image class-honizol">
                                                <img class="product-image-zoom" src="{{asset('images/'.$product_images[$key])}}" data-zoom-image="{{asset('images/'.$product_images[$key])}}" title="{{$product->name}}">
                                            </div>
                                        @else
                                            <div id="thumb-slider" class="full_slider category-slider-inner products-list yt-content-slider" data-rtl="no" data-autoplay="no" data-pagination="no" data-delay="4" data-speed="0.6" data-margin="10" data-items_column0="3" data-items_column1="3" data-items_column2="3" data-items_column3="3" data-items_column4="2" data-arrows="yes" data-lazyload="yes" data-loop="no" data-hoverpause="yes">
                                                <div class="owl2-item" >
                                                    <div class="image-additional">
                                                        <a data-index="0" class="img thumbnail" data-image="{{asset('images/'.$product_images[$key])}}" title="{{$product->name}}">
                                                            <img src="{{asset('images/'.$product_images[$key])}}" title="{{$product->name}}" alt="{{$product->name}}">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif          
                            </div>
                            <div class="content-product-right col-md-7 col-sm-6 col-xs-12">
                                <div class="title-product">
                                    <h1>{{$product->name}}</h1>
                            </div>
                            <div class="box-review">
                                <div class="rating">
                                    <div class="rating-box">
                                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>                            
                                    </div>
                                </div>
                                <a class="reviews_button" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">0 reviews</a> / <a class="write_review_button" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">Write a review</a>
                            </div>

                            <div class="product_page_price price" itemscope="" itemtype="http://data-vocabulary.org/Offer">
                                <span class="price-new"><span id="price-special">Rs {{$product->price}}</span></span>
                            </div>
                            <div class="product-box-desc">
                                <div class="inner-box-desc">
                                @if($product->brand)<div class="brand"><span>Brand: </span><a href="#">{{$product->brand->name}}</a></div>@endif
                                <div class="stock"><span>Availability:</span> @if($product->stock>0)<i class="fa fa-check-square-o" style="color: green"></i>In Stock {{$product->stock}} @else <span style="color:red">Out of Stock</span> @endif</div>
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
                                    @if($product->stock>0)
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
                                            <button type="submit" class="btn btn-default" data-toggle="tooltip" title="" data-original-title="Add to cart"  formaction="{{url('add-to-cart/cart')}}">Add To Cart</button>
                                        </div> 
                                    @endif
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
                                        <li class="active"><a data-toggle="tab" href="#tab-description">Description</a></li>
                                        <li><a href="#tab-review" data-toggle="tab">Review (0)</a></li>
                                        {{-- <li><a href="#tab-tags" data-toggle="tab">Tags</a></li> --}}
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab-description">
                                            {!! $product->description !!}
                                        </div>

                                        <div class="tab-pane" id="tab-review">
                                            <form class="form-horizontal" id="form-review">
                                                <div id="review">
                                                    <p>There are no reviews for this product.</p>
                                                </div>
                                                <h2>Write a review</h2>
                                                <div class="form-group required">
                                                    <div class="col-sm-12">
                                                        <label class="control-label" for="input-name">Your Name</label>
                                                        <input type="text" name="name" value="" id="input-name" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group required">
                                                    <div class="col-sm-12">
                                                        <label class="control-label" for="input-review">Your Review</label>
                                                        <textarea name="text" rows="5" id="input-review" class="form-control"></textarea>
                                                        <div class="help-block"><span class="text-danger">Note:</span> HTML is not translated!</div>
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
                                                <div class="buttons clearfix" style="visibility: hidden; display: block;">
                                                    <div class="pull-right">
                                                        <button type="button" id="button-review" data-loading-text="Loading..." class="btn btn-primary">Continue</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        {{-- <div class="tab-pane" id="tab-tags" >
                                            <a href="#">Monitor</a>,
                                            <a href="#">Apple</a>       
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-product-bottom bottom-product clearfix">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#product-related">Related Products</a></li> 
                    </ul>
                    <div class="tab-content">
                        <div id="product-related" class="tab-pane fade in active">
                            <div class="clearfix module horizontal">
                                <div class="products-category">
                                    <div class="category-slider-inner products-list yt-content-slider releate-products grid" data-rtl="no" data-autoplay="no" data-pagination="no" data-delay="4" data-speed="0.6" data-margin="30" data-items_column0="3" data-items_column1="3" data-items_column2="2" data-items_column3="2" data-items_column4="1" data-arrows="yes" data-lazyload="yes" data-loop="no" data-hoverpause="yes">
                                        <div class="product-layout">
                                            <div class="product-item-container">
                                                <div class="left-block">
                                                    <div class="product-image-container">
                                                        <a href="#" title="Portable  Compact Charger (External Battery) t45 ">
                                                        <img src="{{asset('front/assets/image/catalog/demo/product/electronic/3.jpg')}}" alt="Portable  Compact Charger (External Battery) t45" title="Portable  Compact Charger (External Battery) t45 " class="img-1 img-responsive">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="right-block">
                                                    <div class="caption">
                                                        <h4><a href="#">Portable  Compact Charger (External Battery) t452 </a></h4>
                                                        <div class="total-price clearfix" style="visibility: hidden; display: block;">
                                                            <div class="price price-left">
                                                                <span class="price-new">Rs 74.00</span>
                                                                <span class="price-old">Rs 122.00</span>
                                                            </div>
                                                        </div>
                                                        <div class="description hidden">
                                                            <p>The 30-inch Apple Cinema HD Display delivers an amazing 2560 x 1600 pixel resolution. Designed specifically for the creative professional, this display provides more space for easier access to all the.. </p>
                                                        </div>
                                                    </div>
                                                    <div class="button-group">
                                                        <div class="button-inner so-quickview">
                                                        <button class="wishlist btn-button" type="button" data-toggle="tooltip" title="" onclick="wishlist.add('78');" data-original-title="Add to Wish List"><i class="fa fa-heart-o"></i></button>
                                                        <button class="addToCart btn-button" type="button" data-toggle="tooltip" title="" onclick="cart.add('78', '2');" data-original-title="Add to Cart"><span class="hidden">Add to Cart </span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-layout">
                                            <div class="product-item-container">
                                                <div class="left-block">
                                                    <div class="product-image-container">
                                                        <a href="#" title="Portable  Compact Charger (External Battery) t45 ">
                                                        <img src="{{asset('front/assets/image/catalog/demo/product/electronic/6.jpg')}} " alt="Portable  Compact Charger (External Battery) t45" title="Portable  Compact Charger (External Battery) t45 " class="img-1 img-responsive">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="right-block">
                                                    <div class="caption">
                                                        <h4><a href="#">Portable  Compact Charger (External Battery) t45 </a></h4>
                                                        <div class="total-price clearfix" style="visibility: hidden; display: block;">
                                                            <div class="price price-left">
                                                                <span class="price-new">Rs 200</span>
                                                            </div>
                                                        </div>
                                                        <div class="description hidden">
                                                            <p>The 30-inch Apple Cinema HD Display delivers an amazing 2560 x 1600 pixel resolution. Designed specifically for the creative professional, this display provides more space for easier access to all the.. </p>
                                                        </div>
                                                    </div>
                                                    <div class="button-group">
                                                        <div class="button-inner so-quickview">
                                                        <button class="wishlist btn-button" type="button" data-toggle="tooltip" title="" onclick="wishlist.add('78');" data-original-title="Add to Wish List"><i class="fa fa-heart-o"></i></button>
                                                        <button class="addToCart btn-button" type="button" data-toggle="tooltip" title="" onclick="cart.add('78', '2');" data-original-title="Add to Cart"><span class="hidden">Add to Cart </span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="col-md-3 col-sm-4 col-xs-12 content-aside left_column sidebar-offcanvas">
                <span id="close-sidebar" class="fa fa-times"></span>
                <div class="module category-style">
                    <h3 class="modtitle"><span>Information </span></h3>
                    <div style="padding: 10px; display:flex;">
                        <i class="fa fa-truck" style="font-size:25px;color:#FE8C69"></i>
                        <div style="padding-left: 10px">
                            <span style="font-size: 18px">Free Shipping </span>
                            <p>Free express shipping on orders over Rs3000 2-3 Business Days</p>
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

                <div class="moduletable module so-extraslider-ltr best-seller best-seller-custom">
                    <h3 class="modtitle"><span>Best Sellers</span></h3>
                    <div class="modcontent">
                        <div id="so_extra_slider" class="so-extraslider buttom-type1 preset00-1 preset01-1 preset02-1 preset03-1 preset04-1 button-type1">
                            <div class="extraslider-inner owl2-carousel owl2-theme owl2-loaded extra-animate" data-effect="none">
                                <div class="item ">
                                    <div class="item-wrap style1 ">
                                        <div class="item-wrap-inner">
                                            <div class="media-left">
                                                <div class="item-image">
                                                    <div class="item-img-info product-image-container ">
                                                        <div class="box-label"></div>
                                                        <a class="lt-image" data-product="104" href="#" target="_self" title="Toshiba Pro 21&quot;(21:9) FHD  IPS LED 1920X1080 HDMI(2)">
                                                        <img src="{{asset('front/assets/image/catalog/demo/product/electronic/25.jpg')}}" alt="Toshiba Pro 21&quot;(21:9) FHD  IPS LED 1920X1080 HDMI(2)">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="media-body">
                                                <div class="item-info">
                                                    <!-- Begin title -->
                                                    <div class="item-title">
                                                        <a href="#" target="_self" title="Toshiba Pro 21&quot;(21:9) FHD  IPS LED 1920X1080 HDMI(2) ">
                                                        Toshiba Pro 21"(21:9) FHD  IPS LED 1920X1080 HDMI(2) 
                                                        </a>
                                                    </div>
                                                    <!-- Begin ratting -->
                                                    <div class="rating">
                                                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                    </div>
                                                    <!-- Begin item-content -->
                                                    <div class="price">
                                                        <span class="old-price product-price">$62.00</span>
                                                        <span class="price-old">$337.99</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div> 
</x-layouts.app>    
  <!-- //Main Container -->