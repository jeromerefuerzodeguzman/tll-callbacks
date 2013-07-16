@layout('layouts.default')

@section('title')
	{{ $title }}
@endsection

@section('content')
			<div id="test_onkey">
				{{ Form::text('test_onkey_input', '' , array('id' => 'ontest', 'placeholder' => 'Search user here...')) }}
			</div>
			<table>
				<thead>
					<tr>
						<th>Delete</th>
						<th>Edit</th>
						<th width="250">Email</th>
						<th width="250">First Name</th>
						<th width="250">Last Name</th>
						<th width="250">Account Type</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($accounts as $account)
					<tr>
						<td style="text-align: center;">
							<img class="delete_btn" style="cursor: pointer;" width="25px" src={{ URL::base() . '/img/delete.png' }} />
						</td>
						<td>
							<a href="edit_user/<?php echo $account->id; ?>">
								<img class="edit_btn" style="cursor: pointer;"  width="22px" src={{ URL::base() . '/img/edit.png' }}  />
							</a>
						</td>
						<input type="hidden" name="account_id_hidden" value={{ $account->id }} ></input>
						<td class="account_email">{{ $account->email }}</td>
						<td class="account_fname">{{ $account->fname }}</td>
						<td class="account_lname">{{ $account->lname }}</td>
						<td>
							<input type="hidden" name="type_id_hidden" value={{ $account->type_id }} >
							<span class="type_name">{{ $account->type->name }}</span>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
@endsection


@section('scripts')
	<script>

			$(".delete_btn").click( function() {
				/*var account_id = $(this).closest('tr').find('input[name="account_id_hidden"]').val();*/
				var x = confirm("Are you sure?");
				if (x==true)
				{
					/*$.post(BASE+'/delete_user', {
						account_id: account_id
					}, function(data) {
						location.reload();	
					});*/
				}
			});
			//Filter table 
			//add index column with all content.
			$("table tr:has(td)").each(function(){
				var t = $(this).text().toLowerCase(); //all row text
				$("<td class='indexColumn'></td>").hide().text(t).appendTo(this);
			});//each tr
			$("#ontest").keyup(function(){
				var s = $(this).val().toLowerCase().split(" ");
				if(s == "") {
					$("table tr:hidden").show();
				} else {
					//show all rows.
					$("table tr:hidden").show();
					$.each(s, function(){
						$("table tr:visible .indexColumn:not(:contains('"+ this + "'))").parent().hide();
					});//each
				}
				
			});//key up.
	</script>
@endsection