<x-layouts.app>
    <div class="container" style="padding-top:40px; padding-bottom:40px">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                        <h3><i class="fa fa-user fa-4x"></i></h3>
                        <h2 class="text-center">Reset Password</h2>
                        <p>You can reset your password here.</p>
                        <div class="panel-body">
                            <form id="register-form" role="form" autocomplete="off" class="form" method="post" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="form-group">
                                    <div class="input-group">
                                    <span class="input-group-addon" style="background:rgb(255,94,0)"><i class="glyphicon glyphicon-envelope color-blue" style="color:white"></i></span>
                                    <input id="email" name="email" placeholder="Email Address" class="form-control"  type="email"  value="{{ $email ?? old('email') }}" >
                                    </div>
                                    @error('email')<div class="form-group"><span style="color: red"> * {{$message}}</span></div>@enderror
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                    <span class="input-group-addon" style="background:rgb(255,94,0)"><i class="fa fa-key" style="color:white"></i></span>
                                    <input id="password" name="password" placeholder="Password" class="form-control"  type="password">
                                    </div>
                                    @error('password')<div class="form-group"><span style="color: red"> * {{$message}}</span></div>@enderror
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                    <span class="input-group-addon" style="background:rgb(255,94,0)"><i class="fa fa-key" style="color:white"></i></span>
                                    <input id="password-confirm" name="password_confirmation" placeholder="Confirm Password" class="form-control"  type="Password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('Reset Password') }}</button>
                                </div>             
                            </form>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>    
