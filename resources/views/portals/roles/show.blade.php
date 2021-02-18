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
				<a href="{{ route('portal.usermanage.roles.index') }}">{{ __('global.roles.title') }}</a>
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
						<label class="form-label" for="name">{{ __('global.roles.name') }}</label>
						<input id="name" class="form-control" name="name" value="{{ $role->name }}" disabled>
					</div>

					<div class="form-group">
						<label class="form-label" for="permissions">{{ __('global.permissions.title') }}</label>
						<select id="permissions" name="permissions[]" class="form-control" style="width: 100%" multiple disabled>
							@foreach ($permissions as $permission)
							<option value="{{ $permission->name }}" {{ in_array($permission->name, $role->permissions->pluck('name')->toArray()) ? 'selected' : '' }}>{{ $permission->name }}</option>
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
	$('#permissions')
		.wrap('<div class="position-relative"></div>')
		.select2({
			placeholder: 'Select value',
			dropdownParent: $('#permissions').parent()
		});
</script>
@endpush