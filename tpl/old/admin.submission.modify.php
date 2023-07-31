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
								<h3><i class="icon-list"></i>材料上报</h3>
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
											<label for="title" class="control-label">备注</label>
											<div class="controls">
												<div>字数不超过100字</div>
												<textarea style="width: 80%; height: 10em;" name="memo"><?php echo htmlspecialchars( $data->memo ); ?></textarea>
											</div>
										</div>
										<?php
										if ( $data->reviewMemo )
										{
										?>
										<div class="control-group">
											<label for="title" class="control-label">审核意见</label>
											<div class="controls">
												<?php echo htmlspecialchars( $data->reviewMemo ); ?>
											</div>
										</div>
										<?php
										}
										?>
										<div class="control-group">
											<label for="title" class="control-label">上传文件</label>
											<div class="controls">
												<input id="fileupload" type="file" name="file"  accept=".doc,.docx,.xls,.xlsx,.pdf,.jpg,.png">
												<div id="files" class="files">
													<?php
													foreach ( $data->filesInfo as $f )
													{
													?>
														<p data-id="<?php echo htmlspecialchars( $f[ 'id' ] ); ?>">
															<?php echo htmlspecialchars( $f[ 'name' ] ); ?>
															<img  class="delete-file" src="/img/delete.png" >
														</p>
													<?php
													}
													?>
												</div>
											</div>
										</div>

										<div class="form-actions">
											<button type="submit" id="submit" class="btn btn-primary">保存</button>
											<input type="hidden" name="id" value="<?php echo $data->id; ?>">
											<input type="hidden" name="rrid" value="<?php echo $data->relScheduleRelProjectUserId; ?>">
											<input type="hidden" name="files">
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
<script src="/js/jQuery-File-Upload-9.32.0/js/jquery.fileupload.js"></script>
<script src="/js/jQuery-File-Upload-9.32.0/js/jquery.iframe-transport.js"></script>
<script>
$(function () {
	files = [<?php echo $data->files; ?>];
    var url = '/?module=admin.upload';
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: true,
        done: function (e, data) {
			if ( data.result.result )
			{
				alert( data.result.message );
			}
			else
			{
				$.each(data.result.data, function (index, file) {
					$('<p data-id="' + file.id + '"/>').text(file.name).append('<img class="delete-file" src="/img/delete.png" />').appendTo('#files');
					files.push(file.id);
				});
			}
        }
    });

	$('.files').on('click', '.delete-file', function(){
		var id = parseInt($(this).parent().data('id'));
		files.splice( $.inArray(id, files), 1 );

		$(this).parent().remove();
	});

	$('#ff').submit(function(){
		$('input[name=files]').val(files.join(','));
	});
});

</script>

<?php include ROOT . '/tpl/admin.footer.php'; ?>
