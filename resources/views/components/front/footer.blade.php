<footer class="footer-container typefooter-3" style="background: white; margin-top:20px">
    <div class="footer-has-toggle collapse" id="collapse-footer"  >
        <div class="so-page-builder">
            @php $brands= \App\Models\Brand::where('front',1)->get(); @endphp
            @if(count($brands)>0)
                <section class="section_1 section-color">
                    <div class="container">
                        <h2 class="text-left" style="font-family:Impact;">Our Brands</h2>  
                        <div class="row" style="margin-top:20px;">
                            @foreach($brands as $brand)
                                <div class="col-lg-2 col-xs-4 col-md-2 col-sm-4" style="padding-top:10px">
                                    <a href="{{url('brand/'.$brand->urlname)}}"><img src="{{asset('images/'.$brand->logo)}}" class="img-thumbnail" style="width: 120px; padding:20px;"/></a>    
                                </div>
                            @endforeach   
                        </div>
                    </div>    
                </section>
            @endif    
            <section class="section_2  section-color ">
                <div class="container page-builder-ltr">
                    <div class="row row_dsw3  row-style  row-color ">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_itqc  col-style">
                            <div class="clearfix bonus-menus bonus-menu-4">
                                <ul>
                                    <li class="item secure col-md-3">
                                        <div class="icon">
                                        </div>
                                        <div class="text">
                                            <h5><a>100% Secure Payments</a></h5>
                                            <p>All major credit & debit</p>
                                            <p> cards accepted</p>
                                        </div>
                                    </li>
                                    <li class="item help col-md-3">
                                        <div class="icon">
                                        </div>
                                        <div class="text">
                                            <h5><a>Help Center</a></h5>
                                            <p>Got a question? Look no further. </p>
                                            <p> Browse our FAQs or submit your here.</p>
                                        </div>
                                    </li>
                                    <li class="item trustpay col-md-3">
                                        <div class="icon">
                                        </div>
                                        <div class="text">
                                            <h5><a>TrustPay</a></h5>
                                            <p>100% Payment Protection. Easy</p>
                                            <p> Return Policy </p>
                                        </div>
                                    </li>
                                    <li class="item delivery col-md-3">
                                        <div class="icon">
                                        </div>
                                        <div class="text">
                                            <h5><a>Worldwide Delivery</a></h5>
                                            <p>With sites in 5 languages, we ship to </p>
                                            <p>over 200 countries & regions.</p>
                                        </div>
                                    </li>
                                    <li class="item value col-md-3">
                                        <div class="icon">
                                        </div>
                                        <div class="text">
                                            <h5><a>Great Value</a></h5>
                                            <p>We offer competitive prices on our 100</p>
                                            <p>million plus product range.</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section_3 ">
                <div class="container page-builder-ltr">
                    <div class="row row_4gdc  row-style ">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 col_ir5g  col-style">
                            <div class="footer-links">
                                <h4 class="title-footer">
                                    Information
                                </h4>
                                <ul class="links">
                                    <li>
                                        <a href="{{url('warranty')}}">Warranty And Services</a>
                                    </li>
                                    <li>
                                        <a href="{{url('corporate')}}">Corporate And Wholesale</a>
                                    </li>
                                    @if(Auth::check())
                                        <li>
                                            <a href="{{url('ticket')}}">General Complain</a>
                                        </li>
                                    @endif    
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 col_sa3f  col-style">
                            <div class="footer-links">
                                <h4 class="title-footer">
                                    Mobile App
                                </h4>
                                <ul class="links">
                                    <li style="margin-top:10px">
                                        <img src="https://www.okdam.com/public/images/google-play.png" width="50%" height="50%"/>
                                    </li>

                                    <li style="margin-top:10px">
                                        <img src="https://www.okdam.com/public/images/apple-store.png" width="50%" height="50%"/>
                                    </li>  
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 col_r3tw  col-style">
                            <div class="footer-links">
                                <h4 class="title-footer">
                                    Links
                                </h4>
                                <ul class="links">
                                    <li>
                                        <a href="{{url('/')}}">Home</a>
                                    </li>
                                    <li>
                                        <a href="{{url('about')}}">About</a>
                                    </li>
                                    <li>
                                        <a href="{{url('contact')}}">Contact</a>
                                    </li>
                                    <li>
                                        <a href="{{url('faq')}}">FAQ</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 col_asli  col-style">
                            <div class="footer-links">
                                <h4 class="title-footer">
                                    Contact Us
                                </h4>
                                <ul style="display: flex; flex-direction:column">
                                    <div><i class="fa fa-map-marker" style="font-size:20px"></i><a style="margin-left:10px; font-size:15px" href="#">Address : Bhakta Marga, Baluwatar</a></div>
                                    <div><i class="fa fa-phone" style="font-size:20px"></i><a style="margin-left:10px; font-size:15px" href="#">Contact : 9801119988, 9801199766</a></div>
                                    <div><i class="fa fa-envelope" style="font-size:20px"></i><a style="margin-left:10px; font-size:15px" href="#">Email : sales@meroshopping.com </a></div>
                                    <div class="social_login pull-right" id="so_sociallogin" style="margin-top:10px">
                                        <a href="https://www.facebook.com/MeroShopping" class="btn btn-social-icon btn-sm btn-facebook"><i class="fa fa-facebook fa-fw" aria-hidden="true"></i></a>
                                        <a href="https://www.youtube.com/user/MeroShopping" class="btn btn-social-icon btn-sm btn-youtube"><i class="fa fa-youtube fa-fw" aria-hidden="true"></i></a>
                                        <a href="https://api.whatsapp.com/send?phone=+977 9801119988" class="btn btn-social-icon btn-md bounce" style="background:green"><i class="fa fa-whatsapp fa-fw" aria-hidden="true"></i></a>
                                    </div>
                                </ul>
                            </div>
                        </div>
                        {{-- <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12 col_xi8a  col-style">
                            <div class="footer-links">
                                <h4 class="title-footer">
                                    My Account
                                </h4>
                                <ul class="links">
                                    <li>
                                        <a title="My Account" href="my-account.html">My Account</a>
                                    </li>
                                    <li>
                                        <a title="Account Downloads" href="#">Account Downloads</a>
                                    </li>
                                    <li>
                                        <a title="Checkout" href="cart.html">Checkout</a>
                                    </li>
                                    <li>
                                        <a href="wishlist"> Wishlist</a>
                                    </li>
                                    <li>
                                        <a title="Order History" href="order-information">Order History</a>
                                    </li>
                                    <li>
                                        <a title="Your Transactions" href="#">Your Transactions</a>
                                    </li>
                                </ul>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="footer-toggle hidden-lg hidden-md">
        <a class="showmore collapsed" data-toggle="collapse" href="#collapse-footer" aria-expanded="false" aria-controls="collapse-footer">
        <span class="toggle-more"><i class="fa fa-angle-double-down"></i>Show More</span> 
        <span class="toggle-less"><i class="fa fa-angle-double-up"></i>Show less</span>            
        </a>     
    </div>

    <div class="footer-bottom">
        <div class="container" style="padding-bottom:30px; padding-top:20px">
            <div class="row">
                <div class="col-md-5  col-sm-5 copyright">
                    Copyright  ©  2021 MeroShopping.com  All Rights Reserved
                </div>
                <div class="col-md-7 col-sm-7 payment">
                    <img src="https://www.okdam.com/public/images/we-accept-ok-dam.png"  alt="imgpayment" height="100%" width="1005">
                </div>
            </div>
        </div>
    </div>
</footer>