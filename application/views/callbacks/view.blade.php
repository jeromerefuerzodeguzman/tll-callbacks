@layout('layouts.default')

@section('title')
View Callback
@endsection


@section('content')
	@if(Auth::user()->account->type->name == 'agent')
	{{ Form::open('update_callback', 'POST', array('class' => 'custom')) }}
	{{ Form::hidden('id', $callback->id) }}
	@endif
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
			<td>
			@if(Auth::user()->account->type->name == 'agent')
			{{ Form::text('date', $callback->date, array('id' => 'datepicker')) }}
			@else
			{{ $callback->date }}
			@endif
			</td>
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
			<td>
			@if(Auth::user()->account->type->name == 'agent')
			{{ Form::select('disposition_id', $disposition_id, $callback->disposition->id, array('class' => 'inline')) }}
			@else
			{{ $callback->disposition->name }}
			@endif
			</td>
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
	@if(Auth::user()->account->type->name == 'agent')
		{{ Form::submit('Save', array('class' => 'button radius')) }}
		{{ Form::token(); }}
		{{ Form::close(); }}
		<a href='<?php echo URL::to('dashboard'); ?>'><button class="button radius">Back</button></a>
	@endif

	@if(Auth::user()->account->type->name == 'supervisor')
	<hr />
	Transfer this Callback to other AGENT:
	<br />
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
	@endif
		
@endsection


@section('scripts')
	<script>
		$.get(BASE+'/autocomplete_companyname', function(data) {
			$("#company_name").autocomplete({
				source: data
			});
		});

		$(function() {
			$("#datepicker").datepicker();
		});
	</script>
@endsection