@extends('layouts.admin_app')

@section('content')
@if(Session::has('success'))
<div class="alert alert-success">{{ Session::get('success') }}</div>
@endif

<div class="form-group">
	<div class="card mb-4">
		<div class="card-header">
			<strong>Brand Introduction</strong>
		</div>
		<div class="card-body">
			<form method="POST" action="{{ route('save_setting_brand_intro') }}" enctype="multipart/form-data">
				@csrf
				<div class="form-group">
					<label>Image</label><br>
					@if(!empty($data['website_setting']->brand_intro_image))
					<img src="{{ \App\Http\Controllers\GlobalController::get_production_url($data['website_setting']->brand_intro_image) }}" style="max-width: 250px; display:block; margin-bottom: 10px;">
					@endif
					<input type="file" name="brand_intro_image" class="form-control" accept="image/*">
				</div>
				<div class="form-group">
					<label>Eyebrow Text</label>
					<input type="text" name="brand_intro_eyebrow" class="form-control" placeholder="OUR BRAND" value="{{ $data['website_setting']->brand_intro_eyebrow ?? '' }}">
				</div>
				<div class="form-group">
					<label>Heading</label>
					<input type="text" name="brand_intro_heading" class="form-control" placeholder="Cleanliness Begins with Nature" value="{{ $data['website_setting']->brand_intro_heading ?? '' }}">
				</div>
				<div class="form-group">
					<label>Body Text</label>
					<textarea name="brand_intro_body" class="form-control" rows="4">{{ $data['website_setting']->brand_intro_body ?? '' }}</textarea>
				</div>
				<button type="submit" class="btn btn-primary btn-sm">
					<i class="fa fa-check"></i> {{ isset($data['backendlang']['backendlang']['Save_Changes']) ? $data['backendlang']['backendlang']['Save_Changes'] :'Save Changes' }}
				</button>
			</form>
		</div>
	</div>

	<div class="card">
		<div class="card-header d-flex justify-content-between align-items-center">
			<strong>Feature List (right side icons)</strong>
			<button type="button" class="btn btn-primary btn-sm" id="add_brand_intro_feature">
				<i class="fa fa-plus"></i> Add Item
			</button>
		</div>
		<div class="card-body">
			<small class="text-muted">Icon field takes a Font Awesome class, e.g. <code>fa fa-users</code>, <code>fa fa-seedling</code>, <code>fa fa-globe</code>, <code>fa fa-sparkles</code>.</small>
			<div class="form-group product-image-list mt-3">
				<div class="row" id="imageListId">

				</div>
				<div class="clear-both"></div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript">
	var url = '{{ route("LoadBrandIntroFeatures") }}';

	$.ajax({
        url: url,
        type: 'get',
        success: function(response){
            $('.product-image-list .row').html(response);
        },
    });

    $('#add_brand_intro_feature').click(function(e){
        e.preventDefault();
        $.ajax({
           url: '{{ route("addBrandIntroFeature") }}',
           type: 'post',
           success: function(response){
                $('.product-image-list .row').html(response);
           },
        });
    });

    $('.product-image-list').on('click', '.product-image-thumbnail .delete-image', function(e){
        e.preventDefault();
        var delete_btn = $(this);
        if(confirm("{{ isset($data['backendlang']['backendlang']['Delete_This_Image']) ? $data['backendlang']['backendlang']['Delete_This_Image'] :'Delete this item?' }}") == true){
            var url = '{{ route("DeleteBrandIntroFeature", ":id") }}';
            url = url.replace(':id', $(this).data('id'));
            $.ajax({
                url: url,
                type: 'get',
                success: function(response){
                    delete_btn.closest('.product-image-thumbnail').hide();
                },
            });
        }else{
            return false;
        }
    });

    $(document).on('change', '.brand_intro_feature_icon', function(e){
        var ele = $(this);
        var fd = new FormData();
            fd.append('icon', ele.val());
            fd.append('id', ele.data('id'));

        $.ajax({
           url: '{{ route("changeBrandIntroFeatureIcon") }}',
           type: 'post',
           data: fd,
           contentType: false,
           processData: false,
           success: function(response){
                toastr.success("{{ isset($data['backendlang']['backendlang']['Update_Successful']) ? $data['backendlang']['backendlang']['Update_Successful'] :'Updated' }}");
           },
        });
    });

    $(document).on('change', '.brand_intro_feature_title', function(e){
        var ele = $(this);
        var fd = new FormData();
            fd.append('title', ele.val());
            fd.append('id', ele.data('id'));

        $.ajax({
           url: '{{ route("changeBrandIntroFeatureTitle") }}',
           type: 'post',
           data: fd,
           contentType: false,
           processData: false,
           success: function(response){
                toastr.success("{{ isset($data['backendlang']['backendlang']['Update_Successful']) ? $data['backendlang']['backendlang']['Update_Successful'] :'Updated' }}");
           },
        });
    });

    $(document).on('change', '.brand_intro_feature_subtitle', function(e){
        var ele = $(this);
        var fd = new FormData();
            fd.append('subtitle', ele.val());
            fd.append('id', ele.data('id'));

        $.ajax({
           url: '{{ route("changeBrandIntroFeatureSubtitle") }}',
           type: 'post',
           data: fd,
           contentType: false,
           processData: false,
           success: function(response){
                toastr.success("{{ isset($data['backendlang']['backendlang']['Update_Successful']) ? $data['backendlang']['backendlang']['Update_Successful'] :'Updated' }}");
           },
        });
    });

    $(function() {
        $("#imageListId").sortable({
            update: function(event, ui) {
                    getIdsOfImages();
                }
        });
    });

    function getIdsOfImages() {
        var a = 0;
        $('.product-image-thumbnail').each(function(index) {
            a++;
            var mid = $(this).data('id');

            var fd = new FormData();
                fd.append('mid', mid);
                fd.append('number', a);

            $.ajax({
               url: '{{ route("SortBrandIntroFeature") }}',
               type: 'post',
               data: fd,
               contentType: false,
               processData: false,
               success: function(response){
                    toastr.success("{{ isset($data['backendlang']['backendlang']['Updated']) ? $data['backendlang']['backendlang']['Updated'] :'Updated'}}");
               },
            });
        });
    }
</script>
@endsection
