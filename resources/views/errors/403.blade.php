<!DOCTYPE html>

<html lang="en" class="default-style">
<head>
  <title>403 Forbidden Error - {{ config('app.name') }}</title>

  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
  <link rel="icon" type="image/x-icon" href="favicon.ico">

  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900" rel="stylesheet">

  <!-- Core stylesheets -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/bootstrap.css') }}" class="theme-settings-bootstrap-css">
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/appwork.css') }}" class="theme-settings-appwork-css">
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-corporate.css') }}" class="theme-settings-theme-css">
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/colors.css') }}" class="theme-settings-colors-css">
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/uikit.css') }}">

  <script src="{{ asset('assets/vendor/js/material-ripple.js') }}"></script>
  <script src="{{ asset('assets/vendor/js/layout-helpers.js') }}"></script>

  <!-- Theme settings -->
  <!-- This file MUST be included after core stylesheets and layout-helpers.js in the <head> section -->
  <script src="{{ asset('assets/vendor/js/theme-settings.js') }}"></script>
  <script>
    window.themeSettings = new ThemeSettings({
      cssPath: "{{ asset('assets/vendor/css/rtl') }}/",
      themesPath: "{{ asset('assets/vendor/css/rtl') }}/"
    });
  </script>

  <!-- Core scripts -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <!-- Page -->
  <link rel="stylesheet" href="{{ asset('assets/css/error.css') }}">
</head>

<body class="bg-primary">

  <div class="overflow-hidden">
    <div class="container d-flex align-items-stretch ui-mh-100vh p-0">
      <div class="row w-100">
        <div class="d-flex col-md justify-content-center align-items-center order-2 order-md-1 position-relative p-5">
          <div class="error-bg-skew bg-white"></div>

          <div class="text-md-left text-center">
            <h1 class="display-2 font-weight-bolder mb-4">Uh... Error!</h1>
            <div class="text-xlarge font-weight-light mb-5">Looks like something went wrong.<br>We're working on it.</div>
            <div class="text-big">Please try again or <a href="{{ url('/') }}"><u>Home</u></a></div>
          </div>
        </div>

        <div class="d-flex col-md-5 justify-content-center align-items-center order-1 order-md-2 text-center text-white p-5">
          <div>
            <div class="error-code font-weight-bolder mb-2">403</div>
            <div class="error-description font-weight-light">Forbidden Error</div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Core scripts -->
  <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
  <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
</body>
</html>
