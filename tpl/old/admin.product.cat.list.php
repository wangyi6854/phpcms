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
									产品主分类管理
<?php
if ( $id )
{
?>
									[<a href="./?module=admin.product.cat.list"><?php echo $parent_cat_name; ?></a>]
<?php
}
?>
									<a style="font-size: smaller;"a href="./?module=admin.product.cat.modify">添加分类</a>
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-nomargin table-striped">
									<thead>
										<tr>
											<th>名称</th>
											<th style="width: 30px;">修改</th>
											<th style="width: 30px;">删除</th>
										</tr>
									</thead>
									<tbody>
<?php
foreach ( $list->list as $product )
{
?>
										<tr>
											<td><a href="./?module=admin.product.subcat.list&id=<?php echo $product->id; ?>"><?php echo $product->name; ?></a></td>
											<td><a href="./?module=admin.product.cat.modify&id=<?php echo $product->id; ?>">修改</a></td>
											<td><a href="./?module=admin.product.cat.delete&id=<?php echo $product->id; ?>" class="delete_product">删除</a></td>
										</tr>
<?php
}
?>
									</tbody>
								</table>
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
	$('.delete_product').click(function(e){
		e.preventDefault();
		if (confirm('删除分类并不删除对应的产品。\n如需删除对应产品，请先到产品管理中搜索删除。\n确认删掉这个分类？')) {
			window.location = this.href;
		}
	});
});
</script>
<?php include ROOT . '/tpl/admin.footer.php'; ?>