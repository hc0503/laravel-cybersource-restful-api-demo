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
	@error('summernote')
	<div class="alert alert-danger">
		<i class="ti-user"></i> {{ $message }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
	</div>
	@enderror
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<form id="form" method="POST" action="{{ route('portal.emails.send') }}">
						
						@csrf
						
						<div class="form-group">
							<label class="form-label" for="subject">{{ __('global.emails.subject') }} :</label>
							<input id="subject" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject') }}">
							@error('subject')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>

						<div class="form-group">
							<textarea id="summernote" class="summernote" name="summernote"></textarea>
						</div>

						<div class="text-right mt-4">
							<button class="btn btn-primary ml-2"><i class="ion ion-ios-paper-plane"></i>&nbsp; {{ __('global.emails.send') }}</button>
						 </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('css')
<link href="{{ asset('assets/libs/summernote/summernote-bs4.css') }}" rel="stylesheet" />
@endpush

@push('js')
<script src="{{ asset('assets/libs/summernote/summernote-bs4.min.js') }}"></script>
<script>
	$('#summernote').summernote({
		height: 360,                 // set editor height
		minHeight: null,             // set minimum height of editor
		maxHeight: null,             // set maximum height of editor
		focus: false                 // set focus to editable area after initializing summernote
	});
</script>
@endpush