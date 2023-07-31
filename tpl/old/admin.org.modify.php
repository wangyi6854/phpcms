<?php

include ROOT . '/tpl/admin.header.php';

?>

<div class="container-fluid" id="content">
		<div id="main">

				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i>失信机构编辑</h3>
							</div>
								<div class="box-content nopadding">
								<form action="#" method="POST" class='form-horizontal form-column'>
									<div class="span12">
										<div class="control-group">
											<label for="cat" class="control-label">分类</label>
											<div class="controls">
												<select name="cat" id="cat" class="input-large">
													<option value="0"></option>
<?php
foreach ( $catList->list as $entry )
{
?>
													<option value="<?php echo $entry->id; ?>" <?php if ( $entry->id == $org->cat ) echo 'selected="selected"'?>><?php echo htmlspecialchars( $entry->name ); ?></option>
<?php
}
?>
												</select>
											</div>
										</div>
										<div class="control-group">
											<label for="name" class="control-label">被执行人</label>
											<div class="controls">
												<input type="text" name="name" id="name" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $org->name ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="legal" class="control-label">法人</label>
											<div class="controls">
												<input type="text" name="legal" id="legal" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $org->legal ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="address" class="control-label">地址</label>
											<div class="controls">
												<input type="text" name="address" id="address" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $org->address ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="code" class="control-label">组织机构代码</label>
											<div class="controls">
												<input type="text" name="code" id="code" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $org->code ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="court" class="control-label">发布法院</label>
											<div class="controls">
												<select name="court" id="court" class="input-large">
													<option value="0"></option>
<?php
foreach ( $courtList as $entry )
{
?>
													<option value="<?php echo $entry[ 'id' ]; ?>" <?php if ( $entry[ 'id' ] == $org->court ) echo 'selected="selected"'?>><?php echo htmlspecialchars( $entry[ 'name' ] ); ?></option>
<?php
}
?>
												</select>
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
													<option value="<?php echo $entry[ 'id' ]; ?>" <?php if ( $entry[ 'id' ] == $org->bank ) echo 'selected="selected"'?>><?php echo htmlspecialchars( $entry[ 'name' ] ); ?></option>
<?php
}
?>
												</select>
											</div>
										</div>
										<div class="control-group">
											<label for="exec_court" class="control-label">执行法院</label>
											<div class="controls">
												<input type="text" name="exec_court" id="exec_court" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $org->execCourt ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="yjwh" class="control-label">执行依据文号</label>
											<div class="controls">
												<input type="text" name="yjwh" id="yjwh" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $org->yjwh ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="larq" class="control-label">立案日期</label>
											<div class="controls">
												<input type="text" name="larq" id="larq" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $org->larq ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="ah" class="control-label">案号</label>
											<div class="controls">
												<input type="text" name="ah" id="ah" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $org->ah ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="zxdw" class="control-label">作出执行依据单位</label>
											<div class="controls">
												<input type="text" name="zxdw" id="zxdw" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $org->zxdw ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="yw" class="control-label">生效法律文书确定的义务</label>
											<div class="controls">
												<textarea name="yw" id="yw" rows="5" cols="80%" class="input-block-level"><?php echo htmlspecialchars( $org->yw ); ?></textarea>
											</div>
										</div>
										<div class="control-group">
											<label for="lxqk" class="control-label">被执行人履行情况</label>
											<div class="controls">
												<input type="text" name="lxqk" id="lxqk" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $org->lxqk ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="xwqk" class="control-label">失信被执行人行为具体情形</label>
											<div class="controls">
												<input type="text" name="xwqk" id="xwqk" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $org->xwqk ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="pubdate" class="control-label">发布时间</label>
											<div class="controls">
												<input type="text" name="pubdate" id="pubdate" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $org->pubdate ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="valid" class="control-label">有效</label>
											<div class="controls">
												<input type="checkbox" name="valid" id="valid" value="1" <?php if ( $org->valid ) echo 'checked="checked"'; ?>>
											</div>
										</div>
									</div>

									<div class="span12">
										<div class="form-actions">
											<button type="submit" class="btn btn-primary">保存</button>
											<input type="hidden" name="id" value="<?php echo $org->id; ?>">
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
