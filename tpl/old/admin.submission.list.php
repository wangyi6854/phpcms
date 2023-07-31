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
									报送列表 (<?php echo htmlspecialchars( $schedule->description ); ?>)
								</h3>
								<div style="float: right;">
									<form method="GET" class='search-form' style="display: inline;">
										<div class="search-pane">
											<input type="text" name="keyword" placeholder="搜索评测内容">
											<input type="hidden" name="module" value="<?php echo $module; ?>">

											<button type="submit">
												<i class="icon-search"></i>
											</button>
										</div>
									</form>
								</div>
							</div>
							<?php include ROOT . '/tpl/admin.schedule.display.php'; ?>
							<div class="box-content nopadding">
								<table class="table table-nomargin table-striped">
									<thead>
										<tr>
											<th style="width: 22%;">指标名称</th>
											<th style="width: 22%;">测评内容</th>
											<th style="width: 40%;">报送要求</th>
											<th style="width: 40px;" id="status">报送状态 <img id="sort-indicator"/></th>
											<th style="width: 30px;">操作</th>
										</tr>
									</thead>
									<tbody>
<?php
foreach ( $list as $row )
{
?>
										<tr>
											<td><?php echo htmlspecialchars( iconv_substr( $row[ 'title' ], 0, 20 ) ); ?></td>
											<td><?php echo htmlspecialchars( iconv_substr( $row[ 'content' ], 0, 20 ) ); ?></td>
											<td><?php echo htmlspecialchars( iconv_substr( $row[ 'requirement' ], 0, 60 ) ); ?></td>
											<td><?php echo $row[ 'status' ]; ?></td>
											<td>
	<?php
	if ( !in_array( $row[ 'status' ], [ '通过', '未通过' ] ) && $submittable )
	{
	?>
												<a href="./?module=admin.submission.modify&id=<?php echo $row[ 'submissionId' ]; ?>&rrid=<?php echo $row[ 'rrid' ]; ?>">报送</a>
	<?php
	}
	else
	{
	?>
												<a href="./?module=admin.submission.view&id=<?php echo $row[ 'submissionId' ]; ?>">查看</a>
	<?php
	}
	?>
											</td>
										</tr>
<?php
}
?>
									</tbody>
								</table>
							</div>
							<div class="box-title">
								<?php echo page_string( $page, $num_result, $pagesize ); ?>
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
	$('#status').click(function(){
		var base_url = './?module=admin.submission.list';
		if ($(this).data('order') == 'up')
		{
			window.location = base_url+'&sort=down';
		}
		else if ($(this).data('order') == 'down')
		{
			window.location = base_url;
		}
		else
		{
			window.location = base_url+'&sort=up';
		}
	}).data('order', '<?php echo $sort; ?>');

	switch ($('#status').data('order'))
	{
		case 'up':
			$('#sort-indicator').attr('src', '/img/sort_asc.png');
			break;

		case 'down':
			$('#sort-indicator').attr('src', '/img/sort_desc.png');
			break;

		case '':
			$('#sort-indicator').attr('src', '/img/sorting.png');
			break;

	}

});
</script>
<style>

</style>
<?php include ROOT . '/tpl/admin.footer.php'; ?>