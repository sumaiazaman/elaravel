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
		<a href="{{ route('product.create') }}">Add Product</a>
	</li>
</ul>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon edit"></i><span class="break"></span>Add Product</h2>
		</div>
		<div class="box-content">
			<form class="form-horizontal" method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
				@csrf
				<fieldset>
					<div class="control-group">
						<label class="control-label">Product Name</label>
						<div class="controls">
							<input type="text" style="width: 491px;" class="input-xlarge" name="name" placeholder="Product Name">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="selectError3">Category Name</label>
						<div class="controls">
							<select class="form-control" name="category_id" style="width: 504px;">
								<option>select category</option>
								@foreach($categories as $category)
								<option value="{{ $category->id }}">{{ $category->name }}
								</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="selectError3">Brand Name</label>
						<div class="controls">
							<select class="form-control" name="brand_id" style="width: 504px;">
								<option>select brand</option>
								@foreach($brands as $brand)
								<option value="{{ $brand->id }}">{{ $brand->name }}
								</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="control-group hidden-phone">
						<label class="control-label" >Product Short Description</label>
						<div class="controls">
							<textarea class="cleditor" name="short_description" rows="3" placeholder="Product Short Description"></textarea>
						</div>
					</div>

					<div class="control-group hidden-phone">
						<label class="control-label" >Product Long Description</label>
						<div class="controls">
							<textarea class="cleditor" name="long_description" rows="3" placeholder="Product Long Description"></textarea>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label">Product Price</label>
						<div class="controls">
							<input type="text" style="width: 491px;" class="input-xlarge" name="price" placeholder="Product Price">
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
							<input type="text" style="width: 491px;" class="input-xlarge" name="size" placeholder="Product Size">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label">Product Color</label>
						<div class="controls">
							<input type="text" style="width: 491px;" class="input-xlarge" name="color" placeholder="Product Color">
						</div>
					</div>

					<div class="control-group hidden-phone">
						<label class="control-label" >Publication Status</label>
						<div class="controls">
							<input type="checkbox" name="publication_status" value="1">
						</div>
					</div>

					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Add Product</button>
						<a href="{{ route('product.index') }}" class="btn btn-danger">Back</a>
					</div>
				</fieldset>
			</form>   

		</div>
	</div>

</div><!--/row-->

@endsection