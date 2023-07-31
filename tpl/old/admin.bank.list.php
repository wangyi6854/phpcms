<?php include ROOT . '/tpl/admin.header.php'; ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									银行列表
									<a style="font-size: smaller;"a href="./?module=admin.bank.modify">添加银行</a>
								</h3>
								<div style="float: right;">
									<form action="<?php echo htmlspecialchars( $_SERVER[ 'REQUEST_URI' ] ); ?>" method="GET" class='search-form'>
										<div class="search-pane">
											<input type="text" name="keyword" placeholder="搜索...">
											<input type="hidden" name="module" value="<?php echo $module; ?>">

											<button type="submit">
												<i class="icon-search"></i>
											</button>
										</div>
									</form>
								</div>
							</div>
							<div class="box-content nopadding">
								<table class="table table-nomargin table-striped">
									<thead>
										<tr>
											<th style="width: 30px;">id</th>
											<th style="width: 30px;">顺序</th>
											<th>名称</th>
											<th style="width: 30px;">修改</th>
											<th style="width: 30px;">删除</th>
										</tr>
									</thead>
									<tbody>
<?php
foreach ( $list->list as $bank )
{
?>
										<tr>
											<td><?php echo $bank->id; ?></td>
											<td><?php echo $bank->order; ?></td>
											<td><?php echo $bank->name; ?></td>
											<td><a href="./?module=admin.bank.modify&id=<?php echo $bank->id; ?>">修改</a></td>
											<td><a href="./?module=admin.bank.delete&id=<?php echo $bank->id; ?>" class="delete_bank">删除</a></td>
										</tr>
<?php
}
?>
									</tbody>
								</table>
							</div>
							<div class="box-title">
								<?php echo page_string( $page, $list->totalRecords, $pagesize ); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php include ROOT . '/tpl/admin.footer.script.php'; ?>
<script type="text/javascript">
$(function(){
	$('.delete_bank').click(function(e){
		e.preventDefault();
		if (confirm('确认删掉这个银行？')) {
			window.location = this.href;
		}
	});
});
</script>
<?php include ROOT . '/tpl/admin.footer.php'; ?>