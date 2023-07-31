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
									催收公告列表
									<a style="font-size: smaller;"a href="./?module=admin.csgg.modify">添加催收公告</a>
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
											<th>客户名称</th>
											<th style="width: 30px;">审核</th>
											<th style="width: 30px;">修改</th>
											<th style="width: 30px;">删除</th>
										</tr>
									</thead>
									<tbody>
<?php
foreach ( $list->list as $csgg )
{
?>
										<tr>
											<td><?php echo $csgg->id; ?></td>
											<td><?php echo $csgg->name; ?></td>
											<td><?php echo $csgg->valid ? '已审' : '<span class="not_mod">未审</span>'; ?></td>
											<td><a href="./?module=admin.csgg.modify&id=<?php echo $csgg->id; ?>">修改</a></td>
											<td><a href="./?module=admin.csgg.delete&id=<?php echo $csgg->id; ?>" class="delete_csgg">删除</a></td>
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
	$('.delete_csgg').click(function(e){
		e.preventDefault();
		if (confirm('确认删掉这名催收公告？')) {
			window.location = this.href;
		}
	});
});
</script>
<?php include ROOT . '/tpl/admin.footer.php'; ?>