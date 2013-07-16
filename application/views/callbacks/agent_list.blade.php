@layout('layouts.default')

@section('title')
Disposition List
@endsection


@section('content')
	<table>
		<tr>
			<th width="200px">Username</th>
			<th width="200px">Name</th>
			<th>Count</th>
		</tr>
		@foreach($lists as $list)
		<tr>
			<td>{{ $list->username }}</td>
			<td>{{ $list->lname }}, {{ $list->fname }}</td>
			<td>{{ $list->ctr }}</td>
		</tr>
		@endforeach
	</table>
@endsection

@section('scripts')

@endsection