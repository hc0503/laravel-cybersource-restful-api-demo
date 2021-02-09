<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Laravel</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
  .bs-example{
    margin: 20px;
  }
</style>
</head>
<body>
<div class="bs-example">
  <a href="#" class="navbar-brand text-center">
    <img src="https://www.tutorialrepublic.com/examples/images/logo.svg" height="28" alt="CoolBrand">
  </a>
  <nav class="navbar navbar-expand-md navbar-light bg-light">
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse" style="background-color: #e3f2fd;">
      <div class="navbar-nav">
        <a href="#" class="nav-item nav-link active">Home</a>
        <a href="#" class="nav-item nav-link">Profile</a>
        <a href="#" class="nav-item nav-link">Messages</a>
        <a href="#" class="nav-item nav-link disabled" tabindex="-1">Reports</a>
      </div>
      <div class="navbar-nav ml-auto">
        @if (Route::has('login'))
          <div class="top-right links">
              @auth
                <a href="{{ url('/home') }}">Home</a>
              @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                  <a href="{{ route('register') }}">Register</a>
                @endif
              @endauth
          </div>
        @endif
      </div>
    </div>
  </nav>
</div>
</body>
</html>