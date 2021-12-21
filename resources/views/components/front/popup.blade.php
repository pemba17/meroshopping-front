@props([
    'banner'
])
<div class="modal popupmodal fade in" id="popup" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="{{$banner[0]->link}}"><img src="{{asset('images/'.$banner[0]->image)}}" class="img-fluid"></a>
            <div class="crossbutton">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="donotshowAgain()">
                <span class="fa fa-times"><span>
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    function donotshowAgain(){
        localStorage.setItem('popup', false);
    }
</script>
