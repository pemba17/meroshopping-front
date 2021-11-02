<div class="container">
    <ul class="breadcrumb">
        <li><a href="index.html"><i class="fa fa-home"></i></a></li>
        <li><a href="#">Shopping Cart</a></li>
    </ul>
    
    <div class="row">
        <div id="content" class="col-sm-12">
            <h1>My Cart
            </h1>
            @if(session()->has('success'))
                <div class="alert alert-danger alert-dismissable">
                    <a class="panel-close close" data-dismiss="alert">×</a> 
                    <i class="fa fa-shopping-cart"></i>
                    {{session()->get('success')}}
                </div>
            @endif

            @if ($errors->has('quantity.*'))
                <div class="alert alert-danger alert-dismissable">
                    <a class="panel-close close" data-dismiss="alert">×</a> 
                    <ul>
                        @foreach($errors->get('quantity.*') as $errors)
                            @foreach($errors as $error)
                                <li>* {{ $error }}</li>
                            @endforeach
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td class="text-center">Image</td>
                            <td class="text-left">Product Name</td>
                            <td class="text-left">Quantity</td>
                            <td class="text-right">Unit Price</td>
                            <td class="text-right">Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($details as $key=>$row)
                            <tr>
                                <td class="text-center"> <a href="product.html"><img src="{{asset('front/assets/image/catalog/demo/product/travel/10-80x80.jpg')}}" alt="Bougainvilleas on Lombard Street,  San Francisco, Tokyo" title="Bougainvilleas on Lombard Street,  San Francisco, Tokyo" class="img-thumbnail""></a> </td>
                                <td class="text-left"><a href="#">{{$row->product->name}}</a><br>
                                    {{-- <small>Size: M</small><br>   
                                    <small>Color: Red</small>                                                  --}}
                                </td>
                                <td class="text-left"><div class="input-group btn-block" style="max-width: 200px;">
                                    <input type="text" size="1" class="form-control" wire:model="quantity.{{$key}}">
                                    <span class="input-group-btn">
                                    <button type="submit" data-toggle="tooltip" title="" class="btn btn-primary" wire:click.prevent="updateCart({{$row->id}},{{$key}})" data-original-title
                                    ="Update"><i class="fa fa-refresh"></i></button>
                                    <button type="button" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Remove" wire:click.prevent="removeCart({{$row->id}})" onclick="confirm('Are You Sure?') || event.stopImmediatePropagation();"><i class="fa fa-times-circle"></i></button>
                                    </span></div></td>
                                <td class="text-right">Rs {{$row->product->price}}</td>
                                <td class="text-right">Rs {{$row->quantity * $row->product->price}}</td>
                            </tr>
                        @empty
                            <tr><td colspan="6" style="color: red">* No Records Found</td></tr>
                        @endforelse    
                    </tbody>  
                </table>
            </div>
            <h2>What would you like to do next?</h2>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
            <div class="panel-group" id="accordion">         <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="#collapse-coupon" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion">Use Coupon Code <i class="fa fa-caret-down"></i></a></h4>
                </div>
                <div id="collapse-coupon" class="panel-collapse collapse">
                    <div class="panel-body">
                        <label class="col-sm-2 control-label" for="input-coupon">Enter your coupon here</label>
                        <div class="input-group">
                            <input type="text" name="coupon" value="" placeholder="Enter your coupon here" id="input-coupon" class="form-control">
                            <span class="input-group-btn">
                                <input type="button" value="Apply Coupon" id="button-coupon" data-loading-text="Loading..." class="btn btn-primary">
                            </span>
                        </div>
                    </div>
                </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="#collapse-voucher" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Use Gift Certificate <i class="fa fa-caret-down"></i></a></h4>
                    </div>
                    <div id="collapse-voucher" class="panel-collapse collapse">
                        <div class="panel-body">
                            <label class="col-sm-2 control-label" for="input-voucher">Enter your gift certificate code here</label>
                            <div class="input-group">
                                <input type="text" name="voucher" value="" placeholder="Enter your gift certificate code here" id="input-voucher" class="form-control">
                                <span class="input-group-btn">
                                    <input type="submit" value="Apply Gift Certificate" id="button-voucher" data-loading-text="Loading..." class="btn btn-primary">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-4 col-sm-offset-8">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="text-right"><strong>Sub-Total:</strong></td>
                                <td class="text-right">Rs {{$total_sum}}</td>
                            </tr>
                            {{-- <tr>
                                <td class="text-right"><strong>Eco Tax (-2.00):</strong></td>
                                <td class="text-right">$2.00</td>
                            </tr>
                            <tr>
                                <td class="text-right"><strong>VAT (20%):</strong></td>
                                <td class="text-right">$19.80</td>
                            </tr> --}}
                            <tr>
                                <td class="text-right"><strong>Total:</strong></td>
                                <td class="text-right">Rs {{$total_sum}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="buttons clearfix">
                <div class="pull-left"><a href="{{url('/')}}" class="btn btn-default">Continue Shopping</a></div>
                <div class="pull-right"><a onclick="event.preventDefault(); document.getElementById('checkout-form').submit();" class="btn btn-primary">Checkout</a></div>
                <form method="POST" action="{{url('/checkout')}}" id="checkout-form">
                    @csrf
                    <input type="hidden" name="cart" value="{{$details}}">
                    <input type="hidden" name="total_sum" value="{{$total_sum}}">
                <form>
            </div>
        </div>
    </div>
</div>

