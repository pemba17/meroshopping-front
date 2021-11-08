<div>
    <div class="main-container container">
		<ul class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i></a></li>
			<li><a href="#">Order Infomation</a></li>
		</ul>
		
		<div class="row">
			<!--Middle Part Start-->
			@if(session()->has('success'))
				<div class="alert alert-success alert-dismissable">
					<a class="panel-close close" data-dismiss="alert">×</a> 
					<i class="fa fa-shopping-cart"></i>
					{{session()->get('success')}}
				</div>
			@endif
			<div id="content" class="col-md-12">
				<h2 class="title">Order Information</h2>

				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<td colspan="2" class="text-left">Order Details</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="width: 50%;" class="text-left"> <b>Order ID:</b> #{{$orders->id}}
								<br>
								<b>Date Added:</b> {{$orders->created_at}}</td>
							<td style="width: 50%;" class="text-left"> <b>Payment Method:</b> {{$orders->payment_type}}
								<br>
								<b>Shipping Method:</b> Flat Shipping Rate </td>
						</tr>
					</tbody>
				</table>
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<td style="width: 50%; vertical-align: top;" class="text-left">User Information</td>
							<td style="width: 50%; vertical-align: top;" class="text-left">Delivery Address</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="text-left">Name: {{$orders->name}}
								<br>Email: {{$orders->email}}
								<br>Contact: {{$orders->contact}}
								
							<td class="text-left">Address: {{$orders->address}}
								<br>City: {{$orders->city}}
								<br>State: {{$orders->state}}
						</tr>
					</tbody>
				</table>
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<td class="text-left">Product Name</td>
								<td class="text-right">Quantity</td>
								<td class="text-right">Price</td>
								<td class="text-right">Total</td>
								<td style="width: 20px;"></td>
							</tr>
						</thead>
						<tbody>
							@foreach($order_products as $row)
								<tr>
									<td class="text-left">{{$row->name}} </td>
									<td class="text-right">{{$row->quantity}}</td>
									<td class="text-right">Rs {{$row->price}}</td>
									<td class="text-right">Rs {{$row->price}}</td>
								</tr>
							@endforeach		
						</tbody>
						<tfoot>
							<tr>
								<td colspan="2"></td>
								<td class="text-right"><b>Sub Total -</b>
								</td>
								<td class="text-right">Rs {{$orders->amount}}</td>
								<td></td>
							</tr>
							<tr>
								<td colspan="2"></td>
								<td class="text-right"><b>Discount -</b>
								</td>
								<td class="text-right">Rs {{$orders->discount}}</td>
								<td></td>
							</tr>

							<tr>
								<td colspan="2"></td>
								<td class="text-right"><b>Delivery Charge -</b>
								</td>
								<td class="text-right">Rs {{$orders->delivery_charge}}</td>
								<td></td>
							</tr>
							<tr>
								<td colspan="2"></td>
								<td class="text-right"><b>Total -</b>
								</td>
								<td class="text-right">Rs {{$orders->total_amount}}</td>
								<td></td>
							</tr>
						</tfoot>
					</table>
				</div>
				<div class="buttons clearfix">
					<div class="pull-right"><a class="btn btn-primary" href="{{url('/')}}">Continue Shopping</a>
					</div>
				</div>
			</div>
			<!--Middle Part End-->
		</div>
	</div>
</div>
