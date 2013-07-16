@layout('layouts.default')

@section('title')
	Edit Account
@endsection

@section('content')
	<table width="500px">
		<tr>
			<th width="200px">Labels</th>
			<th width="300px">Values</th>
		</tr>
		<tr>
			<td><strong>First Name</strong></td>
			<td>{{ $account->fname }}</td>
		</tr>
		<tr>
			<td><strong>Last Name</strong></td>
			<td>{{ $account->lname }}</td>
		</tr>
		
	</table>
@endsection


@section('scripts')

@endsection