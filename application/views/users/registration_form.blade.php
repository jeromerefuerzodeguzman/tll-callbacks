@layout('layouts.default')

@section('title')
	{{ $title }}
@endsection

@section('content')
				<div id="login-content">
					<div class="row">
						<div class="large-12 columns">
							<h1>
								Registration
								<span>Northstar Solutions TLL Callbacks</span>
							</h1>
							<div class="separator"></div>
						</div>
					</div>
					{{ Form::open('users/add_user', 'POST', array('class' => 'custom')) }}
					<div class="row" style="margin-top: 30px">
						<div class="large-7 large-offset-1 columns">
							{{ Form::label('new_username', 'Username:') }}
							{{ Form::text('new_username', Input::old('new_username'), array('placeholder' => 'Enter your username here')) }}

							{{ Form::label('new_password', 'Password:') }}
							{{ Form::password('new_password') }}

							{{ Form::label('new_password_confirmation', 'Confirm Password:') }}
							{{ Form::password('new_password_confirmation') }}
							
							{{ Form::label('fname', 'First Name:') }}
							{{ Form::text('fname', Input::old('fname')) }}

							{{ Form::label('lname', 'Last Name:') }}
							{{ Form::text('lname', Input::old('lname')) }}

							{{ Form::label('email', 'Email Address:') }}
							{{ Form::text('email', Input::old('email')) }}

							{{ Form::label('type_id', 'Account Type:') }}
							{{ Form::select('type_id', $type) }}


							<br/>
							@if (Session::has('flash_error'))
							<small class="error">{{ Session::get('flash_error') }}</small>
							@endif
							@if (Session::has('message'))
							<div class="alert-box success radius">{{ Session::get('message') }}</div>
							@endif
							{{ Form::submit('Add User', array('class' => 'button radius')) }}
						</div>
					</div>
					{{ Form::token() }}
					{{ Form::close(); }}
				</div>
			</div>
@endsection

@section('scripts')
	<script>
		// this will hide the ff:
		// label of department_id
		// the dropdown
		// and the error if present
		$('#type_id').change(function() {
			var type = $("#type_id").children("option:selected").text();
			if(type == 'qa') {
				$("label[for=department_id]").css('display','none');;
				$('#department_id').css('display','none');
				$('#department_id').next('.custom.dropdown').css('display','none');
				$('#department_id').next('.custom.dropdown').next('.error').css('display','none');
			} else {
				$("label[for=department_id]").css('display','block');;
				$('#department_id').css('display','block');
				$('#department_id').next('.custom.dropdown').css('display','block');
				$('#department_id').next('.custom.dropdown').next('.error').css('display','block');
			}
		});
	</script>
@endsection