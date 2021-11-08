<x-layouts.app>
    <style>
        img { border: 0; }
        img.highlight { border: 3px solid orange; }
    </style>
   <div class="container">
       <div class="row" style="cursor: pointer">
           <h2 class="text-center" style="padding-bottom: 40px; font-family:Impact;">Select Your Payment</h2>
           <div class="col-lg-3 col-md-3" style="display: flex; justify-content:center; padding-bottom:40px">
               <img src="https://esewa.com.np/common/images/esewa-logo.png" width="40%" class="img-thumbnail" style="padding:10px" id="esewa-logo"/>
           </div>
           <div class="col-lg-3 col-md-3" style="display: flex; justify-content:center;padding-bottom:40px"><img src="https://d7vw40z4bofef.cloudfront.net/static/2.69.07-web19/images/khalti-logo.svg"  width="40%" class="img-thumbnail" style="padding:10px" id="khalti-logo"  ></div>
           <div class="col-lg-3 col-md-3" style="display: flex; justify-content:center;padding-bottom:40px"> <img src="https://www.imepay.com.np/wp-content/themes/WPSTARTER/pagoda_s/img/logo/ime-red.png"  width="40%" class="img-thumbnail" style="padding: 10px" id="ime-logo"/></div>
           <div class="col-lg-3 col-md-3" style="display: flex; justify-content:center;padding-bottom:40px"> <img src="https://cdn.fonepay.com/fonepay-website/image/FonepayRequiredLogos/Fonepay-logo.svg"  width="40%" class="img-thumbnail" style="padding: 10px" id="fone-logo"/></div>
       </div>

       <div class="row" style="cursor: pointer">
            <div class="col-lg-3 col-md-3" style="display: flex; justify-content:center;padding-bottom:40px"> <img src="http://cdn.onlinewebfonts.com/svg/img_462170.png"  width="40%" class="img-thumbnail" style="padding: 10px" id="cod"/></div>
        </div>

       <div class="text-center"><button class="btn btn-success" onclick="" id="select">Proceed</button></div>

       <form method="POST" action="{{url('/orders')}}" id="cod-form">
        @csrf
            <input type="hidden" name="cart_id" value="{{$data['cart_id']}}">
            <input type="hidden" name="amount" value="{{$data['amount']}}">
            <input type="hidden" name="checkout_id" value="{{$data['checkout_id']}}"/>
            <input type="hidden" name="product_id" value="{{$data['product_id']}}"/>
            <input type="hidden" name="quantity" value="{{$data['quantity']}}"/>
            <input type="hidden" name="payment_type" value="cod"/>
       </form>
    </div>  

   <script>
       var $images = $('img');
       var id;
        $images.click(function () {
            $images.removeClass('highlight');
            $(this).addClass('highlight');
            id=$(this).attr('id');
        });

        $('#select').click(function(e){
            if(id=='cod'){
                e.preventDefault();
                $('#cod-form').submit();  
            }
        });
   </script>
</x-layouts.app>    