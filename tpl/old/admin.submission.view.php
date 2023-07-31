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
								<h3><i class="icon-list"></i>材料预览</h3>
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
												<?php echo htmlspecialchars( $data->memo ); ?>
											</div>
										</div>
										<div class="control-group">
											<label for="title" class="control-label">状态</label>
											<div class="controls">
												<?php echo htmlspecialchars( $data->status ); ?>
											</div>
										</div>
										<div class="control-group">
											<label for="title" class="control-label">审核意见</label>
											<div class="controls">
												<?php echo htmlspecialchars( $data->reviewMemo ); ?>
											</div>
										</div>
										<div class="control-group">
											<label for="title" class="control-label">上传文件</label>
											<div class="controls">
												<div id="files" class="files">
													<?php
													foreach ( $data->filesInfo as $f )
													{
													?>
														<p data-id="<?php echo htmlspecialchars( $f[ 'id' ] ); ?>">
															<?php echo htmlspecialchars( $f[ 'name' ] ); ?>
														</p>
													<?php
													}
													?>
												</div>
											</div>
										</div>
										<div class="form-actions">
											<button type="button" onclick="history.back()" class="btn btn-primary">返回</button>
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
