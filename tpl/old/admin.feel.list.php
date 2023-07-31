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
									终端形象列表
									[<a href="./?module=admin.feel.modify" style="font-size: smaller;">添加</a>]
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-nomargin table-striped">
									<thead>
										<tr>
											<th style="width: 30px;">id</th>
											<th>标题</th>
											<th style="width: 30px;">修改</th>
											<th style="width: 30px;">删除</th>
										</tr>
									</thead>
									<tbody>
<?php
foreach ( $list->list as $feel )
{
?>
										<tr>
											<td><?php echo $feel->id; ?></td>
											<td><?php echo $feel->title; ?></td>
											<td><a href="./?module=admin.feel.modify&id=<?php echo $feel->id; ?>">修改</a></td>
											<td><a href="./?module=admin.feel.delete&id=<?php echo $feel->id; ?>" class="delete_feel">删除</a></td>
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
	$('.delete_feel').click(function(e){
		e.preventDefault();
		if (confirm('确认删掉这条终端形象？')) {
			window.location = this.href;
		}
	});
});
</script>
<?php include ROOT . '/tpl/admin.footer.php'; ?>