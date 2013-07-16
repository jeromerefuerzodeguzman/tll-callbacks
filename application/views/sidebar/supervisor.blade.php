<?php 
	//toggle issue section
	$active_user = Request::route()->controller == 'users' ? 'active':'';
?>

<div class="section-container accordion" data-section="accordion">
	<section>
		<p class="title" data-section-title>{{ HTML::link("dashboard", "Dashboard") }}</p>
	</section>
	<section>
		<p class="title" data-section-title>{{ HTML::link("disposition_list", "Disposition") }}</p>
	</section>
	<section>
		<p class="title" data-section-title>{{ HTML::link("agent_list", "Per Agent") }}</p>
	</section>
	<section>
		<p class="title" data-section-title>{{ HTML::link("search", "Search") }}</p>
	</section>
	<section class="{{$active_user}}">
		<p class="title" data-section-title>{{ HTML::link("#", "Users") }}</p>
		<div class="content" data-section-content>
			<ul class="side-nav">
	        	<li>{{ HTML::link("manage_users", "Manage Users") }}</li>
	        	<li>{{ HTML::link("registration", "Create") }}</li>
	    	</ul>
		</div>
	</section>
	
</div>
