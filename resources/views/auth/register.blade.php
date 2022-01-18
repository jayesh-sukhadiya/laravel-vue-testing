<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Register - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('public/assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/components.css') }}">
    <link rel='shortcut icon' type='image/x-icon' href="{{ asset('public/assets/img/logos/company-logo.png') }}" />
</head>

<body style="background-color: #e2ece8;">
    <div class="loader"></div>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-8 offset-md-3 col-lg-6 offset-lg-3 col-xl-8 offset-xl-2">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4 style="padding: 4px 0;color: #1a76c6;font-size: 17px;font-weight: 700;text-transform: uppercase;margin-bottom: -23px;">Register Your Account</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate="">
                                    @csrf
                                    @if(session('error'))
                                        <div class="alert alert-danger" style="padding: 0px !important;">
                                          <ul>
                                              <li>{{ session('error') }}</li>
                                          </ul>
                                      </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="username">username<span class="required-star">*</span> </label>
                                                <input type="text" name="username" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Enter username" tabindex="1" required autofocus maxlength="50" autocomplete="off">
                                                @error('username')
                                                    <div class="invalid-feedback"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="email">Email<span class="required-star">*</span> </label>
                                                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter Email" tabindex="2" maxlength="100" required>
                                                @error('email')
                                                    <div class="invalid-feedback"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="name">Name<span class="required-star">*</span> </label>
                                                <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Name" tabindex="3" maxlength="100" required>
                                                @error('name')
                                                    <div class="invalid-feedback"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="role_id">Select Role<span class="required-star">*</span> </label>
                                                <select name="role_id" class="form-control @error('role_id') is-invalid @enderror" id="role_id" tabindex="4" required>
                                                    <option value="">Select Role</option>
                                                    <option value="2">Shop</option>
                                                    <option value="3">User</option>
                                                </select>
                                                @error('role_id')
                                                    <div class="invalid-feedback"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="language">Language<span class="required-star">*</span></label>
                                                <select name="language" class="form-control @error('language') is-invalid @enderror" id="language" tabindex="4" required>
                                                    <option value="">Select Language</option>
                                                    <option value="English">English</option>
                                                    <option value="Spain">Spain</option>
                                                    <option value="Russian">Russian</option>
                                                </select>
                                                @error('language')
                                                    <div class="invalid-feedback"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="currency">Currency<span class="required-star">*</span> </label>
                                                <select name="currency" class="form-control @error('currency') is-invalid @enderror" id="currency" tabindex="4" required>
                                                    <option value="">Select Currency</option>
                                                    <option value="Euro">Euro</option>
                                                    <option value="British Pound">British Pound</option>
                                                    <option value="INR">INR</option>
                                                </select>
                                                @error('currency')
                                                    <div class="invalid-feedback"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="password">Password<span class="required-star">*</span> </label>
                                                <input type="password" name="password" value="" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="********" tabindex="7" maxlength="25" required>
                                                @error('password')
                                                    <div class="invalid-feedback"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="password_confirmation">Confirm Password<span class="required-star">*</span> </label>
                                                <input type="password" name="password_confirmation" value="" class="form-control @error('password_confirmation') is-invalid @enderror" id="password-confirm" placeholder="********" tabindex="8" maxlength="25" required>
                                                @error('password_confirmation')
                                                    <div class="invalid-feedback"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="remember" class="custom-control-input" tabindex="9" id="remember-me">
                                            <label class="custom-control-label" for="remember-me">Terms and Conditions</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">Register</button>
                                        <div class="float-right" style="margin-top: 10px;">
                                            <a href="{{ url('login') }}" class="text-small"> Already register please <b>Login</b>? </a>
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