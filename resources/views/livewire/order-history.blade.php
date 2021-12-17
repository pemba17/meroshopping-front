<div style="margin-top:20px">
    <div class="main-container container">
		<ul class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i></a></li>
			<li><a href="#">My Order History</a></li>
		</ul>
		
		<div class="row">
			<!--Middle Part Start-->
			<div id="content" class="col-md-12">
				<h2 class="title">My Order History</h2>
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<td class="text-center">Order ID</td>
								<td class="text-left">Product Name</td>
								<td class="text-left">Qty</td>
								<td class="text-center">Status</td>
								<td class="text-center">Order Created</td>
								<td class="text-right">Total</td>
								<td class="text-right">View</td>
							</tr>
						</thead>
						<tbody>
							@forelse($history as $row)
								<tr>
									<td class="text-center"># {{$row->id}}</td>
									<td>
										@foreach($row->product as $product)
											<div><a href="{{url('product/'.$product->urlname)}}">{{$product->name}}</a></div>
										@endforeach	
									</td>
									<td>
										@foreach($row->orderProduct as $order_product)
											<div><a href="">{{$order_product->quantity}}</a></div>
										@endforeach	
									</td>
									<td class="text-center">{{ucfirst($row->order_status)}}</td>
									<td class="text-center">{{$row->created_at->toDateString()}}</td>
									<td class="text-right">Rs {{$row->total_amount}}</td>
									<td class="text-center"><a class="btn btn-info" title="" data-toggle="tooltip" href="{{url('order-received/'.$row->id)}}" data-original-title="View"><i class="fa fa-eye"></i></a>
									</td>
								</tr>
							@empty
								<tr><td colspan="7">* No Records Found</td></tr>
							@endforelse	
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
