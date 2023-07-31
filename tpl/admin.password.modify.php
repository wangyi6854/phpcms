<?php

include ROOT . '/tpl/admin.header.php';

?>

<div class="container-fluid" id="content">
		<div id="main">

				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i>修改密码</h3>
							</div>
							<div class="box-content nopadding" style="padding-top: 20px !important;">
								<form action="#" method="POST" class='form-horizontal form-column'>
									<div class="span6">
										<div class="control-group">
											<label for="old_password" class="control-label">原密码</label>
											<div class="controls">
												<input type="password" name="old_password" id="old_password" placeholder="" class="input-xlarge" value="">
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">新密码</label>
											<div class="controls">
												<input type="password" name="password" id="password" placeholder="" class="input-xlarge" value="">
											</div>
										</div>
									</div>
									<div class="span12">
										<div class="form-actions">
											<button type="submit" class="btn btn-primary">保存</button>
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
