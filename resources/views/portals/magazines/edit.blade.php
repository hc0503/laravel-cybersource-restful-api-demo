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
	@error('cover_image')
	<div class="alert alert-danger }}">
		<i class="ti-user"></i> {{ $message }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
	</div>
	@enderror
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
                <!-- Form -->
                <form id="form" method="POST" action="{{ route('portal.magazines.update', $magazine->guid) }}" enctype="multipart/form-data">
						
						@csrf
						@method('PUT')

						<div class="row">
							<div class="media align-items-center col-md-4 col-sm-12">
								<img src="{{ asset('storage') . $magazine->cover_image }}" alt="{{ $magazine->title }}" class="d-block ui-w-140" id="previewImage">
								<div class="media-body ml-4">
									<label class="btn btn-outline-primary mt-1">
										{{ __('global.magazines.upload') }}
										<input type="file" class="account-settings-fileinput" name="cover_image" id="cover_image" onchange="previewPhoto();" accept=".jpg, .jpeg, .png">
										<input type="number" id="reset" name="reset" value="0" hidden>
									</label> &nbsp;
									<button type="button" class="btn btn-default md-btn-flat mt-1" onclick="resetPhoto();">{{ __('global.magazines.reset') }}</button>
									<div class="text-light small mt-1">{{ __('global.magazines.allowDescription') }}</div>
								</div>
							</div>
							
							<div class="col-md-8 col-sm-12">
								<div class="form-group">
									<label class="form-label" for="title">{{ __('global.magazines.field.title') }} *</label>
									<input id="title" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $magazine->title }}" autofocus>
									@error('title')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								
								<div class="form-group @error('genre_id') is-invalid @enderror">
									<label class="form-label" for="genre">{{ __('global.genres.title') }} *</label>
									<select id="genre" name="genre_id" class="form-control" style="width: 100%">
										@foreach ($genres as $genre)
										<option value="{{ $genre->id }}" {{ $magazine->genre->id == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>
										@endforeach
									 </select>
									@error('genre_id')
										<span class="invalid-feedback" role="alert" style="display: block !important;">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
	
								<div class="form-group @error('frequency_id') is-invalid @enderror">
									<label class="form-label" for="frequency">{{ __('global.frequencies.title') }} *</label>
									<select id="frequency" name="frequency_id" class="form-control" style="width: 100%">
										@foreach ($frequencies as $frequency)
										<option value="{{ $frequency->id }}" {{ $magazine->frequency->id == $frequency->id ? 'selected' : '' }}>{{ $frequency->name }}</option>
										@endforeach
									 </select>
									@error('frequency_id')
										<span class="invalid-feedback" role="alert" style="display: block !important;">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="form-label" for="description">{{ __('global.magazines.field.description') }} *</label>
							<textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" rows="3">{{ $magazine->description }}</textarea>
							@error('description')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>

						@if (auth()->user()->hasRole('SuperAdmin') || auth()->user()->hasPermissionTo('activemagazine'))
						<div class="row">
							<div class="form-group col-md-2 col-sm-12">
								<label class="form-label" for="status">{{ __('global.magazines.field.status') }}</label>
								<select id="status" name="status" class="form-control" style="width: 100%">
									<option value="1" {{ $magazine->status == '1' ? 'selected' : '' }}>{{ __('global.magazines.field.active') }}</option>
									<option value="0" {{ $magazine->status == '0' ? 'selected' : '' }}>{{ __('global.magazines.field.inactive') }}</option>
								</select>
								@error('status')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>

							<div class="form-group col-md-10 col-sm-12">
								<label class="form-label" for="buy_online">{{ __('global.magazines.field.buyOnline') }}</label>
								<input id="buy_online" class="form-control @error('buy_online') is-invalid @enderror" name="buy_online" value="{{ $magazine->buy_online }}">
								@error('buy_online')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						@endif

						<div class="d-flex justify-content-between align-items-center m-0">
							<button type="submit" class="btn btn-secondary">{{ __('global.users.saveAndExit') }}</button>
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
<style>
	.account-settings-fileinput{
		position: absolute;
		visibility: hidden;
		width: 1px;
		height: 1px;
		opacity: 0
	}
</style>
@endpush

@push('js')
<script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
<script>
	var defaultPhoto = "";

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
		
	function previewPhoto() {
      var file = $('#cover_image')[0].files[0];
		if (file) {
			$("#previewImage").attr("src", URL.createObjectURL(file));
			$("#reset").val(0);
		} else {
			$("#previewImage").attr("src", defaultPhoto);
		}
	}

	function resetPhoto() {
      $("#previewImage").attr("src", defaultPhoto);
      $("#reset").val(1);
	}
</script>
@endpush