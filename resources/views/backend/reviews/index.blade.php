@extends('layouts.admin_app')

@section('content')
<div class="container-box form-group">
	<h3>
		{{ isset($data['backendlang']['backendlang']['Filter']) ? $data['backendlang']['backendlang']['Filter'] :'' }}
	</h3>
	<hr>
	<form action="{{ route('review.reviews.index') }}" method="GET">
	<div class="row">
		<div class="col-sm-2">
			<div class="form-group">
				<input type="text" class="form-control" name="customer_name" value="{{ !empty(request('customer_name')) ? request('customer_name') : '' }}" placeholder="{{ isset($data['backendlang']['backendlang']['Search_Customer_Name']) ? $data['backendlang']['backendlang']['Search_Customer_Name'] :'Search Customer Name' }}">
			</div>
		</div>

		<div class="col-sm-2">
			<div class="form-group">
				<select class="form-control" name="status">
					<option value="">{{ isset($data['backendlang']['backendlang']['Select_Status']) ? $data['backendlang']['backendlang']['Select_Status'] :'' }}</option>
					<option {{ (!empty(request('status')) && request('status') == '1') ? 'selected' : '' }} value="1">{{ isset($data['backendlang']['backendlang']['Active']) ? $data['backendlang']['backendlang']['Active'] :'' }}</option>
					<option {{ (!empty(request('status')) && request('status') == '2') ? 'selected' : '' }} value="2">{{ isset($data['backendlang']['backendlang']['Inactive']) ? $data['backendlang']['backendlang']['Inactive'] :'' }}</option>
				</select>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<div class="col-sm-2">
				<div class="form-group">
					{{ isset($data['backendlang']['backendlang']['Item_Per_Page']) ? $data['backendlang']['backendlang']['Item_Per_Page'] :'' }}: <br>
					<select class="input-small" name="per_page">
						<option value="10">10</option>
						<option value="20">20</option>
						<option value="50">50</option>
					</select>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<button class="btn btn-outline-primary btn-sm">
						<i class="bi bi-search"></i> {{ isset($data['backendlang']['backendlang']['Search']) ? $data['backendlang']['backendlang']['Search'] :'' }}
					</button>
					<a href="{{ route('review.reviews.index') }}" class="btn btn-warning btn-sm">
						<i class="bi bi-arrow-clockwise"></i> {{ isset($data['backendlang']['backendlang']['Clear_Search']) ? $data['backendlang']['backendlang']['Clear_Search'] :'' }}
					</a>
				</div>
			</div>
		</div>
	</div>
	</form>
</div>

<div class="form-group container-box">
	@if(!empty($data['permission']['permission'][Auth::guard($data['userGuardRole'])->user()->permission_lvl]['setting-reviews']))
	<div class="form-group" align="right">
		<a href="{{ route('review.reviews.create') }}" class="btn btn-outline-success btn-sm">
			<i class="bi bi-plus"></i> {{ isset($data['backendlang']['backendlang']['Add_New_Review']) ? $data['backendlang']['backendlang']['Add_New_Review'] :'Add New Review' }}
		</a>
	</div>
	@endif
	<div class="row">
		<div class="col-12">
			<table class="table table-bordered">
				<thead>
					<tr class="info">
						<th>#</th>
						<th>{{ isset($data['backendlang']['backendlang']['Photo']) ? $data['backendlang']['backendlang']['Photo'] :'Photo' }}</th>
						<th>{{ isset($data['backendlang']['backendlang']['Customer_Name']) ? $data['backendlang']['backendlang']['Customer_Name'] :'Customer Name' }}</th>
						<th>{{ isset($data['backendlang']['backendlang']['Rating']) ? $data['backendlang']['backendlang']['Rating'] :'Rating' }}</th>
						<th>{{ isset($data['backendlang']['backendlang']['Review_Text_EN']) ? $data['backendlang']['backendlang']['Review_Text_EN'] :'Review Text' }}</th>
						<th>{{ isset($data['backendlang']['backendlang']['Status']) ? $data['backendlang']['backendlang']['Status'] :'' }}</th>
						<th>{{ isset($data['backendlang']['backendlang']['Action']) ? $data['backendlang']['backendlang']['Action'] :'' }}</th>
					</tr>
				</thead>
				<tbody>
					@if (!$reviews->isEmpty())
					@foreach($reviews as $key => $review)
					<tr>
						<td>{{ $key+1 }}
							<input type="hidden" class="row_id" value="{{ $review->id }}">
						</td>
						<td>
							@if(!empty($review->image))
							<img src="{{ asset($review->image) }}" width="60px">
							@endif
						</td>
						<td>{{ $review->customer_name }}</td>
						<td>
							@for($i = 1; $i <= 5; $i++)
								<i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}" style="color: #d6ad55;"></i>
							@endfor
						</td>
						<td>{{ \Illuminate\Support\Str::limit($review->review_text, 80) }}</td>
						<td>
							@if ($review->status == 1)
								<span class="badge bg-success">
									{{ $data['backendlang']['backendlang']['Active'] ?? '' }}
								</span>
							@else
								<span class="badge bg-danger">
									{{ $data['backendlang']['backendlang']['Inactive'] ?? '' }}
								</span>
							@endif
						</td>
						<td>
							@if(!empty($data['permission']['permission'][Auth::guard($data['userGuardRole'])->user()->permission_lvl]['setting-reviews']))
							<a href="{{ route('review.reviews.edit', $review->id) }}" class="btn btn-outline-primary btn-sm">
								<i style="width: 20px;" class="ace-icon bi bi-pencil bigger-130"></i>
							</a>
							&nbsp;&nbsp;
							@if($review->status == 1)
							<a href="#" class="red change-status btn btn-outline-danger btn-sm" data-id="2">
								<i style="width: 20px;" class="ace-icon bi bi-shield-fill-x bigger-130"></i>
							</a>
							@else
							<a href="#" class="green change-status btn btn-outline-success btn-sm" data-id="1">
								<i style="width: 20px;" class="ace-icon bi bi-shield-check bigger-130"></i>
							</a>
							@endif
							&nbsp;&nbsp;
							<a href="#" class="red change-status btn btn-outline-danger btn-sm" data-id="3">
								<i style="width: 20px;" class="ace-icon bi bi-trash bigger-130"></i>
							</a>
							@endif
						</td>
					</tr>
					@endforeach
					@else
					<tr>
						<td colspan="7">{{ isset($data['backendlang']['backendlang']['No_Result_Found']) ? $data['backendlang']['backendlang']['No_Result_Found'] :'' }}</td>
					</tr>
					@endif
				</tbody>
			</table>
			{{ $reviews->links() }}
		</div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
	$('.change-status').click(function(){
        $('.loading-gif').show();
        var ele = $(this);
        var row_id = ele.closest('tr').find('.row_id').val();

        var fd = new FormData();
        fd.append('row_id', row_id);
        fd.append('status', ele.data('id'));

        $.ajax({
           url: '{{ route("ReviewStatus") }}',
           type: 'post',
           data: fd,
           contentType: false,
           processData: false,
           success: function(response){
                $('.loading-gif').hide();
                toastr.success("{{ isset($data['backendlang']['backendlang']['Update_Successful']) ? $data['backendlang']['backendlang']['Update_Successful'] :'' }}");
                window.location.href="{{ route('review.reviews.index') }}";
           },
        });
    });
</script>
@endsection
