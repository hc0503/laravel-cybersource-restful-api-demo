<!-- Layout footer -->
<nav class="layout-footer footer bg-footer-theme">
	<div class="container-fluid d-flex flex-wrap justify-content-between text-center container-p-x pb-3">
		<div class="pt-3">
			© Copyright 2021 Magazine Heaven Direct All Rights Reserved.
		</div>
		<div>
			<a href="{{ route('home') }}" class="footer-link pt-3">{{ __('global.home.title') }}</a>
			<a href="{{ route('about-us') }}" class="footer-link pt-3 ml-4">{{ __('global.aboutUs.footTitle') }}</a>
			{{-- <a href="{{ route('gallery') }}" class="footer-link pt-3 ml-4">{{ __('global.magazineGallery.title') }}</a> --}}
			<a href="{{ route('contact-us.view') }}" class="footer-link pt-3 ml-4">{{ __('global.contactUs.title') }}</a>
			<a href="javascript:void(0)" class="footer-link pt-3 ml-4">{{ __('global.termsAndConditions.title') }}</a>
			<a href="{{ url('privacy') }}" class="footer-link pt-3 ml-4">{{ __('global.privacyPolicy.title') }}</a>
			{{-- <a href="javascript:void(0)" class="footer-link pt-3 ml-4">{{ __('global.siteMap.title') }}</a> --}}
		</div>
	</div>
</nav>
<!-- / Layout footer -->