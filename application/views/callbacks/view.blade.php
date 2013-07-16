@layout('layouts.default')

@section('title')
View Callback
@endsection


@section('content')
	<table width="500px">
		<tr>
			<th width="200px">Labels</th>
			<th width="300px">Values</th>
		</tr>
		<tr>
			<td><strong>Agent Id: </strong></td>
			<td>{{ $callback->account->user->username }}</td>
		</tr>
		<tr>
			<td><strong>Date: </strong></td>
			<td>{{ $callback->date }}</td>
		</tr>
		<tr>
			<td><strong>Company Name: </strong></td>
			<td>{{ $callback->company_name }}</td>
		</tr>
		<tr>
			<td><strong>Business Telephone Number: </strong></td>
			<td>{{ $callback->telephone_number }}</td>
		</tr>
		<tr>
			<td><strong>Contact Name: </strong></td>
			<td>{{ $callback->contact_name }}</td>
		</tr>
		<tr>
			<td><strong>Industry: </strong></td>
			<td>{{ $callback->industry_name }}</td>
		</tr>
		<tr>
			<td><strong>Disposition: </strong></td>
			<td>{{ $callback->disposition->name }}</td>
		</tr>
		<tr>
			<td><strong>Address: </strong></td>
			<td>{{ $callback->address }}</td>
		</tr>
		<tr>
			<td><strong>Comments: </strong></td>
			<td>{{ $callback->comments }}</td>
		</tr>
		<tr>
			<td><strong>Tags: </strong></td>
			<td>{{ $callback->tags }}</td>
		</tr>
	</table>
	<hr />
	Transfer this Callback to other AGENT:
	<br />
	{{ Form::open('transfer_callback', 'POST', array('class' => 'custom')) }}
	<table width="500px">
		<tr>
			<td width="100px">
				{{ Form::label('account_id', 'AGENT:') }}
			</td>
			<td>
				{{ Form::select('account_id', $users) }}
			</td>
		</tr>
		{{ Form::hidden('callback_id', $callback_id) }}
		<tr>
			<td>
				{{ Form::submit('Transfer', array('class' => 'tiny button radius')) }}
			</td>
			<td>
			</td>
		</tr>
	</table>
	{{ Form::close() }}
		
@endsection

@section('scripts')
	
@endsection