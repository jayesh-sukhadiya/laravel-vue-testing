<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('public/assets/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/bundles/bootstrap-social/bootstrap-social.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/custom.css') }}">
    <link rel='shortcut icon' type='image/x-icon' href="{{ asset('public/assets/img/logos/company-logo.png') }}" />
</head>

<body style="background-color: #e2ece8;">
    <div class="loader"></div>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <h1 class="align-center"><img alt="image" src="{{ asset('public/assets/img/logos/company-logo.png') }}" class="header-logo" style="height: 150px;border-radius: 20px;" /></h1>
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4 style="padding: 4px 0;color: #1a76c6;font-size: 17px;font-weight: 700;text-transform: uppercase;margin-bottom: -23px;margin-left: 25%;">Account Login</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ url('user-login') }}" class="needs-validation" novalidate="">
                                    @csrf
                                    @if(session('error'))
                                        <div class="alert alert-danger" style="padding: 0px !important;">
                                          <ul>
                                              <li>{{ session('error') }}</li>
                                          </ul>
                                      </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="username">Email / Username </label>
                                        <input id="username" type="text" name="username" value="{{ old('username') }}" placeholder="Enter Email / Username"  class="form-control @error('username') is-invalid @enderror" tabindex="1" required autofocus value="{{ old('username') }}">
                                        @error('username')
                                            <div class="invalid-feedback"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                        </div>
                                        <input id="password" type="password" name="password" placeholder="********" class="form-control @error('password') is-invalid @enderror" tabindex="2" required>
                                        @error('password')
                                            <div class="invalid-feedback"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                     
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                                            <label class="custom-control-label" for="remember-me">Remember Me</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">Login</button>
                                        <div class="float-left" style="margin-top: 10px;">
                                            <a href="{{ url('register') }}" class="text-small"> New user please <b>Register</b>? </a>
                                        </div>
                                        <div class="float-right" style="margin-top: 10px;">
                                            <a href="{{ url('forget-password') }}" class="text-small"> Forgot Password? </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="{{ asset('public/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('public/assets/js/custom.js') }}"></script>
</body>
</html>