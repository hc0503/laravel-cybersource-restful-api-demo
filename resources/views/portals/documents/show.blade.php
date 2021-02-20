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
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="form-group">
						<label class="form-label" for="name">{{ __('global.documents.field.name') }}</label>
						<input id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $document->name }}" disabled>
					</div>

					<div class="form-group @error('users') is-invalid @enderror">
						<label class="form-label" for="users">{{ __('global.users.title') }}</label>
						<select id="users" name="users[]" class="form-control" style="width: 100%" multiple disabled>
							@foreach ($users as $user)
							<option value="{{ $user->id }}" {{ in_array($user->id, $document->users->pluck('id')->toArray()) == $user->id ? 'selected' : '' }}>{{ $user->email }}</option>
							@endforeach
						</select>
					</div>

					<div class="text-right m-0">
						<a href="{{ asset('storage') . $document->path }}" class="btn btn-secondary" target="__blank"><i class="fas fa-download"> {{ __('global.documents.download') }}</i></a>
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
	$('#users')
		.wrap('<div class="position-relative"></div>')
		.select2({
			placeholder: 'Select value',
			dropdownParent: $('#users').parent()
		});
</script>
@endpush