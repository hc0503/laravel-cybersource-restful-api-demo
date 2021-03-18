<!DOCTYPE html>

<html lang="en" class="default-style">

<head>
    <title>{{ __('global.login.title') }} - {{ config('app.name') }}</title>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900" rel="stylesheet">

    <!-- Icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/ionicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/open-iconic.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/pe-icon-7-stroke.css') }}">

    <!-- Core stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/bootstrap.css') }}" class="theme-settings-bootstrap-css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/appwork.css') }}" class="theme-settings-appwork-css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-corporate.css') }}" class="theme-settings-theme-css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/colors.css') }}" class="theme-settings-colors-css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/uikit.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">

    <!-- Load polyfills -->
    <script src="{{ asset('assets/vendor/js/polyfills.js') }}"></script>
    <script>document['documentMode']===10&&document.write('<script src="https://polyfill.io/v3/polyfill.min.js?features=Intl.~locale.en"><\/script>')</script>

    <script src="{{ asset('assets/vendor/js/material-ripple.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/layout-helpers.js') }}"></script>

    <!-- Theme settings -->
    <!-- This file MUST be included after core stylesheets and layout-helpers.js in the <head> section -->
    {{-- <script src="{{ asset('assets/vendor/js/theme-settings.js') }}"></script>
    <script>
        window.themeSettings = new ThemeSettings({
        cssPath: "{{ asset('assets/vendor/css/rtl') }}/",
        themesPath: "{{ asset('assets/vendor/css/rtl') }}/"
        });
    </script> --}}

    <!-- Core scripts -->
    <script src="{{ asset('assets/vendor/js/pace.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Libs -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}">
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/authentication.css') }}">
</head>

<body>
    <div class="page-loader">
        <div class="bg-primary"></div>
    </div>

    <!-- Content -->

    <div class="authentication-wrapper authentication-3">
        <div class="authentication-inner">

        <!-- Side container -->
        <!-- Do not display the container on extra small, small and medium screens -->
        <div class="d-none d-lg-flex col-lg-8 align-items-center ui-bg-cover ui-bg-overlay-container p-5" style="background-image: url('assets/img/bg/21.jpg');">
            <div class="ui-bg-overlay bg-dark opacity-50"></div>

            <!-- Text -->
            {{-- <div class="w-100 text-white px-5">
            <h1 class="display-2 font-weight-bolder mb-4">{{ __('global.login.joinOurCommunity') }}</h1>
            <div class="text-large font-weight-light">
                {{ __('global.login.description') }}
            </div>
            </div> --}}
            <!-- /.Text -->
        </div>
        <!-- / Side container -->

        <!-- Form container -->
        <div class="d-flex col-lg-4 align-items-center bg-white p-5">
            <!-- Inner container -->
            <!-- Have to add `.d-flex` to control width via `.col-*` classes -->
            <div class="d-flex col-sm-7 col-md-5 col-lg-12 px-0 px-xl-4 mx-auto">
                <div class="w-100">

                <!-- Logo -->
                <div class="d-flex justify-content-center align-items-center">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" height="130px">
                </div>
                <!-- / Logo -->

                <h4 class="text-center text-lighter font-weight-normal mt-5 mb-0">{{ __('global.login.formDescription') }}</h4>

                <!-- Form -->
                <form class="my-3" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="email">{{ __('global.login.email') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label d-flex justify-content-between align-items-end" for="password">
                        <div>{{ __('global.login.password') }}</div>
                        <a href="{{ route('password.request') }}" class="d-block small">{{ __('global.login.forgotPassword') }}</a>
                        </label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between align-items-center m-0">
                        <label class="custom-control custom-checkbox m-0" for="remember">
                        <input name="remember" type="checkbox" class="custom-control-input" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="custom-control-label">{{ __('global.login.rememberMe') }}</span>
                        </label>
                        <button type="submit" class="btn btn-primary">{{ __('global.login.signIn') }}</button>
                    </div>
                </form>
                <!-- / Form -->

                <div class="text-center text-muted">
                    {{ __('global.login.notHaveAccountYet') }} <a href="{{ route('register') }}">{{ __('global.login.signUp') }}</a>
                </div>

            </div>
            </div>
        </div>
        <!-- / Form container -->

        </div>
    </div>

    <!-- / Content -->

    <!-- Core scripts -->
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/sidenav.js') }}"></script>

    <!-- Libs -->
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <!-- Demo -->
    <script src="{{ asset('assets/js/demo.js') }}"></script>

</body>

</html>