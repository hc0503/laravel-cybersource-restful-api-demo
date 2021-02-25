@extends('layouts.website')

@section('content')
<div class="container">
	{!! $disclaimer->content ?? '' !!}
</div>

@endsection