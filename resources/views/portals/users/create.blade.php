@extends('layouts.portal')
@section('content')
<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">{{ $pageTitle }}</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ route('portal.home') }}">{{ __('global.home.title') }}</a>
			</li>
			<li class="breadcrumb-item">
				<a href="{{ route('portal.users.index') }}">{{ __('global.users.title') }}</a>
			</li>
			<li class="breadcrumb-item active">{{ $pageTitle }}</li>
			</ol>
		</div>
	</div>
</div>
<div class="container-fluid">
	@if (session()->get('status'))
	<div class="alert alert-{{ session()->get('status') }}">
		<i class="ti-user"></i> {{ session()->get('message') }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
	</div>
	@endif
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
                <!-- Form -->
                <form id="form" class="my-5" method="POST" action="{{ route('portal.users.store') }}">
						
						@csrf

						<input id="exit" name="exit" value="true" hidden/>
						<div class="form-row">
							<div class="form-group col-md-6 col-sm-12">
								<label class="form-label" for="name">{{ __('global.users.name') }} *</label>
								<input id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autofocus>
								@error('name')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
	
							<div class="form-group col-md-6 col-sm-12">
								<label class="form-label" for="email">{{ __('global.users.email') }} *</label>
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="off">
								@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-6 col-sm-12">
								<label class="form-label" for="company">{{ __('global.users.company') }}</label>
								<input id="company" class="form-control @error('company') is-invalid @enderror" name="company" value="{{ old('company') }}">
								@error('company')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
	
							<div class="form-group col-md-6 col-sm-12">
								<label class="form-label" for="website">{{ __('global.users.website') }}</label>
								<input id="website" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ old('website') }}">
								@error('website')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-6 col-sm-12">
								<label class="form-label" for="address">{{ __('global.users.address') }} *</label>
								<input id="address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}">
								@error('address')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
	
							<div class="form-group col-md-6 col-sm-12">
								<label class="form-label" for="city">{{ __('global.users.city') }} *</label>
								<input id="city" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}">
								@error('city')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-6 col-sm-12">
								<label class="form-label" for="zip">{{ __('global.users.zip') }} *</label>
								<input id="zip" class="form-control @error('zip') is-invalid @enderror" name="zip" value="{{ old('zip') }}">
								@error('zip')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
	
							<div class="form-group col-md-6 col-sm-12 @error('country') is-invalid @enderror">
								<label class="form-label" for="country">{{ __('global.users.country') }} *</label>
								<select id="country" name="country" class="form-control" style="width: 100%">
									<option></option>
									@foreach ($countries as $country)
									<option value="{{ $country->code }}" {{ old('country') == $country->code ? 'selected' : '' }}>{{ $country->name }}</option>
									@endforeach
								 </select>
								@error('country')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-6 col-sm-12">
								<label class="form-label d-flex justify-content-between align-items-end" for="password">
								<div>{{ __('global.login.password') }}</div>
								</label>
								<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="off">
								@error('password')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							
							<div class="form-group col-md-6 col-sm-12">
                        <label class="form-label" for="password-confirm">{{ __('global.register.confirmPassword') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="off">
                    </div>
						</div>
						<div class="d-flex justify-content-between align-items-center m-0">
							<button type="submit" class="btn btn-info" onclick="saveAnother();">{{ __('global.users.saveAndAnother') }}</button>
							<button type="submit" class="btn btn-secondary" onclick="saveExit();">{{ __('global.users.saveAndExit') }}</button>
						</div>
				  </form>
				  <!-- / Form -->
				</div>
			</div>
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
		
	function saveAnother() {
		event.preventDefault();
		$('#exit').val(false);
		$('#form').submit();
	}

	function saveExit() {
		event.preventDefault();
		$('#exit').val(true);
		$('#form').submit();
	}
</script>
@endpush