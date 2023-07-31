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
									失信人员分类管理
									<a style="font-size: smaller;"a href="./?module=admin.people.cat.modify">添加分类</a>
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
foreach ( $list->list as $people )
{
?>
										<tr>
											<td><?php echo $people->name; ?></td>
											<td><a href="./?module=admin.people.cat.modify&id=<?php echo $people->id; ?>">修改</a></td>
											<td><a href="./?module=admin.people.cat.delete&id=<?php echo $people->id; ?>" class="delete_people">删除</a></td>
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
	$('.delete_people').click(function(e){
		e.preventDefault();
		if (confirm('删除分类并不删除对应的失信人员。\n如需删除对应失信人员，请先到失信人员管理中搜索删除。\n确认删掉这个分类？')) {
			window.location = this.href;
		}
	});
});
</script>
<?php include ROOT . '/tpl/admin.footer.php'; ?>