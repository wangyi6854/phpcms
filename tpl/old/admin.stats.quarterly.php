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
									季度统计
									<?php include ROOT . '/tpl/admin.schedule_list_select.php'; ?>
								</h3>
								<div style="float: right;">
									<!-- 总体通过率：<?php echo $total_pass_rate; ?>%未通过率：<?php echo $total_unpass_rate; ?>% -->
								</div>
							</div>
							<div class="box-content nopadding">
								<table class="table table-nomargin table-striped" id="t">
									<thead>
										<tr>
											<th style="">单位名称</th>
											<th style="width: 100px;">通过率</th>
										</tr>
									</thead>
									<tbody>
<?php
foreach ( $list as $row )
{
?>
										<tr>
											<td>
												<a href="./?module=admin.v_submission.list&userId=<?php echo htmlspecialchars( $row[ 3 ] ); ?>&scheduleId=<?php echo $scheduleId; ?>"><?php echo htmlspecialchars( $row[ 0 ] ); ?></a>
												<?php echo $row[ 4 ] != '正常' ? '(' . $row[ 4 ] . ')' : ''; ?>
											</td>
											<td><?php echo round( $row[ 1 ] / $row[ 2 ] * 100, 1 ); ?>%</td>
										</tr>
<?php
}
?>
									</tbody>
								</table>
							</div>
							<div class="box-title">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php include ROOT . '/tpl/admin.footer.script.php'; ?>
<script type="text/javascript" src="/js/jquery.dataTables.min.js" ></script>
<style type="text/css" src="/css/jquery.dataTables.min.css"></style>
<script type="text/javascript">
$(function(){
	$('#t').DataTable( {
		paging:	false,
		info:	false,
		order:	[],
		language:	{
			search:	'搜索：'
		}
	});

	$('select[name=schedule]').change(function(){
		window.location = './?module=admin.stats.quarterly&scheduleId=' + $(this).fieldValue();
	});

});


</script>
<style>

</style>
<?php include ROOT . '/tpl/admin.footer.php'; ?>