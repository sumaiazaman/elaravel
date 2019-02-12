@extends('admin_layout')

@section('admin_content')
<ul class="breadcrumb">
	<li>
		<i class="icon-home"></i>
		<a href="{{ route('admin.dashboard') }}">Home</a>
		<i class="icon-angle-right"></i> 
	</li>
	<li>
		<i class="icon-edit"></i>
		<a href="{{ route('product.update', $product->id) }}">Update Product</a>
	</li>
</ul>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon edit"></i><span class="break"></span>Update Product</h2>
		</div>
		<div class="box-content">
			<form class="form-horizontal" method="post" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
				@csrf
				@method('PUT')
				<fieldset>
					<div class="control-group">
						<label class="control-label">Product Name</label>
						<div class="controls">
							<input type="text" style="width: 491px;" class="input-xlarge" name="name" value="{{ $product->name }}">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="selectError3">Category Name</label>
						<div class="controls">
							<select class="form-control" name="category_id" style="width: 504px;">
								@foreach($categories as $category)
								<option {{ $category->id == $product->category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}
								</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="selectError3">Brand Name</label>
						<div class="controls">
							<select class="form-control" name="brand_id" style="width: 504px;">
								@foreach($brands as $brand)
								<option {{ $brand->id == $product->brand->id ? 'selected' : '' }} value="{{ $brand->id }}">{{ $brand->name }}
								</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="control-group hidden-phone">
						<label class="control-label" >Product Short Description</label>
						<div class="controls">
							<textarea class="cleditor" name="short_description" rows="3"> {{ $product->short_description }}</textarea>
						</div>
					</div>

					<div class="control-group hidden-phone">
						<label class="control-label" >Product Long Description</label>
						<div class="controls">
							<textarea class="cleditor" name="long_description" rows="3"> {{ $product->long_description }}</textarea>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label">Product Price</label>
						<div class="controls">
							<input type="text" style="width: 491px;" class="input-xlarge" name="price" value="{{ $product->price }}">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="fileInput">Product Image</label>
						<div class="controls">
							<input class="input-file uniform_on" name="image" id="fileInput" type="file">
						</div>
					</div>					

					<div class="control-group">
						<label class="control-label">Product Size</label>
						<div class="controls">
							<input type="text" style="width: 491px;" class="input-xlarge" name="size" value="{{ $product->size }}">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label">Product Color</label>
						<div class="controls">
							<input type="text" style="width: 491px;" class="input-xlarge" name="color" value="{{ $product->color }}">
						</div>
					</div>

					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Update Product</button>
						<a href="{{ route('product.index') }}" class="btn btn-danger">Back</a>
					</div>
				</fieldset>
			</form>    

		</div>
	</div>

</div><!--/row-->

@endsection