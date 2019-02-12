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
		<a href="{{ route('category.update', $category->id) }}">Update Category</a>
	</li>
</ul>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon edit"></i><span class="break"></span>Update Category</h2>
		</div>
		<div class="box-content">
			<form class="form-horizontal" method="post" action="{{ route('category.update',$category->id) }}">
				@csrf
				@method('PUT')
				<fieldset>
					<div class="control-group">
						<label class="control-label">Category Name</label>
						<div class="controls">
							<input type="text" style="width: 491px;" class="input-xlarge" name="name" value="{{ $category->name }}">
						</div>
					</div>

					<div class="control-group hidden-phone">
						<label class="control-label" >Category Description</label>
						<div class="controls">
							<textarea class="cleditor" name="description" rows="3">{{ $category->description }}</textarea>
						</div>
					</div>

					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Update Category</button>
						<a href="{{ route('category.index') }}" class="btn btn-danger">Back</a>
					</div>
				</fieldset>
			</form>   

		</div>
	</div>

</div><!--/row-->

@endsection