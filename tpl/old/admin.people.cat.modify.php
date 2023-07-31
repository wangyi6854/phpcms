<?php

include ROOT . '/tpl/admin.header.php';

?>

<div class="container-fluid" id="content">
		<div id="main">

				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i>失信人员分类编辑</h3>
							</div>
							<div class="box-content nopadding">
								<form action="#" method="POST" class='form-horizontal form-column'>
									<div class="span6">
										<div class="control-group">
											<label for="title" class="control-label">分类名称</label>
											<div class="controls">
												<input type="text" name="name" id="name" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $peopleCat->name ); ?>">
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
