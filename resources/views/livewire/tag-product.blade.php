<div style="margin-top: 20px">
	<div class="container product-detail">
	    <div class="row">
            <aside class="col-md-3 col-sm-4 col-xs-12 content-aside left_column sidebar-offcanvas">
				<span id="close-sidebar" class="fa fa-times"></span>
				<div class="module so_filter_wrap filter-horizontal">
					<h3 class="modtitle"><span>SHOP BY</span></h3>
					<div class="modcontent">
						<ul>
							<li class="so-filter-options" data-option="search">
								<div class="so-filter-heading">
									<div class="so-filter-heading-text">
										<span>Search</span>
									</div>
									<i class="fa fa-chevron-down"></i>
								</div>
								
							</li>
							<li class="so-filter-options" data-option="Size">
								<div class="so-filter-heading">
									<div class="so-filter-heading-text">
										<span>Search</span>
									</div>
									<i class="fa fa-chevron-down"></i>
								</div>
								<div class="so-filter-content-opts" style="display: block;">
									<div class="so-filter-content-opts-container">
										<div class="so-filter-option opt-select  opt_enable" data-type="option" data-option_value="46" data-count_product="1" data-list_product="111">
											<div class="so-option-container">
                                                 <input type="text" class="form-control" wire:model="search"/>   
											</div>
										</div>
									</div>
								</div>
							</li>
							{{-- <li class="so-filter-options" data-option="Manufacturer">
								<div class="so-filter-heading">
									<div class="so-filter-heading-text">
										<span>Brands</span>
									</div>
									<i class="fa fa-chevron-down"></i>
								</div>
								<div class="so-filter-content-opts">
									<div class="so-filter-content-opts-container">
										<div class="so-filter-option opt-select  opt_enable" data-type="manufacturer" data-manufacturer_value="8" data-count_product="4" data-list_product="30,58,61,105">
											<div class="so-option-container">
                                                <div class="form-row">
                                                    <input type="checkbox"/>
                                                    <label>Apple</label>
                                                </div>    
                                                <div class="form-row">
                                                    <input type="checkbox"/>
                                                    <label>Apple</label>
                                                </div>    
											</div>
										</div>
									</div>
								</div>
							</li> --}}
							<li class="so-filter-options" data-option="Price">
								<div class="so-filter-heading">
									<div class="so-filter-heading-text">
										<span>Price</span>
									</div>
									<i class="fa fa-chevron-down"></i>
								</div>
								<div class="so-filter-content-opts">
									<div class="so-filter-content-opts-container">
										<div class="so-filter-content-wrapper so-filter-iscroll">
											<div class="so-filter-options">
												<div class="so-filter-option so-filter-price">
													<div class="content_min_max">
														<div class="put-min put-min_max">
														<input type="number" class="form-control" wire:model="from_price">
														</div>
														<div class="put-max put-min_max">
														<input type="number" class="form-control" wire:model="to_price">
														</div>
													</div>
													<div class="content_scroll">
														<div id="slider-range"></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>
						</ul>
						<div class="clear_filter">
							<a class="btn btn-default inverse" id="btn_resetAll" wire:click.prevent="resetData()">
								<span class="hidden fa fa-times" aria-hidden="true"></span> Reset All
							</a>
						</div>
					</div>
				</div>
			</aside>
			<div id="content" class="col-md-9 col-sm-12 col-xs-12">
                <a href="javascript:void(0)" class="open-sidebar hidden-lg hidden-md"><i class="fa fa-bars"></i>Sidebar</a>
				<div class="products-category">
					<div class="form-group clearfix">
						<h3 class="title-category ">{{$tag->name}} Products</h3>
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
                                                    <img src="{{asset('images/'.$product_images[0])}} " alt="{{$row->name}}" title="{{$row->name}}" class="img-1 img-responsive">
                                                    <img src="{{asset('images/'.$product_images[0])}} " alt="{{$row->name}}" title="{{$row->name}}" class="img-2 img-responsive">
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
                                                    <button class="addToCart" type="button" data-toggle="tooltip"  data-original-title="Add to Cart " wire:click.prevent="addToCart({{$row->id}})"><span>Add to Cart </span></button>
                                                    <button class="wishlist btn-button" type="button" data-toggle="tooltip" data-original-title="Add to Wish List " wire:click.prevent="addToWishList({{$row->id}})"><i class="fa fa-heart-o"></i></button>
                                                </div>
                                            </div>
                                            <div class="button-group">
                                                <button class="wishlist btn-button" type="button" data-toggle="tooltip"  data-original-title="Add to Wish List" wire:click.prevent="addToWishList({{$row->id}})"><i class="fa fa-heart-o"></i></button>
                                                <button class="addToCart btn-button" type="button" data-toggle="tooltip"  data-original-title="Add to Cart" wire:click.prevent="addToCart({{$row->id}})"><span class="hidden">Add to Cart </span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty    
                                <h3 class="text-center" style="color: red">* No Records Found</h3>
                            @endforelse    
                        </div>
                        <div style="float:right">{{$products->links('pagination-links')}}</div> 	
				    </div>
			    </div>
		    </div>
	    </div>
    </div>
</div>    
