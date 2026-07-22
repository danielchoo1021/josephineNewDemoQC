<div class="container-box form-group mb-5 pb-5">
	<div class="row">
		<div class="col-12">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						{{ isset($data['backendlang']['backendlang']['Customer_Name_EN']) ? $data['backendlang']['backendlang']['Customer_Name_EN'] :'Customer Name (EN)' }}: <span class="important-text">*</span>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="customer_name" value="{{ isset($review) ? $review->customer_name : old('customer_name') }}" placeholder="{{ isset($data['backendlang']['backendlang']['Customer_Name_EN']) ? $data['backendlang']['backendlang']['Customer_Name_EN'] :'Customer Name (EN)' }} *">
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						{{ isset($data['backendlang']['backendlang']['Customer_Name_CN']) ? $data['backendlang']['backendlang']['Customer_Name_CN'] :'Customer Name (CN)' }}:
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="customer_name_cn" value="{{ isset($review) ? $review->customer_name_cn : old('customer_name_cn') }}" placeholder="{{ isset($data['backendlang']['backendlang']['Customer_Name_CN']) ? $data['backendlang']['backendlang']['Customer_Name_CN'] :'Customer Name (CN)' }}">
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						{{ isset($data['backendlang']['backendlang']['Photo']) ? $data['backendlang']['backendlang']['Photo'] :'Photo' }}:
					</div>
					<div class="col-sm-10">
						<input type="file" class="form-control" name="image" accept="image/*">
						@if(!empty($review->image))
						<img src="{{ asset($review->image) }}" width="80px" class="mt-2">
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						{{ isset($data['backendlang']['backendlang']['Rating']) ? $data['backendlang']['backendlang']['Rating'] :'Rating' }}: <span class="important-text">*</span>
					</div>
					<div class="col-sm-10">
						@php
							$selectedRating = isset($review) ? $review->rating : old('rating', 5);
						@endphp
						<select class="form-control" name="rating">
							@for($i = 5; $i >= 1; $i--)
								<option {{ ($selectedRating == $i) ? 'selected' : '' }} value="{{ $i }}">{{ $i }} {{ isset($data['backendlang']['backendlang']['Stars']) ? $data['backendlang']['backendlang']['Stars'] :'Stars' }}</option>
							@endfor
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						{{ isset($data['backendlang']['backendlang']['Review_Text_EN']) ? $data['backendlang']['backendlang']['Review_Text_EN'] :'Review Text (EN)' }}: <span class="important-text">*</span>
					</div>
					<div class="col-sm-10">
						<textarea class="form-control" name="review_text" rows="3" placeholder="{{ isset($data['backendlang']['backendlang']['Review_Text_EN']) ? $data['backendlang']['backendlang']['Review_Text_EN'] :'Review Text (EN)' }} *">{{ isset($review) ? $review->review_text : old('review_text') }}</textarea>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						{{ isset($data['backendlang']['backendlang']['Review_Text_CN']) ? $data['backendlang']['backendlang']['Review_Text_CN'] :'Review Text (CN)' }}:
					</div>
					<div class="col-sm-10">
						<textarea class="form-control" name="review_text_cn" rows="3" placeholder="{{ isset($data['backendlang']['backendlang']['Review_Text_CN']) ? $data['backendlang']['backendlang']['Review_Text_CN'] :'Review Text (CN)' }}">{{ isset($review) ? $review->review_text_cn : old('review_text_cn') }}</textarea>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						{{ isset($data['backendlang']['backendlang']['Sort_Level']) ? $data['backendlang']['backendlang']['Sort_Level'] :'Sort Level' }}:
					</div>
					<div class="col-sm-10">
						<input type="number" class="form-control" name="sort_level" value="{{ isset($review) ? $review->sort_level : old('sort_level') }}" placeholder="{{ isset($data['backendlang']['backendlang']['Sort_Level']) ? $data['backendlang']['backendlang']['Sort_Level'] :'Sort Level' }} (lower shows first)">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
