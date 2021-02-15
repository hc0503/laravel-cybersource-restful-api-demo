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
                <form id="form" method="POST" action="{{ route('portal.magazines.store') }}" enctype="multipart/form-data">
						
						@csrf

						<input id="exit" name="exit" value="true" hidden/>

						<div class="row">
							<div class="form-group col-md-6 col-sm-12">
								<label class="form-label" for="title">{{ __('global.magazines.field.title') }} *</label>
								<input id="title" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" autofocus>
								@error('title')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>

							<div class="form-group col-md-6 col-sm-12">
								<label class="form-label" for="title">{{ __('global.magazines.field.coverImage') }}</label>
								<input id="cover_image" type="file" class="form-control @error('cover_image') is-invalid @enderror" name="cover_image" value="{{ old('cover_image') }}" accept=".jpg, .jpeg, .png" />
								@error('cover_image')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						
						<div class="form-group">
							<label class="form-label" for="description">{{ __('global.magazines.field.description') }} *</label>
							<textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" rows="3">{{ old('description') }}</textarea>
							@error('description')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>

						<div class="row">
							<div class="form-group @error('genre') is-invalid @enderror col-md-6 col-sm-12">
								<label class="form-label" for="genre">{{ __('global.genres.title') }} *</label>
								<select id="genre" name="genre" class="form-control" style="width: 100%">
									<option></option>
									@foreach ($genres as $genre)
									<option value="{{ $genre->id }}" {{ old('genre') == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>
									@endforeach
								 </select>
								@error('genre')
									<span class="invalid-feedback" role="alert" style="display: block !important;">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>

							<div class="form-group @error('frequency') is-invalid @enderror col-md-6 col-sm-12">
								<label class="form-label" for="frequency">{{ __('global.frequencies.title') }} *</label>
								<select id="frequency" name="frequency" class="form-control" style="width: 100%">
									<option></option>
									@foreach ($frequencies as $frequency)
									<option value="{{ $frequency->id }}" {{ old('frequency') == $frequency->id ? 'selected' : '' }}>{{ $frequency->name }}</option>
									@endforeach
								 </select>
								@error('frequency')
									<span class="invalid-feedback" role="alert" style="display: block !important;">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
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