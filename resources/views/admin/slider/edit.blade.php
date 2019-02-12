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
		<a href="{{ route('slider.update',$slider->id) }}">Update Slider</a>
	</li>
</ul>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon edit"></i><span class="break"></span>Add Slider</h2>
		</div>
		<div class="box-content">
			<form class="form-horizontal" method="post" action="{{ route('slider.update',$slider->id) }}" enctype="multipart/form-data">
				@csrf
				@method('PUT')
				<fieldset>
					<div class="control-group">
						<label class="control-label">Slider Title</label>
						<div class="controls">
							<input type="text" style="width: 491px;" class="input-xlarge" name="title" value="{{ $slider->title }}">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label">Slider Sub_Title</label>
						<div class="controls">
							<input type="text" style="width: 491px;" class="input-xlarge" name="sub_title" value="{{ $slider->sub_title }}">
						</div>
					</div>					

					<div class="control-group">
						<label class="control-label" for="fileInput">Slider Image</label>
						<div class="controls">
							<input class="input-file uniform_on" name="image" id="fileInput" type="file">
						</div>
					</div>

					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Update Slider</button>
						<a href="{{ route('slider.index') }}" class="btn btn-danger">Back</a>
					</div>
				</fieldset>
			</form>   

		</div>
	</div>

</div><!--/row-->

@endsection