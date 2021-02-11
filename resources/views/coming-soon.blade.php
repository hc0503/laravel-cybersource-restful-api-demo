<!DOCTYPE html>

<html lang="en" class="default-style">
<head>
  <title>{{ $pageTitle }} - {{ config('app.name') }}</title>

  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
  <link rel="icon" type="image/x-icon" href="favicon.ico">

  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Raleway:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Icon fonts -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/ionicons.css') }}">
  <link rel="stylesheet" href="assets/vendor/fonts/linearicons.css') }}">

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
  {{-- <script src="assets/vendor/js/theme-settings.js"></script>
  <script>
    window.themeSettings = new ThemeSettings({
      cssPath: "{{ asset('assets/vendor/css/rtl') }}/",
      themesPath: "{{ asset('assets/vendor/css/rtl') }}/"
    });
  </script> --}}

  <!-- Core scripts -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <!-- Page -->
  <link rel="stylesheet" href="{{ asset('assets/css/coming-soon.css') }}">
</head>

<body>

  <!-- Wrapper -->
  <div class="d-flex align-items-stretch w-100 ui-mh-100vh ui-bg-cover ui-bg-overlay-container" style="background-image: url(assets/img/bg/coming-soon.jpg);">
    <div class="row no-gutters w-100">
      <div class="ui-bg-overlay bg-dark opacity-50"></div>

      <div class="d-flex col flex-column text-white px-4 px-sm-5">

        <div class="d-flex align-items-center mt-5">
          <div class="ui-w-60">
            <div class="w-100 position-relative" style="padding-bottom: 54%">
              <svg class="w-100 h-100 position-absolute" viewBox="0 0 148 80" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs><linearGradient id="a" x1="46.49" x2="62.46" y1="53.39" y2="48.2" gradientUnits="userSpaceOnUse"><stop stop-opacity=".25" offset="0"></stop><stop stop-opacity=".1" offset=".3"></stop><stop stop-opacity="0" offset=".9"></stop></linearGradient><linearGradient id="e" x1="76.9" x2="92.64" y1="26.38" y2="31.49" xlink:href="#a"></linearGradient><linearGradient id="d" x1="107.12" x2="122.74" y1="53.41" y2="48.33" xlink:href="#a"></linearGradient></defs><path class="fill-primary" transform="translate(-.1)" d="M121.36,0,104.42,45.08,88.71,3.28A5.09,5.09,0,0,0,83.93,0H64.27A5.09,5.09,0,0,0,59.5,3.28L43.79,45.08,26.85,0H.1L29.43,76.74A5.09,5.09,0,0,0,34.19,80H53.39a5.09,5.09,0,0,0,4.77-3.26L74.1,35l16,41.74A5.09,5.09,0,0,0,94.82,80h18.95a5.09,5.09,0,0,0,4.76-3.24L148.1,0Z"></path><path transform="translate(-.1)" d="M52.19,22.73l-8.4,22.35L56.51,78.94a5,5,0,0,0,1.64-2.19l7.34-19.2Z" fill="url(#a)"></path><path transform="translate(-.1)" d="M95.73,22l-7-18.69a5,5,0,0,0-1.64-2.21L74.1,35l8.33,21.79Z" fill="url(#e)"></path><path transform="translate(-.1)" d="M112.73,23l-8.31,22.12,12.66,33.7a5,5,0,0,0,1.45-2l7.3-18.93Z" fill="url(#d)"></path></svg>
            </div>
          </div>
          <div class="text-large ml-3">
            {{ config('app.name') }}
          </div>
        </div>

        <div class="py-5 my-auto">

          <div class="display-4 text-expanded mb-2">We'll be launching</div>
          <h1 class="display-2 font-weight-bolder text-expanded">COMING SOON</h1>
          <p class="text-big">We are working very hard on our website. You can see result soon.</p>

        </div>
      </div>

      <div class="d-flex col-lg-5 col-xl-4 align-items-center bg-white py-5 px-4 px-sm-5">
        <div class="flex-shrink-1">
          <h5 class="font-weight-bold mb-4">WHO <span class="text-primary">WE ARE</span></h5>
          <p>Magazine Heaven Direct is the specialist partner for enterprising,
            independent magazine publishers. Whether you are an existing magazine
            or yet to launch, we will help you achieve your circulation goals and
            provide a range of specialist, tailored services that will really
            benefit your business.
            We pride ourselves on the quality and range of our services and deliver
            unique, creative solutions for publishers who need to get their product
            to market or expand and develop an existing market or distribution
            channel, either in the UK or Internationally.
            Magazine Heaven Direct is affiliated with Magazine Heaven, The UK’s
            largest Magazine Retail store, stocking more 3600 publications, with an
            impressive e-commerce store and offering worldwide single copy sales
            direct to consumer and subscriptions. Magazine Heaven also curates and
            sells back issues for many publishers and offers mailing services and
            bulk deliveries.</p>

          <h5 class="font-weight-bold mt-5 mb-4">TOUCH <span class="text-primary">WITH US</span></h5>
          <p><i class="ion ion-ios-mail ui-w-40 text-center text-lightest text-big align-middle"></i><a href="mailto:#" class="align-middle">bill@magazineheaven.com</a></p>
          <p><i class="ion ion-ios-call ui-w-40 text-center text-lightest text-big align-middle"></i><span class="align-middle">+44 (0) 7712 862 582</span></p>
          <div>
            <a href="#" class="btn icon-btn borderless btn-outline-twitter rounded-pill">
              <span class="ion ion-logo-twitter"></span>
            </a>
            <a href="#" class="btn icon-btn borderless btn-outline-facebook rounded-pill">
              <span class="ion ion-logo-facebook"></span>
            </a>
            <a href="#" class="btn icon-btn borderless btn-outline-instagram rounded-pill">
              <span class="ion ion-logo-instagram"></span>
            </a>
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
