@layout('layouts.default')

@section('title')
Search Callbacks
@endsection


@section('content')
	{{ Form::open('search_callback', 'POST', array('class' => 'custom')) }}
	<table width="450px">
		<tr>
			<td>
				{{ Form::label('field', 'Search by:') }}
			</td>
			<td>
				{{ Form::select('field', $field) }}
			</td>
		</tr>
		<tr>
			<td>
				{{ Form::label('keyword', 'Keyword:') }}
			</td>
			<td>
				{{ Form::text('keyword', Input::old('keyword')) }}
			</td>
		</tr>
		<tr>
			<td>
				{{ Form::submit('Search', array('class' => 'button radius')) }}
			</td>
			<td>
			</td>
		</tr>
	</table>
	{{ Form::close() }}
	<hr />
	@if(isset($list))
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
			@foreach($list as $callback)
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
	@endif
@endsection

@section('scripts')

@endsection