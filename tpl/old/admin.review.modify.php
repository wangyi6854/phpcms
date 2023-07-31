<?php

$extra_header = <<<EOF

EOF;

$extra_footer = <<<EOF

EOF;

include ROOT . '/tpl/admin.header.php';

?>

<div class="container-fluid" id="content">
		<div id="main">

				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i>材料审核</h3>
							</div>
							<div class="box-content nopadding" style="padding-top: 20px !important;">
								<form method="POST" class='form-horizontal form-column' id="ff">
									<div class="span12">
										<div class="control-group">
											<label for="title" class="control-label">指标名称</label>
											<div class="controls">
												<?php echo htmlspecialchars( $data->project->titleContent ); ?>
											</div>
										</div>
										<div class="control-group">
											<label for="title" class="control-label">测评内容</label>
											<div class="controls">
												<?php echo htmlspecialchars( $data->project->contentContent ); ?>
											</div>
										</div>
										<div class="control-group">
											<label for="title" class="control-label">报送要求</label>
											<div class="controls">
												<?php echo htmlspecialchars( $data->project->requirementContent ); ?>
											</div>
										</div>
										<div class="control-group">
											<label for="title" class="control-label">测评标准</label>
											<div class="controls">
												<?php echo htmlspecialchars( $data->project->codeContent ); ?>
											</div>
										</div>
										<div class="control-group">
											<label for="title" class="control-label">报送单位</label>
											<div class="controls">
												<?php echo htmlspecialchars( $data->user->username ); ?>
											</div>
										</div>
										<div class="control-group">
											<label for="title" class="control-label">报送备注</label>
											<div class="controls">
												<?php echo htmlspecialchars( $data->memo ); ?>
											</div>
										</div>
										<div class="control-group">
											<label for="title" class="control-label">审核意见</label>
											<div class="controls">
												<div>字数不超过100字(必填)</div>
												<textarea style="width: 80%; height: 10em;" name="reviewMemo" id="reviewMemo"><?php echo htmlspecialchars( $data->reviewMemo ); ?></textarea>
											</div>
										</div>
										<div class="control-group">
											<label for="title" class="control-label">报送材料</label>
											<div class="controls">

												<fieldset>
													<legend style="font-size: 14px;">点击左键查看，点击右键下载。如果无法查看，请下载查看。</legend>
													<?php
													foreach( $data->filesInfo as $file )
													{
													?>
													<div>
														<a class="file-link" data-file_id="<?php echo htmlspecialchars( $file->id );?>" href="<?php echo htmlspecialchars( $file->path );?>" target="_blank"><?php echo htmlspecialchars( $file->name );?></a>
													</div>
													<?php
													}
													?>
												</fieldset>
											</div>
										</div>

										<div class="form-actions">
											<button type="button" id="pass" class="btn btn-primary">通过</button>
											<button type="button" id="fail" class="btn btn-primary">不通过</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>



			</div>
		</div></div>

<?php
foreach( $data->filesInfo as $file )
{
	if ( $file->images )
	{
?>
<div id="f_<?php echo htmlspecialchars( $file->id );?>" style="display: none; overflow-y:auto">
<?php
		foreach( $file->images as $image )
		{
?>
	<img src="<?php echo htmlspecialchars( $image );?>" ><br>
<?php
		}
?>
</div>
<?php
	}
}
?>
<?php include ROOT . '/tpl/admin.footer.script.php'; ?>
<script src="js/plugins/jquery-ui/jquery.ui.position.js"></script>
<script src="js/plugins/jquery-ui/jquery.ui.button.js"></script>
<script src="js/plugins/jquery-ui/jquery.ui.dialog.js"></script>
<script>
$(function () {
	submissionId = <?php echo $id; ?>;


	$('#pass').click(function(){
		window.location = './?module=admin.review.pass&pass=true&id='+submissionId+"&reviewMemo="+encodeURIComponent($('#reviewMemo').val());
	});

	$('#fail').click(function(){
		if (check_memo())
		{
			window.location = './?module=admin.review.pass&pass=false&id='+submissionId+"&reviewMemo="+encodeURIComponent($('#reviewMemo').val());
		}
	});

	$('.file-link').click(function(e){
		e.preventDefault();

		var options = {
			modal:	true,
			draggable:	false,
			width:	'80%',
			height:	$(window).height(),
			title:	$(this).text()
		};

		var id = $(this).data('file_id');
		$('#f_'+id).dialog(options);
	});


});
function check_memo()
{
	if ( !$('#reviewMemo').val() )
	{
		alert( '请填写审核意见' );
		return false;
	}
	return true;
};

</script>

<?php include ROOT . '/tpl/admin.footer.php'; ?>
