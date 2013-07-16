@layout('layouts.default')

@section('title')
Create Callback
@endsection


@section('content')

	{{ Form::open('create_callback/add', 'POST', array('class' => 'custom')) }}
	<div class="row">
		<div class="large-7 columns">
			{{ Form::label('date', 'Callback Date:') }}
			{{ Form::text('date', Input::old('date'), array('id' => 'datepicker')) }}
			<br />
			{{ Form::label('company_name', 'Company Name:') }}
			{{ Form::text('company_name', Input::old('company_name')) }}
			<br />
			{{ Form::label('telephone_number', 'Business Telephone #:') }}
			{{ Form::text('telephone_number', Input::old('telephone_number')) }}
			<br />
			{{ Form::label('contact_name', 'Contact Name:') }}
			{{ Form::text('contact_name', Input::old('contact_name')) }}
			<br />
			{{ Form::label('industry_name', 'Industry:') }}
			{{ Form::text('industry_name', Input::old('industry_name')) }}
			<br />
			{{ Form::label('address', 'Address:') }}
			{{ Form::textarea('address', Input::old('address')) }}
			<br />
			{{ Form::label('disposition_id', 'Disposition:') }}
			{{ Form::select('disposition_id', $disposition_id) }}
			<br/>
			{{ Form::label('comments', 'Comments:') }}
			{{ Form::textarea('comments', Input::old('comments')) }}
			<br />
			{{ Form::label('tags', 'Tags:') }}
			{{ Form::textarea('tags', Input::old('tags')) }}
			<br />

			{{ Form::submit('Create', array('class' => 'button radius')) }}
		</div>
 		
	</div>
	{{ Form::token(); }}
	{{ Form::close(); }}
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