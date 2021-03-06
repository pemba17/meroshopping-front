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
                @if(session()->has('color'))
                    <div class="alert alert-{{session()->get('color')}} alert-dismissable">
                @else <div class="alert alert-danger alert-dismissable">        
                @endif        
                    <a class="panel-close close" data-dismiss="alert">×</a> 
                    <i class="fa fa-shopping-cart"></i>
                    {{session()->get('success')}}
                </div>
            @endif

            @error('quantity.*')
                <div class="alert alert-danger alert-dismissable">
                    <a class="panel-close close" data-dismiss="alert">×</a> 
                    {{$message}}
                </div>
            @enderror

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td class="text-center">Image</td>
                            <td class="text-left">Product Name</td>
                            <td class="text-left">Quantity</td>
                            <td class="text-right">Unit Price</td>
                            <td class="text-right">Total</td>
                            <td class="text-center">Action</td>  
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($details as $key=>$row)
                            <tr>
                                @php $image=explode(',',$row->product->filename);@endphp
                                <td class="text-center"><a href="{{url('product/'.$row->product->urlname)}}"><img src="{{asset('images/'.$image[0])}}" alt="{{$row->product->name}}" title="{{$row->product->name}}" class="img-thumbnail" width="80" height="80" style="object-fit: cover"></a> </td>
                                <td class="text-left"><a href="{{url('product/'.$row->product->urlname)}}">{{$row->product->name}}</a>
                                    @php
                                    $size_name=DB::table('sizes')->where('id',$row->size_id)->first();
                                    $color_name=DB::table('colors')->where('id',$row->color_id)->first();
                                    
                                    @endphp  
                                    @if($size_name)<br><small>Size {{$size_name->name}}</small>@endif
                                    @if($color_name)<br><small>Color {{$color_name->name}}</small>@endif
                                </td>
                                <td class="text-left">
                                    <div class="displayflex">
                                        <button class="btn btn-warning custombtncol" wire:click.prevent="decrement({{$key}})"> 
                                            <i class="fa fa-minus"></i>
                                        </button>
                                        <input type="number" min="1" class="form-control numberinput" wire:model="quantity.{{$key}}">
                                            <button class="btn btn-success custombtncolright" wire:click.prevent="increment({{$key}})"> 
                                                <i class="fa fa-plus"></i>
                                            </button>
                                    </div>    
                                </td>
                                <td class="text-right">Rs {{$row->product->price}}</td>
                                <td class="text-right">Rs {{$row->quantity * $row->product->price}}</td>

                                <td class="text-center">
                                    <div class="input-group btn-block">
                                        <span class="input-group-btn">
                                            <button type="submit" data-toggle="tooltip" title="" class="btn btn-primary" wire:click.prevent="updateCart({{$row->id}},{{$key}} @if($color_name),{{$color_name->id}} @endif @if($size_name),{{$size_name->id}} @endif)" data-original-title
                                                ="Update">
                                                <i class="fa fa-refresh"></i>
                                            </button>

                                            <button type="button" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Remove" wire:click.prevent="removeCart({{$row->id}})" onclick="confirm('Are You Sure?') || event.stopImmediatePropagation();"><i class="fa fa-times-circle"></i></button>
                                        </span>
                                    </div>    
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" style="color: red">* No Records Found</td></tr>
                        @endforelse    
                    </tbody>  
                </table>
            </div>

            @if(count($details)>0)
                <h2>What would you like to do next?</h2>
                <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
                @if(session()->has('couponError')) <span style="color: red">* {{session()->get('couponError')}}</span> @endif
                @error('coupon')<span style="color: red">* {{$message}}</span>@enderror
                <div class="panel-group" id="accordion"><div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="#collapse-coupon" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion">Use Coupon Code <i class="fa fa-caret-down"></i></a></h4>
                    </div>
                    <form id="collapse-coupon" class="panel-collapse collapse">
                        <div class="panel-body">
                            <label class="col-sm-2 control-label" for="input-coupon">Enter your coupon here</label>
                            <div class="input-group">
                                <input type="text" wire:model.lazy="coupon" placeholder="Enter your coupon here" id="input-coupon" class="form-control">
                                <span class="input-group-btn">
                                    <input type="button" value="Apply Coupon" id="button-coupon" data-loading-text="Loading..." class="btn btn-primary" wire:click="applyCoupon()">  
                                </span>
                            </div>
                        </div>
                    </form>
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
                                @if($discount>0)
                                    <tr>
                                        <td class="text-right"><strong>Discount ({{$couponPercent}}%) :</strong></td>
                                        <td class="text-right">{{$discount}}</td>
                                    </tr>
                                @endif    
                                <tr>
                                    <td class="text-right"><strong>Total:</strong></td>
                                    <td class="text-right">Rs {{$total_sum-$discount}}</td>
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
                        <input type="hidden" name="discount" value="{{$discount}}">
                        <input type="hidden" name="couponPercent" value="{{$couponPercent}}">
                    <form>
                </div>
            @endif    
        </div>
    </div>
</div>

