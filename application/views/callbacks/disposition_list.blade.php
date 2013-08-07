@layout('layouts.default')

@section('title')
Callback Disposition List
@endsection


@section('content')
	<h6>Overall Callback Disposition List</h6>
	<table style="font-size: 14px;" width="400px">
		<tr>
			<th>Disposition</th>
			<th>Count</th>
		</tr>
		@foreach($lists as $list)
		<tr>
			<td>{{ $list->name }}</td>
			<td>{{ $list->ctr }}</td>
		</tr>
		@endforeach
	</table>
	<hr />
	{{ Form::open('disposition_list_bydate', 'POST', array('class' => 'custom')) }}
	<div class="row">
		<div class="large-6 columns">
			<div class="small-2 columns">
				{{ Form::label('date', 'Date:', array('class' => 'left inline')) }}
	        </div>
	        <div class="small-10 columns">
				{{ Form::text('date', $today, array('id' => 'datepicker')) }}
				{{ Form::submit('Search', array('class' => 'tiny button radius')) }}
	        </div>
	    </div>
	</div>
	{{ Form::close() }}
	<h6>Daily Callback Disposition List</h6>
	<table style="font-size: 14px;" width="400px">
		<tr>
			<th>Disposition</th>
			<th>Count</th>
		</tr>
		@foreach($lists_bydate as $list_bydate)
		<tr>
			<td>{{ $list_bydate->name }}</td>
			<td>{{ $list_bydate->ctr }}</td>
		</tr>
		@endforeach
	</table>
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