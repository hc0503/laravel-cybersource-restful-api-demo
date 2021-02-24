<!-- Footer -->
<nav class="container px-3 footer bp-3 bg-white pt-4">
	<div class="text-center">© Copyright 2021 Magazine Heaven Direct All Rights Reserved.</div>
	<hr class="d-none d-lg-block w-100 my-2">
	<div class="text-center">
	  	<a href="{{ route('home') }}" class="footer-link pt-3">{{ __('global.home.title') }}</a>
		<a href="{{ route('about-us') }}" class="footer-link pt-3 ml-4">{{ __('global.aboutUs.footTitle') }}</a>
		{{-- <a href="{{ route('gallery') }}" class="footer-link pt-3 ml-4">{{ __('global.magazineGallery.title') }}</a> --}}
		<a href="{{ route('contact-us.view') }}" class="footer-link pt-3 ml-4">{{ __('global.contactUs.title') }}</a>
		<a href="{{ url('disclaimer') }}" class="footer-link pt-3 ml-4">{{ __('global.termsAndConditions.title') }}</a>
		<a href="{{ url('privacy') }}" class="footer-link pt-3 ml-4">{{ __('global.privacyPolicy.title') }}</a>
		{{-- <a href="javascript:void(0)" class="footer-link pt-3 ml-4">{{ __('global.siteMap.title') }}</a> --}}
	</div>
 </nav>
 <!-- / Footer -->