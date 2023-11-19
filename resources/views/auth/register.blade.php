<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom CSS styles for the registration page */
        body {
            background-color: #f5f5f5;
        }

        .register-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 100px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="register-container">
            <h2 class="text-center">Register</h2>
            <form action="{{ route('register_user') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" class="form-control" id="name" value="{{ old('name')}}"  name="name" placeholder="Enter your full name">
                    <span class="text-danger">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" value="{{ old('email')}}" name="email" placeholder="Enter your email">
                    <span class="text-danger">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter a password">
                    <span class="text-danger">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm-password" name="confirm_password" placeholder="Confirm your password">
                    <span class="text-danger">
                        @error('confirm_password')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group">
                    <label for="confirm-password">Image</label>
                    <input type="file" class="form-control" name="image">
                    <span class="text-danger">
                        @error('image')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <input type="text" class="form-control" name="role" placeholder="Enter Your Role">
                    <span class="text-danger">
                        @error('role')
                            {{ $message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group">
                    <label for="church_name">Church Name:</label>
                    <input type="text" class="form-control" name="church_name" placeholder="Enter church name">
                    <span class="text-danger">
                        @error('church_name')
                            {{ $message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group">
                    <label for="church_address">Church Address:</label>
                    <input type="text" class="form-control" name="church_address" placeholder="Enter Church Address">
                    <span class="text-danger">
                        @error('church_address')
                            {{ $message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group">
                    <label for="church_logo">Church Logo</label>
                    <input type="file" class="form-control" name="church_logo">
                    <span class="text-danger">
                        @error('church_logo')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </form>
            <p class="mt-3 text-center">Already have an account? <a href="{{ route('login_view') }}">Login here</a></p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
