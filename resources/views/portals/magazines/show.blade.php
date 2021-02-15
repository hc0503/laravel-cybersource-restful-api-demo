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
						<div class="form-group col-md-6 col-sm-12 text-center">
							<img src="{{ asset('storage') . $magazine->cover_image }}" alt="{{ $magazine->title }}" height="250">
						</div>

						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label class="form-label" for="title">{{ __('global.magazines.field.title') }}</label>
								<input id="title" class="form-control" name="title" value="{{ $magazine->title }}" disabled>
							</div>
						
							<div class="form-group">
								<label class="form-label" for="genre">{{ __('global.genres.title') }}</label>
								<select id="genre" name="genre" class="form-control" style="width: 100%" disabled>
									<option></option>
									@foreach ($genres as $genre)
									<option value="{{ $genre->id }}" {{ $magazine->genre->id == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>
									@endforeach
								 </select>
							</div>
	
							<div class="form-group">
								<label class="form-label" for="frequency">{{ __('global.frequencies.title') }}</label>
								<select id="frequency" name="frequency" class="form-control" style="width: 100%" disabled>
									<option></option>
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