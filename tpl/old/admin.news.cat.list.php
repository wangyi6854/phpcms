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
									新闻分类管理
<?php
if ( $id )
{
?>
									[<a href="./?module=admin.news.cat.list"><?php echo $parent_cat_name; ?></a>]
<?php
}
?>
										<a style="font-size: smaller;"a href="./?module=admin.news.cat.modify">添加分类</a>
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
foreach ( $list->list as $news )
{
?>
										<tr>
<?php
	if ( !$id )
	{
?>
											<td><a href="./?module=admin.news.cat.list&id=<?php echo $news->id; ?>"><?php echo $news->name; ?></a></td>
<?php
	}
	else
	{
?>
											<td><?php echo $news->name; ?></td>
<?php
	}
?>
											<td><a href="./?module=admin.news.cat.modify&id=<?php echo $news->id; ?>">修改</a></td>
											<td><a href="./?module=admin.news.cat.delete&id=<?php echo $news->id; ?>" class="delete_news">删除</a></td>
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
	$('.delete_news').click(function(e){
		e.preventDefault();
		if (confirm('删除分类并不删除对应的新闻。\n如需删除对应新闻，请先到新闻管理中搜索删除。\n确认删掉这个分类？')) {
			window.location = this.href;
		}
	});
});
</script>
<?php include ROOT . '/tpl/admin.footer.php'; ?>