<div class="container" style="margin-top:50px">
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Success!</strong> {{session()->get('success')}}
        </div>
    @endif    
    <div class="row">
        <div id="content" class="col-sm-12">
            <div class="info-contact row">
                <div class="col-sm-6 col-xs-12 info-store">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14126.665962388915!2d85.3339865!3d27.7275818!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xaa8a910a5cc0958e!2sMero%20Shopping!5e0!3m2!1sen!2snp!4v1637649166080!5m2!1sen!2snp" width="550" height="540" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                <div class="col-sm-6 col-xs-12 contact-form">
                    <form class="form-horizontal" wire:submit.prevent="save()">
                        <fieldset>
                            <legend>
                                <h2>Contact Form </h2></legend>
                            <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam

                            </p>

                            <div class="form-group required">
                                <div class="col-sm-12">
                                    <input type="text" id="input-name" class="form-control" placeholder="Your Name *"  wire:model.lazy="name"/>
                                    @error('name')<span style="color: red">* {{$message}}</span>@enderror
                                </div>
                            </div>
                            <div class="form-group required">
                                <div class="col-sm-12">
                                    <input type="email" id="input-email" class="form-control" placeholder="E-Mail Address *" wire:model.lazy="email"/>
                                    @error('email')<span style="color: red">* {{$message}}</span>@enderror
                                </div>
                            </div>

                            <div class="form-group required">
                                <div class="col-sm-12">
                                    <input type="number" id="input-contact" class="form-control" placeholder="Contact Number *" wire:model.lazy="contact"/>
                                    @error('contact')<span style="color: red">* {{$message}}</span>@enderror
                                </div>
                            </div>

                            <div class="form-group required">
                                <div class="col-sm-12">
                                    <textarea name="enquiry" rows="10" id="input-enquiry" placeholder="Enquiry *" class="form-control" wire:model.lazy="enquiry"></textarea>
                                    @error('enquiry')<span style="color: red">* {{$message}}</span>@enderror
                                </div>
                            </div>

                        </fieldset>
                        <div class="buttons">
                            <div class="pull-left">
                                <button class="btn btn-info" type="submit"><span>Submit </span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>