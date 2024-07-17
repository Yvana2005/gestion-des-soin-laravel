<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>sai i lama - Login</title>

    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">

    <!-- Custom styles for this template-->
    <link href="{{ asset('dashboard/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Axios Library -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body class="login">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-md-6 shadow-lg form my-5">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h2 class="h3 text-light mb-4">{{ __('sentence.Welcome') }}</h2>
                            <hr>
                            <center>
                                <div class="d-flex w-25 justify-content-center align-items-center">
                                    <img src="{{ asset('img/sai-i-lama-logo.png') }}" class="img-fluid">
                                </div>
                            </center>
                            <hr>

                        </div>
                        <form id="loginForm" method="POST" action="{{ route('login') }}" class="user">
                            <div class="form-group">
                                <input id="email" type="email"
                                    class="input w-100 @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus
                                    aria-describedby="emailHelp" placeholder="{{ __('sentence.Email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input id="password" type="password"
                                    class="input w-100 @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password"
                                    placeholder="{{ __('sentence.Password') }}">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox small">
                                    <input class="custom-control-input" type="checkbox" name="remember" id="customCheck"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    {{ csrf_field() }}
                                    <label class="custom-control-label"
                                        for="customCheck">{{ __('sentence.Remember Me') }}</label>
                                </div>
                            </div>
                            <button class="btn btn-success btn-user btn-block" type="submit">
                                {{ __('sentence.Login') }}</button>
                        </form>
                        <hr>
                        @if (Route::has('password.request'))
                            <div class="text-center">
                                <a class="small text-light" href="{{ route('password.request') }}">
                                    {{ __('sentence.Forgot Your Password') }}</a>
                            </div>
                        @endif
                    </div>
                    <div class="drop drop1"></div>
                    <div class="drop drop2"></div>
                    <div class="drop drop3"></div>
                    <div class="drop drop4"></div>
                    <div class="drop drop5"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            // Extract the value before the @ in the email
            const userName = email.split('@')[0];

            const dataForHRM = {
                userName: userName,
                password: password
            };

            const dataForERP = {
                username: userName,
                password: password
            };
            console.log(dataForHRM, dataForERP);

            // CSRF Token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            try {
                const responses = await Promise.all([
                    axios.post('http://localhost:5000/user/login', dataForHRM, {
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    }),
                    axios.post('http://localhost:5001/v1/user/login', dataForERP, {
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                ]);

                // Process successful responses
                responses.forEach(response => {
                    if (response.data.token) {
                        console.log(`Logged in to ${response.config.url}`, response.data);
                        // Store token or user info as needed
                        localStorage.setItem("access-token", response.data.token);
                        localStorage.setItem("role", response.data.role);
                        localStorage.setItem("user", response.data.username);
                        localStorage.setItem("id", response.data.id);
                        localStorage.setItem("isLogged", true);
                    }
                });

                // Redirect or notify user as needed
                alert('Login successful');
                window.location.href = "/admin/dashboard"; // Example redirection
            } catch (error) {
                console.error('Login failed', error);
                alert('Login failed. Please check your credentials.');
            }
        });
    </script>
</body>

</html>
