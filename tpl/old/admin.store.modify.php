<?php





$extra_header = <<<EOF

    <link href="lib/umeditor1_2_2-utf8-php/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">

EOF;

$extra_footer = <<<EOF

    <script type="text/javascript" charset="utf-8" src="lib/umeditor1_2_2-utf8-php/umeditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="lib/umeditor1_2_2-utf8-php/umeditor.min.js"></script>
    <script type="text/javascript" src="lib/umeditor1_2_2-utf8-php/lang/zh-cn/zh-cn.js"></script>

EOF;


include ROOT . '/tpl/admin.header.php';

?>

<div class="container-fluid" id="content">
		<div id="main">

				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i>销售网络编辑</h3>
							</div>
							<div class="box-content nopadding">
								<form action="#" method="POST" class='form-horizontal form-column'>
									<div class="span12">
										<div class="control-group">
											<label for="name" class="control-label">名称</label>
											<div class="controls">
												<input type="text" name="name" id="name" placeholder="" class="input-xlarge" style="width: 560px;" value="<?php echo htmlspecialchars( $store->name ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="province" class="control-label">省</label>
											<div class="controls">
												<input type="text" name="province" id="province" placeholder="" class="input-xlarge" style="width: 560px;" value="<?php echo htmlspecialchars( $store->province ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="city" class="control-label">市</label>
											<div class="controls">
												<input type="text" name="city" id="city" placeholder="" class="input-xlarge" style="width: 560px;" value="<?php echo htmlspecialchars( $store->city ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="addr" class="control-label">地址</label>
											<div class="controls">
												<input type="text" name="addr" id="addr" placeholder="" class="input-xlarge" style="width: 560px;" value="<?php echo htmlspecialchars( $store->addr ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="tel" class="control-label">电话</label>
											<div class="controls">
												<input type="text" name="tel" id="tel" placeholder="" class="input-xlarge" style="width: 560px;" value="<?php echo htmlspecialchars( $store->tel ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="orderid" class="control-label">显示顺序</label>
											<div class="controls">
												<input type="text" name="orderid" id="orderid" placeholder="默认255，顺序相同按时间倒序。" class="input-xlarge" value="<?php echo htmlspecialchars( $store->order ); ?>">
											</div>
										</div>
									</div>
									<div class="span12">
										<div class="form-actions">
											<button type="submit" class="btn btn-primary">保存</button>
											<input type="hidden" name="id" value="<?php echo $store->id; ?>">
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
