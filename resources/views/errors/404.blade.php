<style>
    .errorclass {
        width: 100%;
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .btn-default{
        color: #fff;
        border-radius: 3px;
        border: none;
        background: #ff5e00;
        border-color: #ff5e00;
        cursor: pointer;
        padding: 15px 20px;
    }
</style>
<div class="errorclass">
    <img width="400" style="border-radius: 5px;" src="{{asset('front/assets/image/cart-empty.png')}}" alt="" />
    <h4>404 Page Not Found</h4>
    <a href="/">
        <button class="btn-default">Go Back</button>
    </a>
</div>