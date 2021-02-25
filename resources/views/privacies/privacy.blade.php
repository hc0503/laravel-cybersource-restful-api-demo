@extends('layouts.website')

@section('content')
<div class="container">
	{!! $privacy->content ?? '' !!}
</div>

@endsection