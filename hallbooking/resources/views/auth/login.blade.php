<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="KARE AUTOMATION SYSTEM" name="description">
    <title>KARE AUTOMATION SYSTEM</title>
    <!-- Styles -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/kare_logo.png') }}">
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .has-danger .help-block { color: red !important; }
        .login-bg img { width: 100%; height: auto; }
        .login-container { padding: 50px; background: rgba(255, 255, 255, 0.8); }
        .login-logo { width: 100%; max-width: 250px; margin: 0 auto 20px; display: block; }
        .login-footer { margin-top: 20px; text-align: center; }
        
    </style>
</head>
<body class="login">
    <div class="row bs-reset">
        <div class="col-md-6 bs-reset">
            <div class="login-bg" style="position: relative;">
                <img class="login-logo" src="{{ asset('images/logo.png') }}" alt="KARE Logo">
                <div class="backstretch" style="position: absolute; top: 0; left: 0; z-index: -1;">
                    <img src="{{ asset('images/bg4.jpg') }}" alt="Background Image">
                </div>
            </div>
        </div>

        <div class="col-md-6 login-container">
            <div class="login-content">
                <h1 class="text-center">Login - EDUKARE</h1>
                <p class="text-center">Automation System - KARE</p>

                <!-- Blade Form -->
                <form action="{{ route('auth.login') }}" method="POST" class="login-form" novalidate="novalidate">
                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="email" class="form-label">User Name:</label>
                        <input type="text" name="email" id="email" class="form-control form-control-solid" placeholder="Email" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" name="password" id="password" class="form-control form-control-solid" placeholder="Password" required>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="rem-password">
                                <label class="rememberme mt-checkbox mt-checkbox-outline">
                                    <input type="checkbox" name="remember" value="1"> Remember me
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-6 text-right">
                            <button class="btn btn-success" type="submit">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="login-footer">
             
                <p>Copyright © SDT-KARE</p>
            </div>
        </div>
    </div>

    <!-- Add Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
