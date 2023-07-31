<?php

include ROOT . '/tpl/admin.header.php';

?>

<div class="container-fluid" id="content">
		<div id="main">

				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i>产品子分类编辑</h3>
							</div>
							<div class="box-content nopadding">
								<form action="#" method="POST" class='form-horizontal form-column'>
									<div class="span6">
										<div class="control-group">
											<label for="name" class="control-label">分类名称</label>
											<div class="controls">
												<input type="text" name="name" id="name" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $productSubCat->name ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="cat" class="control-label">主分类</label>
											<div class="controls">
												<select name="cat" id="cat" class="input-large">
<?php
foreach ( $productCatList->list as $productCat )
{
?>
													<option value="<?php echo $productCat->id; ?>" <?php if ( $productCat->id == $cat ) echo 'selected="selected"'?>><?php echo htmlspecialchars( $productCat->name ); ?></option>
<?php
}
?>
												</select>
											</div>
										</div>
										<div class="control-group">
											<label for="order" class="control-label">显示顺序</label>
											<div class="controls">
												<input type="text" name="order" id="order" placeholder="默认255。越小越靠前。" class="input-xlarge" value="<?php echo htmlspecialchars( $productSubCat->order ); ?>">
											</div>
										</div>
									</div>
									<div class="span12">
										<div class="form-actions">
											<button type="submit" class="btn btn-primary">保存</button>
											<input type="hidden" name="id" value="<?php echo $id; ?>">
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div></div>


<?php include ROOT . '/tpl/admin.footer.script.php'; ?>


<?php include ROOT . '/tpl/admin.footer.php'; ?>
