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
				<a href="{{ route('portal.usermanage.users.index') }}">{{ __('global.users.title') }}</a>
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
					<div class="form-row">
						<div class="form-group col-md-6 col-sm-12">
							<label class="form-label" for="name">{{ __('global.users.field.name') }}</label>
							<input id="name" class="form-control" name="name" value="{{ $user->name }}" disabled>
						</div>

						<div class="form-group col-md-6 col-sm-12">
							<label class="form-label" for="email">{{ __('global.users.field.email') }}</label>
							<input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" disabled>
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-6 col-sm-12">
							<label class="form-label" for="name1">{{ __('global.users.field.name') }} 1</label>
							<input id="name1" class="form-control @error('name1') is-invalid @enderror" name="name1" value="{{ $user->name1 }}" disabled>
						</div>

						<div class="form-group col-md-6 col-sm-12">
							<label class="form-label" for="email1">{{ __('global.users.field.email') }} 1</label>
							<input id="email1" type="email" class="form-control @error('email1') is-invalid @enderror" name="email1" value="{{ $user->email1 }}" disabled>
						</div>
					</div>
					
					<div class="form-row">
						<div class="form-group col-md-6 col-sm-12">
							<label class="form-label" for="name2">{{ __('global.users.field.name') }} 2</label>
							<input id="name2" class="form-control @error('name2') is-invalid @enderror" name="name2" value="{{ $user->name2 }}" disabled>
						</div>

						<div class="form-group col-md-6 col-sm-12">
							<label class="form-label" for="email2">{{ __('global.users.field.email') }} 2</label>
							<input id="email2" type="email" class="form-control @error('email2') is-invalid @enderror" name="email2" value="{{ $user->email2 }}" disabled>
						</div>
					</div>
					
					<div class="form-row">
						<div class="form-group col-md-6 col-sm-12">
							<label class="form-label" for="name3">{{ __('global.users.field.name') }} 3</label>
							<input id="name3" class="form-control @error('name3') is-invalid @enderror" name="name3" value="{{ $user->name3 }}" disabled>
						</div>

						<div class="form-group col-md-6 col-sm-12">
							<label class="form-label" for="email3">{{ __('global.users.field.email') }} 3</label>
							<input id="email3" type="email" class="form-control @error('email3') is-invalid @enderror" name="email3" value="{{ $user->email3 }}" disabled>
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-6 col-sm-12">
							<label class="form-label" for="company">{{ __('global.users.field.company') }}</label>
							<input id="company" class="form-control" name="company" value="{{ $user->company }}" disabled>
						</div>

						<div class="form-group col-md-6 col-sm-12">
							<label class="form-label" for="website">{{ __('global.users.field.website') }}</label>
							<a href="{{ $user->website }}" class="form-control" target="_blank">{{ $user->website }}</a>
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-6 col-sm-12">
							<label class="form-label" for="address">{{ __('global.users.field.address') }}</label>
							<input id="address" class="form-control" name="address" value="{{ $user->address }}" disabled>
						</div>

						<div class="form-group col-md-6 col-sm-12">
							<label class="form-label" for="city">{{ __('global.users.field.city') }}</label>
							<input id="city" class="form-control" name="city" value="{{ $user->city }}" disabled>
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-6 col-sm-12">
							<label class="form-label" for="zip">{{ __('global.users.field.zip') }}</label>
							<input id="zip" class="form-control" name="zip" value="{{ $user->zip }}" disabled>
						</div>

						<div class="form-group col-md-6 col-sm-12">
							<label class="form-label" for="country">{{ __('global.users.field.country') }}</label>
							<select id="country" name="country" class="form-control" style="width: 100%" disabled>
								<option></option>
								@foreach ($countries as $country)
								<option value="{{ $country->code }}" {{ $user->country == $country->code ? 'selected' : '' }}>{{ $country->name }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group @error('roles') is-invalid @enderror">
						<label class="form-label" for="roles">{{ __('global.roles.title') }}</label>
						<select id="roles" name="roles[]" class="form-control" style="width: 100%" multiple disabled>
							<option></option>
							@foreach ($roles as $role)
							<option value="{{ $role->name }}" {{ in_array($role->name, $user->roles->pluck('name')->toArray()) ? 'selected' : '' }}>{{ $role->name }}</option>
							@endforeach
						</select>
					</div>
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
		
	$('#roles')
		.wrap('<div class="position-relative"></div>')
		.select2({
			placeholder: 'Select value',
			dropdownParent: $('#roles').parent()
		});
</script>
@endpush