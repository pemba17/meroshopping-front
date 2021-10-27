<x-layouts.app>
    <div>
        <div class="container">
            <div class="row">
                <div id="content" class="col-md-9" style="margin-top:40px;">
                    <div class="row">
                        <div class="col-sm-5" ></div>
                        <div class="col-sm-7">
                            <div class="well col-sm-12" style="background:white">    
                                <div class="text-center">
                                    <img src="http://127.0.0.1:8000/front/assets/image/catalog/demo/logo/logo-old.png" alt="Your Store" title="Your Store">
                                </div>
                                @if(session()->has('errorSocial'))<span style="color:red">* {{session()->get('errorSocial')}}</span> @endif
                                <form action="{{ route('login') }}" method="post">
                                    @csrf
                                    <div class="form-group" style="margin-top:20px">
                                        <label class="control-label" for="input-email">E-Mail Address</label>
                                        <input type="email" name="email" value="" placeholder="E-Mail Address" id="input-email" class="form-control" value="{{ old('email') }}" required>
                                        @error('email')<span style="color:red">* {{$message}}</span>@enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="input-password">Password</label>
                                        <input type="password" name="password" value="" placeholder="Password" id="input-password" class="form-control">
                                        @error('password')<span style="color:red">* {{$message}}</span>@enderror
                                    </div>

                                    <div class="form-group" style="display: flex; align-items: center;">
                                        <div> <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}></div>
                                        <div style="margin-left: 5px">
                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>    
                                    </div>

                                    @if (Route::has('password.request'))
                                        <div class="form-group">  
                                            <a href="{{ route('password.request') }}">Forgotten Password?</a>
                                        </div> 
                                    @endif
                                    <input type="submit" value="Login" class="btn btn-success pull-left">  
                                </form>
                                <div id="column-login" class="col-sm-8 pull-right">
                                    <div class="row">
                                        <div class="social_login pull-right" id="so_sociallogin">
                                            <a href="#" class="btn btn-social-icon btn-sm btn-facebook"><i class="fa fa-facebook fa-fw" aria-hidden="true"></i></a>
                                            <a href="{{ url('auth/google') }}" class="btn btn-social-icon btn-sm btn-google"><i class="fa fa-google fa-fw" aria-hidden="true"></i></a>
                                        </div>
                                    </div>    
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>   


