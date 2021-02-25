<!-- Footer -->
<nav class="container px-3 footer bp-3 bg-white pt-4">
	<div class="text-center">© Copyright 2021 Magazine Heaven Direct All Rights Reserved.</div>
	<hr class="d-none d-lg-block w-100">
	<div class="text-center mb-4 pt-3">
	  	<a href="{{ route('home') }}" class="footer-link {{ request()->is('home') ? 'active' : '' }}">{{ __('global.home.title') }}</a>
		<a href="{{ route('about-us') }}" class="footer-link {{ request()->is('about-us') ? 'active' : '' }} ml-4">{{ __('global.aboutUs.footTitle') }}</a>
		<a href="{{ route('contact-us.view') }}" class="footer-link {{ request()->is('contact-us') ? 'active' : '' }} ml-4">{{ __('global.contactUs.title') }}</a>
		<a href="{{ route('disclaimer') }}" class="footer-link {{ request()->is('disclaimer') ? 'active' : '' }} ml-4">{{ __('global.termsAndConditions.title') }}</a>
		<a href="{{ route('privacy') }}" class="footer-link {{ request()->is('privacy') ? 'active' : '' }} ml-4">{{ __('global.privacyPolicy.title') }}</a>
	</div>
 </nav>
 <!-- / Footer -->