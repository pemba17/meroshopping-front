<div>
    <div class="main-container container" style="margin-top:20px ">
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Success!</strong> {{session()->get('success')}}
            </div>
        @endif 
		<div class="row">
			<div id="content" class="col-md-9">
				<h2 class="title">Open Ticket</h2>
				<p>Please complete the form below to open the ticket.</p>
				<form class="form-horizontal" wire:submit.prevent="save()">
					<fieldset>
						<div class="form-group required">
							<label for="input-firstname" class="col-sm-2 control-label">Title</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="input-firstname" placeholder="Title" wire:model.lazy="title">
                                @error('title')<span style="color:red">* {{$message}}</span>@enderror
							</div>
						</div>
                        <div class="form-group">
							<label for="input-comment" class="col-sm-2 control-label">Description</label>
							<div class="col-sm-10">
								<textarea class="form-control" id="input-comment" placeholder="description" rows="10" wire:model.lazy="description"></textarea>
                                @error('description')<span style="color:red">* {{$message}}</span>@enderror
							</div>
						</div>
					</fieldset>
					<div class="buttons clearfix">
						<div class="pull-right">
							<input type="submit" class="btn btn-success" value="Submit">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
