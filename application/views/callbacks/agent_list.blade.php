@layout('layouts.default')

@section('title')
Callback Agent List
@endsection


@section('content')
	<h6>Overall Callback Agents Count</h6>
	<table style="font-size: 14px;">
		<tr style="font-weight: bold;">
			<td width="100px">Username</td>
			<td>Answering Machine</td>
			<td>No Answer</td>
			<td>Not Interested</td>
			<td>Do Not Call</td>
			<td>Undeclared Sale</td>
			<td>Sale</td>
			<td>Total Count</td>

		</tr>
		<?php
			$name_holder = '';
			$id_holder = 0;
			$total_count_per_agent = 0;
		?>
		@foreach($lists as $list)

			<?php
				if($name_holder == $list->username) {
					if($id_holder+1 != $list->id) {
						$diff = $list->id - $id_holder;
						for($ctr = 1; $ctr < $diff; $ctr++) {
							echo '<td>0</td>';
						}
					}
					echo '<td>'. $list->ctr .'</td>';
					$total_count_per_agent += $list->ctr;
					$id_holder = $list->id;


				}else {
					if($name_holder == '') {
						$name_holder = $list->username;
						echo '<tr>';
						echo '<td><a href="'. URL::to('agent_callbacks/'. $list->account_id) .'">' . $name_holder . '</a></td>';
						if($list->id > 1) {
							$ctr = $list->id;
							while($ctr > 1) {
								echo '<td>0</td>';
								$ctr--;
							}
							echo '<td>'. $list->ctr .'</td>';
							$total_count_per_agent += $list->ctr;
							$id_holder = $list->id;
						}else {
							echo '<td>'. $list->ctr .'</td>';
							$total_count_per_agent += $list->ctr;
							$id_holder = $list->id;
						}
					} else {

						while($id_holder < 6) {
							echo '<td>0</td>';
							$id_holder++;
						}
						echo '<td style="font-weight: bold;">' . $total_count_per_agent . '</td>';
						echo '</tr>';
						$total_count_per_agent = 0;

						//populates the next row
						$name_holder = $list->username;
						echo '<tr>';
						echo '<td><a href="'. URL::to('agent_callbacks/'. $list->account_id) .'">' . $name_holder . '</a></td>';
						if($list->id > 1) {
							$ctr = $list->id;
							while($ctr > 1) {
								echo '<td>0</td>';
								$ctr--;
							}
							echo '<td>'. $list->ctr .'</td>';
							$total_count_per_agent += $list->ctr;
							$id_holder = $list->id;
						}else {
							echo '<td>'. $list->ctr .'</td>';
							$total_count_per_agent += $list->ctr;
							$id_holder = $list->id;
						}
					}
				}
			?>
		@endforeach
		<?php
			if($id_holder != 0) {
				$col_ctr = $id_holder;
				while($col_ctr < 6) {
					echo '<td>0</td>';
					$col_ctr++;
				}					
				echo '<td style="font-weight: bold;">' . $total_count_per_agent . '</td>';
				echo '</tr>';
			}
		?>
	</table>
	<hr />
	{{ Form::open('agent_list_bydate', 'POST', array('class' => 'custom')) }}
	<div class="row">
		<div class="large-6 columns">
			<div class="small-2 columns">
				{{ Form::label('date', 'Date:', array('class' => 'left inline')) }}
	        </div>
	        <div class="small-10 columns">
				{{ Form::text('date', $today, array('id' => 'datepicker')) }}
				{{ Form::submit('Search', array('class' => 'tiny button radius')) }}
	        </div>
	    </div>
	</div>
	{{ Form::close() }}
	<h6>Daily Callback Agents Count</h6>
	<table style="font-size: 14px;">
		<tr style="font-weight: bold;">
			<td width="100px">Username</td>
			<td>Answering Machine</td>
			<td>No Answer</td>
			<td>Not Interested</td>
			<td>Do Not Call</td>
			<td>Undeclared Sale</td>
			<td>Sale</td>
			<td>Total Count</td>

		</tr>
		<?php
			$name_holder = '';
			$id_holder = 0;
			$total_count_per_agent = 0;
		?>
		@foreach($lists_bydate as $list)

			<?php
				if($name_holder == $list->username) {
					if($id_holder+1 != $list->id) {
						$diff = $list->id - $id_holder;
						for($ctr = 1; $ctr < $diff; $ctr++) {
							echo '<td>0</td>';
						}
					}
					echo '<td>'. $list->ctr .'</td>';
					$total_count_per_agent += $list->ctr;
					$id_holder = $list->id;


				}else {
					if($name_holder == '') {
						$name_holder = $list->username;
						echo '<tr>';
						echo '<td><a href="'. URL::to('agent_callbacks/'. $list->account_id) .'">' . $name_holder . '</a></td>';
						if($list->id > 1) {
							$ctr = $list->id;
							while($ctr > 1) {
								echo '<td>0</td>';
								$ctr--;
							}
							echo '<td>'. $list->ctr .'</td>';
							$total_count_per_agent += $list->ctr;
							$id_holder = $list->id;
						}else {
							echo '<td>'. $list->ctr .'</td>';
							$total_count_per_agent += $list->ctr;
							$id_holder = $list->id;
						}
					} else {

						while($id_holder < 6) {
							echo '<td>0</td>';
							$id_holder++;
						}
						echo '<td style="font-weight: bold;">' . $total_count_per_agent . '</td>';
						echo '</tr>';
						$total_count_per_agent = 0;

						//populates the next row
						$name_holder = $list->username;
						echo '<tr>';
						echo '<td><a href="'. URL::to('agent_callbacks/'. $list->account_id) .'">' . $name_holder . '</a></td>';
						if($list->id > 1) {
							$ctr = $list->id;
							while($ctr > 1) {
								echo '<td>0</td>';
								$ctr--;
							}
							echo '<td>'. $list->ctr .'</td>';
							$total_count_per_agent += $list->ctr;
							$id_holder = $list->id;
						}else {
							echo '<td>'. $list->ctr .'</td>';
							$total_count_per_agent += $list->ctr;
							$id_holder = $list->id;
						}
					}
				}
			?>
		@endforeach
		<?php
			if($id_holder != 0) {
				$col_ctr = $id_holder;
				while($col_ctr < 6) {
					echo '<td>0</td>';
					$col_ctr++;
				}					
				echo '<td style="font-weight: bold;">' . $total_count_per_agent . '</td>';
				echo '</tr>';
			}
		?>
	</table>
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