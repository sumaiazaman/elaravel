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
		<a href="{{ route('product.index') }}">All Product</a>
	</li>
</ul>

<div class="row-fluid sortable">		
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon user"></i><span class="break"></span>All Product</h2>
		</div>
		<div class="box-content">
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Category Name</th>
						<th>Brand Name</th>
						<th>Short Description</th>
						<th>Long Description</th>
						<th>Image</th>
						<th>Size</th>
						<th>Color</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>   
				<tbody>
					@foreach($products  as $key => $product)
					<tr>
						<td>{{ $key+1 }}</td>
						<td class="center">{{ $product->name }}</td>
						<td class="center">{{ $product->category->name }}</td>
						<td class="center">{{ $product->brand->name }}</td>
						<td class="center">{{ $product->short_description }}</td>
						<td class="center">{{ $product->long_description }}</td>

						<td>
							<img src="{{ asset('/uploads/product/'.$product->image) }}" class="img-responsive img-thumbnail" style="width: 100px; height: 100px;">
						</td>

						<td class="center">{{ $product->size }}</td>
						<td class="center">{{ $product->color }}</td>

						<td class="center">
							@if($product->publication_status == 1)
							<span class="label label-success">Active</span>
							@else
							<span class="label label-danger">Inactive</span>
							@endif
						</td>
						<td class="center">
							@if($product->publication_status == 1)
							<a class="btn btn-danger" href="{{ route('product.inactive',$product->id) }}">
								<i class="halflings-icon white thumbs-down"></i>                
							</a>
							@else
							<a class="btn btn-success" href="{{ route('product.active',$product->id) }}">
								<i class="halflings-icon white thumbs-up"></i>                
							</a>
							@endif

							<a class="btn btn-info" href="{{ route('product.edit', $product->id) }}">
								<i class="halflings-icon white edit"></i>                                            
							</a>
							
							<form id="delete-form-{{ $product->id }}" method="POST" action="{{ route('product.destroy',$product->id) }}"style="display: none;">
								@csrf
								@method('DELETE')
							</form>

							<button type="button" class="btn btn-danger btn-sm"onclick="if(confirm('Are you sure? You want to delete this?')){
								event.preventDefault();
								document.getElementById('delete-form-{{ $product->id }}').submit();
							}
							else{
								event.preventDefault();
							}"><i class="halflings-icon white trash"></i></button>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>            
		</div>
	</div><!--/span-->

</div><!--/row-->

@endsection