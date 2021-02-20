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
			<li class="breadcrumb-item active">{{ $pageTitle }}</li>
			</ol>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<!-- Form -->
					<form id="form" method="POST" action="{{ route('portal.profiles.update', $user->guid) }}">
						
						@csrf

						<div class="text-right">
							<button type="submit" class="btn waves-effect waves-light btn-secondary">
								<i class="fas fa-save"></i> {{ __('global.profiles.update') }}
							</button>
						</div>

						<div class="form-row">
							<div class="form-group col-md-6 col-sm-12">
								<label class="form-label" for="name">{{ __('global.users.field.name') }} *</label>
								<input id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" autofocus>
								@error('name')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
	
							<div class="form-group col-md-6 col-sm-12">
								<label class="form-label" for="email">{{ __('global.users.field.email') }} *</label>
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" autocomplete="off">
								@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-6 col-sm-12">
								<label class="form-label" for="name1">{{ __('global.users.field.name') }} 1</label>
								<input id="name1" class="form-control @error('name1') is-invalid @enderror" name="name1" value="{{ $user->name1 }}">
								@error('name1')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
	
							<div class="form-group col-md-6 col-sm-12">
								<label class="form-label" for="email1">{{ __('global.users.field.email') }} 1</label>
								<input id="email1" type="email" class="form-control @error('email1') is-invalid @enderror" name="email1" value="{{ $user->email1 }}" autocomplete="off">
								@error('email1')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						
						<div class="form-row">
							<div class="form-group col-md-6 col-sm-12">
								<label class="form-label" for="name2">{{ __('global.users.field.name') }} 2</label>
								<input id="name2" class="form-control @error('name2') is-invalid @enderror" name="name2" value="{{ $user->name2 }}">
								@error('name2')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
	
							<div class="form-group col-md-6 col-sm-12">
								<label class="form-label" for="email2">{{ __('global.users.field.email') }} 2</label>
								<input id="email2" type="email" class="form-control @error('email2') is-invalid @enderror" name="email2" value="{{ $user->email2 }}" autocomplete="off">
								@error('email2')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						
						<div class="form-row">
							<div class="form-group col-md-6 col-sm-12">
								<label class="form-label" for="name3">{{ __('global.users.field.name') }} 3</label>
								<input id="name3" class="form-control @error('name3') is-invalid @enderror" name="name3" value="{{ $user->name3 }}">
								@error('name3')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
	
							<div class="form-group col-md-6 col-sm-12">
								<label class="form-label" for="email3">{{ __('global.users.field.email') }} 3</label>
								<input id="email3" type="email" class="form-control @error('email3') is-invalid @enderror" name="email3" value="{{ $user->email3 }}" autocomplete="off">
								@error('email3')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-6 col-sm-12">
								<label class="form-label" for="company">{{ __('global.users.field.company') }}</label>
								<input id="company" class="form-control @error('company') is-invalid @enderror" name="company" value="{{ $user->company }}">
								@error('company')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
	
							<div class="form-group col-md-6 col-sm-12">
								<label class="form-label" for="website">{{ __('global.users.field.website') }}</label>
								<input id="website" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ $user->website }}">
								@error('website')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-6 col-sm-12">
								<label class="form-label" for="address">{{ __('global.users.field.address') }} *</label>
								<input id="address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $user->address }}">
								@error('address')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
	
							<div class="form-group col-md-6 col-sm-12">
								<label class="form-label" for="city">{{ __('global.users.field.city') }} *</label>
								<input id="city" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ $user->city }}">
								@error('city')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-6 col-sm-12">
								<label class="form-label" for="zip">{{ __('global.users.field.zip') }} *</label>
								<input id="zip" class="form-control @error('zip') is-invalid @enderror" name="zip" value="{{ $user->zip }}">
								@error('zip')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
	
							<div class="form-group col-md-6 col-sm-12 @error('country') is-invalid @enderror">
								<label class="form-label" for="country">{{ __('global.users.field.country') }} *</label>
								<select id="country" name="country" class="form-control" style="width: 100%">
									<option></option>
									@foreach ($countries as $country)
									<option value="{{ $country->code }}" {{ $user->country == $country->code ? 'selected' : '' }}>{{ $country->name }}</option>
									@endforeach
								 </select>
								@error('country')
									<span class="invalid-feedback" role="alert" style="display: block !important;">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-6 col-sm-12">
								<label class="form-label" for="password">{{ __('global.login.password') }}</label>
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
</script>
@endpush