<?php

include ROOT . '/tpl/admin.header.php';

?>

<div class="container-fluid" id="content">
		<div id="main">

				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i>修改报送要求</h3>
							</div>
							<div class="box-content nopadding" style="padding-top: 20px !important;">
								<form action="#" method="POST" class='form-horizontal form-column'>
									<div class="span12">
										<div class="control-group">
											<label for="password" class="control-label">内容</label>
											<div class="controls">
												<textarea name="content" style="width: 90%; height: 12em;"><?php echo htmlspecialchars( $data->content ); ?></textarea>
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
