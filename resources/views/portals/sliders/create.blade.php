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
				<a href="{{ route('portal.sliders.index') }}">{{ __('global.sliders.title') }}</a>
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
                <form id="form" method="POST" action="{{ route('portal.sliders.store') }}" enctype="multipart/form-data">
						
						@csrf

						<input id="exit" name="exit" value="true" hidden/>


						<div class="row">
							<div class="media align-items-center col-md-4 col-sm-12">
								<img src="" alt="" class="d-block ui-w-140" id="previewImage">
								<div class="media-body ml-4">
									<label class="btn btn-outline-primary mt-1">
										{{ __('global.sliders.upload') }}
										<input type="file" class="account-settings-fileinput" name="image" id="image" onchange="previewPhoto();" accept=".jpg, .jpeg, .png">
										<input type="number" id="reset" name="reset" value="0" hidden>
									</label> &nbsp;
									<button type="button" class="btn btn-default md-btn-flat mt-1" onclick="resetPhoto();">{{ __('global.sliders.reset') }}</button>
									<div class="text-light small mt-1">{!! __('global.sliders.allowDescription') !!}</div>
								</div>
							</div>

							<div class="col-md-8 sm-12">
								<div class="form-group">
									<label class="form-label" for="title">{{ __('global.sliders.field.title') }} *</label>
									<input id="title" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" autofocus>
									@error('title')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="form-group col-md-2 col-sm-12">
								<label class="form-label" for="status">{{ __('global.sliders.field.status') }}</label>
								<select id="status" name="status" class="form-control" style="width: 100%">
									<option value="1" {{ old('status') == '1' ? 'selected' : '' }}>{{ __('global.sliders.field.active') }}</option>
									<option value="0" {{ old('status') == '0' ? 'selected' : '' }}>{{ __('global.sliders.field.inactive') }}</option>
								</select>
								@error('status')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>

							<div class="form-group col-md-10 col-sm-12">
								<label class="form-label" for="url">{{ __('global.sliders.field.url') }}</label>
								<input id="url" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url') }}">
								@error('url')
									<span class="invalid-feedback" role="alert">
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
<script>
	var defaultPhoto = "";

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
	
	function previewPhoto() {
      var file = $('#image')[0].files[0];
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