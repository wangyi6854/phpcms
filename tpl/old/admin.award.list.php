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
									荣誉证书管理
									<a style="font-size: smaller;"a href="./?module=admin.award.modify">添加</a>
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
foreach ( $list->list as $award )
{
?>
										<tr>
											<td><?php echo $award->title; ?></a></td>
											<td><a href="./?module=admin.award.modify&id=<?php echo $award->id; ?>">修改</a></td>
											<td><a href="./?module=admin.award.delete&id=<?php echo $award->id; ?>" class="delete_award">删除</a></td>
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
	$('.delete_award').click(function(e){
		e.preventDefault();
		if (confirm('确认删除？')) {
			window.location = this.href;
		}
	});
});
</script>
<?php include ROOT . '/tpl/admin.footer.php'; ?>