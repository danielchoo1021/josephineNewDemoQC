@extends('layouts.admin_app')
@section('content')
@if($errors->any())
  <div class="alert alert-danger">{!! implode('<br/>', $errors->all(':message')) !!}</div>
@endif
<form method="POST" action="{{ route('review.reviews.store') }}" id="review-form" enctype="multipart/form-data">
@csrf
@include('backend.reviews.form')
</form>

@if(!empty($data['permission']['permission'][Auth::guard($data['userGuardRole'])->user()->permission_lvl]['setting-reviews']))
<div class="submit-form-btn">
	<div class="form-group wizard-actions" align="right">
		<a href="{{ route('review.reviews.index') }}" class="btn btn-outline-danger">
			<i class="bi bi-ban"> {{ isset($data['backendlang']['backendlang']['Cancel']) ? $data['backendlang']['backendlang']['Cancel'] :'' }}</i>
		</a>

		<button class="btn btn-outline-primary">
			<i class="bi bi-check"> {{ isset($data['backendlang']['backendlang']['Create']) ? $data['backendlang']['backendlang']['Create'] :'' }}</i>
		</button>

	</div>
</div>
@endif
@endsection

@section('js')
<script type="text/javascript">
	$('.submit-form-btn .btn-outline-primary').click( function(e){
    	e.preventDefault();

    	$('#review-form').submit();
    });
</script>
@endsection
