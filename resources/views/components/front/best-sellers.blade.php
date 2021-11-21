@props([
    'best'
])
<div class="moduletable module so-extraslider-ltr best-seller best-seller-custom">
    <h3 class="modtitle"><span>Best Sellers</span></h3>
    <div class="modcontent">
        <div id="so_extra_slider" class="so-extraslider buttom-type1 preset00-1 preset01-1 preset02-1 preset03-1 preset04-1 button-type1">
            <div class="extraslider-inner owl2-carousel owl2-theme owl2-loaded extra-animate" data-effect="none">
                <div class="item">
                    @foreach($best as $row)
                        <div class="item-wrap style1 ">
                            <div class="item-wrap-inner">
                                <div class="media-body">
                                    <div class="item-info">
                                        <div class="item-title" style="padding-bottom: 10px">
                                            <a title="{{$row->name}}">
                                                {{$row->name}}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach    
                </div>
            </div>
        </div>
    </div>
</div>