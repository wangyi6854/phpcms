<?php

include ROOT . '/tpl/admin.header.php';

?>

<div class="container-fluid" id="content">
		<div id="main">

				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i>催收公告编辑</h3>
							</div>
								<div class="box-content nopadding">
								<form action="#" method="POST" class='form-horizontal form-column'>
									<div class="span12">
										<div class="control-group">
											<label for="name" class="control-label">客户名称</label>
											<div class="controls">
												<input type="text" name="name" id="name" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $csgg->name ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="loan_date" class="control-label">贷款日期</label>
											<div class="controls">
												<input type="text" name="loan_date" id="loan_date" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $csgg->loan_date ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="repay_date" class="control-label">到期日期</label>
											<div class="controls">
												<input type="text" name="repay_date" id="repay_date" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $csgg->repay_date ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="amount" class="control-label">贷款余额</label>
											<div class="controls">
												<input type="text" name="amount" id="amount" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $csgg->amount ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="bank" class="control-label">发布银行</label>
											<div class="controls">
												<select name="bank" id="bank" class="input-large">
													<option value="0"></option>
<?php
foreach ( $bankList as $entry )
{
?>
													<option value="<?php echo $entry[ 'id' ]; ?>" <?php if ( $entry[ 'id' ] == $csgg->bank ) echo 'selected="selected"'?>><?php echo htmlspecialchars( $entry[ 'name' ] ); ?></option>
<?php
}
?>
												</select>
											</div>
										</div>
										<div class="control-group">
											<label for="guarantor" class="control-label">担保人</label>
											<div class="controls">
												<input type="text" name="guarantor" id="guarantor" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $csgg->guarantor ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="firm" class="control-label">机构</label>
											<div class="controls">
												<input type="text" name="firm" id="firm" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $csgg->firm ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="valid" class="control-label">已审核</label>
											<div class="controls">
												<input type="checkbox" name="valid" id="valid" value="1" <?php if ( $csgg->valid ) echo 'checked="checked"'; ?>>
											</div>
										</div>
										<div class="control-group">
											<label for="pub" class="control-label">发布人</label>
											<div class="controls">
												<span><?php echo htmlspecialchars( $csgg->userNickName ); ?></span>
											</div>
										</div>

									</div>

									<div class="span12">
										<div class="form-actions">
											<button type="submit" class="btn btn-primary">保存</button>
											<input type="hidden" name="id" value="<?php echo $csgg->id; ?>">
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
