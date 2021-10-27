<x-layouts.app>
    	<!-- Main Container  -->
	<div class="main-container container">
		<ul class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i></a></li>
			<li><a href="#">Account</a></li>
			<li><a href="#">Register</a></li>
		</ul>
		
		<div class="row">
			<div id="content" class="col-md-9">
				<h2 class="title">Register Account</h2>
				<p>If you already have an account with us, please login at the <a href="#">login page</a>.</p>
				<form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" class="form-horizontal account-register clearfix">
                    @csrf
					<fieldset id="account">
						<legend>Your Personal Details</legend>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-firstname">Full Name</label>
							<div class="col-sm-10">
								<input type="text" name="name" placeholder="Full Name" id="input-firstname" class="form-control" value="{{ old('name') }}" required>
                                @error('name')<span style="color:red">* {{$message}}</span>@enderror
							</div>
                            
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-address">Address</label>
							<div class="col-sm-10">
								<input type="text" name="address" placeholder="Address" id="input-address" class="form-control" value="{{ old('address') }}">
                                @error('address')<span style="color:red">* {{$message}}</span>@enderror
							</div>
						</div>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-email">E-Mail</label>
							<div class="col-sm-10">
								<input type="email" name="email"  placeholder="E-Mail" id="input-email" class="form-control" value="{{ old('email') }}" required>
                                @error('email')<span style="color:red">* {{$message}}</span>@enderror
							</div>
						</div>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-telephone">Contact</label>
							<div class="col-sm-10">
								<input type="number" name="contact"placeholder="Contact" id="input-telephone" class="form-control" value="{{ old('contact') }}" required>
                                @error('contact')<span style="color:red">* {{$message}}</span>@enderror
							</div>
						</div>
					</fieldset>
					<fieldset>
						<legend>Your Password</legend>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-password">Password</label>
							<div class="col-sm-10">
								<input type="password" name="password" placeholder="Password" id="input-password" class="form-control" required>
                                @error('password')<span style="color:red">* {{$message}}</span>@enderror
							</div>
						</div>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-confirm">Confirm Password</label>
							<div class="col-sm-10">
								<input type="password" name="password_confirmation" placeholder="Password Confirm" id="input-confirm" class="form-control" required> 
							</div>
						</div>
					</fieldset>
                    <div class="pull-left"></a>
                        <input type="submit" value="Register" class="btn btn-success">
                    </div>
				</form>
			</div>
		</div>
	</div>
	<!-- //Main Container -->
</x-layouts.app>
