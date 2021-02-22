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
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="form-group col-md-4 col-sm-12 text-center">
							<img src="{{ asset('storage') . $slider->image }}" alt="{{ $slider->title }}" height="240">
						</div>

						<div class="col-md-8 col-sm-12">
							<div class="form-group">
								<label class="form-label" for="title">{{ __('global.sliders.field.title') }}</label>
								<input id="title" class="form-control" name="title" value="{{ $slider->title }}" disabled>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="form-group col-md-2 col-sm-12">
							<label class="form-label" for="status">{{ __('global.sliders.field.status') }}</label>
							<select id="status" name="status" class="form-control" style="width: 100%" disabled>
								<option value="1" {{ $slider->status == '1' ? 'selected' : '' }}>{{ __('global.sliders.field.active') }}</option>
								<option value="0" {{ $slider->status == '0' ? 'selected' : '' }}>{{ __('global.sliders.field.inactive') }}</option>
							</select>
						</div>

						<div class="form-group col-md-10 col-sm-12">
							<label class="form-label" for="url">{{ __('global.sliders.field.url') }}</label>
							<a href="{{ $slider->url }}" class="form-control" target="_blank">{{ $slider->url }}</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('css')
@endpush

@push('js')
@endpush