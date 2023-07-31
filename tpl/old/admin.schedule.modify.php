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
											<label for="title" class="control-label">报送周期</label>
											<div class="controls">
												<input type="text" name="description" placeholder="例如：2019 第三季度" class="input-xlarge" value="<?php echo htmlspecialchars( $data->description ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="title" class="control-label">报送开始</label>
											<div class="controls">
												<input type="text" name="submitStart" placeholder="格式：2019-02-06" class="input-xlarge" value="<?php echo htmlspecialchars( $data->submitStart ? date( 'Y-m-d', strtotime( $data->submitStart ) ) : '' ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="title" class="control-label">报送结束</label>
											<div class="controls">
												<input type="text" name="submitEnd" placeholder="格式：2019-02-06" class="input-xlarge" value="<?php echo htmlspecialchars( $data->submitEnd ? date( 'Y-m-d', strtotime( $data->submitEnd ) ) : '' ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="title" class="control-label">二级初审开始</label>
											<div class="controls">
												<input type="text" name="reviewStart" placeholder="格式：2019-02-06" class="input-xlarge" value="<?php echo htmlspecialchars( $data->reviewStart ? date( 'Y-m-d', strtotime( $data->reviewStart ) ) : '' ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="title" class="control-label">二级初审结束</label>
											<div class="controls">
												<input type="text" name="reviewEnd" placeholder="格式：2019-02-06" class="input-xlarge" value="<?php echo htmlspecialchars( $data->reviewEnd ? date( 'Y-m-d', strtotime( $data->reviewEnd ) ) : '' ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="title" class="control-label">一级初审开始</label>
											<div class="controls">
												<input type="text" name="review12Start" placeholder="格式：2019-02-06" class="input-xlarge" value="<?php echo htmlspecialchars( $data->reviewStart ? date( 'Y-m-d', strtotime( $data->review12Start ) ) : '' ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="title" class="control-label">一级初审结束</label>
											<div class="controls">
												<input type="text" name="review12End" placeholder="格式：2019-02-06" class="input-xlarge" value="<?php echo htmlspecialchars( $data->reviewEnd ? date( 'Y-m-d', strtotime( $data->review12End ) ) : '' ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="title" class="control-label">重新报送开始</label>
											<div class="controls">
												<input type="text" name="submit2Start" placeholder="格式：2019-02-06" class="input-xlarge" value="<?php echo htmlspecialchars( $data->submit2Start ? date( 'Y-m-d', strtotime( $data->submit2Start ) ) : '' ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="title" class="control-label">重新报送结束</label>
											<div class="controls">
												<input type="text" name="submit2End" placeholder="格式：2019-02-06" class="input-xlarge" value="<?php echo htmlspecialchars( $data->submit2End ? date( 'Y-m-d', strtotime( $data->submit2End ) ) : '' ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="title" class="control-label">二级终审开始</label>
											<div class="controls">
												<input type="text" name="review2Start" placeholder="格式：2019-02-06" class="input-xlarge" value="<?php echo htmlspecialchars( $data->review2Start ? date( 'Y-m-d', strtotime( $data->review2Start ) ) : '' ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="title" class="control-label">二级终审结束</label>
											<div class="controls">
												<input type="text" name="review2End" placeholder="格式：2019-02-06" class="input-xlarge" value="<?php echo htmlspecialchars( $data->review2End ? date( 'Y-m-d', strtotime( $data->review2End ) ) : '' ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="title" class="control-label">一级终审开始</label>
											<div class="controls">
												<input type="text" name="review22Start" placeholder="格式：2019-02-06" class="input-xlarge" value="<?php echo htmlspecialchars( $data->review2Start ? date( 'Y-m-d', strtotime( $data->review22Start ) ) : '' ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="title" class="control-label">一级终审结束</label>
											<div class="controls">
												<input type="text" name="review22End" placeholder="格式：2019-02-06" class="input-xlarge" value="<?php echo htmlspecialchars( $data->review2End ? date( 'Y-m-d', strtotime( $data->review22End ) ) : '' ); ?>">
											</div>
										</div>

										<div class="form-actions">
											<button type="submit" id="submit" class="btn btn-primary">保存</button>
											<input type="hidden" name="id" value="<?php echo $data->id; ?>">
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
<script>
$(function () {

</script>

<?php include ROOT . '/tpl/admin.footer.php'; ?>
