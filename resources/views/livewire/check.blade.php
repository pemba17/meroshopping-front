<div id="content">
    <style>
        .innerItemClass {
            width: 204px;
            max-width: 210px;
        }

        .itemMainClass {
            display: flex;
            flex-wrap: wrap;
            float: unset !important;
        }

        .itemMainImg {
            margin: unset !important;
            width: 100% !important;
            object-fit: cover;
        }

        @media screen and (max-width: 788px) {
            .innerItemClass {
                width: 100%;
                max-width: 100%;
            }
        }
    </style>
    <div class="so-page-builder">
        <section id="section_1_h3">
            <div class="container page-builder-ltr">
                <div class="row row-style row_lkda">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col_iksd menu_vertical">
                        <div class="row row-style row-lkdn">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_kkwm col-style megamenu-style-dev">
                                <div class="responsive">
                                    <div class="so-vertical-menu no-gutter">
                                        <nav class="navbar-default">
                                            <div class=" container-megamenu  container   vertical  ">
                                                <div id="menuHeading">
                                                    <div class="megamenuToogle-wrapper">
                                                        <div class="megamenuToogle-pattern">
                                                            <div class="container">
                                                                <div><span></span><span></span><span></span></div>
                                                                <span class="title-mega">
                                                                    All Categories
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="navbar-header">
                                                    <span class="title-navbar hidden-lg hidden-md"> All Categories </span>
                                                    <button type="button" id="show-verticalmenu" data-toggle="collapse" class="navbar-toggle">
                                                        <span class="icon-bar"></span>
                                                        <span class="icon-bar"></span>
                                                        <span class="icon-bar"></span>
                                                    </button>
                                                </div>
                                                <div class="vertical-wrapper">
                                                    <span id="remove-verticalmenu" class="fa fa-times"></span>
                                                    <div class="megamenu-pattern">
                                                        <div class="container">
                                                            <ul class="megamenu" data-transition="slide" data-animationtime="300">
                                                                @foreach($categories as $row)
                                                                @php $sub_cat=\App\Models\Category::getSubCategory($row->id); @endphp
                                                                <li class="item-vertical  item-style3 with-sub-menu hover">
                                                                    <p class='close-menu'></p>
                                                                    <a class="clearfix" href="{{url('category/'.$row->urltitle)}}">
                                                                        <span>
                                                                            <strong><i class="icon"></i><img src="{{asset('front/assets/image/catalog/demo/menu/icon/icon-4.png')}}" alt="">{{$row->title}}</strong>
                                                                        </span>
                                                                        @if(count($sub_cat)>0)<b class='fa fa-caret-right'></b>@endif
                                                                    </a>
                                                                    @if(count($sub_cat)>0)
                                                                    <div class="sub-menu" style="width:650px">
                                                                        <div class="content">
                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <div class="categories ">
                                                                                        <div class="row">
                                                                                            @foreach($sub_cat as $row1)
                                                                                            <div class="col-sm-4 static-menu">
                                                                                                <div class="menu">
                                                                                                    <ul>
                                                                                                        <li>
                                                                                                            <a href="{{url('category/'.$row1->urltitle)}}" class="main-menu">{{$row1->title}}</a>
                                                                                                            <ul>
                                                                                                                @php $sub_cat1=\App\Models\Category::getSubCategory($row1->id); @endphp

                                                                                                                @foreach($sub_cat1 as $row2)
                                                                                                                <li><a href="{{url('category/'.$row2->urltitle)}}">{{$row2->title}}</a></li>
                                                                                                                @endforeach
                                                                                                            </ul>
                                                                                                        </li>
                                                                                                    </ul>
                                                                                                </div>
                                                                                            </div>
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="border"></div>
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                </li>
                                                                @endforeach
                                                                <li class="loadmore"><i class="fa fa-plus-square"></i><span class="more-view">Load More</span></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_k32j">
                                <div class="trending-search">
                                    <h3 class="title_block">
                                        Trending Search
                                    </h3>
                                    <a href="#">Letv</a>
                                    <a href="#">Formal Shoes</a>
                                    <a href="#">Vivo Mobiles</a>
                                    <a href="#">Reebook</a>
                                    <a href="#">Micromax</a>
                                    <a href="#">Travel Vacation</a>
                                    <a href="#">Hotel</a>
                                    <a href="#">Restaurant</a>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_iuhd block">
                                <div class="module so-extraslider-ltr home3_extra bn-shadow">
                                    <h3 class="modtitle">Popular Items</h3>
                                    <div class="modcontent">
                                        <div id="so_extra_slider_450" class="so-extraslider buttom-type1 preset00-1 preset01-1 preset02-1 preset03-1 preset04-1 button-type1">
                                            <div class="box-banner">
                                                <div class="banners">
                                                </div>
                                            </div>
                                            <!-- Begin extraslider-inner -->
                                            <div class="extraslider-inner products-list grid" data-effect="none">
                                                <div class="item ">
                                                    @foreach($popular_products as $popular)
                                                    <div class="item-wrap product-layout style1 ">
                                                        <div class="product-item-container">
                                                            <div class="left-block ">
                                                                <div class="product-image-container">
                                                                    <a class="lt-image" href="{{url('product/'.$popular->urlname)}}" target="_blank" title="{{$popular->name}}">
                                                                        <img src="{{asset('front/assets/image/catalog/demo/product/fashion/5-60x60.png')}}" alt="{{$popular->name}}">
                                                                    </a>
                                                                </div>
                                                                <div class="box-label">
                                                                </div>
                                                            </div>
                                                            <div class="right-block">
                                                                <div class="caption">
                                                                    <h4 class="font-ct">
                                                                        <a href="{{url('product/'.$popular->urlname)}}" target="_blank" title="{{$popular->name}} ">
                                                                            {{$popular->name}}
                                                                        </a>
                                                                    </h4>
                                                                    <div class="content_price price font-ct">
                                                                        <span class="old-price product-price">Rs. {{$popular->price}}</span>&nbsp;&nbsp;
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End item-wrap-inner -->
                                                    </div>
                                                    <!-- End item-wrap -->
                                                    @endforeach
                                                </div>
                                            </div>
                                            <!--End extraslider-inner -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_lbre block hidden-xs">
                                <div class="banner-layout-3 bt-1 clearfix banners">
                                    <div class="">
                                        <a class="bn-shadow" href="#" title="Banner 1">
                                            <img src="{{asset('banners/popular.jpeg')}}" alt="Static Image">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_d2sm block">
                                <div class="module so-extraslider-ltr home3_extra_style2 bn-shadow">
                                    <h3 class="modtitle">Weekly Popular Items</h3>
                                    <div class="modcontent">
                                        <div id="so_extra_slider_305" class="so-extraslider buttom-type1 preset00-1 preset01-1 preset02-1 preset03-2 preset04-1 button-type1">
                                            <div class="box-banner">
                                                <div class="banners">
                                                </div>
                                            </div>
                                            <!-- Begin extraslider-inner -->
                                            <div class="extraslider-inner products-list grid" data-effect="none">
                                                <div class="item">
                                                    @foreach($weekly_popular_items as $row)
                                                    <div class="item-wrap product-layout style1 ">
                                                        <div class="product-item-container">
                                                            <div class="left-block ">
                                                                <div class="product-image-container">
                                                                    <a class="lt-image" href="{{url('product/'.$row->urlname)}}" title="{{$row->name}}">
                                                                        <img src="{{asset('front/assets/image/catalog/demo/product/electronic/25-210x210.jpg')}}" alt="Toshiba Pro 21&quot;(21:9) FHD  IPS LED 1920X1080 HDMI(2)">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="right-block">
                                                                <div class="caption">
                                                                    <h4 class="font-ct">
                                                                        <a href="{{url('product/'.$row->urlname)}}" title="{{$row->name}}">
                                                                            {{$row->name}}
                                                                        </a>
                                                                    </h4>
                                                                    <div class="content_price price font-ct">
                                                                        <span class="old-price product-price">Rs {{$row->price}} </span>&nbsp;&nbsp;
                                                                    </div>
                                                                </div>
                                                                <div class="button-group2">
                                                                    <button class="bt-cart addToCart" type="button" data-toggle="tooltip" title="Add to Cart" wire:click.prevent="addToCart({{$row->product_id}})"> <span>Add to Cart</span></button>
                                                                    <button class="bt wishlist" type="button" data-toggle="tooltip" title="Add to Wish List" wire:click.prevent="addToWishList({{$row->product_id}})"><i class="fa fa-heart"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <!--End extraslider-inner -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_dmsm block">
                                <div class="block-testimonial bn-shadow">
                                    <div class="testimonial-items contentslider" data-rtl="no" data-loop="no" data-autoplay="yes" data-autoheight="no" data-autowidth="no" data-delay="4" data-speed="0.6" data-margin="0" data-items_column0="1" data-items_column1="1" data-items_column2="1" data-items_column3="1" data-items_column4="1" data-arrows="no" data-pagination="yes" data-lazyload="yes" data-hoverpause="yes">
                                        <div class="item">
                                            <div class="text">
                                                <div class="t">Lorem Khaled Ipsum is a major key to success. It’s on you how you want to live your life. Everyone has a choice. I pick my choice, squeaky clean. Always remember in the jungle there’s a lot of they in there</div>
                                            </div>
                                            <div class="img"><img src="{{asset('front/assets/image/catalog/demo/banners/home3/user-2.jpg')}}" alt="Static Image"></div>
                                            <div class="name">Sharon Stone</div>
                                            <div class="job">Acc - Hollywood</div>
                                        </div>
                                        <div class="item">
                                            <div class="text">
                                                <div class="t">
                                                    Khaled Lorem Ipsum is a major key to success. It’s on you how you want to live your life. Everyone has a choice. I pick my choice, squeaky clean. Always remember in the jungle there’s a lot of they in there
                                                </div>
                                            </div>
                                            <div class="img"><img src="{{asset('front/assets/image/catalog/demo/banners/home3/user-1.jpg')}}" alt="Static Image"></div>
                                            <div class="name">David Beckham</div>
                                            <div class="job">CE0 - Magentech</div>
                                        </div>
                                        <div class="item">
                                            <div class="text">
                                                <div class="t">
                                                    Lorem Khaled Ipsum is a major key to success. It’s on you how you want to live your life. Everyone has a choice. I pick my choice, squeaky clean. Always remember in the jungle there’s a lot of they in there
                                                </div>
                                            </div>
                                            <div class="img"><img src="{{asset('front/assets/image/catalog/demo/banners/home3/user-3.jpg')}}" alt="Static Image"></div>
                                            <div class="name">Johny Walker</div>
                                            <div class="job">Manager - United</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col_8sje slider_container">
                        <div class="row row_mwsi row-style">
                            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 col_5q4o slider-layout-3">
                                <div class="module sohomepage-slider so-homeslider-ltr">
                                    <div class="modcontent">
                                        <div id="sohomepage-slider1">
                                            <div class="so-homeslider yt-content-slider full_slider owl-drag" data-rtl="yes" data-autoplay="yes" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="10" data-items_column00="1" data-items_column0="1" data-items_column1="1" data-items_column2="1" data-items_column3="1" data-items_column4="1" data-arrows="yes" data-pagination="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
                                                <div class="item">
                                                    <a href="#" title="slide 1 - 1" target="_self">
                                                        <img class="responsive" src="{{asset('banners/banner1.png')}}" alt="slide 1 - 1">
                                                    </a>
                                                    <div class="sohomeslider-description">
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <a href=" #" title="slide 1 - 2" target="_self">
                                                        <img class="responsive" src="{{asset('banners/banner6.png')}}" alt="slide 1 - 2">
                                                    </a>
                                                    <div class="sohomeslider-description">
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <a href=" #   " title="slide 1 - 3" target="_self">
                                                        <img class="responsive" src="{{asset('banners/banner7.png')}}" alt="slide 1 - 3">
                                                    </a>
                                                    <div class="sohomeslider-description">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col_8jd3 deal-layout-3 hidden-sm hidden-md hidden-xs">
                                <div class="module so-deals-ltr home3_deal">
                                    <div class="product-image-container">
                                        <a href="product.html" target="_self">
                                            <img src="https://images.pexels.com/photos/6612388/pexels-photo-6612388.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" alt=" Magnetic Air Vent Phone Holder for iPhone 7 / 7 Plus" class="img-responsive">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_stzj block">
                                <div class="cate-html">
                                    <ul class="cate-html-item contentslider" data-rtl="no" data-loop="no" data-autoplay="yes" data-autoheight="no" data-autowidth="no" data-delay="4" data-speed="0.6" data-margin="27" data-items_column0="5" data-items_column1="3" data-items_column2="3" data-items_column3="3" data-items_column4="2" data-arrows="yes" data-pagination="no" data-lazyload="yes" data-hoverpause="yes">
                                        @foreach($circle_categories as $cat)
                                        <li class="item">
                                            <div class="item-image"><a title="{{$cat->title}}" href="{{url('category/'.$cat->urltitle)}}"><img src="{{asset('front/assets/image/catalog/demo/banners/home3/cate-1.jpg')}}" alt="{{$cat->title}}"></a></div>
                                            <div class="item-content">
                                                <h4><a href="{{url('category/'.$cat->urltitle)}}">{{$cat->title}}</a></h4>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_6iia block">
                                <div class="module so-deals-ltr home3_deal_style2">
                                    <div class="head-title">
                                        <h2 class="modtitle font-ct"><span>Hot Deal</span></h2>
                                    </div>
                                    <div class="modcontent products-list grid">
                                        <div id="so_deals_986" class="so-deal modcontent products-list grid clearfix preset00-4 preset01-4 preset02-3 preset03-2 preset04-1  button-type1  style2">
                                            <div class="extraslider-inner" data-effect="none">
                                                @foreach($hot_deal_products as $hot)
                                                <div class="item" style="margin: 10px">
                                                    <div class="transition product-layout">
                                                        <div class="product-item-container ">
                                                            <div class="left-block ">
                                                                <div class="product-image-container">
                                                                    <div class="image">
                                                                        <a class="lt-image hidden" href="product.html" target="_self" title="{{$hot->name}}">
                                                                        </a>
                                                                        <a class="lt-image" href="{{url('product/'.$hot->urlname)}}" target="_self">
                                                                            <img src="{{asset('front/assets/image/catalog/demo/product/electronic/1-226x226.jpg')}}" alt="{{$hot->name}}" class="img-responsive">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="right-block">
                                                                <div class="caption">
                                                                    <h4><a href="{{url('product/'.$hot->urlname)}}" target="_self" title="{{$hot->name}}">{{$hot->name}}</a></h4>
                                                                    <div class="price">
                                                                        <span class="price-new">Rs. {{$hot->price}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="button-group2">
                                                                    @if($hot->stock>0)
                                                                    <button class="bt-cart addToCart" type="button" data-toggle="tooltip" title="Add to Cart" wire:click.prevent="addToCart({{$hot->id}})"> <span>Add to Cart</span></button>
                                                                    @endif
                                                                    <button class="bt wishlist" type="button" data-toggle="tooltip" title="Add to Wish List" wire:click.prevent="addToWishList({{$hot->id}})"><i class="fa fa-heart"></i></button>
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
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_kjmz block">
                                <div class="banner-21 banner">
                                    <div>
                                        <a class="bn-shadow" href="#" title="Banner 24">
                                            <img src="{{asset('banners/ban02.png')}}" alt="Static Image">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @foreach($show_categories_main as $main=>$row)
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_hksd block">
                                <div class="module so-listing-tabs-ltr home3_listingtab_style2">
                                    <div class="head-title">
                                        <h3 class="modtitle">{{$row->title}}</h3>
                                        <select name="subcategories" class="mobileSubCategories form-control">
                                            @php $sub_cat=\App\Models\Category::getSubCategory($row->id)->take(8); @endphp
                                            @foreach($sub_cat as $key=>$info)
                                            <option value="{{substr($info->title,0,10)}}">{{substr($info->title,0,10)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="modcontent">
                                        <div id="so_listing_tabs_727" class="so-listing-tabs first-load module">
                                            <div class="ltabs-wrap">
                                                <div class="ltabs-tabs-container">
                                                    <!--Begin Tabs-->
                                                    <!--Sub Categories for mobile-->

                                                    <!-- End Sub Categories for mobile-->
                                                    <!-- <div class="ltabs-tabs-wrap">
                                                            <div class="item-sub-cat">
                                                                <ul class="ltabs-tabs cf">
                                                                    @php $sub_cat=\App\Models\Category::getSubCategory($row->id)->take(8); @endphp
                                                                    @foreach($sub_cat as $key=>$info)
                                                                        <li class="ltabs-tab @if($key==0) tab-sel @endif" data-category-id="40" data-active-content=".items-category-40" wire:click.prevent="changeCat({{$main}},{{$info->id}})">
                                                                            <div class="ltabs-tab-img">
                                                                                <img src="{{asset('front/assets/image/catalog/demo/category/94.jpg')}}" title="{{$info->title}}" alt="{{$info->title}}" style="background:#fff" />
                                                                            </div>
                                                                            <span class="ltabs-tab-label">
                                                                                {{substr($info->title,0,10)}} ...
                                                                            </span>
                                                                        </li>
                                                                    @endforeach   
                                                                </ul>
                                                            </div>
                                                        </div> -->
                                                    <!-- End Tabs-->
                                                </div>
                                                <div class="wap-listing-tabs products-list grid">
                                                    <div class="ltabs-items-container">
                                                        <div class="ltabs-items ltabs-items-selected items-category-40">
                                                            <div class=" ltabs-slider ">
                                                                <div class="ltabs-item itemMainClass">
                                                                    @foreach($sub_cat_products[$main] as $product)
                                                                    <div class="item-inner innerItemClass product-thumb trg transition product-layout">
                                                                        <div class="product-item-container">
                                                                            <div class="left-block ">
                                                                                <div class="image product-image-container">
                                                                                    <a class="lt-image" href="product.html" target="_self" title="Compact Portable Charger (External Battery)">
                                                                                        <img class="itemMainImg" src="{{asset('front/assets/image/catalog/demo/product/electronic/13-226x226.jpg')}}" alt="Compact Portable Charger (External Battery)">
                                                                                    </a>
                                                                                </div>
                                                                                <div class="box-label">
                                                                                </div>
                                                                            </div>
                                                                            <div class="right-block">
                                                                                <div class="caption">
                                                                                    <h4>
                                                                                        <a href="product.html" title="Compact Portable Charger (External Battery)" target="_self">
                                                                                            {{$product->name}}
                                                                                        </a>
                                                                                    </h4>
                                                                                    <p class="price">
                                                                                        Rs. 80.00
                                                                                    </p>
                                                                                </div>
                                                                                <div class="button-group2">
                                                                                    <button class="bt-cart addToCart" type="button" data-toggle="tooltip" title="Add to cart" onclick="cart.add('103');"> <span>Add to cart</span></button>
                                                                                    <button class="bt wishlist" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('103');"><i class="fa fa-heart"></i></button>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_4kdf block">
                                <div class="banner-layout-5 row clearfix">
                                    <div class="banner-22 col-sm-4  banners">
                                        <div>
                                            <a class="bn-shadow" href="#" title="Banner 22">
                                                <img src="{{asset('banners/banner4.png')}}" alt="Static Image">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="banner-23 col-sm-4 banners">
                                        <div>
                                            <a class="bn-shadow" href="#" title="Banner 23">
                                                <img src="{{asset('banners/banner5.png')}}" alt="Static Image">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="banner-24 col-sm-4  banners">
                                        <div>
                                            <a class="bn-shadow" href="#" title="Banner 24">
                                                <img src="{{asset('banners/banner2.png')}}" alt="Static Image">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_ksde block">
                        <div class="module so-extraslider-ltr home3_extra_style3">
                            <h3 class="modtitle">Feature Items</h3>
                            <div class="modcontent">
                                <div id="so_extra_slider_528" class="so-extraslider buttom-type1 preset00-6 preset01-5 preset02-3 preset03-2 preset04-1 button-type1">
                                    <div class="box-banner">
                                        <div class="banners">
                                        </div>
                                    </div>
                                    <!-- Begin extraslider-inner -->
                                    <div class="extraslider-inner products-list grid" data-effect="none">
                                        @foreach($featured_products as $row)
                                        <div class="item " style="margin:10px">
                                            <div class="item-wrap product-layout style1 ">
                                                <div class="product-item-container">
                                                    <div class="left-block ">
                                                        <div class="product-image-container">
                                                            <a class="lt-image" href="{{url('product/'.$row->urlname)}}" target="_self" title="{{$row->title}}">
                                                                <img src="{{asset('front/assets/image/catalog/demo/product/electronic/25-234x234.jpg')}}" alt="{{$row->title}}">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="right-block">
                                                        <div class="caption">
                                                            <h4 class="font-ct">
                                                                <a href="{{url('product/'.$row->urlname)}}" target="_self" title="{{$row->title}}">
                                                                    {{$row->name}}
                                                                </a>
                                                            </h4>
                                                            <div class="content_price price font-ct">
                                                                <span class="old-price product-price">Rs {{$row->price}}</span>&nbsp;&nbsp;
                                                            </div>
                                                        </div>
                                                        <div class="button-group2">
                                                            <button class="bt-cart addToCart" type="button" data-toggle="tooltip" title="Add to Cart" wire:click.prevent="addToCart({{$row->id}})"><span>Add to Cart</span></button>
                                                            <button class="bt wishlist" type="button" data-toggle="tooltip" title="Add to Wish List" wire:click.prevent="addToWishList({{$row->id}})"><i class="fa fa-heart"></i></button>
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
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_g1nr  block">
                        <div class="row">
                            <div class="banner-25 col-sm-6 banners">
                                <div>
                                    <a class="bn-shadow" href="#" title="Banner 25">
                                        <img src="{{asset('front/assets/image/catalog/demo/banners/home3/banner25.jpg')}}" alt="Static Image">
                                    </a>
                                </div>
                            </div>
                            <div class="banner-26 col-sm-6  banners">
                                <div>
                                    <a class="bn-shadow" href="#" title="Banner 26">
                                        <img src="{{asset('front/assets/image/catalog/demo/banners/home3/banner26.jpg')}}" alt="Static Image">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- //Main Container -->