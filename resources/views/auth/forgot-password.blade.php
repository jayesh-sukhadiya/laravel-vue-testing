<!DOCTYPE html>
<html lang="en">
<!-- auth-login.html -->
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Forget Password - {{ config('app.name') }}</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('public/assets/css/app.min.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/components.css') }}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('public/assets/css/custom.css') }}">
    <link rel='shortcut icon' type='image/x-icon' href="{{ asset('public/assets/img/favicon.png') }}" />
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
                                <h4 style="padding: 4px 0;color: #1a76c6;font-size: 17px;font-weight: 700;text-transform: uppercase;margin-bottom: -23px;margin-left: 25%;">Forgot Password</h4>
                            </div>
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('password.email') }}" class="needs-validation" novalidate="">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Enter Email"  class="form-control @error('email') is-invalid @enderror" tabindex="1" required autofocus maxlength="100">
                                        @error('email')
                                            <div class="invalid-feedback"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">Submit</button>
                                    </div>
                                     <div class="form-group">
                                        <div class="float-right">
                                            <a href="{{ url('login') }}" class="text-small"> <b>Login?</b> </a>
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
    <!-- General JS Scripts -->
    <script src="{{ asset('public/assets/js/app.min.js') }}"></script>
    <!-- JS Libraies -->
    <!-- Page Specific JS File -->
    <!-- Template JS File -->
    <script src="{{ asset('public/assets/js/scripts.js') }}"></script>
    <!-- Custom JS File -->
    <script src="{{ asset('public/assets/js/custom.js') }}"></script>
</body>
</html>
