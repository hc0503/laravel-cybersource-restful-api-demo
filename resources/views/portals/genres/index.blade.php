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
	<div class="row">
		<div class="col-12">
			<div class="card">
					<div class="card-body">
						@if (auth()->user()->hasRole('SuperAdmin') || auth()->user()->hasPermissionTo('creategenre'))
						<a href="{{ route('portal.genres.create') }}" class="btn waves-effect waves-light btn-secondary">
							<i class="fas fa-plus"></i> {{ trans('global.genres.create') }}
						</a>
						@endif
						<div class="table-responsive mt-2">
							<table id="dataTable" class="datatables-demo table table-striped table-bordered">
									<thead>
										<tr>
											<th>#</th>
											<th>{{ trans('global.genres.name') }}</th>
											<th>{{ trans('global.createdAt') }}</th>
											<th width="0px;">{{ trans('global.action') }}</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>#</th>
											<th>{{ trans('global.genres.name') }}</th>
											<th>{{ trans('global.createdAt') }}</th>
											<th>{{ trans('global.action') }}</th>
										</tr>
									</tfoot>
							</table>
						</div>
					</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables/datatables.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}">
@endpush

@push('js')
<script src="{{ asset('assets/vendor/libs/datatables/datatables.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
<script>
	$('#dataTable').dataTable({
		'processing': true,
		'serverSide': true,
		'ajax': {
			'url': "{{ route('portal.genres.index') }}",
			'type': 'GET'
		},
		'columns': [
			{'data': 'id'},
			{'data': 'name'},
			{'data': 'created_at'},
			{'data': 'action'},
		]
	});

	function deleteData(dataId) {
		Swal.fire({
			title: "{{ __('global.swal.delete.title') }}", 
			text: "{{ __('global.swal.delete.text') }}",
			type: 'warning',
			showCancelButton: true,
			customClass: {
				confirmButton: 'btn btn-secondary btn-lg',
				cancelButton: 'btn btn-default btn-lg'
			}
		}).then(function (result) {
			if (result.value) {
				$('#deleteForm'+dataId).submit();
			}
		})
    }
</script>
@endpush