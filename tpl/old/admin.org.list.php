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
									失信机构列表
									<a style="font-size: smaller;"a href="./?module=admin.org.modify">添加失信机构</a>
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
											<th>被执行人</th>
											<th style="width: 30px;">修改</th>
											<th style="width: 30px;">删除</th>
										</tr>
									</thead>
									<tbody>
<?php
foreach ( $list->list as $org )
{
?>
										<tr>
											<td><?php echo $org->id; ?></td>
											<td><?php echo $org->name; ?></td>
											<td><a href="./?module=admin.org.modify&id=<?php echo $org->id; ?>">修改</a></td>
											<td><a href="./?module=admin.org.delete&id=<?php echo $org->id; ?>" class="delete_org">删除</a></td>
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
	$('.delete_org').click(function(e){
		e.preventDefault();
		if (confirm('确认删掉这名失信机构？')) {
			window.location = this.href;
		}
	});
});
</script>
<?php include ROOT . '/tpl/admin.footer.php'; ?>