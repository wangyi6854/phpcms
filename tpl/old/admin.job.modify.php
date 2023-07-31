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
								<h3><i class="icon-list"></i>职位编辑</h3>
							</div>
							<div class="box-content nopadding">
								<form action="#" method="POST" class='form-horizontal form-column'>
									<div class="span12">
										<div class="control-group">
											<label for="gw" class="control-label">岗位名称</label>
											<div class="controls">
												<input type="text" name="gw" id="gw" placeholder="" class="input-xlarge" style="width: 560px;" value="<?php echo htmlspecialchars( $job->gw ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="edu" class="control-label">学历</label>
											<div class="controls">
												<input type="text" name="edu" id="edu" placeholder="" class="input-xlarge" style="width: 560px;" value="<?php echo htmlspecialchars( $job->edu ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="nos" class="control-label">人数</label>
											<div class="controls">
												<input type="text" name="nos" id="nos" placeholder="" class="input-xlarge" style="width: 560px;" value="<?php echo htmlspecialchars( $job->nos ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="orderid" class="control-label">顺序</label>
											<div class="controls">
												<input type="text" name="orderid" id="orderid" placeholder="默认255，顺序相同按时间倒序。" class="input-xlarge" value="<?php echo htmlspecialchars( $job->orderid ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="bz" class="control-label">招聘要求及职责</label>
											<div class="controls">
												<textarea name="bz" id="bz" rows="10" class="input-block-level"><?php echo htmlspecialchars( $job->bz ); ?></textarea>
											</div>
										</div>
									</div>
									<div class="span12">
										<div class="form-actions">
											<button type="submit" class="btn btn-primary">保存</button>
											<input type="hidden" name="id" value="<?php echo $job->id; ?>">
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
