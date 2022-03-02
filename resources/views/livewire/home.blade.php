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
    @if($popup_banner->isNotEmpty())
        <x-front.popup :banner="$popup_banner"/>
    @endif
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
                                                                            <strong><i class="icon"></i><img src="{{asset('images/'.$row->icon)}}" alt="">{{$row->title}}</strong>
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
                                    @foreach($trending_search as $ts)
                                        <a href="{{url('search/'.$ts->name)}}">{{$ts->name}}</a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_iuhd block">
                                <div class="module so-extraslider-ltr home3_extra bn-shadow">
                                    <h3 class="modtitle"><a href="{{url('type/popular-items')}}" style="color: white">Popular Items</a></h3>
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
                                                                        @php $photo=explode(',',$popular->filename);@endphp
                                                                        <img src="{{asset('images/'.$photo[0])}}" alt="{{$popular->name}}" width="60" height="60" style="object-fit: cover">
                                                                    </a>
                                                                </div>
                                                                <div class="box-label">
                                                                </div>
                                                            </div>
                                                            <div class="right-block" style="padding:10px">
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
                            {{-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_lbre block hidden-xs">
                                <div class="banner-layout-3 bt-1 clearfix banners">
                                    <div>
                                        <a class="bn-shadow" href="{{$after_popular_banners->link}}" title="{{$after_popular_banners->title}}">
                                            <img src="{{asset('images/'.$after_popular_banners->image)}}" alt="{{$after_popular_banners->title}}">
                                        </a>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_d2sm block">
                                <div class="module so-extraslider-ltr home3_extra_style2 bn-shadow">
                                    <h3 class="modtitle"><a href="{{url('type/weekly-popular-items')}}" style="color: white"> Weekly Popular Items</a></h3>
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
                                                                        @php $photo=explode(',',$row->filename); @endphp
                                                                        <img src="{{asset('images/'.$photo[0])}}" alt="{{$row->name}}" height="210" width="210" style="object-fit: cover">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="right-block" style="padding:10px">
                                                                <div class="caption">
                                                                    <h4 class="font-ct">
                                                                        <a href="{{url('product/'.$row->urlname)}}" title="{{$row->name}}">
                                                                            {{Str::limit($row->name, 20, '...') }}
                                                                        </a>
                                                                    </h4>
                                                                    <div class="content_price price font-ct" style="display: flex;justify-content:space-between">
                                                                        <span class="old-price product-price">Rs {{$row->price}} </span>&nbsp;&nbsp;
                                                                        <button class="bt wishlist" style="border:none" type="button" data-toggle="tooltip" title="Add to Wish List" wire:click.prevent="addToWishList({{$row->product_id}})"><i class="fa fa-heart"></i></button>

                                                                    </div>
                                                                </div>
                                                                {{-- <div class="button-group2">
                                                                    <button class="bt-cart addToCart" type="button" data-toggle="tooltip" title="Add to Cart" wire:click.prevent="addToCart({{$row->product_id}})"> <span>Add to Cart</span></button>
                                                                </div> --}}
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
                                                <div class="t">I love dealing with meroshopping.com. Easy, painless, trouble-free. Description of the items clear and simple to understand. Pictures are great. Packaged nicely, very clean and neat. Coming very fast and very friendly staff. What else do you need? I\'m giving all stars!</div>
                                            </div>
                                            <div class="img"><img src="{{asset('front/assets/image/catalog/demo/banners/home3/user-2.jpg')}}" alt="Static Image"></div>
                                            <div class="name">Saligram Aryal</div>
                                        </div>
                                        <div class="item">
                                            <div class="text">
                                                <div class="t">
                                                    I usually prefer online shopping. This is the age of technology so why should we waste out time by lingering here and there. Thus, I have found meroshopping.com as a customer friendly. I am inspired with the services it has provided plus it has included numerous items under the same roofs.
                                                </div>
                                            </div>
                                            <div class="img"><img src="{{asset('front/assets/image/catalog/demo/banners/home3/user-1.jpg')}}" alt="Static Image"></div>
                                            <div class="name">Ramita Mahajaran</div>
                                        </div>
                                        <div class="item">
                                            <div class="text">
                                                <div class="t">
                                                    Wow, what a great experience I had with you guys! Good online mero shopping , great prices, speedy shipping, even some extras and personalized note with my order! You guys rock; I'm telling all my friends about you!Thanks for everything.
                                                </div>
                                            </div>
                                            <div class="img"><img src="{{asset('front/assets/image/catalog/demo/banners/home3/user-3.jpg')}}" alt="Static Image"></div>
                                            <div class="name">Shyam Sunuwar</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_8sje slider_container">
                        <div class="row row_mwsi row-style">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_5q4o">
                                <div class="module sohomepage-slider so-homeslider-ltr">
                                    <div class="modcontent">
                                        <div id="sohomepage-slider1">
                                            <div class="so-homeslider yt-content-slider full_slider owl-drag" data-rtl="yes" data-autoplay="yes" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="10" data-items_column00="1" data-items_column0="1" data-items_column1="1" data-items_column2="1" data-items_column3="1" data-items_column4="1" data-arrows="yes" data-pagination="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
                                                @foreach($front_sliders as $index=>$front)
                                                    <div class="item">
                                                        <a href="{{$front->link}}" title="slide 1 - 1" target="_self">
                                                            <img class="responsive" src="{{asset('images/'.$front->image)}}" alt="slide {{$index+1}} - {{$index+1}}">
                                                        </a>
                                                        <div class="sohomeslider-description">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col_8jd3 deal-layout-3 hidden-sm hidden-md hidden-xs">
                                <div class="module so-deals-ltr home3_deal">
                                    <div class="product-image-container">
                                        <a href="{{$slider_right_banners->link}}" target="_self">
                                            <img src="{{asset('images/'.$slider_right_banners->image)}}" alt="{{$slider_right_banners->title}}" class="img-responsive">
                                        </a>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_stzj block">
                                <div class="cate-html">
                                    <ul class="cate-html-item contentslider" data-rtl="no" data-loop="no" data-autoplay="yes" data-autoheight="no" data-autowidth="no" data-delay="4" data-speed="0.6" data-margin="27" data-items_column0="5" data-items_column1="3" data-items_column2="3" data-items_column3="3" data-items_column4="2" data-arrows="yes" data-pagination="no" data-lazyload="yes" data-hoverpause="yes">
                                        @foreach($circle_categories as $cat)
                                        <div class="grid">
                                        <li class="item">
                                            <div class="item-image"><a title="{{$cat->title}}" href="{{url('category/'.$cat->urltitle)}}">
                                                <img src="{{asset('images/'.$cat->image)}}" alt="{{$cat->title}}" style="object-fit: cover; height:185px; width:245px"></a></div>
                                        </li>
                                        <p class="text-center"><b><a href="{{url('category/'.$cat->urltitle)}}">{{$cat->title}}</a></b></p>
                                        </div>


                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_hksd block">
                                <div class="module so-listing-tabs-ltr home3_listingtab_style2">
                                    <div class="head-title">
                                        <h3 class="modtitle"><a href="{{url('type/latest-products')}}">Latest Product</a></h3>
                                    </div>
                                    <div class="modcontent">
                                        <div id="so_listing_tabs_727" class="so-listing-tabs first-load module">
                                            <div class="ltabs-wrap">
                                                <div class="ltabs-tabs-container">
                                                </div>
                                                <div class="wap-listing-tabs products-list grid">
                                                    <div class="ltabs-items-container">
                                                        <div class="ltabs-items ltabs-items-selected items-category-40">
                                                            <div class=" ltabs-slider ">
                                                                <div class="ltabs-item itemMainClass">
                                                                    @foreach($latest_product as $latest)
                                                                    <style>
                                                                        .product-item-container:hover{
                                                                            box-shadow: 0 2px 4px 0 rgb(0 0 0 / 25%) !important;
                                                                            margin:5px;
                                                                        }

                                                                    </style>
                                                                        <div class="item-inner innerItemClass product-thumb trg transition product-layout">
                                                                            <div class="product-item-container innerTabContent" style="margin:5px">
                                                                                <div class="left-block ">
                                                                                    <div class="image product-image-container">
                                                                                        <a class="lt-image" href="{{url('product/'.$latest->urlname)}}" title="{{$latest->name}}">
                                                                                            @php $photo=explode(',',$latest->filename);@endphp
                                                                                            <img class="itemMainImg" src="{{asset('images/'.$photo[0])}}" alt="{{$latest->name}}" width="226" height="226" style="object-fit:contain;">
                                                                                        </a>
                                                                                    </div>
                                                                                    <div class="box-label">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="right-block" style="padding:10px">
                                                                                    <div class="caption">
                                                                                        <h4>
                                                                                            <a href="{{url('product/'.$latest->urlname)}}" title="{{$latest->name}}">
                                                                                                {{ Str::limit($latest->name, 20, ' ...') }}

                                                                                            </a>
                                                                                        </h4>
                                                                                        <p class="price" style="display:flex !important;justify-content:space-between">
                                                                                            Rs {{$latest->price}}
                                                                                            <button class="bt wishlist" style="border:none" type="button" data-toggle="tooltip" title="Add to Wish List" wire:click.prevent="addToWishList({{$latest->id}})"><i class="fa fa-heart"></i></button>
                                                                                        </p>
                                                                                    </div>
                                                                                    {{-- <div class="button-group2">
                                                                                        <button class="bt-cart addToCart" type="button" data-toggle="tooltip" title="Add to cart" wire:click.prevent="addToCart({{$cat->id}})" > <span>Add to cart</span></button>
                                                                                        <button class="bt wishlist" style="border:none" type="button" data-toggle="tooltip" title="Add to Wish List" wire:click.prevent="addToWishList({{$latest->id}})"><i class="fa fa-heart"></i></button>
                                                                                    </div> --}}
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
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_6iia block">
                                <div class="module so-deals-ltr home3_deal_style2">
                                    <div class="head-title">
                                        <h2 class="modtitle font-ct"><a href="{{url('type/hot-deals')}}">Hot Deal</a></h2>
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
                                                                        <a class="lt-image hidden" href="{{url('product/'.$hot->urlname)}}" target="_self" title="{{$hot->name}}">
                                                                        </a>
                                                                        <a class="lt-image" href="{{url('product/'.$hot->urlname)}}" target="_self">
                                                                            @php $img=explode(',',$hot->filename);@endphp
                                                                            <img src="{{asset('images/'.$img[0])}}" alt="{{$hot->name}}" class="img-responsive" style="height:300px; width:226px">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="right-block" style="padding:10px">
                                                                <div class="caption">
                                                                    <h4 style="padding:0;text-align:left">
                                                                        <a href="{{url('product/'.$hot->urlname)}}" target="_self" title="{{$hot->name}}">
                                                                            {{Str::limit($hot->name,25,'...')}}
                                                                        </a>
                                                                    </h4>
                                                                    <div class="price" style="display:flex !important;justify-content:space-between">
                                                                        <span class="price-new">Rs. {{$hot->price}}</span>
                                                                        <button class="bt wishlist" style="border:none" type="button" data-toggle="tooltip" title="Add to Wish List" wire:click.prevent="addToWishList({{$hot->id}})"><i class="fa fa-heart"></i></button>
                                                                    </div>
                                                                </div>
                                                                {{-- <div class="button-group2">
                                                                    @if($hot->stock>0)
                                                                    <button class="bt-cart addToCart" type="button" data-toggle="tooltip" title="Add to Cart" wire:click.prevent="addToCart({{$hot->id}})"> <span>Add to Cart</span></button>
                                                                    @endif
                                                                </div> --}}
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
                            {{-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_kjmz block">
                                <div class="banner-21 banner">
                                    <div>
                                        <a class="bn-shadow" href="{{$after_hot_banners->link}}" title="{{$after_hot_banners->title}}">
                                            <img src="{{asset('images/'.$after_hot_banners->image)}}" alt="{{$after_hot_banners->title}}">
                                        </a>
                                    </div>
                                </div>
                            </div> --}}
                            @foreach($section_categories as $row)
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_hksd block">
                                    <div class="module so-listing-tabs-ltr home3_listingtab_style2">
                                        <div class="head-title">
                                            <h3 class="modtitle"><a href="{{url('category/'.$row->urltitle)}}">{{$row->title}}</h3>
                                        </div>
                                        <div class="modcontent">
                                            <div id="so_listing_tabs_727" class="so-listing-tabs first-load module">
                                                <div class="ltabs-wrap">
                                                    <div class="ltabs-tabs-container">
                                                        <!--Begin Tabs-->
                                                        <!--Sub Categories for mobile-->
                                                        {{-- <select name="subcategories" class="mobileSubCategories">
                                                            <option value="pets">pets</option>
                                                            <option value="pets">pets</option>
                                                        </select> --}}
                                                        <!-- End Sub Categories for mobile-->
                                                        {{-- <div class="ltabs-tabs-wrap">
                                                            <div class="item-sub-cat">
                                                                <ul class="ltabs-tabs cf">
                                                                    <li class="ltabs-tab tab-sel" data-category-id="40" data-active-content=".items-category-40">
                                                                        <div class="ltabs-tab-img">
                                                                            <img src="{{asset('front/assets/image/catalog/demo/category/94.jpg')}}" title="CASE" alt="CASE" style="background:#fff" />
                                                                        </div>
                                                                        <span class="ltabs-tab-label">
                                                                            CASE
                                                                        </span>
                                                                    </li>
                                                                    <li class="ltabs-tab " data-category-id="41" data-active-content=".items-category-41">
                                                                        <div class="ltabs-tab-img">
                                                                            <img src="{{asset('front/assets/image/catalog/demo/category/93.jpg')}}" title="Cell & Cable" alt="Cell & Cable" style="background:#fff" />
                                                                        </div><span class="ltabs-tab-label">Cell & Cable</span>
                                                                    </li>
                                                                    <li class="ltabs-tab " data-category-id="42" data-active-content=".items-category-42">
                                                                        <div class="ltabs-tab-img">
                                                                            <img src="{{asset('front/assets/image/catalog/demo/category/88.jpg')}}" title="Headphone" alt="Headphone" style="background:#fff" />
                                                                        </div>
                                                                        <span class="ltabs-tab-label">
                                                                            Headphone
                                                                        </span>
                                                                    </li>
                                                                    <li class="ltabs-tab " data-category-id="43" data-active-content=".items-category-43">
                                                                        <div class="ltabs-tab-img">
                                                                            <img src="{{asset('front/assets/image/catalog/demo/category/90.jpg')}}" title="Laptops" alt="Laptops" style="background:#fff" />
                                                                        </div>
                                                                        <span class="ltabs-tab-label">
                                                                            Laptops
                                                                        </span>
                                                                    </li>
                                                                    <li class="ltabs-tab " data-category-id="44" data-active-content=".items-category-44">
                                                                        <div class="ltabs-tab-img">
                                                                            <img src="{{asset('front/assets/image/catalog/demo/category/87.jpg')}}" title="Mobile & Table" alt="Mobile & Table" style="background:#fff" />
                                                                        </div>
                                                                        <span class="ltabs-tab-label">
                                                                            Mobile & Table
                                                                        </span>
                                                                    </li>
                                                                    <li class="ltabs-tab " data-category-id="45" data-active-content=".items-category-45">
                                                                        <div class="ltabs-tab-img">
                                                                            <img src="{{asset('front/assets/image/catalog/demo/category/91.jpg')}}" title="Sound" alt="Sound  " style="background:#fff" />
                                                                        </div>
                                                                        <span class="ltabs-tab-label">
                                                                            Sound
                                                                        </span>
                                                                    </li>
                                                                    <li class="ltabs-tab " data-category-id="46" data-active-content=".items-category-46">
                                                                        <div class="ltabs-tab-img">
                                                                            <img src="{{asset('front/assets/image/catalog/demo/category/89.jpg')}}" title="USB & HDD" alt="USB & HDD" style="background:#fff" />
                                                                        </div>
                                                                        <span class="ltabs-tab-label">
                                                                            USB & HDD
                                                                        </span>
                                                                    </li>
                                                                    <li class="ltabs-tab " data-category-id="47" data-active-content=".items-category-47">
                                                                        <div class="ltabs-tab-img">
                                                                            <img src="{{asset('front/assets/image/catalog/demo/category/92.jpg')}}" title="Video & Camera" alt="Video & Camera" style="background:#fff" />
                                                                        </div>
                                                                        <span class="ltabs-tab-label">
                                                                            Video & Camera
                                                                        </span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div> --}}
                                                        <!-- End Tabs-->
                                                    </div>
                                                    <div class="wap-listing-tabs products-list grid">
                                                        <div class="ltabs-items-container">
                                                            <div class="ltabs-items ltabs-items-selected items-category-40">
                                                                <div class=" ltabs-slider ">
                                                                    <div class="ltabs-item itemMainClass">
                                                                        @php $first_cat=\App\Models\Category::where('parentId',$row->id)->pluck('id')->toArray();
                                                                              $second_cat=\App\Models\Category::whereIn('parentId',$first_cat)->pluck('id')->toArray();
                                                                              $combine_cat=array_merge($first_cat,$second_cat);
                                                                              $cat_products=\App\Models\Product::whereIn('categoryId',$combine_cat)->orderBy('id','desc')->take(10)->get();
                                                                        @endphp
                                                                        @foreach($cat_products as $cat)
                                                                            <div class="item-inner innerItemClass product-thumb trg transition product-layout">
                                                                                <div class="product-item-container innerTabContent" style="margin:5px;">
                                                                                    <div class="left-block ">
                                                                                        <div class="image product-image-container">
                                                                                            <a class="lt-image" href="{{url('product/'.$cat->urlname)}}" title="{{$cat->name}}">
                                                                                                @php $photo=explode(',',$cat->filename);@endphp
                                                                                                <img class="itemMainImg" src="{{asset('images/'.$photo[0])}}" alt="{{$cat->name}}" width="226" height="226" style="object-fit:contain;">
                                                                                            </a>
                                                                                        </div>
                                                                                        <div class="box-label">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="right-block" style="padding:10px">
                                                                                        <div class="caption">
                                                                                            <h4>
                                                                                                <a href="{{url('product/'.$cat->urlname)}}" title="{{$cat->name}}">
                                                                                                    {{Str::limit($cat->name, 15, '...')}}
                                                                                                </a>
                                                                                            </h4>
                                                                                            <p class="price" style="display:flex !important;justify-content:space-between">
                                                                                                Rs {{$cat->price}}
                                                                                                <button class="bt wishlist" style="border:none" type="button" data-toggle="tooltip" title="Add to Wish List" wire:click.prevent="addToWishList({{$cat->id}})"><i class="fa fa-heart"></i></button>
                                                                                            </p>
                                                                                        </div>
                                                                                        {{-- <div class="button-group2">
                                                                                            <button class="bt-cart addToCart" type="button" data-toggle="tooltip" title="Add to cart" wire:click.prevent="addToCart({{$cat->id}})" > <span>Add to cart</span></button>
                                                                                        </div> --}}
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
                                    @foreach($before_feature_banners as $row)
                                        <div class="banner-22 col-sm-4 banners" style="padding-top:20px">
                                            <div>
                                                <a class="bn-shadow" href="{{$row->link}}" title="{{$row->title}}">
                                                    <img src="{{asset('images/'.$row->image)}}" alt="{{$row->title}}">
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_ksde block">
                        <div class="module so-extraslider-ltr home3_extra_style3">
                            <h3 class="modtitle"><a href="{{url('type/feature-items')}}">Feature Items</a></h3>
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
                                                                @php $photo=explode(',',$row->filename); @endphp
                                                                <img src="{{asset('images/'.$photo[0])}}" alt="{{$row->title}}" width="234" height="234" style="object-fit: cover">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="right-block" style="padding:10px">
                                                        <div class="caption">
                                                            <h4 class="font-ct">
                                                                <a href="{{url('product/'.$row->urlname)}}" target="_self" title="{{$row->title}}">
                                                                    {{Str::limit($row->name, 15, '...')}}
                                                                </a>
                                                            </h4>
                                                            <div class="content_price price font-ct" style="display: flex;justify-content:space-between">
                                                                <span class="old-price product-price">Rs {{$row->price}}</span>&nbsp;&nbsp;
                                                                <button class="bt wishlist" style="border:none" type="button" data-toggle="tooltip" title="Add to Wish List" wire:click.prevent="addToWishList({{$row->id}})"><i class="fa fa-heart"></i></button>
                                                            </div>
                                                        </div>
                                                        {{-- <div class="button-group2">
                                                            <button class="bt-cart addToCart" type="button" data-toggle="tooltip" title="Add to Cart" wire:click.prevent="addToCart({{$row->id}})"><span>Add to Cart</span></button>
                                                        </div> --}}
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
                            @foreach($last_banners as $last)
                                <div class="banner-25 col-sm-6 banners">
                                    <div>
                                        <a class="bn-shadow" href="{{$last->link}}" title="{{$last->title}}">
                                            <img src="{{asset('images/'.$last->image)}}" alt="{{$last->title}}">
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @if($popup_banner->isNotEmpty())
        <script>
            $(window).load(function()
            {
                setInterval(() => {
                    localStorage.removeItem('popup');
                }, 3600000)
                if(localStorage.getItem('popup') === "false"){
                    $("#popup").modal('hide');
                }else{
                    $('#popup').modal('show');
                }
            });
        </script>
    @endif
</div>
<!-- //Main Container -->
