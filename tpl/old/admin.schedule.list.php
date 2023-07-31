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
									报送时间列表
									[<a href="./?module=admin.schedule.modify" style="font-size: smaller;">添加</a>]
								</h3>
								<div style="float: right;">
								</div>
							</div>
							<div class="box-content nopadding">
								<div style="text-align: center; color: red; font-size: 16px; padding: 10px;">报送开始后不能修改删除</div>
								<table class="table table-nomargin table-striped">
									<thead>
										<tr>
											<th style="width: 60px;">报送周期</th>
											<th style="width: 12%;">报送起止时间</th>
											<th style="width: 12%;">二级初审起止时间</th>
											<th style="width: 12%;">一级初审起止时间</th>
											<th style="width: 12%;">重新报送起止时间</th>
											<th style="width: 12%;">二级终审起止时间</th>
											<th style="width: 12%;">一级终审起止时间</th>
											<th style="width: 40px;">操作</th>
										</tr>
									</thead>
									<tbody>
<?php
foreach ( $list as $row )
{
?>
										<tr>
											<td><?php echo htmlspecialchars( iconv_substr( $row[ 'description' ], 0, 20 ) ); ?></td>
											<td><?php echo date( 'Y-n-j', strtotime( $row[ 'submitStart' ] ) ); ?> 至 <?php echo date( 'Y-n-j', strtotime( $row[ 'submitEnd' ] ) ); ?></td>
											<td><?php echo date( 'Y-n-j', strtotime( $row[ 'reviewStart' ] ) ); ?> 至 <?php echo date( 'Y-n-j', strtotime( $row[ 'reviewEnd' ] ) ); ?></td>
											<td><?php echo date( 'Y-n-j', strtotime( $row[ 'review12Start' ] ) ); ?> 至 <?php echo date( 'Y-n-j', strtotime( $row[ 'review12End' ] ) ); ?></td>
											<td><?php echo date( 'Y-n-j', strtotime( $row[ 'submit2Start' ] ) ); ?> 至 <?php echo date( 'Y-n-j', strtotime( $row[ 'submit2End' ] ) ); ?></td>
											<td><?php echo date( 'Y-n-j', strtotime( $row[ 'review2Start' ] ) ); ?> 至 <?php echo date( 'Y-n-j', strtotime( $row[ 'review2End' ] ) ); ?></td>
											<td><?php echo date( 'Y-n-j', strtotime( $row[ 'review22Start' ] ) ); ?> 至 <?php echo date( 'Y-n-j', strtotime( $row[ 'review22End' ] ) ); ?></td>
											<td>
												<?php
												if ( strtotime( $row[ 'submitStart' ] ) > time() + 3600 )
												{
												?>
												<a href="./?module=admin.schedule.modify&id=<?php echo $row[ 'id' ]; ?>">修改</a>
												<a href="./?module=admin.schedule.delete&id=<?php echo $row[ 'id' ]; ?>">删除</a>
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

});
</script>
<style>

</style>
<?php include ROOT . '/tpl/admin.footer.php'; ?>