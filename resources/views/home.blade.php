@extends('layouts.website')

@section('content')
<!-- Hero slider -->
<div class="swiper-container" id="shop-hero-slider">
	<div class="swiper-wrapper">
		@foreach ($sliders as $item)
		<div class="swiper-slide ui-bg-cover">
			<img src="{{ asset('storage') . $item->image }}" alt="" width="100%">
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

<div class="container mt-4">
	<div class="row">
		<div class="col-md-3">
			<form action="{{ route('home') }}">
				<select id="genres" name="genre" class="form-control" style="width: 100%" onchange="this.form.submit()">
					<option value="all">Select by Genre...</option>
					@foreach ($genres as $genre)
					<option value="{{ $genre->guid }}" {{ $currentGenre == $genre->guid ? 'selected' : '' }}>{{ $genre->name }}</option>
					@endforeach
				</select>
			</form>
		</div>
		
		<div class="col-md-9">
			<div class="row">
				@foreach ($magazines as $item)
				<div class="col-md-3 text-center p-4">
					<a href="{{ route('magazines.details', $item->guid) }}" class="d-block">
						<img src="{{ asset('storage') . $item->cover_image }}" class="mb-2" alt="{{ $item->title }}" style="max-width: 75%; max-height: 200px">
					</a>
					<h6 class="font-weight-normal">
						<a href="{{ route('magazines.details', $item->guid) }}" class="text-body">{{ $item->title }}</a>
					</h6>
					<div class="d-flex justify-content-center">
						<a href="{{ $item->buy_online }}" class="btn btn-outline-primary btn-sm text-expanded" target="__blank">
							{{ __('global.magazines.field.buyOnline') }}
						</a>
					</div>
				</div>
				@endforeach
			</div>
			{{-- Pagination --}}
			<div class="d-flex justify-content-center">
				{!! $magazines->appends(['genre' => $currentGenre])->links() !!}
			</div>
		</div>
	</div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}">
<style>
	.select2-results__options {
		min-height: 350px;
		overflow-y: auto;
	}
</style>
@endpush

@push('js')
<script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
<script>
	$('#genres').select2();
</script>
@endpush
