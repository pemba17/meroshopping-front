<div>
    <div class="container">
	    <ul class="breadcrumb">
	        <li><a href="index.html"><i class="fa fa-home"></i></a></li>
	        <li><a href="#">Account</a></li>
	        <li><a href="wishlist.html">My Wish List</a></li>
	    </ul>
	    <div class="row">
	        <div id="content" class="col-sm-12">
	            <h2>My Wish List</h2>
				@if(session()->has('success'))
					<div class="alert alert-success alert-dismissable">
						<a class="panel-close close" data-dismiss="alert">×</a> 
						<i class="fa fa-shopping-cart"></i>Success! {{session()->get('success')}}
					</div>
				@endif
	            <div class="table-responsive">
	                <table class="table table-bordered table-hover">
	                    <thead>
	                        <tr>
	                            <td class="text-center">SN</td>
	                            <td class="text-left">Product Name</td>
	                            <td class="text-left">Price</td>
	                            <td class="text-right">Action</td>
	                        </tr>
	                    </thead>
	                    <tbody>
							@forelse($wishlist as $key=>$row)
								<tr>
									<td class="text-center">{{++$key}}</td>
									<td class="text-left"><a href="product.html">{{$row->product->name}}</a></td>
									<td class="text-left"><a href="product.html">Rs {{$row->product->price}}</a></td>
									<td class="text-right">
										<button type="button"  data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Add to Cart"  wire:click.prevent="addCart({{$row->product->id}})" onclick="confirm('Add To Cart?') || event.stopImmediatePropagation();"><i class="fa fa-shopping-cart"></i></button>
										<button data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Remove" wire:click.prevent="removeWishList({{$row->id}})" onclick="confirm('Are You Sure?') || event.stopImmediatePropagation();"><i class="fa fa-times"></i></button>
									</td>
								</tr>
							@empty
								<tr><td colspan="4" style="color: red">* No Records Found</td></tr>
							@endforelse	
	                    </tbody>
	                </table>
	            </div>
	            <div class="buttons clearfix">
	                <div class="pull-right"><a href="{{url('/')}}" class="btn btn-primary">Continue Shopping</a></div>
	            </div>
	        </div>
	    </div>
	</div>
</div>
