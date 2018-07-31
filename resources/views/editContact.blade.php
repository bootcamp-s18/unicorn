@extends('layouts.app')

@section('content')
<form method="post" action="/contact/{{ $contact->id }}">
		@csrf
		@method('PUT')

<div id="contact-card" class="m-3" style="max-width: 680px;">
  <div class="container">
    <div class="card border border-dark">

      <h6 class="card-header">Create/Edit your contact</h6>

        <div class="card-body text-center p-1">
          <a href="#" class="btn btn-primary btn-sm float-right mr-5">Save Changes</a>
        </div>

        <div class="media border border-dark rounded align-self-center" style="width: 600px; height: 240px;">
            <div class="col-sm-4 p-2" style="max-width: 180px;">
              <div class="thumbnail">
                <img class="align-self-start rounded" style="width: 150px;" src="/images/img_avatar1.png" alt="Generic placeholder image">
                  <a style="color: #fff" href="#">X</a>
                  <center>
                    <button class="btn btn-sm float-center m-1">Add Photo</button>
                  </center>
                </div>
            </div>

            <!-- input fields and buttons -->
            <div class="media-body text-left col-sm-8">
              <div class="form-group p-2">
                <div class="row">
                  <!-- first name input -->
                  <label><h6 class="mb-0">First Name<h6></label>
                    <div class="input-group width: 350px; rounded">
			                   <input type="text" class="form-control" name="firstName" id="first_name" value="{{ $contact->first_name }}">
                      <div class="input-group-append">
                        <button class="btn btn-sm btn-dark" type="button">x</button>
                      </div>
                    </div>
                  </div>
                <!-- last name input -->
                <div class="row">
                  <label><h6 class="mb-0">Last Name</h6></label>
                    <div class="input-group">
                    	<input class="form-control" id="lastName" name="last_name" rows="3" value="{{ $contact->last_name }}">
                      <div class="input-group-append">
                        <button class="btn btn-sm btn-dark" type="button">x</button>
                      </div>
                    </div>
                </div>
                  <!-- phone number input -->
                  <div class="row">
                    <div class="input-group mt-3">
                        <div class="col-xs-3 m-1" style="width: 25px;">
                          <div class="icon p-2">
                          <i class="fas fa-phone"></i>
                          </div>
                        </div>
                        <div class="col-xs-3 m-1">
                          <input class="form-control input-sm" type="text" style="width: 62px;" placeholder="(###)">
                        </div>
                        <div class="col-xs-3 m-1">
                          <input class="form-control input-sm" type="text" style="width: 62px;" placeholder="####">
                        </div>
                        <div class="col-xs-3 m-1">
                          <div class="input-group">
                            <input class="form-control input-sm" type="text" style="width: 62px;" placeholder="####">
                            <div class="input-group-append">
                              <button class="btn btn-sm btn-dark" type="button">x</button>
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
            <!-- end of media box -->
            </div>
          </div>
        </div>

        <!-- dropdown link -->
        <div id="editMenu" class="container text-center mt-1 mb-1">
        <div class="dropdown">
          <a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-plus"></i> Add More
          </a>
          <div class="dropdown-menu text-center mt-1" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="#">Email</a>
            <a class="dropdown-item" href="#">Address</a>
            <a class="dropdown-item" href="#">Birthday</a>
          </div>
        </div>

    </div>
  </div>
</div>


    	<!-- <div class="form-group">
        <label for="personal_email">Personal Email</label>
        <input type="text" max="{{ $contact->persona_email }}" min="{{ $contact->persona_email }}" class="form-control" name="personalEmail" id="personalEmail" value="{{ $contact->personal_email }}">
      </div>

    	<div class="form-group">
  			<label for="work_email">Work Email</label>
  			<input type="text" max="{{ $contact->work_email }}" min="{{ $contact->work_email }}" class="form-control" name="workEmail" id="workEmail" value="{{ $contact->workEmail }}">
  		</div>


  		<div class="form-group">
  			<label for="home_phone">Home Phone</label>
  			<input type="text" max="{{ $contact->home_phone }}" min="{{ $contact->home_phone }}" class="form-control" name="homePhone" id="homePhone" value="{{ $contact->home_phone }}">
  		</div>

    	<div class="form-group">
  			<label for="work_phone">Work Phone</label>
  			<input type="text" max="{{ $contact->work_phone }}" min="{{ $contact->work_phone }}" class="form-control" name="workPhone" id="workPhone" value="{{ $contact->work_phone }}">
  		</div>

    		<div class="form-group">
    			<label for="cell_phone">Cell Phone</label>
    			<input type="text" max="{{ $contact->cell_phone }}" min="{{ $contact->cell_phone }}" class="form-control" name="cellPhone" id="cellPhone" value="{{ $contact->cell_phone }}">
    		</div>

        	<div class="form-group">
      			<label for="address">Address</label>
      			<input type="text" max="{{ $contact->address }}" min="{{ $contact->address }}" class="form-control" name="address" id="address" value="{{ $contact->address }}">
      		</div>

        	<div class="form-group">
      			<label for="birth_date">Birth Date</label>
      			<input type="text" max="{{ $contact->birth_date }}" min="{{ $contact->birth_date }}" class="form-control" name="birthDate" id="birthDate" value="{{ $contact->birth_date }}">
      		</div>

        	<div class="form-group">
      			<label for="image">Image</label>
      			<input type="text" max="{{ $contact->image }}" min="{{ $contact->image }}" class="form-control" name="image" id="image" value="{{ $contact->image }}">
      		</div>


			</select>
		</div> -->


	</form>

@endsection

