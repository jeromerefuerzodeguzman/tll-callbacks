@layout('layouts.default')

@section('title')
"{{ $agent->user->username }}" LIST
@endsection


@section('content')
	<h6 style="text-decoration: underline">CALLBACKS</h6>
	<table style="font-size: 14px;" width="720px" >
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
				<th>Comments</th>
			</tr>
		</thead>
		<tbody>
			@foreach($callbacks as $callback)
			<tr style='font-size: 12px;<?php if($today == $callback->date) { echo'background-color:#F08080;'; }?>' >
				<td style="text-align: center;">
					<a href="<?php echo URL::to('view_callback/'. $callback->id); ?>"><img class="view_btn" style="cursor: pointer;" width="15px" src={{ URL::base() . '/img/view.png' }} /></a>
				</td>
				<?php if(Auth::user()->account->type->name == 'supervisor') { echo '<td>'. $callback->account->user->username .'</td>'; } ?>
				<td>{{ $callback->date }}</td>
				<td>{{ $callback->company_name }}</td>
				<td>{{ $callback->telephone_number }}</td>
				<td>{{ $callback->contact_name }}</td>
				<td>{{ $callback->industry_name }}</td>
				<td>{{ $callback->disposition->name }}</td>
				<td>{{ $callback->comments }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@endsection

@section('scripts')
@endsection