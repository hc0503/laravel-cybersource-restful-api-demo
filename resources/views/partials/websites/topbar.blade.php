<!-- Logo -->
<a href="{{ route('home') }}" class="d-flex justify-content-center align-items-center mt-2">
	<img src="{{ asset('assets/img/logo.png') }}" alt="Logo" height="130px">
</a>
<!-- / Logo -->

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white px-0">
	<div class="container flex-lg-wrap px-3">
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".shop-header">
		<span class="navbar-toggler-icon"></span>
	</button>

	<!-- Menu -->
	<div class="shop-header navbar-collapse collapse col-lg-12 flex-wrap order-lg-2 px-0">
		<hr class="d-none d-lg-block w-100 my-2">
		<ul class="navbar-nav">
			<li class="nav-item {{ request()->is('home') ? 'active' : '' }}"><a class="nav-link px-lg-3" href="{{ route('home') }}">{{ __('global.home.title') }}</a></li>
			<li class="nav-item {{ request()->is('about-us') ? 'active' : '' }}"><a class="nav-link px-lg-3" href="{{ route('about-us') }}">{{ __('global.aboutUs.footTitle') }}</a></li>
			{{-- <li class="nav-item {{ request()->is('gallery') ? 'active' : '' }}"><a class="nav-link px-lg-3" href="{{ route('gallery') }}">{{ __('global.magazineGallery.title') }}</a></li> --}}
			<li class="nav-item {{ request()->is('contact-us') ? 'active' : '' }}"><a class="nav-link px-lg-3" href="{{ route('contact-us.view') }}">{{ __('global.contactUs.title') }}</a></li>
		</ul>
		<div class="shop-header navbar-collapse collapse">
			<div class="navbar-nav align-items-lg-center ml-auto">
			@if (Auth::check())
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle hide-arrow ml-lg-2" href="#" data-toggle="dropdown">
					<img src="assets/img/avatars/default.jpg" alt class="ui-w-30 rounded-circle align-middle">
					<span class="d-lg-none align-middle">&nbsp; Mike Greene</span>
				</a>
				<div class="dropdown-menu dropdown-menu-right">
					<a class="dropdown-item" href="{{ route('portal.home') }}">
					{{ __('global.goToPortal') }}
					</a>
					<div class="dropdown-divider"></div>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
					@csrf
					</form>
					<a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
					{{ __('global.logOut') }}
					</a>
				</div>
			</li>
			@else
			<a class="btn btn-sm btn-secondary" href="{{ route('login') }}"><i class="ion ion-md-lock"> {{ __('global.login.clientLogin') }}</i></a>
			@endif
			</div>
		</div>
		<hr class="d-none d-lg-block w-100 my-2">
	</div>
	<!-- / Menu -->
	</div>
</nav>
<!-- / Navbar -->

 @push('css')
 @endpush