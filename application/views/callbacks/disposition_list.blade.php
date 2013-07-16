@layout('layouts.default')

@section('title')
Disposition List
@endsection


@section('content')
	<table width="400px">
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
@endsection

@section('scripts')

@endsection