<div class="box-content" style="width: 90%;">
	<table style="width: 100%; text-align: center;">
	<tr>
		<th>初次报送</th>
		<th>二级初审</th>
		<th>一级初审</th>
		<th>补充报送</th>
		<th>二级终审</th>
		<th>一级终审</th>
	</tr>
	<tr>
		<td>
			<?php echo substr( $schedule->submitStart, 0, 10 ); ?>
			至
			<?php echo substr( $schedule->submitEnd, 0, 10 ); ?>
		</td>
		<td>
			<?php echo substr( $schedule->reviewStart, 0, 10 ); ?>
			至
			<?php echo substr( $schedule->reviewEnd, 0, 10 ); ?>
		</td>
		<td>
			<?php echo substr( $schedule->review12Start, 0, 10 ); ?>
			至
			<?php echo substr( $schedule->review12End, 0, 10 ); ?>
		</td>
		<td>
			<?php echo substr( $schedule->submit2Start, 0, 10 ); ?>
			至
			<?php echo substr( $schedule->submit2End, 0, 10 ); ?>
		</td>
		<td>
			<?php echo substr( $schedule->review2Start, 0, 10 ); ?>
			至
			<?php echo substr( $schedule->review2End, 0, 10 ); ?>
		</td>
		<td>
			<?php echo substr( $schedule->review22Start, 0, 10 ); ?>
			至
			<?php echo substr( $schedule->review22End, 0, 10 ); ?>
		</td>
	</tr>
	</table>
</div>