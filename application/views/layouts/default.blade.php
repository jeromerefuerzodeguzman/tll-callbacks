<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>TLL Callbacks</title>
		{{ Asset::styles() }}
	</head>
	<body>
		<div id="content">
			<nav class="top-bar">
				<ul class="title-area">
				    <li class="name">
				      	<h1><a href="#">Northstar Solutions Inc.</a></h1>
				    </li>
    				<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
			  	</ul>
			  	<section class="top-bar-section">
			  		<ul class="right">
			  			<li class="divider"></li>
			  			<li><a href="#">Welcome {{ Auth::user()->account->lname . ', ' .  Auth::user()->account->fname }}</a></li>
			  			<li class="divider"></li>
			  			<li>{{ HTML::link("logout", "Logout") }}</li>
			  		</ul>
			  	</section>
			</nav>
			<div class="row">
				<div class="large-12 columns">
					<h1><a href="#">TLL Callbacks</a></h1>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="large-3 columns">
					@include('sidebar.' . Auth::user()->account->type->name)
				</div>
				<div class="large-9 columns">
					<h4>@yield('title')</h4>
					<hr />
					<div class="row">
						<div class="large-12 columns">
							@yield('content')
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="large-12 columns">
					<hr>
					<h6><small>Copyright 2013 Northstar Solutions Inc.</small></h6>
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
			@elseif(Session::has('error'))
				<div class="alert-box alert">
					{{ Session::get('error') }}
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
		@yield('scripts')
	</body>
</html>