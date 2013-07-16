<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Northstar Solutions TLL Callbacks</title>
	{{ Asset::styles() }}
</head>
<body>
	<div class="row" id="login">
		<div class="large-12 columns">
			<div class="row">
				<div class="large-6 large-centered columns" id="login-content">
					<div class="row">
						<div class="large-12 columns">
							<h1>
								Sign in to
								<span>Northstar Solutions TLL Callbacks</span>
							</h1>
							<div class="separator"></div>
						</div>
					</div>
					{{ Form::open('users/authenticate', 'POST') }}
					<div class="row" style="margin-top: 30px">
						<div class="large-7 large-offset-1 columns">
							{{ Form::label('username', 'User:') }}
							{{ Form::text('username', Input::old('username'), array('placeholder' => 'Enter your username here')) }}
							
							{{ Form::label('password', 'Password:') }}
							{{ Form::password('password') }}
							<br/>
							@if (Session::has('flash_error'))
							<small class="error">{{ Session::get('flash_error') }}</small>
							@endif
							{{ Form::submit('Login', array('class' => 'button radius')) }}
						</div>
					</div>
					{{ Form::token() }}
					{{ Form::close(); }}
				</div>
			</div>
		</div>
	</div>
	<!-- Check for Zepto support, load jQuery if necessary -->
	<script>
	var BASE = "<?php echo URL::base(); ?>";

	  document.write('<script src={{ URL::base() }}/js/vendor/'
	    + ('__proto__' in {} ? 'zepto' : 'jquery')
	    + '.js><\/script>');
	</script>
	{{ Asset::scripts() }}
	<script>
		$(function(){
		    $(document).foundation();    
		})
	</script>

	<div id="alerts">
		@if(Session::has('message'))
			<div class="alert-box success">
				{{ Session::get('message') }}
				<a href="" class="close">&times;</a>
			</div>
		@elseif(Session::has('flash_error'))
			<div class="alert-box alert">
				{{ Session::get('flash_error') }}
				<a href="" class="close">&times;</a>
			</div>
		@endif

		@if($errors->has())
			<script type="text/javascript">
				@foreach($errors->messages as $key => $value)
					var form = $("[name='{{ $key }}']").addClass("error").after('<small class="error">{{ $value[0] }}</small>').parents('form:first');
				@endforeach
			</script>
		@endif
	</div>
</body>
</html>    