@extends('layouts.admin_app')

@section('content')
<div class="container-box form-group">
	<div class="page-header">
	    <h3>
	        {{ $product->product_name }}
	        <span>
	            <i class="ace-icon fa fa-angle-double-right"></i>
	           	Home Page Featured Product Settings
	        </span>
	    </h3>
	</div>
	<hr>

	<form method="POST" action="{{ route('save_featured_settings', $product->id) }}" enctype="multipart/form-data">
		@csrf
		@if($errors->any())
		  	<div class="alert alert-danger">{!! implode('<br/>', $errors->all(':message')) !!}</div>
		@endif

		<div class="form-group">
			<label>Display Name</label>
			<input type="text" class="form-control" name="featured_display_name" placeholder="{{ $product->product_name }}"
				   value="{{ old('featured_display_name', $product->featured_display_name) }}">
			<small class="text-muted">Leave blank to use the product name "{{ $product->product_name }}" on the home page.</small>
		</div>

		<div class="form-group">
			<label>Point 1</label>
			<input type="text" class="form-control" name="featured_point_1" value="{{ old('featured_point_1', $product->featured_point_1) }}">
		</div>

		<div class="form-group">
			<label>Point 2</label>
			<input type="text" class="form-control" name="featured_point_2" value="{{ old('featured_point_2', $product->featured_point_2) }}">
		</div>

		<div class="form-group">
			<label>Point 3</label>
			<input type="text" class="form-control" name="featured_point_3" value="{{ old('featured_point_3', $product->featured_point_3) }}">
		</div>

		<div class="form-group">
			<label>Featured Image</label>
			<br>
			<img src="{{ asset(!empty($product->featured_image) ? $product->featured_image : 'images/no-image-available-icon-61.jpg') }}" class="img-thumbnail mb-2" width="150px">
			<input type="file" name="featured_image" class="form-control" accept="image/*">
			<small class="text-muted">Leave blank to keep the current image.</small>
		</div>

		<div class="submit-form-btn">
			<div class="form-group wizard-actions" align="right">
				<a href="{{ route('product.products.index') }}" class="btn btn-outline-danger">
					<i class="fa fa-ban"> {{ isset($data['backendlang']['backendlang']['Cancel']) ? $data['backendlang']['backendlang']['Cancel'] :'' }}</i>
				</a>

				<button class="btn btn-outline-primary">
					<i class="fa fa-check"> {{ isset($data['backendlang']['backendlang']['Update']) ? $data['backendlang']['backendlang']['Update'] :'Update' }}</i>
				</button>
			</div>
		</div>
	</form>
</div>
@endsection
