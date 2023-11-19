@extends('user.layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        /* Custom CSS for Facebook-like profile settings page */
        body {
            background-color: #f0f2f5;
        }
        .profile-card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }
        .profile-picture {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-image: url('your-profile-image.jpg');
            background-size: cover;
            background-position: center;
            margin: 0 auto 20px;
        }
    </style>
</head>
<body>
    <div class="container">
    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show successMsg" role="alert">
                            {{ Session::get('success') }}
                            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
        <div class="row">
            <div class="col-md-6">
                <div class="profile-card">
                    <form action="{{ route('updateProfilePic') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="profile-picture">
                            <img src="{{ asset('storage/images/users/'.Auth::user()->image ) }}" alt="" style="height:100px; width:100px; border-radius:100px;" >
                        </div>
                        <h2 class="text-center">{{ Auth::user()->name }}</h2>
                        <p class="text-center">{{ Auth::user()->email }}</p>
                        <input type="file" class="form-control" name="profilePic">
                        <span class="text-danger">
                            @error('profilePic')
                                {{ $message }}
                            @enderror
                        </span>
                        <p class="text-center"><small><button type="submit" class="btn btn-sm btn-success">Change Profile Picture</button></small></p>
                    </form>
                    <hr>
                    <form action="{{ route('updateProfileSetting') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullName" value="{{ Auth::user()->name }}" name="name">
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}" name="email">
                            <span class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Role</label>
                            <input type="text" class="form-control" id="email" value="{{ Auth::user()->role }}" name="role">
                            <span class="text-danger">
                                @error('role')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new_password" placeholder="Enter New Password" name="new_password" >
                            <span class="text-danger">
                                @error('new_password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirm_new_password" placeholder="Re-Type New Password" name="confirm_new_password">
                            <span class="text-danger">
                                @error('confirm_new_password')
                                    {{ $message }}
                                @enderror
                            </span>
                            <span class="checkConfirmPasswordMsg"></span>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-card">
                    <form action="{{ url('/update-church-logo') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="profile-picture">
                            <img src="{{ asset('storage/images/users/'.Auth::user()->church_logo ) }}" alt="" style="height:100px; width:100px; border-radius:100px;">
                        </div>
                        <h2 class="text-center">{{ Auth::user()->church_name }}</h2>
                        <p class="text-center">{{ Auth::user()->church_address }}</p>
                        <input type="file" class="form-control" name="logo_church">
                        <span class="text-danger">
                            @error('logo_church')
                                {{ $message }}
                            @enderror
                        </span>
                        <p class="text-center"><small><button type="submit" class="btn btn-sm btn-success">Change Church Logo</button></small></p>
                    </form>
                    <hr>
                    <form  action="{{ route('updateChurchDetail') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Church Name</label>
                            <input type="text" class="form-control" id="fullName" value="{{ Auth::user()->church_name }}" name="church_name">
                            <span class="text-danger">
                                @error('church_name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Church Address</label>
                            <input type="text" class="form-control" id="email" value="{{ Auth::user()->church_address }}" name="church_address">
                            <span class="text-danger">
                                @error('church_address')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Bootstrap JS and Popper.js scripts at the end of your HTML body -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
       $("#confirm_new_password").on("keyup",function(){
            var new_password = $("#new_password").val();
            var confirm_new_password = $("#confirm_new_password").val();
            if(new_password == confirm_new_password){
                $(".checkConfirmPasswordMsg").text('Password and Confirm Password matched').css('color','green');
            }else{
                $(".checkConfirmPasswordMsg").text('Password and Confirm Password are not matching').css('color','red');
            }
       });
    });
</script>
@endsection
