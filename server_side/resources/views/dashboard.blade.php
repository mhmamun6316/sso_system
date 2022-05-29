<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Identification</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('loginForm') }}/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('loginForm') }}/css/main.css">
    <style>
        .error
        {
            color:#FF0000;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="welcome-section mt-5">
            <h4>welcome {{ $user->name }} </h4>  &nbsp; &nbsp;
            <a class="btn btn-success" data-toggle="modal" data-target="#addProject" style="color: white;">Add Project</a> &nbsp; &nbsp;
            <a class="btn btn-danger" href="{{ route('logout') }}">Logout</a>
        </div>
        <div class="main-section mt-3">
            <div class="row">
                <div class="col-md-4 text-center mt-4">
                    <div>
                        <img class="rounded-circle" id="img-show" height="150px" width="150px" src="{{ (!empty($user->avatar)) ? url($user->avatar) : url('loginForm/images/default-profile.PNG') }}">
                    </div><br>
                    <p class="font-weight-bold">{{ $user->name }}</p>
                    <p class="text-black-50">{{ $user->email }}</p>
                </div>
                <div class="col-md-8 mt-4">
                    <form id="profile_update" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mr-4 profile-info">
                            <div class="col-md-4">
                                <p>Name :</p>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="name" placeholder="name" value="{{ $user->name }}">
                            </div>

                            <div class="col-md-4">
                                <p>E-mail :</p>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="email" placeholder="email" value="{{ $user->email }}">
                            </div>

                            <div class="col-md-4">
                                <p>Image :</p>
                            </div>
                            <div class="col-md-8">
                                <input type="file" id="image" class="form-control" name="image" placeholder="image">
                            </div>

                            <div class="col-md-4">
                                <p>Mobile :</p>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="mobile" placeholder="mobile" value="{{ $user->mobile }}">
                            </div>

                            <div class="col-md-4">
                                <p>Phone :</p>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="phone" placeholder="phone" value="{{ $user->phone }}">
                            </div>

                            <div class="col-md-4">
                                <p>Nid :</p>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="nid" placeholder="nid" value="{{ $user->nid }}">
                            </div>

                            <div class="col-md-4">
                                <p>Division :</p>
                            </div>
                            <div class="col-md-8">
                                <select name="division" id="division" class="form-control">
                                    <option disabled selected>Please select a division</option>
                                    @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}" {{ $user->division == $division->id ? 'selected' : ''}}>{{ $division->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <p>District :</p>
                            </div>
                            <div class="col-md-8">
                                <select name="district" id="district" class="form-control">
                                    <option disabled selected>Please select a district</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}" {{ $user->district == $district->id ? 'selected' : ''}}>{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <p>Upazila :</p>
                            </div>
                            <div class="col-md-8">
                                <select name="upazila" id="upazila" class="form-control">
                                    <option disabled selected>Please select a upazila</option>
                                    @foreach ($upazilas as $upazila)
                                        <option value="{{ $upazila->id }}" {{ $user->upazila == $upazila->id ? 'selected' : ''}}>{{ $upazila->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <p>Union :</p>
                            </div>
                            <div class="col-md-8">
                                <select name="union" id="union" class="form-control">
                                    <option disabled selected>Please select a union</option>
                                    @foreach ($unions as $union)
                                        <option value="{{ $union->id }}" {{ $user->union == $union->id ? 'selected' : ''}}>{{ $union->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <p>Village :</p>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="village" placeholder="village" value="{{ $user->village }}">
                            </div>
                        </div>
                        <div class="mr-5 mt-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addProject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('add.project') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <label for="">Project Name</label>
                        <input required class="form-control" type="text" name="project_name" placeholder="enter project name"><br>

                        <label for="">Project Description</label>
                        <input class="form-control" type="text" name="project_description" placeholder="enter project description">
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <script src="{{ asset('loginForm') }}/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
    <script src="{{ asset('loginForm') }}/vendor/bootstrap/js/popper.js"></script>
	<script src="{{ asset('loginForm') }}/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="{{ asset('loginForm') }}/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {

            // profile update form validation
            if($("#profile_update").length > 0)
            {
                $('#profile_update').validate({
                    rules:{
                        name : {
                            required : true,
                            maxlength : 255,
                        },
                        email : {
                            required : true,
                            maxlength : 50,
                            email : true
                        },
                        image: {
                            extension: "jpg|jpeg|png|ico|bmp|Jfif"
                        },
                        mobile:{
                            minlength: 11,
                            maxlength: 11,
                        }
                    },
                    messages : {
                        name : {
                            required : 'Enter your name',
                            maxlength : 'Name should not be more than 255 character'
                        },
                        email : {
                            required : 'Enter your email',
                            email : 'Enter valid email detail',
                            maxlength : 'Email should not be more than 50 character'
                        },
                        photo: {
                            extension: "Please upload file in these format only (jpg, jpeg, png, ico, bmp)."
                        },
                        mobile:{
                            minlength:'Mobile number must be minimum 8 digit long',
                            maxlength:'Mobile number must be maximum 8 digit long'
                        }
                    }
                });
            }

            // for getting district
            $('select[name="division"]').on('change', function() {
                var division_id = $(this).val();
                $.ajax({
                    url: "{{ url('/all/district') }}/" + division_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="district"]').empty();
                        var text =`<option disabled>Please select a district</option>`;
                        $.each(data, function(key, value) {
                                text += `<option value="${value.id}">${value.name}</option>`;
                        });
                        $('select[name="district"]').append(text);
                    },
                });
            });

            // for getting upazila
            $('select[name="district"]').on('change', function() {
                var district_id = $(this).val();
                $.ajax({
                    url: "{{ url('/all/upazila') }}/" + district_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="upazila"]').empty();
                        var text =`<option disabled>Please select a upazila</option>`;
                        $.each(data, function(key, value) {
                                text += `<option value="${value.id}">${value.name}</option>`;
                        });
                        $('select[name="upazila"]').append(text);
                    },
                });
            });

            // for getting union
            $('select[name="upazila"]').on('change', function() {
                var union_id = $(this).val();
                $.ajax({
                    url: "{{ url('/all/union') }}/" + union_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="union"]').empty();
                        var text =`<option disabled>Please select a union</option>`;
                        $.each(data, function(key, value) {
                                text += `<option value="${value.id}">${value.name}</option>`;
                        });
                        $('select[name="union"]').append(text);
                    },
                });
            });

            // code for preview image before upload
            $('#image').change(function(){
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#img-show').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });

        });

    </script>

    @if (Session::has('success'))
        <script>
            swal("Great Job","{!! Session::get('success') !!}","success",{
                button:"okk",
            })
        </script>
    @endif
</body>
</html>
