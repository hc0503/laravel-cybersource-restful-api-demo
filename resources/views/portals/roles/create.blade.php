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
                <form id="form" method="POST" action="{{ route('portal.usermanage.roles.store') }}">
						
						@csrf

						<input id="exit" name="exit" value="true" hidden/>
						<div class="form-group">
							<label class="form-label" for="name">{{ __('global.roles.name') }} *</label>
							<input id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autofocus>
							@error('name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>

						<div class="form-group @error('permissions') is-invalid @enderror">
							<label class="form-label" for="permissions">{{ __('global.permissions.title') }} *</label>
							<select id="permissions" name="permissions[]" class="form-control" style="width: 100%" multiple>
								@foreach ($permissions as $permission)
								<option value="{{ $permission->name }}" {{ collect(old('permissions'))->contains($permission->name) == $permission->name ? 'selected' : '' }}>{{ $permission->name }}</option>
								@endforeach
							 </select>
							@error('permissions')
								<span class="invalid-feedback" role="alert" style="display: block !important;">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						{{-- <div class="row">
							<div class="form-group col-md-3 col-sm-12">
								<label class="form-label">Permissions</label>
								<div class="custom-controls-stacked">
									<label class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" name="createpermission">
										<span class="custom-control-label">createpermission</span>
									</label>
									<label class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" name="editpermission">
										<span class="custom-control-label">editpermission</span>
									</label>
									<label class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" name="deletepermission">
										<span class="custom-control-label">deletepermission</span>
									</label>
									<label class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" name="viewuser">
										<span class="custom-control-label">viewuser</span>
									</label>
								</div>
							</div>
	
							<div class="form-group col-md-3 col-sm-12">
								<label class="form-label">Roles</label>
								<div class="custom-controls-stacked">
									<label class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" name="createrole">
										<span class="custom-control-label">createrole</span>
									</label>
									<label class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" name="editrole">
										<span class="custom-control-label">editrole</span>
									</label>
									<label class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" name="deleterole">
										<span class="custom-control-label">deleterole</span>
									</label>
									<label class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" name="viewrole">
										<span class="custom-control-label">viewrole</span>
									</label>
								</div>
							</div>
	
							<div class="form-group col-md-3 col-sm-12">
								<label class="form-label">Users</label>
								<div class="custom-controls-stacked">
									<label class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" name="createuser">
										<span class="custom-control-label">createuser</span>
									</label>
									<label class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" name="edituser">
										<span class="custom-control-label">edituser</span>
									</label>
									<label class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" name="deleteuser">
										<span class="custom-control-label">deleteuser</span>
									</label>
									<label class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" name="viewuser">
										<span class="custom-control-label">viewuser</span>
									</label>
									<label class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" name="managelogin">
										<span class="custom-control-label">managelogin</span>
									</label>
								</div>
							</div>
						</div> --}}

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
	$('#permissions')
		.wrap('<div class="position-relative"></div>')
		.select2({
			placeholder: 'Select value',
			dropdownParent: $('#permissions').parent()
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