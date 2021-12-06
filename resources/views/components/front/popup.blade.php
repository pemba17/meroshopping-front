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

<style>
    .popupmodal{
        top: 50% !important;
        left: 50% !important;
        right: 0 !important;
        bottom: 0 !important;
        transform: translate(-50%, -50%); 
    }
    .popupmodal::-webkit-scrollbar{
        width: 0;
    }
    .crossbutton{
        position: absolute;
        top: 10px;
        right: 10px;
        
    }
    .crossbutton button{
        color: white;
    }
    .crossbutton .close{
        color: #fff !important;
        opacity: 1;
    }

    .crossbutton .close:hover{
        color: #fff !important;
    }
    @media screen and (max-width: 778px){
        .popupmodal{
            width: 100%;
        }
    }
</style>
<script>
    function donotshowAgain(){
        localStorage.setItem('popup', false);
    }
</script>