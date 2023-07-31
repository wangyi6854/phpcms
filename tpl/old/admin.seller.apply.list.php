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
									经销商申请列表
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-nomargin table-striped">
									<thead>
										<tr>
											<th style="width: 30px;">id</th>
											<th>标题</th>
											<th style="width: 30px;">查看</th>
											<th style="width: 30px;">删除</th>
										</tr>
									</thead>
									<tbody>
<?php
foreach ( $list->list as $seller )
{
?>
										<tr <?php if ( !$seller->passed ) echo 'style="background-color: pink !important;"'; ?>>
											<td><?php echo $seller->id; ?></td>
											<td><?php echo $seller->name; ?></td>
											<td><a href="./?module=admin.seller.apply.modify&id=<?php echo $seller->id; ?>" class="view_apply">查看</a></td>
											<td><a href="./?module=admin.seller.apply.delete&id=<?php echo $seller->id; ?>" class="delete_seller">删除</a></td>
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
	$('.delete_seller').click(function(e){
		e.preventDefault();
		if (confirm('确认删掉这个经销商申请？')) {
			window.location = this.href;
		}
	});
});
</script>
<?php include ROOT . '/tpl/admin.footer.php'; ?>