@extends('layout')

@section('content')
<h2 class="title text-center">Features Items</h2>
@foreach($products as $product)
<div class="col-sm-4">
	<div class="product-image-wrapper">
		<div class="single-products">
			<div class="productinfo text-center">
				
				<img src="{{ asset('uploads/product/'.$product->image)}}" class="img-responsive" alt="Item" style="height: 230px; width: 260px;" >
				<h2>TK {{ $product->price }}</h2>
				<p>{{ $product->name }}</p>
				<a href="{{ route('category.product.details', $product->id) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

			</div>
			<div class="product-overlay">
				<div class="overlay-content">					
					<h2>TK {{ $product->price }}</h2>
					<p>{{ $product->name }}</p>
					<a href="{{ route('category.product.details', $product->id) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
				</div>
			</div>
		</div>
		


		<div class="choose">
			<ul class="nav nav-pills nav-justified">
				<li><a href="#"><i class="fa fa-plus-square"></i>{{ $product->category->name }}</a></li>
				<li><a href="{{ route('category.product.details', $product->id) }}"><i class="fa fa-plus-square"></i>View Product</a></li>
			</ul>
			
		</div>
	</div>

</div>
@endforeach


@endsection