@extends('layouts.master')

@section('title')
	Homey
@endsection


@section('content')

@guest
@else
	@include('leftNavBar')
@endguest

<div class="content">
	<h1>Detail Job</h1>
	<table class="table table-striped">
		<tr>
			<th> Product Name </th>
			<td> {{ $product->product_name }} </td>
		</tr>
		<tr>
			<th> Owner Name </th>
			<td> {{ $product->owner->name }} </td>
		</tr>
		<tr>
			<th> Price </th>
			<td> Rp. {{ $product->price }},- </td>
		</tr>
	</table>
	<form class="inlineForm" method="get" action="{!! url('message/user/'.$product->owner->id) !!}">
		{{ csrf_field() }}
		<button type="submit" class="btn btn-primary">
			Contact Owner
		</button>
	</form>
	
</div>
	
@endsection

@section('content2')
	<p>Hellooo</p>
@endsection