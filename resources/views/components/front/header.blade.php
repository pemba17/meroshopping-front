<header id="header" class=" typeheader-1">
    <!-- Header Top -->
    <div class="header-top hidden-compact">
       <div class="container">
          <div class="row">
             <div class="col-lg-3 col-xs-6 header-logo ">
                <div class="navbar-logo">
                   <a href="{{route('/')}}"><img src="{{asset('front/assets/image/catalog/demo/logo/logo-old.png')}}" alt="Your Store"  title="Your Store"></a>
                </div>
             </div>
             <div class="col-lg-7 header-sevices">
                <div class="module html--sevices ">
                   <div class="clearfix sevices-menu">
                    <ul>
                     <li class="col-md-4 item mail">
                        <i class="fa fa-truck" style="font-size:35px;  color:#FE8C69"></i>
                         <div class="text" style="margin-left:10px">
                            <a class="name" href="#">Track Order On</a>
                            <p>Mero Shopping</p>
                         </div>
                      </li>

                      <li class="col-md-4 item mail">
                        <i class="fa fa-cart-plus" style="font-size:35px;  color:#FE8C69"></i>
                         <div class="text" style="margin-left:10px">
                            <a class="name" href="#">Sell Product On</a>
                            <p>Mero Shopping</p>
                         </div>
                      </li>
                      <li class="col-md-4 item delivery" style="display: flex; align-items:center">
                         <i class="fa fa-user" style="font-size:35px;  color:#FE8C69"></i>
                         <div class="text" style="margin-left:10px">
                            @guest
                              <a class="name" href="{{route('login')}}">Login</a>
                              <p>Access the system</p>
                           @endguest
                         </div>
                         @auth
                           <div class="btn-group">
                              <button class="btn-link dropdown-toggle" data-toggle="dropdown">
                                 <span class="hidden-xs">@if(auth()->user()->name!=NULL) {{auth()->user()->name}} @else Customer @endif</span>
                                 <i class="fa fa-angle-down"></i>
                              </button>
                              <ul class="dropdown-menu">
                                 <li>
                                    <a href="{{url('profile')}}">{{ __('My Profile') }}</a>
                                 </li>
                                 <li>
                                    <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                 </li>
                              </ul>
                           </div>
                         @endauth
                      </li>
                   </ul>
                   </div>
                </div>
               </div>
               <div class="col-lg-2 col-xs-6 header-cart">
                  <div class="shopping_cart">
                     <div id="cart" class="btn-shopping-cart">
                        @php
                           $client_id=Auth::check()?auth()->user()->id:$_COOKIE['device'];
                           $cart_details=\App\Models\Cart::with('product')->where('client_id',$client_id)->get();
                           $total_sum=\App\Models\Cart::select()
                           ->rightJoin('products','carts.product_id','products.id')
                           ->where('client_id',$client_id)
                           ->sum(DB::raw('price * quantity'));
                        @endphp
                        <a data-loading-text="Loading... " class="btn-group top_cart dropdown-toggle" data-toggle="dropdown">
                           <div class="shopcart">
                              <span class="handle pull-left"></span>
                              <div class="cart-info">
                                 <h2 class="title-cart">Shopping cart</h2>
                                 <h2 class="title-cart2 hidden">My Cart</h2>
                                 <span class="total-shopping-cart cart-total-full">
                                 <span class="items_cart">{{count($cart_details)}} </span><span class="items_cart2">item(s)</span><span class="items_carts"> - Rs {{$total_sum}}</span>
                                 </span>
                              </div>
                           </div>
                        </a>
                        <ul class="dropdown-menu pull-right shoppingcart-box">
                           <li class="content-item">
                              @forelse($cart_details as $row)
                                 <table class="table table-striped" style="margin-bottom:10px;">
                                       <tbody>
                                          <tr>
                                             <td class="text-center size-img-cart">
                                                   <a href="product.html"><img src="{{asset('front/assets/image/catalog/demo/product/travel/10-54x54.jpg')}}" alt="Bougainvilleas on Lombard Street,  San Francisco, Tokyo" title="Bougainvilleas on Lombard Street,  San Francisco, Tokyo" class="img-thumbnail"></a>
                                             </td>
                                             <td class="text-left"><a href="product.html">{{$row->product->name}}</a>
                                                   {{-- <br> - <small>Size M</small> </td> --}}
                                             <td class="text-right">x{{$row->quantity}}</td>
                                             <td class="text-right">Rs {{$row->quantity * $row->product->price}}</td>
                                             <td class="text-center">
                                                   <button type="button" title="Remove" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
                                             </td>
                                          </tr>
                                       </tbody>
                                 </table>
                              @empty
                                 <div class="text-center">
                                    <img width="200" style="border-radius: 5px;" src="{{asset('front/assets/image/cart-empty.png')}}" alt="" />
                                    Cart is Empty
                                 </div>
                              @endforelse
                           </li>
                           @if(count($cart_details)>0)
                              <li>
                                 <div class="checkout clearfix">
                                    <a href="{{url('cart')}}" class="btn btn-view-cart inverse"> View Cart</a>
                                    <a class="btn btn-checkout pull-right" onclick="event.preventDefault(); document.getElementById('checkout-form-header').submit();" >Checkout</a>
                                    <form method="POST" action="{{url('/checkout')}}" id="checkout-form-header">
                                       @csrf
                                       <input type="hidden" name="cart" value="{{$cart_details}}">
                                       <input type="hidden" name="total_sum" value="{{$total_sum}}">
                                    </form>
                                 </div>
                              </li>
                           @endif
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
       </div>
    </div>
    <!-- //Header Top -->
    <!-- Header center -->
    <div class="header-center">
       <div class="container">
          <div class="row" style="display: flex; justify-content:center">
             <!--Searchhome-->
             <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 header-search">
                <div id="sosearchpro" class="sosearchpro-wrapper so-search ">
                   <form method="GET" action="index.php">
                      <div id="search0" class="search input-group form-group">
                         <input class="autosearch-input form-control" type="text" value="" size="50" autocomplete="off" placeholder="Search Products On Mero Shopping" name="search">
                         <div class="select_category filter_type  icon-select">
                           <select class="no-border" name="category_id">
                              <option value="0">All Categories </option>
                              <option value="82 ">Book Stationery </option>
                              <option value="65">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Girls New </option>
                              <option value="56">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Kitchen </option>
                              <option value="61">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pearl mens </option>
                              <option value="38 ">Laptop &amp; Notebook </option>
                              <option value="52 ">Spa &amp; Massage </option>
                              <option value="44">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Latenge mange </option>
                              <option value="53">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Necklaces </option>
                              <option value="54">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pearl Jewelry </option>
                              <option value="55">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Slider 925 </option>
                              <option value="24">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Phones &amp; PDAs </option>
                              <option value="59 ">Sport &amp; Entertaiment </option>
                              <option value="69">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Camping &amp; Hiking </option>
                              <option value="70">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Cusen mariot </option>
                              <option value="74">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Engite nanet </option>
                              <option value="64">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Fashion </option>
                              <option value="66">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Men </option>
                              <option value="60 ">Travel &amp; Vacation </option>
                              <option value="71">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Best Tours </option>
                              <option value="72">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Cruises </option>
                              <option value="73">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Destinations </option>
                              <option value="67">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Hotel &amp; Resort </option>
                              <option value="63">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Infocus </option>
                              <option value="18 ">Laptops &amp; Notebooks </option>
                              <option value="46">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Macs </option>
                              <option value="45">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Windows </option>
                              <option value="34 ">Food &amp; Restaurant </option>
                              <option value="47">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Hanet magente </option>
                              <option value="43">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Knage unget </option>
                              <option value="48">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Punge nenune </option>
                              <option value="49">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Qunge genga </option>
                              <option value="50">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tange manue </option>
                              <option value="51">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Web Cameras </option>
                              <option value="39 ">Shop Collection </option>
                              <option value="40">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Hanet magente </option>
                              <option value="41">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Knage unget </option>
                              <option value="42">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Latenge mange </option>
                              <option value="58">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Punge nenune </option>
                              <option value="17">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Qunge genga </option>
                              <option value="57">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tange manue </option>
                              <option value="35 ">Fashion &amp; Accessories </option>
                              <option value="36">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Dress Ladies </option>
                              <option value="31">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Jean </option>
                              <option value="27">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Men Fashion </option>
                              <option value="88">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; T-shirt </option>
                              <option value="26">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Trending </option>
                              <option value="37">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Western Wear </option>
                              <option value="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Women Fashion </option>
                              <option value="32">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Bags </option>
                              <option value="33 ">Digital &amp; Electronics </option>
                              <option value="83">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Cell Computers </option>
                              <option value="84">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Computer Accessories </option>
                              <option value="85">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Computer Headsets </option>
                              <option value="86">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Desna Jacket </option>
                              <option value="87">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Electronics </option>
                              <option value="89">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Headphone </option>
                              <option value="90">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Laptops </option>
                              <option value="78">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Mobiles </option>
                              <option value="79">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sound </option>
                              <option value="80">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; USB &amp; HDD </option>
                              <option value="81">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; VGA and CPU </option>
                              <option value="62">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Video &amp; Camera </option>
                              <option value="76">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Video You </option>
                              <option value="75">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Wireless Speakers </option>
                              <option value="29">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Camera New </option>
                              <option value="28">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Case </option>
                              <option value="30">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Cell &amp; Cable </option>
                              <option value="77">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Mobile &amp; Table </option>
                              <option value="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Bluetooth Speakers </option>
                           </select>
                        </div>
                         <span class="input-group-btn">
                         <button type="submit" class="button-search btn btn-default btn-lg" name="submit_search"><i class="fa fa-search"></i><span class="hidden">Search</span></button>
                         </span>
                      </div>
                      <input type="hidden" name="route" value="product/search">
                   </form>
                </div>
             </div>

               {{-- <!-- Menuhome -->
               <div class="col-lg-6 col-md-8 col-sm-1 col-xs-3 header-menu">
                  <div class="megamenu-style-dev megamenu-dev">
                     <div class="responsive">
                        <nav class="navbar-default">
                           <div class="container-megamenu horizontal">
                              <div class="navbar-header">
                                 <button type="button" id="show-megamenu" data-toggle="collapse" class="navbar-toggle">
                                 <span class="icon-bar"></span>
                                 <span class="icon-bar"></span>
                                 <span class="icon-bar"></span>
                                 </button>
                              </div>
                              <div class="megamenu-wrapper">
                                 <span id="remove-megamenu" class="fa fa-times"></span>
                                 <div class="megamenu-pattern">
                                    <div class="container">
                                       <ul class="megamenu" data-transition="slide" data-animationtime="500">
                                          <li class="full-width menu-home with-sub-menu hover">
                                             <p class="close-menu"></p>
                                             <a href="#" class="clearfix">
                                             <strong>
                                             Home
                                             </strong>
                                             <b class="caret"></b>
                                             </a>
                                             <div class="sub-menu" style=" display: none; right: auto;">
                                                <div class="content" style="display: none; height: 400px;">
                                                   <div class="row">
                                                      <div class="col-sm-12">
                                                         <div class="html ">
                                                            <div class="col-lg-4 col-md-4 col-sm-12" style="text-align: center; margin-bottom: 20px;min-height: 140px;">
                                                               <a href="index.html" title="" style="font-size: 12px;text-transform: uppercase;font-weight: bold;text-align: center;">
                                                                  <img src="{{asset('front/assets/image/catalog/demo/menu/feature/layout1.jpg')}}" alt="layout" style="margin: 0 0 10px; border: 1px solid #ddd;display: inline-block">
                                                                  <p>Home Page 1</p>
                                                               </a>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-12" style="text-align: center; margin-bottom: 20px;min-height: 140px;">
                                                               <a href="home2.html" title="" style="font-size: 12px;text-transform: uppercase;font-weight: bold;text-align: center;">
                                                                  <img src="{{asset('front/assets/image/catalog/demo/menu/feature/layout2.jpg')}}" alt="layout" style="margin: 0 0 10px; border: 1px solid #ddd;display: inline-block">
                                                                  <p>Home Page 2 </p>
                                                               </a>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-12" style="text-align: center; margin-bottom: 20px;min-height: 140px;">
                                                               <a href="home3.html" title="" style="font-size: 12px;text-transform: uppercase;font-weight: bold;text-align: center;">
                                                                  <img src="{{asset('front/assets/image/catalog/demo/menu/feature/layout3.jpg')}}" alt="layout" style="margin: 0 0 10px; border: 1px solid #ddd;display: inline-block">
                                                                  <p>Home Page 3 </p>
                                                               </a>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-12" style="text-align: center; margin-bottom: 20px;min-height: 140px;">
                                                               <a href="home4.html" title="" style="font-size: 12px;text-transform: uppercase;font-weight: bold;text-align: center;">
                                                                  <img src="{{asset('front/assets/image/catalog/demo/menu/feature/layout4.jpg')}}" alt="layout" style="margin: 0 0 10px; border: 1px solid #ddd;display: inline-block">
                                                                  <p>Home Page 4 </p>
                                                               </a>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-12" style="text-align: center; margin-bottom: 20px;min-height: 140px;">
                                                               <a href="home5.html" title="" style="font-size: 12px;text-transform: uppercase;font-weight: bold;text-align: center;">
                                                                  <img src="{{asset('front/assets/image/catalog/demo/menu/feature/layout5.jpg')}}" alt="layout" style="margin: 0 0 10px; border: 1px solid #ddd;display: inline-block">
                                                                  <p>Home Page 5 </p>
                                                               </a>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-12" style="text-align: center; margin-bottom: 20px;min-height: 140px;">
                                                               <a href="home6.html" title="" style="font-size: 12px;text-transform: uppercase;font-weight: bold;text-align: center;">
                                                                  <img src="{{asset('front/assets/image/catalog/demo/menu/feature/layout6.jpg')}}" alt="layout" style="margin: 0 0 10px; border: 1px solid #ddd;display: inline-block">
                                                                  <p>Home Page 6 </p>
                                                               </a>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </li>
                                          <li class="full-width option2 with-sub-menu hover">
                                             <p class="close-menu"></p>
                                             <a class="clearfix">
                                             <strong>
                                             Features
                                             </strong>
                                             <span class="labelopencart"></span>
                                             <b class="caret"></b>
                                             </a>
                                             <div class="sub-menu" style="width: 100%;">
                                                <div class="content" >
                                                   <div class="row">
                                                      <div class="col-sm-12">
                                                         <div class="html ">
                                                            <div class="row">
                                                              <div class="col-md-3">
                                                                <div class="column">
                                                                  <a href="#" class="title-submenu">Listing pages</a>
                                                                  <div>
                                                                    <ul class="row-list">
                                                                      <li><a href="category.html">Category Page 1 </a></li>
                                                                      <li><a href="category-v2.html">Category Page 2</a></li>
                                                                      <li><a href="category-v3.html">Category Page 3</a></li>
                                                                    </ul>

                                                                  </div>
                                                                </div>
                                                              </div>
                                                              <div class="col-md-3">
                                                                <div class="column">
                                                                  <a href="#" class="title-submenu">Product pages</a>
                                                                  <div>
                                                                    <ul class="row-list">
                                                                      <li><a href="product.html">Image size - small</a></li>
                                                                      <li><a href="product-v2.html">Image size - medium</a></li>
                                                                      <li><a href="product-v3.html">Image size - big</a></li>
                                                                    </ul>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                              <div class="col-md-3">
                                                                <div class="column">
                                                                  <a href="#" class="title-submenu">Shopping pages</a>
                                                                  <div>
                                                                    <ul class="row-list">
                                                                      <li><a href="cart.html">Shopping Cart Page</a></li>
                                                                      <li><a href="checkout.html">Checkout Page</a></li>
                                                                      <li><a href="compare.html">Compare Page</a></li>
                                                                      <li><a href="wishlist.html">Wishlist Page</a></li>

                                                                    </ul>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                              <div class="col-md-3">
                                                                <div class="column">
                                                                  <a href="#" class="title-submenu">My Account pages</a>
                                                                  <div>
                                                                    <ul class="row-list">
                                                                      <li><a href="login.html">Login Page</a></li>
                                                                      <li><a href="register.html">Register Page</a></li>
                                                                      <li><a href="my-account.html">My Account</a></li>
                                                                      <li><a href="order-history.html">Order History</a></li>
                                                                      <li><a href="order-information.html">Order Information</a></li>
                                                                      <li><a href="return.html">Product Returns</a></li>
                                                                      <li><a href="gift-voucher.html">Gift Voucher</a></li>
                                                                    </ul>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </li>
                                          <li class="item-style1 content-full with-sub-menu hover">
                                             <p class="close-menu"></p>
                                             <a class="clearfix">
                                             <strong>
                                             Colections
                                             </strong>
                                             <span class="labelNew"></span>
                                             <b class="caret"></b>
                                             </a>
                                             <div class="sub-menu" style="width: 100%; right: 0px;">
                                                <div class="content">
                                                   <div class="row">
                                                      <div class="col-sm-3">
                                                         <div class="link ">
                                                            <img src="{{asset('front/assets/image/catalog/demo/menu/menu-img1.jpg')}}" alt="" style="width: 100%;">
                                                         </div>
                                                      </div>
                                                      <div class="col-sm-3">
                                                         <div class="link ">
                                                            <img src="{{asset('front/assets/image/catalog/demo/menu/menu-img2.jpg')}}" alt="" style="width: 100%;">
                                                         </div>
                                                      </div>
                                                      <div class="col-sm-3">
                                                         <div class="link ">
                                                            <img src="{{asset('front/assets/image/catalog/demo/menu/menu-img3.jpg')}}" alt="" style="width: 100%;">
                                                         </div>
                                                      </div>
                                                      <div class="col-sm-3">
                                                         <div class="link ">
                                                            <img src="{{asset('front/assets/image/catalog/demo/menu/menu-img4.jpg')}}" alt="" style="width: 100%;">
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="border"></div>
                                                   <div class="row">
                                                      <div class="col-sm-3">
                                                         <div class="categories ">
                                                            <div class="row">
                                                               <div class="col-sm-12 static-menu">
                                                                  <div class="menu">
                                                                     <ul>
                                                                        <li>
                                                                           <a href="category-v3.html" onclick="window.location = '#';" class="main-menu">Food &amp; Restaurant</a>
                                                                           <ul>
                                                                              <li><a href="#" onclick="window.location = '#';">Tange manue</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Women Fashion</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Bags</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Fashion</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Trending</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Macs</a></li>
                                                                           </ul>
                                                                        </li>
                                                                     </ul>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="col-sm-3">
                                                         <div class="categories ">
                                                            <div class="row">
                                                               <div class="col-sm-12 static-menu">
                                                                  <div class="menu">
                                                                     <ul>
                                                                        <li>
                                                                           <a href="#" onclick="window.location = '#';" class="main-menu">Fashion &amp; Accessories</a>
                                                                           <ul>
                                                                              <li><a href="#" onclick="window.location = '#';">Pearl Jewelry</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Destinations</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Camera New</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Spa &amp; Massage</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Camera New</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Cell &amp; Cable</a></li>
                                                                           </ul>
                                                                        </li>
                                                                     </ul>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="col-sm-3">
                                                         <div class="categories ">
                                                            <div class="row">
                                                               <div class="col-sm-12 static-menu">
                                                                  <div class="menu">
                                                                     <ul>
                                                                        <li>
                                                                           <a href="#" onclick="window.location = '#';" class="main-menu">Sport &amp; Entertaiment</a>
                                                                           <ul>
                                                                              <li><a href="#" onclick="window.location = '#';">Tange manue</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Fashion &amp; Accessories</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Bags</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Men Fashion</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Knage unget</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Qunge genga</a></li>
                                                                           </ul>
                                                                        </li>
                                                                     </ul>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="col-sm-3">
                                                         <div class="categories ">
                                                            <div class="row">
                                                               <div class="col-sm-12 static-menu">
                                                                  <div class="menu">
                                                                     <ul>
                                                                        <li>
                                                                           <a href="#" onclick="window.location = '#';" class="main-menu">Mobile &amp; Table</a>
                                                                           <ul>
                                                                              <li><a href="#" onclick="window.location = '#';">Web Cameras</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Windows</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Pearl mens</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Pearl Jewelry</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Spa &amp; Massage</a></li>
                                                                           </ul>
                                                                        </li>
                                                                     </ul>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </li>
                                          <li class="item-style2 content-full feafute with-sub-menu hover">
                                             <p class="close-menu"></p>
                                             <a class="clearfix">
                                             <strong>
                                             Accessories
                                             </strong>
                                             <b class="caret"></b>
                                             </a>
                                             <div class="sub-menu" style="width: 100%">
                                                <div class="content">
                                                   <div class="row">
                                                      <div class="col-sm-8">
                                                         <div class="categories ">
                                                            <div class="row">
                                                               <div class="col-sm-4 static-menu">
                                                                  <div class="menu">
                                                                     <ul>
                                                                        <li>
                                                                           <a href="#" onclick="window.location = '#';" class="main-menu">Fashion &amp; Accessories</a>
                                                                           <ul>
                                                                              <li><a href="#" onclick="window.location = '#';">Digital &amp; Electronics</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Bluetooth Speakers</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Cell &amp; Cable</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Spa &amp; Massage</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Sport &amp; Entertaiment</a></li>
                                                                           </ul>
                                                                        </li>
                                                                        <li>
                                                                           <a href="#" onclick="window.location = '#';" class="main-menu">Pearl mens</a>
                                                                           <ul>
                                                                              <li><a href="#" onclick="window.location = '#';">Web Cameras</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Windows</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Tange manue</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Knage unget</a></li>
                                                                           </ul>
                                                                        </li>
                                                                     </ul>
                                                                  </div>
                                                               </div>
                                                               <div class="col-sm-4 static-menu">
                                                                  <div class="menu">
                                                                     <ul>
                                                                        <li>
                                                                           <a href="#" onclick="window.location = '#';" class="main-menu">Sport &amp; Entertaiment</a>
                                                                           <ul>
                                                                              <li><a href="#" onclick="window.location = '#';">Jean</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Latenge mange</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Punge nenune</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Trending</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Tange manue</a></li>
                                                                           </ul>
                                                                        </li>
                                                                        <li>
                                                                           <a href="#" onclick="window.location = '#';" class="main-menu">Mobile &amp; Table</a>
                                                                           <ul>
                                                                              <li><a href="#" onclick="window.location = '#';">Case</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Laptop &amp; Notebook</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Laptops &amp; Notebooks</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Dress Ladies</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Kitchen</a></li>
                                                                           </ul>
                                                                        </li>
                                                                     </ul>
                                                                  </div>
                                                               </div>
                                                               <div class="col-sm-4 static-menu">
                                                                  <div class="menu">
                                                                     <ul>
                                                                        <li>
                                                                           <a href="#" onclick="window.location = '#';" class="main-menu">Cell &amp; Cable</a>
                                                                           <ul>
                                                                              <li><a href="#" onclick="window.location = '#';">Bluetooth Speakers</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Fashion &amp; Accessories</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Qunge genga</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Punge nenune</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Punge nenune</a></li>
                                                                           </ul>
                                                                        </li>
                                                                        <li>
                                                                           <a href="#" onclick="window.location = '#';" class="main-menu">Food &amp; Restaurant</a>
                                                                           <ul>
                                                                              <li><a href="#" onclick="window.location = '#';">Fashion</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Bags</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Necklaces</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Tange manue</a></li>
                                                                              <li><a href="#" onclick="window.location = '#';">Men Fashion</a></li>
                                                                           </ul>
                                                                        </li>
                                                                     </ul>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="col-sm-4">
                                                         <div class="product best-sellers-menu">
                                                            <div class="image">
                                                               <a href="#" onclick="window.location = '#'"><img src="{{asset('front/assets/image/catalog/demo/product/fashion/24.png')}}" alt=""></a>
                                                            </div>
                                                            <div class="name"><a href="#" onclick="window.location = '#'">Est Officia Including Shoes Beautiful Pieces Canaz</a></div>
                                                            <div class="price">
                                                               $98.00
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </li>
                                          <li class="style-page with-sub-menu hover">
                                             <p class="close-menu"></p>
                                             <a class="clearfix">
                                             <strong>
                                             Pages
                                             </strong>
                                             <b class="caret"></b>
                                             </a>
                                             <div class="sub-menu" style="width: 40%;">
                                                <div class="content" >
                                                   <div class="row">
                                                    <div class="col-md-6">
                                                      <ul class="row-list">
                                                        <li><a class="subcategory_item" href="faq.html">FAQ</a></li>

                                                        <li><a class="subcategory_item" href="sitemap.html">Site Map</a></li>
                                                        <li><a class="subcategory_item" href="contact.html">Contact us</a></li>
                                                        <li><a class="subcategory_item" href="banner-effect.html">Banner Effect</a></li>
                                                      </ul>
                                                    </div>
                                                    <div class="col-md-6">
                                                      <ul class="row-list">
                                                        <li><a class="subcategory_item" href="about-us.html">About Us 1</a></li>
                                                        <li><a class="subcategory_item" href="about-us-2.html">About Us 2</a></li>
                                                        <li><a class="subcategory_item" href="about-us-3.html">About Us 3</a></li>
                                                        <li><a class="subcategory_item" href="about-us-4.html">About Us 4</a></li>
                                                      </ul>
                                                    </div>
                                                  </div>
                                                </div>
                                             </div>
                                          </li>
                                          <li class="">
                                             <p class="close-menu"></p>
                                             <a href="blog-page.html" class="clearfix">
                                             <strong>
                                             Blog
                                             </strong>
                                             </a>
                                          </li>
                                          <li class="deal-h5 hidden">
                                             <p class="close-menu"></p>
                                             <a href="#" class="clearfix">
                                             <strong>
                                             <img src="{{asset('front/assets/image/catalog/demo/menu/hot-block.png')}}" alt="">Buy This Theme!
                                             </strong>
                                             </a>
                                          </li>
                                          <li class="deal-h5 hidden">
                                             <p class="close-menu"></p>
                                             <a href="#" class="clearfix">
                                             <strong>
                                             Today Deals
                                             </strong>
                                             </a>
                                          </li>
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </nav>
                     </div>
                  </div>
               </div> --}}
          </div>
       </div>
    </div>
    <!-- //Header center -->
       <div class="header-form hidden-compact">
          <div class="button-header current">
             <i class="fa fa-bars"></i>
          </div>
          <div class="dropdown-form toogle_content">
             {{-- <div class="pull-left">
                <form action="#" method="post" enctype="multipart/form-data" id="form-language">
                   <div class="btn-group">
                      <button class="btn-link dropdown-toggle" data-toggle="dropdown">
                         <img src="{{asset('front/assets/image/catalog/flags/gb.png')}}" alt="English" title="English">
                         <span class="hidden-xs hidden-sm hidden-md">English</span>&nbsp;<i class="fa fa-angle-down"></i>
                      </button>

                   <ul class="dropdown-menu">
                      <li>
                         <button class="btn-block language-select" type="button" name="ar-ar"><img src="{{asset('front/assets/image/catalog/flags/ar.png')}}" alt="Arabic" title="Arabic"> Arabic</button>
                      </li>
                      <li>
                         <button class="btn-block language-select" type="button" name="en-gb"><img src="{{asset('front/assets/image/catalog/flags/gb.png')}}" alt="English" title="English"> English</button>
                      </li>
                   </ul>
                   </div>
                   <input type="hidden" name="code" value="">
                   <input type="hidden" name="redirect" value="index.html">
                </form>
             </div>
             <div class="pull-left">
                <form action="#" method="post" enctype="multipart/form-data" id="form-currency">
                   <div class="btn-group">
                      <button class="btn-link dropdown-toggle" data-toggle="dropdown">
                         $<span class="hidden-xs"> US Dollar</span>
                         <i class="fa fa-angle-down"></i>
                      </button>
                      <ul class="dropdown-menu">
                         <li>
                            <button class="currency-select btn-block" type="button" name="EUR">??? Euro</button>
                         </li>
                         <li>
                            <button class="currency-select btn-block" type="button" name="GBP">?? Pound Sterling</button>
                         </li>
                         <li>
                            <button class="currency-select btn-block" type="button" name="USD">$ US Dollar</button>
                         </li>
                      </ul>
                   </div>
                   <input type="hidden" name="code" value="">
                   <input type="hidden" name="redirect" value="index.html">
                </form>
             </div> --}}
             <span class="text">User Information</span>
             <ul class="">
                @guest
                  @if (Route::has('login'))
                     <li><a href="{{route('login')}}">Login</a></li>
                  @endif
                @else
                  <li class="wishlist"><a href="wishlist.html" id="wishlist-total" class="top-link-wishlist" title="Wish List (2) "><span>Wish List (0) </span></a></li>
                  <li class="checkout"><a href="cart.html" class="top-link-checkout" title="Checkout"><span>Checkout</span></a></li>
                  <li>
                     <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                           @csrf
                     </form>
                  </li>
               @endif
             </ul>
          </div>
          <div class="button-user">
             <div class="user-info asd">
                <a data-toggle="modal" data-target="#so_sociallogin" href="#">Login</a>
             </div>
          </div>
       </div>
 </header>

 <div class="modal fade in" id="so_sociallogin" tabindex="-1" role="dialog" aria-hidden="true" >
   <div class="modal-dialog block-popup-login">
         <a href="javascript:void(0)" title="Close" class="close close-login fa fa-times-circle" data-dismiss="modal"></a>
         <div class="tt_popup_login"><strong>Sign in Or Register</strong></div>
         <div class="block-content">
               <div class=" col-reg registered-account">
                     <div class="block-content">
                           <form class="form form-login" action="#" method="post" id="login-form">
                                 <fieldset class="fieldset login" data-hasrequired="* Required Fields">
                                       <div class="field email required email-input">
                                             <div class="control">
                                                   <input name="email" value="" autocomplete="off" id="email" type="email" class="input-text" title="Email" placeholder="E-Mail Address">
                                             </div>
                                       </div>
                                       <div class="field password required pass-input">
                                             <div class="control">
                                                   <input name="password" type="password" autocomplete="off" class="input-text" id="pass" title="Password" placeholder="Password">
                                             </div>
                                       </div>

                                       <div class=" form-group">
                                             <label class="control-label">Login with your social account</label>
                                             <div>

                                                   <a href="#" class="btn btn-social-icon btn-sm btn-google-plus"><i class="fa fa-google fa-fw" aria-hidden="true"></i></a>

                                                   <a href="#" class="btn btn-social-icon btn-sm btn-facebook"><i class="fa fa-facebook fa-fw" aria-hidden="true"></i></a>

                                                   <a href="#" class="btn btn-social-icon btn-sm btn-twitter"><i class="fa fa-twitter fa-fw" aria-hidden="true"></i></a>

                                                   <a href="#" class="btn btn-social-icon btn-sm btn-linkdin"><i class="fa fa-linkedin fa-fw" aria-hidden="true"></i></a>

                                             </div>
                                       </div>

                                       <div class="secondary ft-link-p"><a class="action remind" href="#"><span>Forgot Your Password?</span></a></div>
                                       <div class="actions-toolbar">
                                             <div class="primary">
                                                   <button type="submit" class="action login primary" name="send" id="send2"><span>Login</span></button>
                                             </div>
                                       </div>
                                 </fieldset>
                           </form>
                     </div>
               </div>
               <div class="col-reg login-customer">

                     <h2>NEW HERE?</h2>
                     <p class="note-reg">Registration is free and easy!</p>
                     <ul class="list-log">
                           <li>Faster checkout</li>
                           <li>Save multiple shipping addresses</li>
                           <li>View and track orders and more</li>
                     </ul>
                     <a class="btn-reg-popup" title="Register" href="#">Create an account</a>
               </div>
               <div style="clear:both;"></div>
         </div>
   </div>
</div>
