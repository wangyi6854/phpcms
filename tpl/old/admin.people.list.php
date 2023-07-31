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
									人员管理
									[<a href="./?module=admin.people.modify&cat=<?php echo $cat; ?>" style="font-size: smaller;">添加</a>]
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								</h3>
								<div style="float: right;">
									<form action="<?php echo htmlspecialchars( $_SERVER[ 'REQUEST_URI' ] ); ?>" method="GET" class='search-form' style="display: inline;">
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
											<th>姓名</th>
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
											<td><?php echo $people->id; ?></td>
											<td><a href="../?module=people&id=<?php echo $people->id; ?>" target="_blank"><?php echo $people->name; ?></a></td>
											<td><a href="./?module=admin.people.modify&id=<?php echo $people->id; ?>">修改</a></td>
											<td><a href="./?module=admin.people.delete&id=<?php echo $people->id; ?>" class="delete_people">删除</a></td>
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
	$('.delete_people').click(function(e){
		e.preventDefault();
		if (confirm('确认删掉这条内容？')) {
			window.location = this.href;
		}
	});

	$('#cat').change(function(){
		var loc = window.location.href;

		loc = loc.replace( /[\?&]page=\d+/, '' ).replace( /[\?&]cat=\d+/, '' );

		var conn_str = loc.search( /\?/ ) ? '&' : '?';

		var cat = parseInt( $(this).val() );

		if ( cat )
		{
			location = loc + conn_str + 'cat=' + $(this).val();
		}
		else
		{
			location = loc;
		}
	});
});
</script>
<style>

</style>
<?php include ROOT . '/tpl/admin.footer.php'; ?>