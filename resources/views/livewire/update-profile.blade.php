<div class="container" style="background: white; margin-top:40px">
    <h1 class="page-header text-center">Update Profile </h1>
    <form class="row" wire:submit.prevent="save()">
      <!-- left column -->
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="text-center">
          @if($photo)
            <img src="{{ $photo->temporaryUrl() }}" class="avatar img-circle img-thumbnail" alt="avatar" width="30%" >
          @else
            <img src="{{auth()->user()->imageUrl()}}" class="avatar img-circle img-thumbnail" alt="avatar" width="30%" >
          @endif
          <h6>Upload Your Image ...</h6>
          <input type="file" class="text-center center-block well well-sm" accept="image/*" wire:model="photo">
        </div>
      </div>
      <!-- edit form column -->
      <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
        @if(session()->has('success'))
          <div class="alert alert-info alert-dismissable">
            <a class="panel-close close" data-dismiss="alert">×</a> 
            <i class="fa fa-user"></i>
              {{session()->get('success')}}
          </div>
        @endif  
        <div class="form-horizontal" role="form">
          <div class="form-group">
            <label class="col-lg-3 control-label">Full Name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" wire:model="name">
              @error('name')<span style="color: red">* {{$message}}</span>@enderror
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Address:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" wire:model="address">
              @error('address')<span style="color: red">* {{$message}}</span>@enderror
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Contact:</label>
            <div class="col-lg-8">
              <input class="form-control" type="number" wire:model="contact">
              @error('contact')<span style="color: red">* {{$message}}</span>@enderror
            </div>
          </div> 
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input class="btn btn-success" value="Save Changes" type="submit">
            </div>
          </div>
        </div>
      </div>
    </div>
</div>