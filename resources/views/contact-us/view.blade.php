@extends('layouts.website')

@section('content')
<div class="container">
	@if (session()->get('status'))
	<div class="alert alert-{{ session()->get('status') }}">
		<i class="ti-user"></i> {{ session()->get('message') }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
	</div>
	@endif
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<h5>Magazine Heaven Direct Limited</h5>
			<p>Steven Hobbs (New Business Enquiries & Client Services)</p>
			<p>172 Northern Parade</p>
			<p>Hilsea, Portsmouth</p>
			<p>Hampshire</p>
			<p>Po2 9LT</p>
			<div class="justify-content-between d-flex">
				<p>Tel: +44 (0) 2392 787 970</p>
				<a href="mailto:shcirculation@ntlworld.com">shcirculation@ntlworld.com</a>
			</div>

			<h5>Magazine Heaven / Magazine Heaven Direct Limited</h5>
			<p>Bill Palmer (Distribution and Retail Sales)</p>
			<p>c/o Magazine Heaven</p>
			<p>Unit 1b, South Terrace</p>
			<p>Rushden Lakes</p>
			<p>Northants</p>
			<p>NN10 6FS</p>
			<div class="justify-content-between d-flex">
				<p>Tel: +44 (0) 7712 862 582</p>
				<a href="mailto:bill@magazineheaven.com">bill@magazineheaven.com</a>
			</div>
			<p>EU Contacts (French, Spanish, German, Italian Spoken)</p>
			<div class="justify-content-between d-flex">
				<p>Ana Suarez</p>
				<a href="mailto:ana@pineapple-media.com">ana@pineapple-media.com</a>
			</div>
			<div class="justify-content-between d-flex">
				<p>Nico</p>
				<a href="mailto:nico@pineapplemedia.es">nico@pineapplemedia.es</a>
			</div>
		</div>

		<div class="col-md-6 col-sm-12">
			<!-- Form -->
			<form id="form" method="POST" action="{{ route('contact-us.send') }}">
									
				@csrf
				
				<div class="form-group">
					<label class="form-label" for="name">{{ __('global.contactUs.field.name') }} *</label>
					<input id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autofocus>
					@error('name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>

				<div class="form-group">
					<label class="form-label" for="company">{{ __('global.contactUs.field.company') }} *</label>
					<input id="company" class="form-control @error('company') is-invalid @enderror" name="company" value="{{ old('company') }}">
					@error('company')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>

				<div class="form-group @error('country') is-invalid @enderror">
					<label class="form-label" for="country">{{ __('global.contactUs.field.country') }} *</label>
					<select id="country" name="country" class="form-control" style="width: 100%">
						<option></option>
						@foreach ($countries as $country)
						<option value="{{ $country->code }}" {{ old('country') == $country->code ? 'selected' : '' }}>{{ $country->name }}</option>
						@endforeach
						</select>
					@error('country')
						<span class="invalid-feedback" role="alert" style="display: block !important;">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>

				<div class="form-group">
					<label class="form-label" for="telephone">{{ __('global.contactUs.field.telephone') }} *</label>
					<input id="telephone" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') }}">
					@error('telephone')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>

				<div class="form-group">
					<label class="form-label" for="website">{{ __('global.contactUs.field.website') }}</label>
					<input id="website" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ old('website') }}">
					@error('website')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				
				<div class="form-group">
					<label class="form-label" for="email">{{ __('global.contactUs.field.email') }} *</label>
					<input id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
					@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>

				<div class="form-group">
					<label class="form-label" for="enquiry">{{ __('global.contactUs.field.enquiry') }} *</label>
					<textarea class="form-control @error('enquiry') is-invalid @enderror" name="enquiry" id="enquiry" rows="5"></textarea>
					@error('enquiry')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>

				{!! app('captcha')->display() !!}
				@if ($errors->has('g-recaptcha-response'))
					<span class="help-block">
						<strong style="font-size: 85%; color: #d9534f;">{{ $errors->first('g-recaptcha-response') }}</strong>
					</span>
				@endif

				<div class="text-right m-0">
					<button type="submit" class="btn btn-secondary">{{ __('global.users.saveAndExit') }}</button>
				</div>
			</form>
			<!-- / Form -->
		</div>
	</div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}">
@endpush

@push('js')
<script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
<script>
	$('#country')
		.wrap('<div class="position-relative"></div>')
		.select2({
			placeholder: 'Select value',
			dropdownParent: $('#country').parent()
		});
</script>
@endpush