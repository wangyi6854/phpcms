<?php include ROOT . '/tpl/admin.header.php'; ?>
	<div class="container-fluid" id="content">
		<div id="main" style="">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									监督列表
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-nomargin table-striped">
									<thead>
										<tr>
											<th style="width: 30px;">id</th>
											<th style="width: 60px;">处理情况</th>
											<th style="width: 100px;">执行法院</th>
											<th style="width: 100px;">对象姓名</th>
											<th style="text-align: center;">监督事由</th>
											<th style="width: 30px;">详情</th>
											<th style="width: 30px;">删除</th>
										</tr>
									</thead>
									<tbody>
<?php
foreach ( $list->list as $k => $job )
{
?>
										<tr>
											<td><?php echo $job[ 'id' ]; ?></td>
											<td style="color: <?php if ( $job[ 'status' ] == '待处理' ) { echo 'red'; } if ( $job[ 'status' ] == '已处理' ) { echo 'green'; } ?>;"><?php echo $job[ 'status' ]; ?></td>
											<td><?php echo htmlspecialchars( $job[ 'court' ] ); ?></td>
											<td><?php echo htmlspecialchars( $job[ 'target' ] ); ?></td>
											<td><?php echo htmlspecialchars( iconv_substr( $job[ 'content' ], 0, 15, 'UTF-8' ) ); ?></td>
											<td><a href="./?module=admin.jiandu.modify&id=<?php echo $job[ 'id' ]; ?>" class="view_detail" data-toggle="modal">详情</a></td>
											<td><a href="./?module=admin.jiandu.delete&id=<?php echo $job[ 'id' ]; ?>" class="delete_job">删除</a></td>
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
	$('.delete_job').click(function(e){
		e.preventDefault();
		if (confirm('确认删掉这条监督信息？')) {
			window.location = this.href;
		}
	});
});
</script>
<?php include ROOT . '/tpl/admin.footer.php'; ?>
