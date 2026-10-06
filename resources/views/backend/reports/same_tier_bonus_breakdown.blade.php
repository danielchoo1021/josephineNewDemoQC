@php
	$itemsTotal = $items->sum('comm_amount');
	$rate = $bonus->comm_pa;
	$calculated = $itemsTotal * $rate / 100;
@endphp
<div class="mb-3">
	<table class="table table-sm table-borderless mb-0">
		<tr>
			<td style="width: 35%;"><b>Bonus</b></td>
			<td>{{ $bonus->comm_desc }}</td>
		</tr>
		<tr>
			<td><b>Paid to</b></td>
			<td>{{ $upline->f_name ?? '' }} ({{ $bonus->user_id }}){{ !empty($uplineLevel) ? ' - '.$uplineLevel : '' }}</td>
		</tr>
		<tr>
			<td><b>Same-level direct downline</b></td>
			<td>{{ $downline->f_name ?? '' }} ({{ $bonus->user_by }}){{ !empty($downlineLevel) ? ' - '.$downlineLevel : '' }}</td>
		</tr>
		<tr>
			<td><b>Month counted</b></td>
			<td>{{ $period ?? '-' }}</td>
		</tr>
	</table>
</div>

<p class="mb-2"><b>Commissions the downline received in {{ $period ?? 'this month' }}</b> (Order Rebate and Overriding Hierarchy, approved only)</p>

<div class="table-responsive">
	<table class="table table-bordered table-sm">
		<thead>
			<tr class="success">
				<th>#</th>
				<th>Date</th>
				<th>Commission Type</th>
				<th>Transaction Number</th>
				<th class="text-right">Amount (RM)</th>
			</tr>
		</thead>
		<tbody>
			@forelse($items as $key => $item)
			<tr>
				<td>{{ $key + 1 }}</td>
				<td>{{ $item->created_at }}</td>
				<td>{{ $item->comm_desc }}</td>
				<td>{{ !empty($item->transaction_no) ? $item->transaction_no : '-' }}</td>
				<td class="text-right">{{ number_format($item->comm_amount, 4) }}</td>
			</tr>
			@empty
			<tr>
				<td colspan="5" align="center">No commission found.</td>
			</tr>
			@endforelse
			<tr class="warning">
				<td colspan="4"><b>Total received by {{ $bonus->user_by }}</b></td>
				<td class="text-right"><b>{{ number_format($itemsTotal, 4) }}</b></td>
			</tr>
		</tbody>
	</table>
</div>

<div class="p-3 mb-2" style="background-color: #f1f5ff; border-radius: 6px;">
	<p class="mb-1"><b>Calculation</b></p>
	<p class="mb-0">
		{{ number_format($bonus->product_amount, 4) }} &times; {{ rtrim(rtrim(number_format($rate, 4), '0'), '.') }}% =
		<b>RM {{ number_format($bonus->comm_amount, 4) }}</b>
	</p>
</div>

@if(abs($itemsTotal - $bonus->product_amount) > 0.0001)
<p class="text-danger mb-0">
	<small>
		The list above currently adds up to {{ number_format($itemsTotal, 4) }}, but the bonus was calculated on {{ number_format($bonus->product_amount, 4) }}.
		Some of the downline's commissions have changed since the bonus was paid (for example cancelled or burned).
	</small>
</p>
@endif
