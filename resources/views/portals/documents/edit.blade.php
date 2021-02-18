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
				<a href="{{ route('portal.documents.index') }}">{{ __('global.documents.title') }}</a>
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
                <form id="form" method="POST" action="{{ route('portal.documents.update', $document->guid) }}" enctype="multipart/form-data">
						
						@csrf
						@method('PUT')

						<div class="form-group">
							<label class="form-label" for="name">{{ __('global.documents.field.name') }} *</label>
							<input id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $document->name }}" autofocus>
							@error('name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>

						<div class="form-group @error('users') is-invalid @enderror">
							<label class="form-label" for="users">{{ __('global.users.title') }} *</label>
							<select id="users" name="users[]" class="form-control" style="width: 100%" multiple>
								@foreach ($users as $user)
								<option value="{{ $user->id }}" {{ in_array($user->id, $document->users->pluck('id')->toArray()) == $user->id ? 'selected' : '' }}>{{ $user->email }}</option>
								@endforeach
							 </select>
							@error('users')
								<span class="invalid-feedback" role="alert" style="display: block !important;">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>

						<div class="form-group">
							<label class="custom-control custom-checkbox m-0" for="select_all">
								<input name="select_all" type="checkbox" class="custom-control-input" id="select_all" {{ old('select_all') ? 'checked' : '' }}>
								<span class="custom-control-label">{{ __('global.documents.field.selectAll') }}</span>
							</label>
						</div>

						<div class="form-group">
							<label class="form-label" for="document">{{ __('global.documents.field.upload') }}</label>
							<input id="document" type="file" class="form-control @error('document') is-invalid @enderror" name="document" value="{{ old('document') }}" accept=".pdf, .xlsx, .xls, .csv">
							@error('document')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>

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
@endpush

@push('js')
<script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
<script>
	$('#users')
		.wrap('<div class="position-relative"></div>')
		.select2({
			placeholder: 'Select value',
			dropdownParent: $('#users').parent()
		});
	
	$("#select_all").click(function() {
		if ($("#select_all").is(':checked')) {
			$("#users > option").prop("selected", "selected");
			$("#users").trigger("change");
		} else {
			$("#users").val('').trigger('change')
		}
	});
</script>
@endpush