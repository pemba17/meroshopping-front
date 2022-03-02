<x-layouts.app>
    <style>
        img { border: 0; }
        img.highlight { border: 3px solid orange; }
    </style>
   <div class="container">
       <div id="loadingScreen" style="display: none">
           @include('loading')
       </div>
       <div class="row" style="cursor: pointer">
           <h2 class="text-center" style="padding-bottom: 40px; font-family:Impact;">Select Your Payment</h2>
           <div class="col-lg-3 col-md-3" style="display: flex; justify-content:center; padding-bottom:40px">
               <img src="https://esewa.com.np/common/images/esewa-logo.png" width="40%" class="img-thumbnail" style="padding:10px" id="esewa-logo"/>
           </div>
           <div class="col-lg-3 col-md-3" style="display: flex; justify-content:center;padding-bottom:40px"><img src="https://d7vw40z4bofef.cloudfront.net/static/2.69.07-web19/images/khalti-logo.svg"  width="40%" class="img-thumbnail" style="padding:10px" id="khalti-logo"></div>
           {{-- <div class="col-lg-3 col-md-3" style="display: flex; justify-content:center;padding-bottom:40px"> <img src="https://www.imepay.com.np/wp-content/themes/WPSTARTER/pagoda_s/img/logo/ime-red.png"  width="40%" class="img-thumbnail" style="padding: 10px" id="ime-logo"/></div> --}}
           <div class="col-lg-3 col-md-3" style="display: flex; justify-content:center;padding-bottom:40px"> <img src="{{url('front/assets/image/payment-logo/visa.png')}}"  width="40%" class="img-thumbnail" style="padding: 10px" id="nabil-logo"/></div>
           <div class="col-lg-3 col-md-3" style="display: flex; justify-content:center;padding-bottom:40px"> <img src="http://cdn.onlinewebfonts.com/svg/img_462170.png"  width="40%" class="img-thumbnail" style="padding: 10px" id="cod"/></div>
       </div>
    
       <div class="text-center"><button class="btn btn-success" id="select">Proceed To Payment</button></div>

       <form method="POST" action="{{url('/orders')}}" id="cod-form">
        @csrf
            <input type="hidden" name="details" value="{{$json_data}}"/>   
            <input type="hidden" name="temp_id" value="{{$temp_id}}"/>   
       </form>

       <form action="https://uat.esewa.com.np/epay/main" method="POST" id="esewa-form">
            <input value="{{$data['total_amount']}}" name="tAmt" type="hidden">
            <input value="{{$data['total_amount']}}" name="amt" type="hidden">
            <input value="0" name="txAmt" type="hidden">
            <input value="0" name="psc" type="hidden">
            <input value="0" name="pdc" type="hidden">
            <input value="EPAYTEST" name="scd" type="hidden">
            <input value="{{$temp_id}}" name="pid" type="hidden">
            <input value="{{route('esewa.success')}}" type="hidden" name="su">
            <input value="{{route('esewa.fail')}}" type="hidden" name="fu">
        </form>

        <form action="{{url('/khalti')}}" id="khaltiForm" method="POST">
            @csrf
            <input type="hidden" id="payment_data" name="payment_data" value=""/>
            <input type="hidden" id="amount" name="amount" value="{{$data['total_amount']}}"/>
            <input type="hidden" id="productID" name="productID" value="{{$temp_id}}"/>
            <input type="hidden" id="productName" name="productName" value="{{$product_name}}"/>
            <input type="hidden" id="productURL" name="productURL" value="{{url('/'.$product_slug)}}"/>
            <button type="button" id="payment-button" style="display: none"></button> 
        </form>

        {{-- <form action="{{url('nabil-check')}}" id="nabilForm" method="POST">
            @csrf
            <input type="hidden" id="status" name="status"/>
        </form> --}}

        <form action="" id="nabilForm" method="POST">
            @csrf
            <input type="hidden" id="OrderID" name="OrderID"/>
            <input type="hidden" id="SessionID" name="SessionID"/>
            <input type="hidden" id="btnSubmit" name="btnSubmit" value="Submit" />
        </form>
    </div>  

    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
    <script>
        var config = {
            // replace the publicKey with yours
            "publicKey": "test_public_key_fefdf8b276f04f1886f38ed3e012535c",
            "productIdentity": document.getElementById("productID").value,
            "productName": document.getElementById("productName").value,
            "productUrl": document.getElementById("productURL").value,
            "paymentPreference": [
                "KHALTI",
                "EBANKING",
                "MOBILE_BANKING",
                "CONNECT_IPS",
                "SCT",
                ],
            "eventHandler": {
                onSuccess (payload) {
                    document.getElementById("payment_data").value = JSON.stringify(payload);
                    document.getElementById('khaltiForm').submit();
                    document.getElementById('loadingScreen').style.display="hide";
                },
                onError (error) {
                    console.log(error);
                    document.getElementById('loadingScreen').style.display="hide";
                },
                onClose () {
                    console.log('widget is closing');
                    document.getElementById('loadingScreen').style.display="hide";
                }
            }
        };

        var checkout = new KhaltiCheckout(config);
        var btn = document.getElementById("payment-button");
        btn.onclick = function () {
            checkout.show({amount: (document.getElementById("amount").value*100)});
            document.getElementById('loadingScreen').style.display="block";
        }
    </script>
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

            if(id=='esewa-logo'){
                e.preventDefault();
                $('#esewa-form').submit();  
            }

            if(id=='khalti-logo'){
                e.preventDefault();
                $('#payment-button').click();
            }

            if(id=='nabil-logo'){
                $.ajax({
                    url: "http://127.0.0.1:8000/nabil-payment",
                    type:"POST",
                    data:{
                        "_token": "{{ csrf_token() }}",
                        // amount:'<?php echo $data['total_amount'];?>',
                        amount:1,
                        productID: '<?php echo $temp_id;?>'
                    },
                    success:function(response){     
                        if(response.success.status==00){
                            $('#OrderID').val(response.success.data.Response.Order.OrderID);
                            $('#SessionID').val(response.success.data.Response.Order.SessionID);
                            $('#nabilForm').prop('action', response.success.url);
                            $('#nabilForm').submit();
                        }    
                    },
         	    });	
            }
        });
   </script>
</x-layouts.app>    