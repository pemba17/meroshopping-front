<!-- Main Container  -->
<div id="content">
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
                                                                        <a class="lt-image" 
                                                                            href="{{url('product/'.$popular->urlname)}}" target="_blank"
                                                                            title="{{$popular->name}}">
                                                                        <img src="{{asset('front/assets/image/catalog/demo/product/fashion/5-60x60.png')}}" alt="{{$popular->name}}">
                                                                        </a>
                                                                    </div>
                                                                    <div class="box-label">
                                                                    </div>
                                                                </div>
                                                                <div class="right-block">
                                                                    <div class="caption">
                                                                        <h4 class="font-ct">
                                                                            <a href="{{url('product/'.$popular->urlname)}}" target="_blank" title="{{$popular->name}} "  >
                                                                                {{$popular->name}}
                                                                            </a>
                                                                        </h4>
                                                                        <div  class="content_price price font-ct">
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
                                            <img src="https://images.pexels.com/photos/6612388/pexels-photo-6612388.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="Static Image">
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
                                                                        <a class="lt-image" 
                                                                            href="product.html" target="_self"
                                                                            title="Toshiba Pro 21&quot;(21:9) FHD  IPS LED 1920X1080 HDMI(2)">
                                                                        <img src="{{asset('front/assets/image/catalog/demo/product/electronic/25-210x210.jpg')}}" alt="Toshiba Pro 21&quot;(21:9) FHD  IPS LED 1920X1080 HDMI(2)">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="right-block">
                                                                    <div class="caption">
                                                                        <h4 class="font-ct">
                                                                            <a href="product.html" target="_self" title="Toshiba Pro 21&quot;(21:9) FHD  IPS LED 1920X1080 HDMI(2) "  >
                                                                                {{$row->name}}
                                                                            </a>
                                                                        </h4>
                                                                        <div  class="content_price price font-ct">
                                                                            <span class="old-price product-price">Rs {{$row->price}} </span>&nbsp;&nbsp;
                                                                        </div>
                                                                    </div>
                                                                    <div class="button-group2">
                                                                        <button class="bt-cart addToCart"  type="button" data-toggle="tooltip" title="Add to Cart" onclick="cart.add('104');"> <span>Add to Cart</span></button>
                                                                        <button class="bt wishlist" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('104');"><i class="fa fa-heart"></i></button>
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
                                                    Khaled Lorem  Ipsum is a major key to success. It’s on you how you want to live your life. Everyone has a choice. I pick my choice, squeaky clean. Always remember in the jungle there’s a lot of they in there
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
                                            <div class="so-homeslider yt-content-slider full_slider owl-drag" data-rtl="yes" data-autoplay="yes" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="10" data-items_column00="1" data-items_column0="1" data-items_column1="1" data-items_column2="1"  data-items_column3="1" data-items_column4="1" data-arrows="yes" data-pagination="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
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
                                            <img src="https://images.pexels.com/photos/5081399/pexels-photo-5081399.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" alt=" Magnetic Air Vent Phone Holder for iPhone 7 / 7 Plus" class="img-responsive">
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
                                                                            <a class="lt-image hidden" 
                                                                                href="product.html" target="_self"
                                                                                title="{{$hot->name}}">
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
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_lkwe block">
                                <div class="module so-listing-tabs-ltr home3_listingtab">
                                    <div class="head-title">
                                        <h3 class="modtitle">Fashion &amp; Accessories</h3>
                                    </div>
                                    <div class="modcontent">
                                        <div id="so_listing_tabs_342" class="so-listing-tabs first-load module">
                                            <div class="ltabs-wrap products-list grid">
                                                <div class="ltabs-tabs-container" data-delay="300" data-duration="600" data-effect="starwars" data-ajaxurl="" data-type_source="0" data-lg="2" data-md="2" data-sm="1" data-xs="2" data-margin="0">
                                                    <!--Begin Tabs-->
                                                    <div class="ltabs-tabs-wrap">
                                                                 <span class="ltabs-tab-selected"></span>
                                                                 <span class="ltabs-tab-arrow">▼</span>
                                                                 <div class="item-sub-cat">
                                                                        <ul class="ltabs-tabs cf">
                                                                             <li class="ltabs-tab tab-sel" data-category-id="30" data-active-content=".items-category-30"><div class="ltabs-tab-img">
                                                                                    <img src="{{asset('front/assets/image/catalog/demo/category/116.jpg')}}"
                                                                                        title="Bags" alt="Bags"
                                                                                        style="background:#fff"/>
                                                                                </div>
                                                                                <span class="ltabs-tab-label">
                                                                                Bags
                                                                                </span></li>
                                                                             <li class="ltabs-tab" data-category-id="31" data-active-content=".items-category-31"><div class="ltabs-tab-img">
                                                                                    <img src="{{asset('front/assets/image/catalog/demo/category/23.jpg')}}"
                                                                                        title="Dress Ladies" alt="Dress Ladies"
                                                                                        style="background:#fff"/>
                                                                                </div><span class="ltabs-tab-label">Dress Ladies</span>
                                                                            </li>
                                                                             <li class="ltabs-tab " data-category-id="32" data-active-content=".items-category-32">
                                                                                 <div class="ltabs-tab-img">
                                                                                        <img src="{{asset('front/assets/image/catalog/demo/category/24.jpg')}}"
                                                                                            title="Jean" alt="Jean"
                                                                                            style="background:#fff"/>
                                                                                    </div>
                                                                                    <span class="ltabs-tab-label">
                                                                                    Jean
                                                                                    </span>
                                                                             </li>
                                                                             <li class="ltabs-tab " data-category-id="33" data-active-content=".items-category-33">
                                                                                 <div class="ltabs-tab-img">
                                                                                    <img src="{{asset('front/assets/image/catalog/demo/category/9.jpg')}}"
                                                                                        title="Men Fashion" alt="Men Fashion"
                                                                                        style="background:#fff"/>
                                                                                </div>
                                                                                <span class="ltabs-tab-label">
                                                                                Men Fashion
                                                                                </span>
                                                                             </li>
                                                                             <li class="ltabs-tab " data-category-id="34" data-active-content=".items-category-34">
                                                                                <div class="ltabs-tab-img">
                                                                                    <img src="{{asset('front/assets/image/catalog/demo/category/22.jpg')}}"
                                                                                        title="T-shirt" alt="T-shirt"
                                                                                        style="background:#fff"/>
                                                                                </div>
                                                                                <span class="ltabs-tab-label">
                                                                                T-shirt
                                                                                </span>
                                                                             </li>
                                                                             <li class="ltabs-tab " data-category-id="35" data-active-content=".items-category-35">
                                                                                 <div class="ltabs-tab-img">
                                                                                    <img src="{{asset('front/assets/image/catalog/demo/category/25.jpg')}}"
                                                                                        title="Trending" alt="Trending"
                                                                                        style="background:#fff"/>
                                                                                </div>
                                                                                <span class="ltabs-tab-label">
                                                                                Trending
                                                                                </span>
                                                                             </li>
                                                                             <li class="ltabs-tab " data-category-id="36" data-active-content=".items-category-36">
                                                                                    <div class="ltabs-tab-img">
                                                                                        <img src="{{asset('front/assets/image/catalog/demo/category/21.jpg')}}"
                                                                                            title="Western Wear" alt="Western Wear"
                                                                                            style="background:#fff"/>
                                                                                    </div>
                                                                                    <span class="ltabs-tab-label">
                                                                                    Western Wear
                                                                                    </span>
                                                                             </li>
                                                                             <li class="ltabs-tab " data-category-id="37" data-active-content=".items-category-37">
                                                                                 <div class="ltabs-tab-img">
                                                                                    <img src="{{asset('front/assets/image/catalog/demo/category/10.jpg')}}"
                                                                                        title="Women Fashion" alt="Women Fashion"
                                                                                        style="background:#fff"/>
                                                                                </div>
                                                                                <span class="ltabs-tab-label">
                                                                                Women Fashion
                                                                                </span>
                                                                             </li>
                                                                        </ul>
                                                                 </div>
                                                            </div>
                                                    <!-- End Tabs-->
                                                </div>
                                                <div class="wap-listing-tabs ">
                                                <div class="ltabs-items-container">
                                                    <div class="ltabs-items ltabs-items-selected items-category-30" data-total="8">
                                                        <div class="ltabs-items-inner ltabs-slider">
                                                            <div class="ltabs-item ">
                                                                <div class="item-inner product-thumb trg transition product-layout">
                                                                    <div class="product-item-container">
                                                                        <div class="left-block ">
                                                                            <div class="image product-image-container">
                                                                                <a class="lt-image" 
                                                                                    href="product.html" target="_self"
                                                                                    title="Est Officia Including Shoes Beautiful Pieces Canaz">
                                                                                <img src="{{asset('front/assets/image/catalog/demo/product/fashion/24-226x226.png')}}" alt="Est Officia Including Shoes Beautiful Pieces Canaz">
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="right-block">
                                                                            <div class="caption">
                                                                                <h4>
                                                                                    <a href="product.html" 
                                                                                        title="Est Officia Including Shoes Beautiful Pieces Canaz" target="_self">
                                                                                    Est Officia Including Shoes Beautiful Pieces Canaz
                                                                                    </a>
                                                                                </h4>
                                                                                <div class="rating">
                                                                                    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                                                    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                                                    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                                                    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                                                </div>
                                                                                <p class="price">
                                                                                    <span class="price-new">Rs. 80.00</span>
                                                                                </p>
                                                                            </div>
                                                                            <div class="button-group2">
                                                                                <button class="bt-cart addToCart" type="button" data-toggle="tooltip" title="Add to cart" onclick="cart.add('42');"> <span>Add to cart</span></button>
                                                                                <button class="bt wishlist" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('42');"><i class="fa fa-heart"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="item-inner product-thumb trg transition product-layout">
                                                                    <div class="product-item-container">
                                                                        <div class="left-block ">
                                                                            <div class="image product-image-container ">
                                                                                <a class="lt-image" 
                                                                                    href="product.html" target="_self"
                                                                                    title="Invisible Hidden Spy Earphone Micro Wireless">
                                                                                <img src="{{asset('front/assets/image/catalog/demo/product/fashion/16-226x226.png')}}" alt="Invisible Hidden Spy Earphone Micro Wireless">
                                                                                </a>
                                                                            </div>
                                                                            <div class="box-label">
                                                                            </div>
                                                                        </div>
                                                                        <div class="right-block">
                                                                            <div class="caption">
                                                                                <h4>
                                                                                    <a href="product.html" 
                                                                                        title="Invisible Hidden Spy Earphone Micro Wireless" target="_self">
                                                                                    Invisible Hidden Spy Earphone Micro Wireless
                                                                                    </a>
                                                                                </h4>
                                                                                <div class="rating">
                                                                                    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                                                    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                                                    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                                                    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                                                </div>
                                                                                <p class="price">
                                                                                    Rs. 100.00
                                                                                </p>
                                                                            </div>
                                                                            <div class="button-group2">
                                                                                <button class="bt-cart addToCart" type="button" data-toggle="tooltip" title="Add to cart" onclick="cart.add('52');"> <span>Add to cart</span></button>
                                                                                <button class="bt wishlist" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('52');"><i class="fa fa-heart"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="ltabs-item ">
                                                                <div class="item-inner product-thumb trg transition product-layout">
                                                                    <div class="product-item-container">
                                                                        <div class="left-block ">
                                                                            <div class="image product-image-container">
                                                                                <a class="lt-image" 
                                                                                    href="product.html" target="_self"
                                                                                    title="Ligula tortoram ut labore et dolore magna elip">
                                                                                <img src="{{asset('front/assets/image/catalog/demo/product/fashion/14-226x226.png')}}" alt="Ligula tortoram ut labore et dolore magna elip">
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="right-block">
                                                                            <div class="caption">
                                                                                <h4>
                                                                                    <a href="product.html" 
                                                                                        title="Ligula tortoram ut labore et dolore magna elip" target="_self">
                                                                                    Ligula tortoram ut labore et dolore magna elip
                                                                                    </a>
                                                                                </h4>
                                                                                <div class="rating">
                                                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                                                </div>
                                                                                <p class="price">
                                                                                    <span class="price-new">Rs. 80.00</span>
                                                                                    <span class="price-old">Rs. 100.00</span>
                                                                                </p>
                                                                            </div>
                                                                            <div class="button-group2">
                                                                                <button class="bt-cart addToCart" type="button" data-toggle="tooltip" title="Add to cart" onclick="cart.add('87');"> <span>Add to cart</span></button>
                                                                                <button class="bt wishlist" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('87');"><i class="fa fa-heart"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="item-inner product-thumb trg transition product-layout">
                                                                    <div class="product-item-container">
                                                                        <div class="left-block ">
                                                                            <div class="image product-image-container">
                                                                                <a class="lt-image" 
                                                                                    href="product.html" target="_self"
                                                                                    title="Ligula tortoram ut labore et dolore magna elip">
                                                                                <img src="{{asset('front/assets/image/catalog/demo/product/fashion/11-226x226.png')}}" alt="Ligula tortoram ut labore et dolore magna elip">
                                                                                </a>
                                                                            </div>
                                                                            <div class="box-label">
                                                                            </div>
                                                                        </div>
                                                                        <div class="right-block">
                                                                            <div class="caption">
                                                                                <h4>
                                                                                    <a href="product.html" 
                                                                                        title="Ligula tortoram ut labore et dolore magna elip" target="_self">
                                                                                    Ligula tortoram ut labore et dolore magna elip
                                                                                    </a>
                                                                                </h4>
                                                                                <div class="rating">
                                                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                                                </div>
                                                                                <p class="price">
                                                                                    Rs. 100.00
                                                                                </p>
                                                                            </div>
                                                                            <div class="button-group2">
                                                                                <button class="bt-cart addToCart" type="button" data-toggle="tooltip" title="Add to cart" onclick="cart.add('90');"> <span>Add to cart</span></button>
                                                                                <button class="bt wishlist" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('90');"><i class="fa fa-heart"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="ltabs-item ">
                                                                <div class="item-inner product-thumb trg transition product-layout">
                                                                    <div class="product-item-container">
                                                                        <div class="left-block ">
                                                                            <div class="image product-image-container">
                                                                                <a class="lt-image" 
                                                                                    href="product.html" target="_self"
                                                                                    title="magna elip therefore always free from bolac sodo">
                                                                                <img src="{{asset('front/assets/image/catalog/demo/product/fashion/18-226x226.png')}}" alt="magna elip therefore always free from bolac sodo">
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="right-block">
                                                                            <div class="caption">
                                                                                <h4>
                                                                                    <a href="product.html" 
                                                                                        title="magna elip therefore always free from bolac sodo" target="_self">
                                                                                    magna elip therefore always free from bolac sodo
                                                                                    </a>
                                                                                </h4>
                                                                                <div class="rating">
                                                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                                                </div>
                                                                                <p class="price">
                                                                                    <span class="price-new">Rs. 98.00</span>
                                                                                    <span class="price-old">Rs. 100.00</span>
                                                                                </p>
                                                                            </div>
                                                                            <div class="button-group2">
                                                                                <button class="bt-cart addToCart" type="button" data-toggle="tooltip" title="Add to cart" onclick="cart.add('83');"> <span>Add to cart</span></button>
                                                                                <button class="bt wishlist" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('83');"><i class="fa fa-heart"></i></button> 
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="item-inner product-thumb trg transition product-layout">
                                                                    <div class="product-item-container">
                                                                        <div class="left-block ">
                                                                            <div class="image product-image-container">
                                                                                <a class="lt-image" 
                                                                                    href="product.html" target="_self"
                                                                                    title="Est Officia Including Shoes Beautiful Pieces Canaz">
                                                                                <img src="{{asset('front/assets/image/catalog/demo/product/fashion/15-226x226.png')}}" alt="Est Officia Including Shoes Beautiful Pieces Canaz">
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="right-block">
                                                                            <div class="caption">
                                                                                <h4>
                                                                                    <a href="product.html" 
                                                                                        title="Est Officia Including Shoes Beautiful Pieces Canaz" target="_self">
                                                                                    Est Officia Including Shoes Beautiful Pieces Canaz
                                                                                    </a>
                                                                                </h4>
                                                                                <div class="rating">
                                                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                                                </div>
                                                                                <p class="price">
                                                                                    <span class="price-new">Rs. 50.00</span>
                                                                                </p>
                                                                            </div>
                                                                            <div class="button-group2">
                                                                                <button class="bt-cart addToCart" type="button" data-toggle="tooltip" title="Add to cart" onclick="cart.add('29');"> <span>Add to cart</span></button>
                                                                                <button class="bt wishlist" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('29');"><i class="fa fa-heart"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ltabs-items items-category-31 grid" data-total="8">
                                                         <div class="ltabs-loading"></div>
                                                    </div>
                                                    <div class="ltabs-items items-category-32 grid" data-total="8">
                                                         <div class="ltabs-loading"></div>
                                                    </div>
                                                    <div class="ltabs-items items-category-33 grid" data-total="8">
                                                         <div class="ltabs-loading"></div>
                                                    </div>
                                                    <div class="ltabs-items items-category-34 grid" data-total="8">
                                                         <div class="ltabs-loading"></div>
                                                    </div>
                                                    <div class="ltabs-items items-category-35 grid" data-total="8">
                                                         <div class="ltabs-loading"></div>
                                                    </div>
                                                    <div class="ltabs-items items-category-36 grid" data-total="8">
                                                         <div class="ltabs-loading"></div>
                                                    </div>
                                                    <div class="ltabs-items items-category-37 grid" data-total="8">
                                                         <div class="ltabs-loading"></div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_hksd block">
                                <div class="module so-listing-tabs-ltr home3_listingtab_style2">
                                    <div class="head-title">
                                        <h3 class="modtitle">Digital & Electronic2</h3>
                                    </div>
                                    <div class="modcontent">
                                        <div id="so_listing_tabs_727" class="so-listing-tabs first-load module">
                                            <div class="ltabs-wrap">
                                                <div class="ltabs-tabs-container" data-delay="300" data-duration="600" data-effect="starwars" data-ajaxurl="" data-type_source="0" data-lg="4" data-md="3" data-sm="2" data-xs="2" data-margin="0">
                                                    <!--Begin Tabs-->
                                                    <div class="ltabs-tabs-wrap">
                                                                 <span class="ltabs-tab-selected"></span>
                                                                 <span class="ltabs-tab-arrow">▼</span>
                                                                 <div class="item-sub-cat">
                                                                        <ul class="ltabs-tabs cf">
                                                                             <li class="ltabs-tab tab-sel" data-category-id="40" data-active-content=".items-category-40"><div class="ltabs-tab-img">
                                                                                    <img src="{{asset('front/assets/image/catalog/demo/category/94.jpg')}}"
                                                                                        title="CASE" alt="CASE"
                                                                                        style="background:#fff"/>
                                                                                </div>
                                                                                <span class="ltabs-tab-label">
                                                                                CASE
                                                                                </span></li>
                                                                             <li class="ltabs-tab " data-category-id="41" data-active-content=".items-category-41"><div class="ltabs-tab-img">
                                                                                    <img src="{{asset('front/assets/image/catalog/demo/category/93.jpg')}}"
                                                                                        title="Cell & Cable" alt="Cell & Cable"
                                                                                        style="background:#fff"/>
                                                                                </div><span class="ltabs-tab-label">Cell & Cable</span>
                                                                            </li>
                                                                             <li class="ltabs-tab " data-category-id="42" data-active-content=".items-category-42">
                                                                                 <div class="ltabs-tab-img">
                                                                                        <img src="{{asset('front/assets/image/catalog/demo/category/88.jpg')}}"
                                                                                            title="Headphone" alt="Headphone"
                                                                                            style="background:#fff"/>
                                                                                    </div>
                                                                                    <span class="ltabs-tab-label">
                                                                                    Headphone
                                                                                    </span>
                                                                             </li>
                                                                             <li class="ltabs-tab " data-category-id="43" data-active-content=".items-category-43">
                                                                                 <div class="ltabs-tab-img">
                                                                                    <img src="{{asset('front/assets/image/catalog/demo/category/90.jpg')}}"
                                                                                        title="Laptops" alt="Laptops"
                                                                                        style="background:#fff"/>
                                                                                </div>
                                                                                <span class="ltabs-tab-label">
                                                                                Laptops
                                                                                </span>
                                                                             </li>
                                                                             <li class="ltabs-tab " data-category-id="44" data-active-content=".items-category-44">
                                                                                <div class="ltabs-tab-img">
                                                                                    <img src="{{asset('front/assets/image/catalog/demo/category/87.jpg')}}"
                                                                                        title="Mobile & Table" alt="Mobile & Table"
                                                                                        style="background:#fff"/>
                                                                                </div>
                                                                                <span class="ltabs-tab-label">
                                                                                Mobile & Table
                                                                                </span>
                                                                             </li>
                                                                             <li class="ltabs-tab " data-category-id="45" data-active-content=".items-category-45">
                                                                                 <div class="ltabs-tab-img">
                                                                                    <img src="{{asset('front/assets/image/catalog/demo/category/91.jpg')}}"
                                                                                        title="Sound" alt="Sound  "
                                                                                        style="background:#fff"/>
                                                                                </div>
                                                                                <span class="ltabs-tab-label">
                                                                                Sound
                                                                                </span>
                                                                             </li>
                                                                             <li class="ltabs-tab " data-category-id="46" data-active-content=".items-category-46">
                                                                                    <div class="ltabs-tab-img">
                                                                                        <img src="{{asset('front/assets/image/catalog/demo/category/89.jpg')}}"
                                                                                            title="USB & HDD" alt="USB & HDD"
                                                                                            style="background:#fff"/>
                                                                                    </div>
                                                                                    <span class="ltabs-tab-label">
                                                                                    USB & HDD
                                                                                    </span>
                                                                             </li>
                                                                             <li class="ltabs-tab " data-category-id="47" data-active-content=".items-category-47">
                                                                                 <div class="ltabs-tab-img">
                                                                                    <img src="{{asset('front/assets/image/catalog/demo/category/92.jpg')}}"
                                                                                        title="Video & Camera" alt="Video & Camera"
                                                                                        style="background:#fff"/>
                                                                                </div>
                                                                                <span class="ltabs-tab-label">
                                                                                Video & Camera
                                                                                </span>
                                                                             </li>
                                                                        </ul>
                                                                 </div>
                                                            </div>
                                                    <!-- End Tabs-->
                                                </div>
                                                <div class="wap-listing-tabs products-list grid">
                                                <div class="ltabs-items-container">
                                                    <div class="ltabs-items ltabs-items-selected items-category-40" data-total="12">
                                                        <div class="ltabs-items-inner ltabs-slider ">
                                                            <div class="ltabs-item ">
                                                                <div class="item-inner product-thumb trg transition product-layout">
                                                                    <div class="product-item-container">
                                                                        <div class="left-block ">
                                                                            <div class="image product-image-container">
                                                                                <a class="lt-image" 
                                                                                    href="product.html" target="_self"
                                                                                    title="Compact Portable Charger (External Battery)">
                                                                                <img src="{{asset('front/assets/image/catalog/demo/product/electronic/13-226x226.jpg')}}" alt="Compact Portable Charger (External Battery)">
                                                                                </a>
                                                                            </div>
                                                                            <div class="box-label">
                                                                            </div>
                                                                        </div>
                                                                        <div class="right-block">
                                                                            <div class="caption">
                                                                                <h4>
                                                                                    <a href="product.html" 
                                                                                        title="Compact Portable Charger (External Battery)" target="_self">
                                                                                    Compact Portable Charger (External Batte..
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
                                                                <div class="item-inner product-thumb trg transition product-layout">
                                                                    <div class="product-item-container">
                                                                        <div class="left-block ">
                                                                            <div class="image product-image-container">
                                                                                <a class="lt-image" 
                                                                                    href="product.html" target="_self"
                                                                                    title="Charger  Compact Portable with Premium">
                                                                                <img src="{{asset('front/assets/image/catalog/demo/product/electronic/11-226x226.jpg')}}" alt="Charger  Compact Portable with Premium">
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="right-block">
                                                                            <div class="caption">
                                                                                <h4>
                                                                                    <a href="product.html" 
                                                                                        title="Charger  Compact Portable with Premium" target="_self">
                                                                                    Charger  Compact Portable with Premium
                                                                                    </a>
                                                                                </h4>
                                                                                <p class="price">
                                                                                    <span class="price-new">Rs. 80.00</span>
                                                                                </p>
                                                                            </div>
                                                                            <div class="button-group2">
                                                                                <button class="bt-cart addToCart" type="button" data-toggle="tooltip" title="Add to cart" onclick="cart.add('51');"> <span>Add to cart</span></button>
                                                                                <button class="bt wishlist" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('51');"><i class="fa fa-heart"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="ltabs-item ">
                                                                <div class="item-inner product-thumb trg transition product-layout">
                                                                    <div class="product-item-container">
                                                                        <div class="left-block ">
                                                                            <div class="image product-image-container">
                                                                                <a class="lt-image" 
                                                                                    href="product.html" target="_self"
                                                                                    title="Compact Portable Charger (External Battery) T21">
                                                                                <img src="{{asset('front/assets/image/catalog/demo/product/electronic/14-226x226.jpg')}}" alt="Compact Portable Charger (External Battery) T21">
                                                                                </a>
                                                                            </div>
                                                                            <div class="box-label">
                                                                            </div>
                                                                        </div>
                                                                        <div class="right-block">
                                                                            <div class="caption">
                                                                                <h4>
                                                                                    <a href="product.html" 
                                                                                        title="Compact Portable Charger (External Battery) T21" target="_self">
                                                                                    Compact Portable Charger (External Batte..
                                                                                    </a>
                                                                                </h4>
                                                                                <p class="price">
                                                                                    Rs. 100.00
                                                                                </p>
                                                                            </div>
                                                                            <div class="button-group2">
                                                                                <button class="bt-cart addToCart" type="button" data-toggle="tooltip" title="Add to cart" onclick="cart.add('75');"> <span>Add to cart</span></button>
                                                                                <button class="bt wishlist" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('75');"><i class="fa fa-heart"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="item-inner product-thumb trg transition product-layout">
                                                                    <div class="product-item-container">
                                                                        <div class="left-block ">
                                                                            <div class="image product-image-container ">
                                                                                <a class="lt-image" 
                                                                                    href="product.html" target="_self"
                                                                                    title="Compact Portable Charger (External Battery) T22">
                                                                                <img src="{{asset('front/assets/image/catalog/demo/product/electronic/21-226x226.jpg')}}" alt="Compact Portable Charger (External Battery) T22">
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="right-block">
                                                                            <div class="caption">
                                                                                <h4>
                                                                                    <a href="product.html" 
                                                                                        title="Compact Portable Charger (External Battery) T22" target="_self">
                                                                                    Compact Portable Charger (External Batte..
                                                                                    </a>
                                                                                </h4>
                                                                                <p class="price">
                                                                                    <span class="price-new">Rs. 80.00</span>
                                                                                </p>
                                                                            </div>
                                                                            <div class="button-group2">
                                                                                <button class="bt-cart addToCart" type="button" data-toggle="tooltip" title="Add to cart" onclick="cart.add('88');"> <span>Add to cart</span></button>
                                                                                <button class="bt wishlist" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('88');"><i class="fa fa-heart"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="ltabs-item ">
                                                                <div class="item-inner product-thumb trg transition product-layout">
                                                                    <div class="product-item-container">
                                                                        <div class="left-block ">
                                                                            <div class="image product-image-container">
                                                                                <a class="lt-image" 
                                                                                    href="product.html" target="_self"
                                                                                    title="Lorem Ipsum dolor at vero eos et iusto odi  with Premium">
                                                                                <img src="{{asset('front/assets/image/catalog/demo/product/electronic/26-226x226.jpg')}}" alt="Lorem Ipsum dolor at vero eos et iusto odi  with Premium">
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="right-block">
                                                                            <div class="caption">
                                                                                <h4>
                                                                                    <a href="product.html" 
                                                                                        title="Lorem Ipsum dolor at vero eos et iusto odi  with Premium" target="_self">
                                                                                    Lorem Ipsum dolor at vero eos et iusto o..
                                                                                    </a>
                                                                                </h4>
                                                                                <p class="price">
                                                                                    <span class="price-new">Rs. 80.00</span>
                                                                                </p>
                                                                            </div>
                                                                            <div class="button-group2">
                                                                                <button class="bt-cart addToCart" type="button" data-toggle="tooltip" title="Add to cart" onclick="cart.add('105');"> <span>Add to cart</span></button>
                                                                                <button class="bt wishlist" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('105');"><i class="fa fa-heart"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="item-inner product-thumb trg transition product-layout">
                                                                    <div class="product-item-container">
                                                                        <div class="left-block ">
                                                                            <div class="image product-image-container">
                                                                                <a class="lt-image" 
                                                                                    href="product.html" target="_self"
                                                                                    title="Mammo Diablo except to obtain some advan from">
                                                                                <img src="{{asset('front/assets/image/catalog/demo/product/electronic/6-226x226.jpg')}}" alt="Mammo Diablo except to obtain some advan from">
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="right-block">
                                                                            <div class="caption">
                                                                                <h4>
                                                                                    <a href="product.html" 
                                                                                        title="Mammo Diablo except to obtain some advan from" target="_self">
                                                                                    Mammo Diablo except to obtain some advan..
                                                                                    </a>
                                                                                </h4>
                                                                                <p class="price">
                                                                                    <span class="price-new">Rs. 80.00</span>
                                                                                </p>
                                                                            </div>
                                                                            <div class="button-group2">
                                                                                <button class="bt-cart addToCart" type="button" data-toggle="tooltip" title="Add to cart" onclick="cart.add('110');"> <span>Add to cart</span></button>
                                                                                <button class="bt wishlist" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('110');"><i class="fa fa-heart"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="ltabs-item ">
                                                                <div class="item-inner product-thumb trg transition product-layout">
                                                                    <div class="product-item-container">
                                                                        <div class="left-block ">
                                                                            <div class="image product-image-container">
                                                                                <a class="lt-image" 
                                                                                    href="product.html" target="_self"
                                                                                    title="Portable  Compact Charger (External Battery) t45">
                                                                                <img src="{{asset('front/assets/image/catalog/demo/product/electronic/4-226x226.jpg')}}" alt="Portable  Compact Charger (External Battery) t45">
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="right-block">
                                                                            <div class="caption">
                                                                                <h4>
                                                                                    <a href="product.html" 
                                                                                        title="Portable  Compact Charger (External Battery) t45" target="_self">
                                                                                    Portable  Compact Charger (External Batt..
                                                                                    </a>
                                                                                </h4>
                                                                                <p class="price">
                                                                                    <span class="price-new">Rs. 60.00</span>
                                                                                </p>
                                                                            </div>
                                                                            <div class="button-group2">
                                                                                <button class="bt-cart addToCart" type="button" data-toggle="tooltip" title="Add to cart" onclick="cart.add('78');"> <span>Add to cart</span></button>
                                                                                <button class="bt wishlist" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('78');"><i class="fa fa-heart"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="item-inner product-thumb trg transition product-layout">
                                                                    <div class="product-item-container">
                                                                        <div class="left-block ">
                                                                            <div class="image product-image-container">
                                                                                <a class="lt-image" 
                                                                                    href="product.html" target="_self"
                                                                                    title="LG 29UC97-S 29&quot;(21:9) FHD  IPS LED 2560X1080 HDMI(2)">
                                                                                <img src="{{asset('front/assets/image/catalog/demo/product/electronic/28-226x226.jpg')}}" alt="LG 29UC97-S 29&quot;(21:9) FHD  IPS LED 2560X1080 HDMI(2)">
                                                                                </a>
                                                                            </div>
                                                                            <div class="box-label">
                                                                            </div>
                                                                        </div>
                                                                        <div class="right-block">
                                                                            <div class="caption">
                                                                                <h4>
                                                                                    <a href="product.html" 
                                                                                        title="LG 29UC97-S 29&quot;(21:9) FHD  IPS LED 2560X1080 HDMI(2)" target="_self">
                                                                                    LG 29UC97-S 29"(21:9) FHD  IPS LED 2560X..
                                                                                    </a>
                                                                                </h4>
                                                                                <p class="price">
                                                                                    Rs. 101.00
                                                                                </p>
                                                                            </div>
                                                                            <div class="button-group2">
                                                                                <button class="bt-cart addToCart" type="button" data-toggle="tooltip" title="Add to cart" onclick="cart.add('40');"> <span>Add to cart</span></button>
                                                                                <button class="bt wishlist" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('40');"><i class="fa fa-heart"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="ltabs-item ">
                                                                <div class="item-inner product-thumb trg transition product-layout">
                                                                    <div class="product-item-container">
                                                                        <div class="left-block ">
                                                                            <div class="image product-image-container">
                                                                                <a class="lt-image" 
                                                                                    href="product.html" target="_self"
                                                                                    title="Compact Portable Charger (Power Bank) with Premium">
                                                                                <img src="{{asset('front/assets/image/catalog/demo/product/electronic/19-226x226.jpg')}}" alt="Compact Portable Charger (Power Bank) with Premium">
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="right-block">
                                                                            <div class="caption">
                                                                                <h4>
                                                                                    <a href="product.html" 
                                                                                        title="Compact Portable Charger (Power Bank) with Premium" target="_self">
                                                                                    Compact Portable Charger (Power Bank) wi..
                                                                                    </a>
                                                                                </h4>
                                                                                <p class="price">
                                                                                    <span class="price-new">Rs. 60.00</span>
                                                                                    <span class="price-old">Rs. 199.99</span>
                                                                                </p>
                                                                            </div>
                                                                            <div class="button-group2">
                                                                                <button class="bt-cart addToCart" type="button" data-toggle="tooltip" title="Add to cart" onclick="cart.add('66');"> <span>Add to cart</span></button>
                                                                                <button class="bt wishlist" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('66');"><i class="fa fa-heart"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="item-inner product-thumb trg transition product-layout">
                                                                    <div class="product-item-container">
                                                                        <div class="left-block ">
                                                                            <div class="image product-image-container ">
                                                                                <a class="lt-image" 
                                                                                    href="product.html" target="_self"
                                                                                    title="SamSung 23UC97-S 29&quot;(21:9) FHD  IPS LED 2560X1080 ">
                                                                                <img src="{{asset('front/assets/image/catalog/demo/product/electronic/5-226x226.jpg')}}" alt="SamSung 23UC97-S 29&quot;(21:9) FHD  IPS LED 2560X1080 ">
                                                                                </a>
                                                                            </div>
                                                                            <div class="box-label">
                                                                            </div>
                                                                        </div>
                                                                        <div class="right-block">
                                                                            <div class="caption">
                                                                                <h4>
                                                                                    <a href="product.html" 
                                                                                        title="SamSung 23UC97-S 29&quot;(21:9) FHD  IPS LED 2560X1080 " target="_self">
                                                                                    SamSung 23UC97-S 29"(21:9) FHD  IPS LED ..
                                                                                    </a>
                                                                                </h4>
                                                                                <p class="price">
                                                                                    Rs. 279.99
                                                                                </p>
                                                                            </div>
                                                                            <div class="button-group2">
                                                                                <button class="bt-cart addToCart" type="button" data-toggle="tooltip" title="Add to cart" onclick="cart.add('64');"> <span>Add to cart</span></button>
                                                                                <button class="bt wishlist" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('64');"><i class="fa fa-heart"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="ltabs-item ">
                                                                <div class="item-inner product-thumb trg transition product-layout">
                                                                    <div class="product-item-container">
                                                                        <div class="left-block ">
                                                                            <div class="image product-image-container">
                                                                                <a class="lt-image" 
                                                                                    href="product.html" target="_self"
                                                                                    title="Luma Extrem ich toil and pain can pcure him">
                                                                                <img src="{{asset('front/assets/image/catalog/demo/product/electronic/9-226x226.jpg')}}" alt="Luma Extrem ich toil and pain can pcure him">
                                                                                </a>
                                                                            </div>
                                                                            <div class="box-label">
                                                                                <span class="label-product label-sale">-20%</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="right-block">
                                                                            <div class="caption">
                                                                                <h4>
                                                                                    <a href="product.html" 
                                                                                        title="Luma Extrem ich toil and pain can pcure him" target="_self">
                                                                                    Luma Extrem ich toil and pain can pcure ..
                                                                                    </a>
                                                                                </h4>
                                                                                <p class="price">
                                                                                    <span class="price-new">Rs. 400.00</span>
                                                                                    <span class="price-old">Rs. 500.00</span>
                                                                                </p>
                                                                            </div>
                                                                            <div class="button-group2">
                                                                                <button class="bt-cart addToCart" type="button" data-toggle="tooltip" title="Add to cart" onclick="cart.add('60');"> <span>Add to cart</span></button>
                                                                                <button class="bt wishlist" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('60');"><i class="fa fa-heart"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="item-inner product-thumb trg transition product-layout">
                                                                    <div class="product-item-container">
                                                                        <div class="left-block ">
                                                                            <div class="image product-image-container">
                                                                                <a class="lt-image" 
                                                                                    href="product.html" target="_self"
                                                                                    title="Compact Portable Charger (External Battery) T23">
                                                                                <img src="{{asset('front/assets/image/catalog/demo/product/electronic/17-226x226.jpg')}}" alt="Compact Portable Charger (External Battery) T23">
                                                                                </a>
                                                                            </div>
                                                                            <div class="box-label">
                                                                            </div>
                                                                        </div>
                                                                        <div class="right-block">
                                                                            <div class="caption">
                                                                                <h4>
                                                                                    <a href="product.html" 
                                                                                        title="Compact Portable Charger (External Battery) T23" target="_self">
                                                                                    Compact Portable Charger (External Batte..
                                                                                    </a>
                                                                                </h4>
                                                                                <p class="price">
                                                                                    Rs. 1,000.00
                                                                                </p>
                                                                            </div>
                                                                            <div class="button-group2">
                                                                                <button class="bt-cart addToCart" type="button" data-toggle="tooltip" title="Add to cart" onclick="cart.add('68');"> <span>Add to cart</span></button>
                                                                                <button class="bt wishlist" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('68');"><i class="fa fa-heart"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ltabs-items items-category-41 grid" data-total="8">
                                                         <div class="ltabs-loading"></div>
                                                    </div>
                                                    <div class="ltabs-items items-category-42 grid" data-total="8">
                                                         <div class="ltabs-loading"></div>
                                                    </div>
                                                    <div class="ltabs-items items-category-43 grid" data-total="8">
                                                         <div class="ltabs-loading"></div>
                                                    </div>
                                                    <div class="ltabs-items items-category-44 grid" data-total="8">
                                                         <div class="ltabs-loading"></div>
                                                    </div>
                                                    <div class="ltabs-items items-category-45 grid" data-total="8">
                                                         <div class="ltabs-loading"></div>
                                                    </div>
                                                    <div class="ltabs-items items-category-46 grid" data-total="8">
                                                         <div class="ltabs-loading"></div>
                                                    </div>
                                                    <div class="ltabs-items items-category-47 grid" data-total="8">
                                                         <div class="ltabs-loading"></div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                                                <a class="lt-image" 
                                                                    href="{{url('product/'.$row->urlname)}}" target="_self"
                                                                    title="{{$row->title}}">
                                                                <img src="{{asset('front/assets/image/catalog/demo/product/electronic/25-234x234.jpg')}}" alt="{{$row->title}}">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="right-block">
                                                            <div class="caption">
                                                                <h4 class="font-ct">
                                                                    <a href="{{url('product/'.$row->urlname)}}" target="_self" title="{{$row->title}}" >
                                                                    {{$row->name}}
                                                                    </a>
                                                                </h4>
                                                                <div  class="content_price price font-ct">
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