@extends('layouts.admin_app')
@section('content')
<form method="POST" action="{{ route('save_setting_override_hierarchy_bonus') }}" id="setting-override-hierarchy-form">
@csrf
	<div class="row">
		@if(!$levels->isEmpty())
		@foreach($levels as $level)
		<div class="col-md-4 col-12 mt-3">
			<div class="container-box form-group">
				<span class="box form-group" style="background-color: {{ $level->level_colour }};">
					@php
						$langFlag = $_COOKIE['backend_global_language'] ?? ($_COOKIE['backend_global_language'] ?? '0');

							if($langFlag == 1){
								$agent_lvl = $level->agent_lvl_cn;
							}else{
								$agent_lvl = $level->agent_lvl;
							}
					@endphp
					<h2 align='center' style="color: white;" class="text">{{ $agent_lvl }}</h2>
				</span>
				<br>
				<div class="form-group">
					<input type="hidden" name="agent_lvl[]" value="{{ $level->id }}">
					<input type="hidden" name="ids[]" value="{{ !empty($value[$level->id][1]) ? $value[$level->id][1] : '' }}">
					<label>
						{{ isset($data['backendlang']['backendlang']['Commission']) ? $data['backendlang']['backendlang']['Commission'] :'' }} (%)
					</label>
					<input type="text" class="form-control" name="comm_amount[]" placeholder="{{ isset($data['backendlang']['backendlang']['Commission']) ? $data['backendlang']['backendlang']['Commission'] :'' }}"
						   value="{{ !empty($value[$level->id][0]) ? $value[$level->id][0] : '' }}"
						   onkeypress="return isNumberKey(event)">
				</div>
			</div>
		</div>
		@endforeach
		@else
			<h3>{{ isset($data['backendlang']['backendlang']['Agent_Level_Needed']) ? $data['backendlang']['backendlang']['Agent_Level_Needed'] :'' }}</h3>
			<p class="important-text">
				{{ isset($data['backendlang']['backendlang']['Please_go_to']) ? $data['backendlang']['backendlang']['Please_go_to'] :'' }} <b>{{ isset($data['backendlang']['backendlang']['Settings']) ? $data['backendlang']['backendlang']['Settings'] :'' }} <i class="fa fa-long-arrow-right" aria-hidden="true"></i> {{ isset($data['backendlang']['backendlang']['Agent_Level']) ? $data['backendlang']['backendlang']['Agent_Level'] :'' }}</b> {{ isset($data['backendlang']['backendlang']['For_add_Agent_Level_first']) ? $data['backendlang']['backendlang']['For_add_Agent_Level_first'] :'' }} </p>
		@endif
	</div>
</form>

<div class="submit-form-btn">
	<div class="form-group wizard-actions" align="right">
		<button class="btn btn-outline-primary">
			<i class="fa fa-check"> {{ isset($data['backendlang']['backendlang']['Save_Changes']) ? $data['backendlang']['backendlang']['Save_Changes'] :'' }}</i>
		</button>

	</div>
</div>
@endsection
@section('js')
<script type="text/javascript">
	$('.submit-form-btn .btn-outline-primary').click( function(e){
    	e.preventDefault();
    	$('.loading-gif').show();
    	$('#setting-override-hierarchy-form').submit();
    });
</script>
@endsection
