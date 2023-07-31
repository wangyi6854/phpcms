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
									线路列表
									[<a href="./?module=admin.product.modify" style="font-size: smaller;">添加</a>]
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
											<th>
												标题
											</th>
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
											<td><?php echo $product->id; ?></td>
											<td>
												<?php echo $product->name; ?>
												<span style="color: red;">
<?php
if ( $product->new )
{
	echo '[新品]';
}
if ( $product->hot )
{
	echo '[热门]';
}
if ( $product->tj )
{
	echo '[推荐]';
}
?>
												</span>
											</td>
											<td><a href="./?module=admin.product.modify&id=<?php echo $product->id; ?>">修改</a></td>
											<td><a href="./?module=admin.product.delete&id=<?php echo $product->id; ?>" class="delete_product">删除</a></td>
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
	$('.delete_product').click(function(e){
		e.preventDefault();
		if (confirm('确认删掉这条线路？')) {
			window.location = this.href;
		}
	});
});
</script>
<?php include ROOT . '/tpl/admin.footer.php'; ?>