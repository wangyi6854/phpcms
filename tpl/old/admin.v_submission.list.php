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
									<?php echo htmlspecialchars( $target_user->username ); ?>
									<?php
									if ( !empty( $currentScheduleId ) )
									{
										include ROOT . '/tpl/admin.schedule_list_select.php';
									}
									if ( !empty( $currentYear ) )
									{
										include ROOT . '/tpl/admin.year_list.select.php';
									}
									?>
								</h3>
								<div style="float: right;">
								</div>
							</div>
							<div class="box-content nopadding">
								<table class="table table-nomargin table-striped">
									<thead>
										<tr>
											<th style="width: 22%;">指标名称</th>
											<th style="width: 22%;">测评内容</th>
											<th style="width: 45%;">报送要求</th>
											<th style="width: 40px;">报送状态</th>
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
	if ( $row[ 'submissionId' ] )
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
	$('select[name=schedule]').change(function(){
		window.location = './?module=admin.v_submission.list&scheduleId=' + $(this).fieldValue() + '&userId=<?php echo $userId; ?>';
	});
	$('select[name=year]').change(function(){
		window.location = './?module=admin.v_submission.list&year=' + $(this).fieldValue() + '&userId=<?php echo $userId; ?>';
	});
});
</script>
<style>

</style>
<?php include ROOT . '/tpl/admin.footer.php'; ?>