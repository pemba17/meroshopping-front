<div class="container" style="background-color: #fff; border-radius: 10px; margin-top: 10px;">
  <h1 class="page-header text-center">Update Profile </h1>
  @if(session()->has('success'))
    <div class="alert alert-success alert-dismissable">
      <a class="panel-close close" data-dismiss="alert">×</a> 
        {{session()->get('success')}}
    </div>
  @endif  
  <form class="row mb-3" wire:submit.prevent="save()">
    <div class="col-md-2"></div>
    <div class="col-md-4">
      <div class="text-center">
        @if($photo)
        <img src="{{ $photo->temporaryUrl() }}" class="avatar img-circle img-thumbnail" alt="avatar" width="85px">
        @else
        <img src="{{auth()->user()->imageUrl()}}" class="avatar img-circle img-thumbnail" alt="avatar" width="85px">
        @endif
        <h6>Upload Your Image ...</h6>
        <input type="file" class="text-center center-block well well-sm form-control" accept="image/*" wire:model="photo">
      </div>
      <div class="form-group">
        <label class="control-label">Full Name:</label>
        <input class="form-control" type="text" wire:model="name">
        @error('name')<span style="color: red">* {{$message}}</span>@enderror
      </div>
      <div class="form-group">
        <label class="control-label">Address:</label>
        <input class="form-control" type="text" wire:model="address">
        @error('address')<span style="color: red">* {{$message}}</span>@enderror
      </div>
      <div class="form-group">
        <label class="control-label">Mobile:</label>
        <input class="form-control" type="number" wire:model="contact">
        @error('contact')<span style="color: red">* {{$message}}</span>@enderror
      </div>
      <div class="form-group">
        <label class="control-label">Phone:</label>
        <input class="form-control" type="number" wire:model="phone">
        @error('phone')<span style="color: red">* {{$message}}</span>@enderror
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label class="control-label">Date of birth:</label>
        <input class="form-control" type="date" wire:model="dob">
        @error('dob')<span style="color: red">* {{$message}}</span>@enderror
      </div>
      <div class="form-group">
        <label class="control-label">Gender:</label>
        <select name="gender" class="form-control" wire:model="gender">
          <option value="">Select Gender</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
          <option value="others">Others</option>
        </select>
        @error('gender')<span style="color: red">* {{$message}}</span>@enderror
      </div>
      <div class="form-group">
        <label class="control-label">Country:</label>
        <input class="form-control" type="text" wire:model="country" placeholder="Nepal">
        @error('country')<span style="color: red">* {{$message}}</span>@enderror
      </div>
      <div class="form-group">
        <label class="control-label">State:</label>
        <input class="form-control" type="text" wire:model="state" placeholder="Province 1">
        @error('state')<span style="color: red">* {{$message}}</span>@enderror
      </div>
      <div class="form-group">
        <label class="control-label">City:</label>
        <input class="form-control" type="text" wire:model="city" placeholder="KTM">
        @error('city')<span style="color: red">* {{$message}}</span>@enderror
      </div>
      <div class="form-group">
        <label class="control-label">Zip Code:</label>
        <input class="form-control" type="number" wire:model="zip_code" placeholder="00977">
        @error('zip_code')<span style="color: red">* {{$message}}</span>@enderror
      </div>
      <div class="form-group text-right" class="margin-top: 30px">
        <input class="btn btn-success" value="Save Changes" type="submit">
      </div>
    </div>

  </form>
</div>