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
				<a href="{{ route('portal.magazines.index') }}">{{ __('global.magazines.title') }}</a>
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
					<div class="row">
						<div class="form-group col-md-3 col-sm-12 text-center">
							<img src="{{ asset('storage') . $magazine->cover_image }}" alt="{{ $magazine->title }}" height="240">
						</div>

						<div class="col-md-3 col-sm-12">
							<div class="form-group">
								<label class="form-label" for="auth_name">{{ __('global.magazines.field.authName') }}</label>
								<input id="auth_name" class="form-control" name="auth_name" value="{{ $magazine->user->name }}" disabled>
							</div>

							<div class="form-group">
								<label class="form-label" for="auth_email">{{ __('global.magazines.field.authEmail') }}</label>
								<input id="auth_email" class="form-control" name="auth_email" value="{{ $magazine->user->email }}" disabled>
							</div>
						</div>

						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label class="form-label" for="title">{{ __('global.magazines.field.title') }}</label>
								<input id="title" class="form-control" name="title" value="{{ $magazine->title }}" disabled>
							</div>
						
							<div class="form-group">
								<label class="form-label" for="genre">{{ __('global.genres.title') }}</label>
								<select id="genre" name="genre" class="form-control" style="width: 100%" disabled>
									@foreach ($genres as $genre)
									<option value="{{ $genre->id }}" {{ $magazine->genre->id == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>
									@endforeach
								</select>
							</div>
	
							<div class="form-group">
								<label class="form-label" for="frequency">{{ __('global.frequencies.title') }}</label>
								<select id="frequency" name="frequency" class="form-control" style="width: 100%" disabled>
									@foreach ($frequencies as $frequency)
									<option value="{{ $frequency->id }}" {{ $magazine->frequency->id == $frequency->id ? 'selected' : '' }}>{{ $frequency->name }}</option>
									@endforeach
								 </select>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="form-label" for="description">{{ __('global.magazines.field.description') }}</label>
						<textarea id="description" class="form-control" name="description" rows="5" disabled>{{ $magazine->description }}</textarea>
					</div>
					
					<div class="row">
						<div class="form-group col-md-2 col-sm-12">
							<label class="form-label" for="status">{{ __('global.magazines.field.status') }}</label>
							<select id="status" name="status" class="form-control" style="width: 100%" disabled>
								<option value="1" {{ $magazine->status == '1' ? 'selected' : '' }}>{{ __('global.magazines.field.active') }}</option>
								<option value="0" {{ $magazine->status == '0' ? 'selected' : '' }}>{{ __('global.magazines.field.inactive') }}</option>
							</select>
						</div>

						<div class="form-group col-md-2 col-sm-12">
							<label class="form-label" for="price">{{ __('global.price') }}</label>
							<input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $magazine->price }}" step="0.1" min="0" disabled>
						</div>

						<div class="form-group col-md-8 col-sm-12">
							<label class="form-label" for="buy_online">{{ __('global.magazines.field.buyOnline') }}</label>
							<a href="{{ $magazine->buy_online }}" class="form-control" target="_blank">{{ $magazine->buy_online }}</a>
						</div>
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
	$('#genre')
		.wrap('<div class="position-relative"></div>')
		.select2({
			placeholder: 'Select value',
			dropdownParent: $('#genre').parent()
		});

	$('#frequency')
		.wrap('<div class="position-relative"></div>')
		.select2({
			placeholder: 'Select value',
			dropdownParent: $('#frequency').parent()
		});
</script>
@endpush