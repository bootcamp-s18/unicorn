@extends('layouts.app')

@section('content')
    <div id="contact-card" class="m-2">
        <div class="row">
            <div class="container">
                <div class="card border border-dark">
                    <h5 class="card-header">Create/Edit your contact</h5>
                    <div class="card-body text-center">
                        <a href="#" class="btn btn-primary btn-sm float-right">Save Changes</a>
                    </div>
                    <div class="media border border-dark align-self-center" style="width: 500px; height: 200px;">
                        <div class="container float-center p-2" style="max-width: 180px;">
                            <img class="align-self-start" style="width: 150px;" src="/images/deer.jpeg" alt="Generic placeholder image">
                            <button class="btn btn-sm float-center">Add Photo</button>
                        </div>
                        <div class="media-body text-left" >
                            <div class="form-group col-sm-4" style="min-width: 300px;">
                                <label><h6>First Name<h6></label>
                                <div class="row">
                                    <input class = "form-control" type="text" style="width: 260px;" placeholder="Input Text"><button class="btn btn-xs" type=" button delete" value="x">x</button>
                                </div>
                                <label><h6>Last Name</h6></label>
                                <div class="row">
                                    <input class = "form-control" type="text" style="width: 260px;" placeholder="Input Text"><button class="btn btn-xs" type="delete" value="X">x</button>
                                        <div class="row">
                                            <div class="col-xs-4 m-1" style="width: 25px;">
                                                <div class="icon">
                                                    <i class="fas fa-phone"></i>
                                                </div>
                                            </div>
                                            <div class="col-xs-4 m-1">
                                                <input class="form-control" type="text" style="width: 60px;" placeholder="(###)">
                                            </div>
                                            <div class="col-xs-4 m-1">
                                                <input class="form-control" type="text" style="width: 62px;" placeholder="####">
                                            </div>
                                            <div class="col-xs-4 m-1">
                                                <input class="form-control" type="text" style="width: 70px;" placeholder="####"><button class="btn btn-xs" type="delete" value="X">x</button>
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
@endsection

