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
				<a href="{{ route('portal.usermanage.permissions.index') }}">{{ __('global.permissions.title') }}</a>
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
					<div class="form-group">
						<label class="form-label" for="name">{{ __('global.permissions.name') }}</label>
						<input id="name" class="form-control" name="name" value="{{ $permission->name }}" disabled>
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
	$('#permissions')
		.wrap('<div class="position-relative"></div>')
		.select2({
			placeholder: 'Select value',
			dropdownParent: $('#permissions').parent()
		});
</script>
@endpush