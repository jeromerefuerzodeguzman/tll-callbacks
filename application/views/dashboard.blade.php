@layout('layouts.default')

@section('title')
Dashboard
@endsection


@section('content')
	<h6>CALLBACKS</h6>
	<table>
		<thead>
			<tr>
				<th>View</th>
				<?php if(Auth::user()->account->type->name == 'supervisor') { echo '<th>Agent ID</th>'; } ?>
				<th>Date</th>
				<th>Company Name</th>
				<th>Business Telephone #</th>
				<th>Contact Name</th>
				<th>Industry</th>
				<th>Disposition</th>
			</tr>
		</thead>
		<tbody>
			@foreach($callbacks as $callback)
			<tr style='font-size: 12px;<?php if($today == $callback->date) { echo'background-color:#F08080;'; }?>' >
				<td style="text-align: center;">
					<a href="view_callback/<?php echo $callback->id; ?>"><img class="view_btn" style="cursor: pointer;" width="15px" src={{ URL::base() . '/img/view.png' }} /></a>
				</td>
				<?php if(Auth::user()->account->type->name == 'supervisor') { echo '<td>'. $callback->account->user->username .'</td>'; } ?>
				<td>{{ $callback->date }}</td>
				<td>{{ $callback->company_name }}</td>
				<td>{{ $callback->telephone_number }}</td>
				<td>{{ $callback->contact_name }}</td>
				<td>{{ $callback->industry_name }}</td>
				<td>{{ $callback->disposition->name }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<hr />
	<button class="tiny button round">Click to View Expire Callbacks</button>
	<div id="expired" style="display: none;">
		<h6>EXPIRED CALLBACKS</h6>
		<table>
			<thead>
				<tr>
					<th>View</th>
					<?php if(Auth::user()->account->type->name == 'supervisor') { echo '<th>Agent ID</th>'; } ?>
					<th>Date</th>
					<th>Company Name</th>
					<th>Business Telephone #</th>
					<th>Contact Name</th>
					<th>Industry</th>
					<th>Disposition</th>
				</tr>
			</thead>
			<tbody>
				@foreach($ecallbacks as $ecallback)
				<tr>
					<td style="text-align: center;">
						<a href="view_callback/<?php echo $ecallback->id; ?>"><img class="view_btn" style="cursor: pointer;" width="15px" src={{ URL::base() . '/img/view.png' }} /></a>
					</td>
					<?php if(Auth::user()->account->type->name == 'supervisor') { echo '<td>'. $ecallback->account->user->username .'</td>'; } ?>
					<td>{{ $ecallback->date }}</td>
					<td>{{ $ecallback->company_name }}</td>
					<td>{{ $ecallback->telephone_number }}</td>
					<td>{{ $ecallback->contact_name }}</td>
					<td>{{ $ecallback->industry_name }}</td>
					<td>{{ $ecallback->disposition->name }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection

@section('scripts')
	<script>
		$("button").click(function () {
			$("#expired").toggle('fast');
		});
	</script>
@endsection