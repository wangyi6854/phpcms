<select name="schedule">
<?php
foreach ( $app->db->simpleQuery( 'select id, description from schedule order by id desc' ) as $row )
{
	$selected = !empty( $currentScheduleId ) ? $row[ 'id' ] == $currentScheduleId : false;
?>
	<option value="<?php echo $row[ 'id' ]; ?>"<?php echo $selected ? ' selected' : ''; ?>><?php echo htmlspecialchars( $row[ 'description' ] ); ?></option>
<?php
}
?>
</select>