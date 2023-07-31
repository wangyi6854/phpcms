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
								<h3><i class="icon-list"></i>经销商公告编辑</h3>
							</div>
							<div class="box-content nopadding">
								<form action="#" method="POST" class='form-horizontal form-column'>
									<div class="span12">
										<div class="control-group">
											<label for="title" class="control-label">标题</label>
											<div class="controls">
												<input type="text" name="title" id="title" placeholder="" class="input-xlarge" style="width: 560px;" value="<?php echo htmlspecialchars( $sellerNotice->title ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="postdate" class="control-label">添加日期</label>
											<div class="controls">
												<input type="text" name="postdate" id="postdate" placeholder="日期格式: <?php echo date('Y-m-d H:i:s'); ?>" class="input-xlarge" value="<?php echo htmlspecialchars( $sellerNotice->postDate ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="order" class="control-label">显示顺序</label>
											<div class="controls">
												<input type="text" name="order" id="order" placeholder="默认255，顺序相同按时间倒序。" class="input-xlarge" value="<?php echo htmlspecialchars( $sellerNotice->order ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="content" class="control-label">内容</label>
											<div class="controls">
												<script type="text/plain" id="text_content" name="content" style="width: 1000px;">
												   <?php echo $sellerNotice->content; ?>
												</script>
												<!-- <textarea name="content" id="content" class="input-block-level"><?php echo htmlspecialchars( $sellerNotice->content ); ?></textarea>-->
											</div>
										</div>
									</div>
									<div class="span12">
										<div class="form-actions">
											<button type="submit" class="btn btn-primary">保存</button>
											<input type="hidden" name="id" value="<?php echo $sellerNotice->id; ?>">
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

<script type="text/javascript">

$(function(){
	UM.getEditor('text_content');
});

</script>
<?php include ROOT . '/tpl/admin.footer.php'; ?>
