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
	
	<h1>My Product</h1>
	
	@if(Auth::check() && Auth::user()->occupation == 'Lancer')
		<a href="{{ url('product/create') }}" class='btn btn-primary'> Upload Product </a>
		<a href="{{ url('product') }}" class='btn btn-primary'> All Product </a>
		<ul class="list-group">
		@if($product_count != 0)
		<ul class="list-group">
		@foreach ($product_list as $product)
			<a href="{{ url('product/' . $product->id ) }}" class="list-group-item">
				<span class="badge">Rp. {{ $product->price }},-</span>
				<h4 class="list-group-item-heading">{{ $product->product_name }}</h4>
				<p class="list-group-item-text">Keterangan</p>
			</a>
		@endforeach
		</ul>
		<div class="table-nav">
			<div class="jumlah-data">
				<strong>Jumlah Product : {{$product_count}}</strong>
			</div>
			<div class="paging">
				{{$product_list->links()}}
			</div>
		</div>
		@else
			<div class="info-warning">
				No Product yet<br>
				Upload and Sell your Product Now!!
			</div>
		@endif
		
	@else
		
	@endif
		
	
</div>
	
@endsection

@section('content2')
	<p>Hellooo</p>
@endsection