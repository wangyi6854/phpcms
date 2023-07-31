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
									实景展示列表
									[<a href="./?module=admin.product.show.modify" style="font-size: smaller;">添加</a>]
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-nomargin table-striped">
									<thead>
										<tr>
											<th style="width: 30px;">id</th>
											<th>标题</th>
											<th style="width: 30px;">定点</th>
											<th style="width: 30px;">修改</th>
											<th style="width: 30px;">删除</th>
										</tr>
									</thead>
									<tbody>
<?php
foreach ( $list->list as $productShow )
{
?>
										<tr>
											<td><?php echo $productShow->id; ?></td>
											<td><?php echo $productShow->title; ?></td>
											<td><a href="./?module=admin.product.show.item.list&cat=<?php echo $productShow->id; ?>">定点</a></td>
											<td><a href="./?module=admin.product.show.modify&id=<?php echo $productShow->id; ?>">修改</a></td>
											<td><a href="./?module=admin.product.show.delete&id=<?php echo $productShow->id; ?>" class="delete_productShow">删除</a></td>
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
	$('.delete_productShow').click(function(e){
		e.preventDefault();
		if (confirm('确认删掉这条实景展示？')) {
			window.location = this.href;
		}
	});
});
</script>
<?php include ROOT . '/tpl/admin.footer.php'; ?>