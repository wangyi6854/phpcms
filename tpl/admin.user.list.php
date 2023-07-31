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
									单位列表
								</h3>
								<div style="float: right;">
									<form method="GET" class='search-form' style="display: inline;">
										<div class="search-pane">
											<input type="text" name="keyword" placeholder="搜索">
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
											<th style="">用户名</th>
											<th style="width: 20%;">状态</th>
											<th style="width: 30px;">操作</th>
										</tr>
									</thead>
									<tbody>
<?php
foreach ( $list as $row )
{
?>
										<tr>
											<td><?php echo htmlspecialchars( $row[ 'username' ] ); ?></td>
											<td><?php echo htmlspecialchars( iconv_substr( $row[ 'status' ], 0, 20 ) ); ?></td>
											<td>
												<a href="./?module=admin.user.modify&id=<?php echo $row[ 'id' ]; ?>">修改</a>
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