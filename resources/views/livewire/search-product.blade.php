<div style="margin-top: 20px">
	<div class="container product-detail">
	    <div class="row">
			<div id="content" class="col-md-12 col-sm-12 col-xs-12">
				<div class="products-category">
					<div class="form-group clearfix">
						<h3 class="title-category ">Search Products</h3>
					</div>
					<div class="products-category">
                        <div class="product-filter filters-panel">
                            <div class="row">
                                @if(count($products)>0)
                                    <div class="col-sm-2 view-mode hidden-sm hidden-xs">
                                        <div class="list-view">
                                            <button class="btn btn-default grid active" data-view="grid" data-toggle="tooltip"  data-original-title="Grid"><i class="fa fa-th"></i></button>
                                            <button class="btn btn-default list" data-view="list" data-toggle="tooltip" data-original-title="List"><i class="fa fa-th-list"></i></button>
                                        </div>
                                    </div>	
                                    <div class="short-by-show form-inline text-right col-md-10 col-sm-12">
                                        <div class="form-group short-by">
                                            <label class="control-label" for="input-sort">Sort By:</label>
                                            <select id="input-sort" class="form-control" wire:model="sort">
                                                <option value="">Select</option>
                                                <option value="Low To High">Price (Low &gt; High)</option>
                                                <option value="High To Low">Price (High &gt; Low)</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="input-limit">Show:</label>
                                            <select id="input-limit" class="form-control" wire:model="perPage">
                                                <option value="6">6</option>
                                                <option value="9">9</option>
                                                <option value="12">12</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif    
                            </div>
                        </div>
                            
                        <div class="products-list grid row number-col-3 so-filter-gird">
                            @forelse($products as $row)
                                <div class="product-layout col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                    <div class="product-item-container">
                                        <div class="left-block">
                                            <div class="product-image-container  second_img  ">
                                                <a href="{{url('product/'.$row->urlname)}}" title="{{$row->name}} ">
                                                    @php $product_images=explode(',',$row->filename);@endphp
                                                    <img src="{{asset('images/'.$product_images[0])}} " alt="{{$row->name}}" title="{{$row->name}}" class="img-1 img-responsive" style="height: 250px; object-fit:cover;">
                                                    <img src="{{asset('images/'.$product_images[0])}} " alt="{{$row->name}}" title="{{$row->name}}" class="img-2 img-responsive" style="height: 250px; object-fit:cover;">
                                                </a>
                                            </div>
                                        </div>
                                        
                                        <div class="right-block">
                                            <div class="caption">
                                                <h4><a href="{{url('product/'.$row->urlname)}}">{{$row->name}}</a></h4>
                                                <div class="total-price">
                                                    <div class="price price-left">
                                                        <span class="price-new">Rs {{$row->price}}</span> 
                                                    </div>
                                                </div>
                                                <div class="description item-desc hidden">
                                                    <p>{{$row->urlname}} </p>
                                                </div>
                                                <div class="list-block hidden">
                                                    {{-- <button class="addToCart" type="button" data-toggle="tooltip"  data-original-title="Add to Cart " wire:click.prevent="addToCart({{$row->id}})"><span>Add to Cart </span></button> --}}
                                                    <button class="wishlist btn-button" type="button" data-toggle="tooltip" data-original-title="Add to Wish List " wire:click.prevent="addToWishList({{$row->id}})"><i class="fa fa-heart-o"></i></button>
                                                </div>
                                            </div>
                                            <div class="button-group">
                                                <button class="wishlist btn-button" type="button" data-toggle="tooltip"  data-original-title="Add to Wish List" wire:click.prevent="addToWishList({{$row->id}})"><i class="fa fa-heart-o"></i></button>
                                                {{-- <button class="addToCart btn-button" type="button" data-toggle="tooltip"  data-original-title="Add to Cart" wire:click.prevent="addToCart({{$row->id}})"><span class="hidden">Add to Cart </span></button> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty    
                                <div style="display: flex; flex-direction: column; align-items:center; justify-content: center;">
                                    <img width="200" style="border-radius: 5px;" src="{{asset('front/assets/image/no-record-found.png')}}" alt="" />
                                    <h4 style="margin-top: 20px;">
                                        Search Result Not Found
                                    </h5>
                                    <p>We're sorry. We cannot find any matches for your search term.</p>
                                </div>
                            @endforelse    
                        </div>
                        <div style="float:right">{{$products->links('pagination-links')}}</div> 	
				    </div>
			    </div>
		    </div>
	    </div>
    </div>
</div>    
