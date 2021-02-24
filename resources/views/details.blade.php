@extends('layouts.website')

@section('content')
<div class="container">
	<div class="row no-gutters">
      <div class="col-lg-5 col-xl-4 text-center">
			<h3>{{ $magazine->title }}</h3>
			<!-- Preview -->
			<a id="shop-preview-image" href="#" class="img-thumbnail ui-bordered mb-4 mt-3">
				<img src="{{ asset('storage') . $magazine->cover_image }}" alt="{{ $magazine->title }}" class="img-fluid">
			</a>
			<a href="{{ $magazine->buy_online }}" class="btn btn-secondary"><i class="ion ion-md-cart"> {{ __('global.magazines.field.buyOnline') }}</i></a>
      </div>
      <div class="col-lg-7 col-xl-8 py-5 pt-lg-0 pl-lg-5">
			<p>{{ $magazine->description }}</p>
			<table class="table my-4">
				<tbody>
					<tr>
						<td class="border-0 text-muted align-middle" style="width: 110px">{{ __('global.frequencies.sTitle') }} :</td>
						<td class="border-0">
							{{ $magazine->frequency->name }}
						</td>
					</tr>
					<tr>
						<td class="border-0 text-muted align-middle" style="width: 110px">{{ __('global.price') }} :</td>
						<td class="border-0">
							{{ $magazine->price ?? '' }}
						</td>
					</tr>
				</tbody>
			</table>
      </div>
	</div>
</div>
@endsection