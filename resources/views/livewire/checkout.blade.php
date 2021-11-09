@push('main-layout')
    <link href="{{asset('front/assets/css/themecss/so_onepagecheckout.css')}}" rel="stylesheet">
@endpush
<div>
    <div class="container">
		<ul class="breadcrumb">
			<li><a href="index.html"><i class="fa fa-home"></i></a></li>
			<li><a href="#">Checkout</a></li>
		</ul>
		<div class="row">
			<div id="content" class="col-sm-12">
				<h1>So Onepage Checkout</h1>
				<div class="so-onepagecheckout layout1">
					<div class="col-left col-lg-6 col-md-6 col-sm-6 col-xs-12">
						{{-- <div class="checkout-content login-box">
							<h2 class="secondary-title"><i class="fa fa-user"></i>Create an Account or Login</h2>
							<div class="box-inner">
								<div class="radio">
									<label>
										<input type="radio" name="account" value="register" checked="checked">Register Account</label>
								</div>

								<div class="radio">
									<label>
										<input type="radio" name="account" value="guest">Guest Checkout</label>
								</div>

								<div class="radio">
									<label>
										<input type="radio" name="account" value="login">Returning Customer</label>
								</div>
							</div>
						</div> --}}

						{{-- <div class="checkout-content checkout-login" style="">
							<fieldset>
								<h2 class="secondary-title"><i class="fa fa-unlock"></i>Returning Customer</h2>
								<div class="box-inner">
									<div class="form-group">
										<input type="text" name="login_email" value="" placeholder="E-Mail" id="input-login_email" class="form-control">
									</div>
									<div class="form-group">
										<input type="password" name="login_password" value="" placeholder="Password" id="input-login_password" class="form-control">
										<a href="#">Forgotten Password</a>
									</div>
									<div class="form-group">
										<input type="button" value="Login" id="button-login" data-loading-text="Loading..." class="btn-primary button">
									</div>
								</div>
							</fieldset>
						</div> --}}

						<div class="checkout-content checkout-register">
							<fieldset id="account">
								<h2 class="secondary-title"><i class="fa fa-user-plus"></i>Your Personal Details</h2>
								<div class="payment-new box-inner">
									{{-- <div class="form-group customer-group" style="display: none">
										<label class="control-label">Customer Group</label>
										<div class="radio">
											<label>
												<input type="radio" name="customer_group_id" value="1" checked="checked"> Default
											</label>
										</div>
									</div> --}}
									<div class="form-group required">
										<div><label>First Name</label></div>
										<input type="text" placeholder="Full Name *" id="input-payment-firstname" class="form-control"  wire:model.lazy="name">
										@error('name')<span style="color: red">* {{$message}}</span>@enderror
									</div>
								
									<div class="form-group required">
										<div><label>Email</label></div>
										<input type="email"  placeholder="E-Mail *" id="input-payment-email" class="form-control" wire:model.lazy="email">
										@error('email')<span style="color: red">* {{$message}}</span>@enderror
									</div>
									<div class="form-group required">
										<div><label>Contact Number</label></div>
										<input type="number" placeholder="Contact Number *" id="input-payment-telephone" class="form-control" wire:model.lazy="contact">
										@error('contact')<span style="color: red">* {{$message}}</span>@enderror
									</div>
								</div>
							</fieldset>
							
							<fieldset id="address">
								<h2 class="secondary-title"><i class="fa fa-map-marker"></i>Delivery Address</h2>
								<div class=" checkout-payment-form">
									<div class="box-inner">
										<form class="form-horizontal form-payment">
											<div id="payment-new" style="display: block">
												<div class="form-group required">
													<div><label>Address</label></div>
													<input type="text" placeholder="Address * " id="input-payment-address-1" class="form-control" wire:model.lazy="address">
													@error('address')<span style="color: red">* {{$message}}</span>@enderror
												</div>
												<div class="form-group required">
													<div><label>City</label></div>
													<select name="shipping_country_id" id="input-shipping-country" class="form-control" wire:model.lazy="city">
														<option value=""> Select City * </option>
														<option value="Kathmandu">Kathmandu</option>
														<option value="Biratnagar">Biratnagar</option>
													</select>	
													@error('city')<span style="color: red">* {{$message}}</span>@enderror
												</div>
												<div class="form-group required">
													<div><label>State</label></div>
													<input type="text" placeholder="State *" id="input-payment-state" class="form-control" wire:model.lazy="state">
													@error('state')<span style="color: red">* {{$message}}</span>@enderror
												</div>
											</div>
										</form>
									</div>
								</div>
							</fieldset>

							<div id="coupon_voucher_reward">
								<div class="checkout-content coupon-voucher">
									<h2 class="secondary-title"><i class="fa fa-gift"></i>Do you Have a Coupon or Voucher?</h2>
									<div class="box-inner">
										<div class="panel-body checkout-coupon">
											<label class="col-sm-2 control-label" for="input-coupon">Enter coupon code</label>
											@error('coupon')<span style="color: red">*{{$message}}</span>@enderror
											<div class="input-group">
												<input type="text" wire:model.lazy="coupon" placeholder="Enter coupon code" id="input-coupon" class="form-control">
												<span class="input-group-btn">
													<input type="button" value="Apply Coupon" id="button-coupon" data-loading-text="Loading..." class="btn-primary button" wire:click="applyCoupon()">
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>	
						</div>
					</div>

					<div class="col-right col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<section class="section-right">
							<div class="checkout-content checkout-cart">
								<h2 class="secondary-title"><i class="fa fa-shopping-cart"></i>My Cart</h2>
								<div class="box-inner">
									<div class="table-responsive checkout-product">
										<table class="table table-bordered table-hover">
											@error('quantity.*')<span style="color:red">{{$message}}</span>@enderror
											<thead>
												<tr>
													<th class="text-left name" colspan="2">Product Name</th>
													<th class="text-center quantity">Quantity</th>
													<th class="text-center checkout-price">Unit Price</th>
													<th class="text-right total">Total</th>
												</tr>
											</thead>
											<tbody>
												@foreach($carts as $key=>$row)
													<tr>
														<td class="text-left name" colspan="2">
															<a href="product.html"><img src="{{asset('front/assets/image/catalog/demo/product/travel/2-80x80.jpg')}}" alt="Bougainvilleas on Lombard Street,  San Francisco, Tokyo" title="Bougainvilleas on Lombard Street,  San Francisco, Tokyo" class="img-thumbnail"></a>
															<a href="product.html" class="product-name">{{$row['product']['name']}}</a>
														</td>
														<td class="text-left quantity">
															<div class="input-group">
																<input type="text" wire:model="quantity.{{$key}}" size="1" class="form-control">
																<span class="input-group-btn">
																	<span data-toggle="tooltip" title="" data-product-key="317" class="btn-delete" data-original-title="Remove" wire:click="removeCart({{$row['id']}})"><i class="fa fa-trash-o"></i></span>
																	<span data-toggle="tooltip" title="" data-product-key="317" class="btn-update" data-original-title="Update" wire:click="updateCart({{$row['id']}},{{$key}},{{$row['product_id']}})" ><i class="fa fa-refresh"></i></span>
																</span>
															</div>
														</td>
														<td class="text-right price">Rs {{$row['product']['price']}}</td>
														<td class="text-right total">Rs {{$row['quantity'] * $row['product']['price']}}</td>
													</tr>
												@endforeach													
											</tbody>
											<tfoot>
												<tr>
													<td colspan="4" class="text-left">Sub-Total:</td>
													<td class="text-right">Rs {{$total_sum}}</td>
												</tr>
												@if($discount>0)
													<tr>
														<td colspan="4" class="text-left">Discount:</td>
														<td class="text-right">Rs {{$discount}}</td>
													</tr>
												@endif
												
												@if($delivery_charge>0)
													<tr>
														<td colspan="4" class="text-left">Delivery Charge:</td>
														<td class="text-right">Rs {{$delivery_charge}}</td>
													</tr>
												@endif

												<tr>
													<td colspan="4" class="text-left">Total:</td>
													<td class="text-right">Rs {{$total_sum-$discount-$delivery_charge}}</td>
												</tr>
											</tfoot>
										</table>
									</div>
								</div>
							</div>

							<div class="checkout-content confirm-section">
								<div>
									<h2 class="secondary-title"><i class="fa fa-comment"></i>Add Comments About Your Order</h2>
									<label>
										<textarea name="comment" rows="8" class="form-control" wire:model.lazy="comments"></textarea>
									</label>
								</div>
								<div class="confirm-order">
									<button data-loading-text="Loading..." class="btn btn-primary button confirm-button" type="button" wire:click="save()">Confirm Order </button>
								</div>
							</div>
						</section>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>
