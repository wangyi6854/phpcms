<?php

include ROOT . '/tpl/admin.header.php';

?>

<div class="container-fluid" id="content">
		<div id="main">

				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i>经销商申请编辑</h3>
							</div>
							<div class="box-content nopadding">
								<form action="#" method="POST" class='form-horizontal form-column'>
									<div class="span12">
										<div class="control-group">
											<label for="username" class="control-label">用户名</label>
											<div class="controls">
												<input type="text" name="username" id="username" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $seller->username ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="pwd" class="control-label">密码</label>
											<div class="controls">
												<input type="password" name="pwd" id="pwd" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $seller->password ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="postdate" class="control-label">申请时间</label>
											<div class="controls">
												<input type="text" name="postdate" id="postdate" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $seller->postDate ); ?>" disabled="disabled">
											</div>
										</div>
										<div class="control-group">
											<label for="addrp" class="control-label">省份</label>
											<div class="controls">
												<input type="text" name="addrp" id="addrp" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $seller->province ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="addrc" class="control-label">城市</label>
											<div class="controls">
												<input type="text" name="addrc" id="addrc" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $seller->city ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="addr" class="control-label">地址</label>
											<div class="controls">
												<input type="text" name="addr" id="addr" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $seller->addr ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="lxr" class="control-label">联系人</label>
											<div class="controls">
												<input type="text" name="lxr" id="lxr" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $seller->contractor ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="tel" class="control-label">电话</label>
											<div class="controls">
												<input type="text" name="tel" id="tel" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $seller->tel ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="mobile" class="control-label">手机</label>
											<div class="controls">
												<input type="text" name="mobile" id="mobile" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $seller->mobile ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="tax" class="control-label">传真</label>
											<div class="controls">
												<input type="text" name="tax" id="tax" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $seller->fax ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="email" class="control-label">邮箱</label>
											<div class="controls">
												<input type="text" name="email" id="email" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $seller->email ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">产品类别</label>
											<div class="controls">
<?php
foreach ( $catList->list as $cat )
{
?>
												<label class='checkbox'>
													<input type="checkbox" name="cats[]" value="<?php echo $cat->id; ?>" <?php echo in_array( $cat->id, $seller->cats ) ? 'checked="checked"' : ''; ?>><?php echo htmlspecialchars( $cat->name ); ?>
												</label>
<?php
}
?>
											</div>
										</div>
									</div>

									<div class="span12">
										<div class="form-actions">
											<button type="submit" class="btn btn-primary">通过</button>
											<input type="hidden" name="id" value="<?php echo $seller->id; ?>">
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
