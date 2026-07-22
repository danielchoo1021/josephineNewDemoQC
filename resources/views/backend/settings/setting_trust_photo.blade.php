@extends('layouts.admin_app')
@section('content')
<div class="form-group">
	<form method="POST" action="{{ route('save_setting_trust_photo') }}" id="setting-merchant-form" enctype="multipart/form-data">
		@csrf
		<div class="big-parent pb-5">
			<div class="form-group">
				<div class="row">
					<div class="col-12">
						<div class="form-group container-box">
							<h4>1/3 Images</h4>
							<hr>
							<div class="row">
								<div class="col-sm-12">
									<input type="file" name="image" class="form-control" accept="image/*">
									<small class="form-text text-muted">Max file size: 20MB.</small>
									@error('image')
										<div class="text-danger">{{ $message }}</div>
									@enderror
									@if(!empty($trust_photo->image))
										<img src="{{ asset($trust_photo->image) }}" width="200" class="mt-2">
									@endif
								</div>
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
    		alert('Image file size must not exceed 20MB.');
    		return;
    	}

    	$('#setting-merchant-form').submit();
    });
</script>
@endsection
