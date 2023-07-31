<?php


include ROOT . '/tpl/admin.header.php';

?>

<div class="container-fluid" id="content">
	<div id="main">
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-title">
							<h3><i class="icon-list"></i>举报详情</h3>
						</div>

						<div class="box-content nopadding">
							<form method="POST" class='form-horizontal form-column'>
								<div class="span12">
									<div class="control-group">
										<label for="cat" class="control-label">类别</label>
										<div class="controls">
											<?php echo htmlspecialchars( $jubao->cat ); ?>
										</div>
									</div>
									<div class="control-group">
										<label for="name" class="control-label">举报人姓名</label>
										<div class="controls">
											<?php echo htmlspecialchars( $jubao->name ); ?>
										</div>
									</div>
									<div class="control-group">
										<label for="idcard" class="control-label">举报人身份证号</label>
										<div class="controls">
											<?php echo htmlspecialchars( $jubao->idcard ); ?>
										</div>
									</div>
									<div class="control-group">
										<label for="addr" class="control-label">举报人住址</label>
										<div class="controls">
											<?php echo htmlspecialchars( $jubao->addr ); ?>
										</div>
									</div>
									<div class="control-group">
										<label for="mobile" class="control-label">举报人手机号码</label>
										<div class="controls">
											<?php echo htmlspecialchars( $jubao->mobile ); ?>
										</div>
									</div>
									<div class="control-group">
										<label for="tel" class="control-label">举报人电话</label>
										<div class="controls">
											<?php echo htmlspecialchars( $jubao->tel ); ?>
										</div>
									</div>
									<div class="control-group">
										<label for="court" class="control-label">执行法院</label>
										<div class="controls">
											<?php echo htmlspecialchars( $jubao->court ); ?>
										</div>
									</div>
									<div class="control-group">
										<label for="ah" class="control-label">执行案号</label>
										<div class="controls">
											<?php echo htmlspecialchars( $jubao->ah ); ?>
										</div>
									</div>
									<div class="control-group">
										<label for="target" class="control-label">被举报人姓名</label>
										<div class="controls">
											<?php echo htmlspecialchars( $jubao->target ); ?>
										</div>
									</div>
									<div class="control-group">
										<label for="content" class="control-label">线索</label>
										<div class="controls">
											<?php echo htmlspecialchars( $jubao->content ); ?>
										</div>
									</div>
									<div class="control-group">
										<label for="content" class="control-label">附件列表</label>
										<div class="controls">
											<?php
											foreach ( $jubao->attachment as $a )
											{
											?>
											<?php echo $a->title; ?>
											<a href="<?php echo $a->url; ?>" target="_blank">查看</a>
											<br />
											<?php
											}
											?>
										</div>
									</div>
								</div>

								<div class="span12">
									<div class="form-actions">
										<?php
										if ( $jubao->status == '待处理' )
										{
										?>
										<button type="submit" class="btn btn-primary">标记为已处理</button>
										<?php
										}
										else
										{
										?>
										已处理
										<?php
										}
										?>
										<input type="hidden" name="id" value="<?php echo $jubao->id; ?>">
										<input type="hidden" name="module" value="admin.jubao.pass">
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<?php include ROOT . '/tpl/admin.footer.script.php'; ?>
<?php include ROOT . '/tpl/admin.footer.php'; ?>
