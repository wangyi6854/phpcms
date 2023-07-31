<select name="year">
<?php
foreach ( $app->db->simpleQuery( 'select distinct year( submitStart ) as year from schedule order by id desc' ) as $row )
{
	$selected = !empty( $currentYear ) ? $row[ 'year' ] == $currentYear : false;
?>
	<option value="<?php echo $row[ 'year' ]; ?>"<?php echo $selected ? ' selected' : ''; ?>><?php echo htmlspecialchars( $row[ 'year' ] ); ?></option>
<?php
}
?>
</select>