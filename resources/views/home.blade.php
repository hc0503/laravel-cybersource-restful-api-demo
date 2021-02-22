@extends('layouts.website')

@section('content')
<!-- Hero slider -->
<div class="swiper-container" id="shop-hero-slider">
	<div class="swiper-wrapper">
	  	@foreach ($sliders as $item)
		<div class="swiper-slide ui-bg-cover" style="background-image: url({{ asset('storage') . $item->image }})">
			<div class="container px-3 px-3">
				<div class="shop-hero-container">
					<div class="flex-shrink-1 text-center py-5">
						<div class="shop-hero-slider-animated shop-hero-slider-delay-2 display-3 bg-white text-center text-body font-weight-bold text-expanded py-1 px-3 mx-auto">
							{{ $item->title }}
						</div>
						<a href="{{ $item->url }}" class="shop-hero-slider-animated shop-hero-slider-delay-3 btn btn-primary btn-lg text-expanded mt-5" target="__blank">
							{{ __('global.magazines.field.buyOnline') }}
						</a>
					</div>
				</div>
			</div>
		</div>
		@endforeach
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
