@extends('layouts.website')

@section('content')
<!-- Hero slider -->
<div class="swiper-container" id="shop-hero-slider">
	<div class="swiper-wrapper">
	  <!-- Animate first slide on page load -->
	  <div class="swiper-slide shop-hero-slider-animating ui-bg-cover" style="background-image: url(assets/img/bg/16.jpg)">
		 <div class="container px-3">
			<div class="shop-hero-container">
			  <div class="flex-shrink-1 text-center py-5">
				 <div class="shop-hero-slider-animated shop-hero-slider-delay-1 display-1 font-weight-semibold mb-2">SAVE 50%</div>
				 <div class="shop-hero-slider-animated shop-hero-slider-delay-2 display-4">FOR FIRST PURCHASE</div>
				 <button type="button" class="shop-hero-slider-animated shop-hero-slider-delay-3 btn btn-primary btn-lg text-expanded mt-5">SHOP NOW</button>
			  </div>
			</div>
		 </div>
	  </div>
	  <div class="swiper-slide ui-bg-cover" style="background-image: url(assets/img/bg/27.png)">
		 <div class="container px-3">
			<div class="shop-hero-container">
			  <div class="flex-shrink-1 col-12 py-5">
				 <div class="shop-hero-slider-animated shop-hero-slider-delay-1 display-2 text-primary text-expanded">SUMMER</div>
				 <div class="shop-hero-slider-animated shop-hero-slider-delay-2 display-2 text-primary text-expanded">COLLECTION</div>
				 <div class="shop-hero-slider-animated shop-hero-slider-delay-3 display-2 text-primary text-expanded">2018</div>
				 <button type="button" class="shop-hero-slider-animated shop-hero-slider-delay-4 btn btn-primary btn-lg text-expanded mt-5">SHOP NOW</button>
			  </div>
			</div>
		 </div>
	  </div>
	  <div class="swiper-slide ui-bg-cover" style="background-image: url(assets/img/bg/28.png)">
		 <div class="container px-3 px-3">
			<div class="shop-hero-container">
			  <div class="flex-shrink-1 text-center py-5">
				 <div class="shop-hero-slider-animated shop-hero-slider-delay-1 display-4 text-white text-expanded mb-4">EXCLUSIVE</div>
				 <div class="shop-hero-slider-animated shop-hero-slider-delay-2 display-3 bg-white text-center text-body font-weight-bold text-expanded py-1 px-3 mx-auto">SUITS COLLECTION</div>
				 <button type="button" class="shop-hero-slider-animated shop-hero-slider-delay-3 btn btn-primary btn-lg text-expanded mt-5">SHOP NOW</button>
			  </div>
			</div>
		 </div>
	  </div>
	</div>
	<div class="swiper-button-next custom-icon">
	  <i class="lnr lnr-chevron-right text-body"></i>
	</div>
	<div class="swiper-button-prev custom-icon">
	  <i class="lnr lnr-chevron-left text-body"></i>
	</div>
 </div>
 <!-- Hero slider -->
@endsection
