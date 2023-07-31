<?php

include ROOT . '/tpl/admin.header.php';

?>

<div class="container-fluid" id="content">
		<div id="main">

				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i>修改用户信息</h3>
							</div>
							<div class="box-content nopadding" style="padding-top: 20px !important;">
								<form action="#" method="POST" class='form-horizontal form-column'>
									<div class="span6">
										<div class="control-group">
											<label for="password" class="control-label">用户</label>
											<div class="controls">
												<?php echo htmlspecialchars( $target_user->username ); ?>
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">密码</label>
											<div class="controls">
												<input type="text" name="password" id="password" placeholder="无需修改请留空" class="input-xlarge" value="">
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">状态</label>
											<div class="controls">
												<select name="status">
													<option value="正常" <?php echo $target_user->status == '正常' ? 'selected' : ''; ?>>正常</option>
													<option value="过期" <?php echo $target_user->status == '过期' ? 'selected' : ''; ?>>过期</option>
												</select>
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
