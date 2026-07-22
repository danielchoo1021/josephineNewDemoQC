@extends('layouts.admin_app')
@section('content')
<div class="form-group">
	<form method="POST" action="{{ route('save_setting_home_video') }}" id="setting-merchant-form" enctype="multipart/form-data">
		@csrf
		<div class="big-parent pb-5">
			<div class="form-group">
				<div class="row">
					<div class="col-12">
						<div class="form-group container-box">
							<h4>Video</h4>
							<hr>
							<div class="row">
								<div class="col-sm-12">
									<input type="file" name="image[1]" class="form-control" accept="video/mp4,video/quicktime,video/x-msvideo,video/x-ms-wmv">
									<small class="form-text text-muted">Max file size: 20MB. Allowed formats: mp4, mov, avi, wmv.</small>
									@error('image.1')
										<div class="text-danger">{{ $message }}</div>
									@enderror
									@if(!empty($video[1]->image))
										<video width="400" controls>
											<source src="{{ asset($video[1]->image) }}" type="video/mp4">
										</video>
									@endif
								</div>
							</div>
						</div>
					</div>
					<div class="col-12">
						<div class="container-box">
							<h4>Title (English)</h4>
							<hr>
							<div class="form-group">
								<input type="text" class="form-control" name="title[1]" value="{{ !empty($video[1]->title) ? $video[1]->title : '' }}" placeholder="e.g. OUR PROMISE">
							</div>
						</div>
					</div>
					<div class="col-12">
						<div class="container-box">
							<h4>Title (中文)</h4>
							<hr>
							<div class="form-group">
								<input type="text" class="form-control" name="title_cn[1]" value="{{ !empty($video[1]->title_cn) ? $video[1]->title_cn : '' }}" placeholder="例：我们的承诺">
							</div>
						</div>
					</div>
					<div class="col-12">
						<div class="container-box">
							<h4>Text (English)</h4>
							<hr>
							<div class="form-group">
								<input type="text" class="form-control" name="text[1]" value="{{ !empty($video[1]->text) ? $video[1]->text : '' }}" placeholder="e.g. For a cleaner home and a better planet.">
							</div>
						</div>
					</div>
					<div class="col-12">
						<div class="container-box">
							<h4>Text (中文)</h4>
							<hr>
							<div class="form-group">
								<input type="text" class="form-control" name="text_cn[1]" value="{{ !empty($video[1]->text_cn) ? $video[1]->text_cn : '' }}" placeholder="例：为了更干净的家，也为了更好的地球。">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
	<div class="submit-form-btn">
		<div class="form-group wizard-actions" align="right">
			<button class="btn btn-outline-primary">
				<i class="fa fa-check"> {{ isset($data['backendlang']['backendlang']['Save_Changes']) ? $data['backendlang']['backendlang']['Save_Changes'] :'' }}</i>
			</button>
		</div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
	$('.submit-form-btn .btn-outline-primary').click( function(e){
    	e.preventDefault();

    	var maxSize = 20 * 1024 * 1024;
    	var oversized = false;

    	$('#setting-merchant-form input[type="file"]').each(function(){
    		if(this.files.length && this.files[0].size > maxSize){
    			oversized = true;
    		}
    	});

    	if(oversized){
    		e.stopPropagation();
    		$('.loading-gif').hide();
    		alert('Video file size must not exceed 20MB.');
    		return;
    	}

    	$('#setting-merchant-form').submit();
    });
</script>
@endsection
