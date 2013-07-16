@layout('layouts.default')

@section('title')
	{{ $title }}
@endsection

@section('content')
	<div class="large-10 columns">
		<p><em>
			{{ $account->department_id != '0' ? strtoupper($account->department->name) : 'ADMINISTRATION' }} -
			{{ strtoupper($account->type->name) }}
		</em></p>

	</div>
	<div class="large-2 columns">
		<p><a href="#" id="edit_info_link">Edit Info</a></p>
	</div>
	<div class="row">
		<div class="large-12 columns">
			<h6>Basic Information:</h6>
		</div>
		<div class="large-9 pull-3 columns">
			<div class="small-3 columns">
				<ul class="no-bullet">
					<li>Username:</li>
					<li>Password:</li>
					<li>Email:</li>
				</ul>
			</div>
			<div class="small-9 columns">
				<ul class="no-bullet">
					<li><em>{{ $account->user->username }}</em></li>
					<li><em> *****************  <a href="#" id="edit_password_link">(Edit Password)</a></em></li>
					<li><em>{{ $account->email }}</em></li>
				</ul>
			</div>	
		</div>
	</div>
	<div id="edit_info" title="Information">
		<p class="">Edit Information</p>
		{{ Form::open() }}
		{{ Form::hidden('account_id', $account->id) }}

		{{ Form::label('username', 'Username:') }}
		{{ Form::text('username', $account->user->username ) }}

		{{ Form::label('fname', 'First Name:') }}
		{{ Form::text('fname', $account->fname) }}

		{{ Form::label('lname', 'Last Name:') }}
		{{ Form::text('lname', $account->lname) }}

		{{ Form::label('email', 'Email Address:') }}
		{{ Form::text('email', $account->email) }}

		{{ Form::token(); }}						
		{{ Form::close(); }}
	</div>
	<div id="edit_password" title="Password">
		<p class="">Change Password</p>
		{{ Form::open() }}
		{{ Form::hidden('user_id', $account->user->id) }}

		{{ Form::label('old_password', 'Old Password:') }}
		{{ Form::password('old_password') }}

		{{ Form::label('new_password', 'New Password:') }}
		{{ Form::password('new_password') }}

		{{ Form::label('new_password_confirmation', 'Confirm Password:') }}
		{{ Form::password('new_password_confirmation') }}

		{{ Form::token(); }}						
		{{ Form::close(); }}
	</div>
@endsection

@section('scripts')
	<script>
		//opens dialog box
		$("#edit_info_link").click( function() {
				$( "#edit_info" ).dialog( "open" );
			});

		$("#edit_password_link").click( function() {
				$( "#edit_password" ).dialog( "open" );
			});

		//jquery for update dialog box
		$( "#edit_info" ).dialog({
			autoOpen: false,
			height: 600,
			width: 420,
			modal: true,
			buttons: {
				"Update": function() {
					var account_id = $('input[name="account_id"]').val();
					var username = $('input[name="username"]').val();
					var fname = $('input[name="fname"]').val();
					var lname = $('input[name="lname"]').val();
					var email = $('input[name="email"]').val();

					$.post(BASE+'/update_profile', {
						account_id: account_id,
						username: username,
						fname: fname,
						lname: lname,
						email: email
					}, function(data) {
						location.reload();	
					});
					$( this ).dialog( "close" );
					
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
		});

		//jquery for update dialog box
		$( "#edit_password" ).dialog({
			autoOpen: false,
			height: 600,
			width: 420,
			modal: true,
			buttons: {
				"Update": function() {
					var user_id = $('input[name="user_id"]').val();
					var old_password = $('input[name="old_password"]').val();
					var new_password = $('input[name="new_password"]').val();
					var new_password_confirmation = $('input[name="new_password_confirmation"]').val();
					
					if(new_password == '' || new_password_confirmation == '' || old_password == '' ||  new_password != new_password_confirmation) {
						if(new_password != new_password_confirmation) {
							alert('Password do not match')
						} else {
							alert('Complete the fields');
						}
					} else {
						$.post(BASE+'/change_password', {
							user_id: user_id,
							old_password: old_password,
							new_password: new_password
						}, function(data) {
							location.reload();	
						});
						$( this ).dialog( "close" );
					}

				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
		});
	</script>
@endsection


