												<select name="subcat" id="subcat" class='input-large'>
<?php
foreach ( $list->list as $cat )
{
?>
													<option value="<?php echo $cat->id; ?>" <?php if ( $cat->id == $default ) echo 'selected="selected"'?>><?php echo htmlspecialchars( $cat->name ); ?></option>
<?php
}
?>
												</select>
