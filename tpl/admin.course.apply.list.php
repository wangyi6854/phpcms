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
									课程预约管理
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<select name="site" id="site" class="input-large">
										<option value="">选择场地</option>
<?php
foreach ( $sites as $entry )
{
?>
										<option value="<?php echo htmlspecialchars( $entry ); ?>" <?php if ( $entry == $site ) echo 'selected="selected"'?>><?php echo htmlspecialchars( $entry ); ?></option>
<?php
}
?>
									</select>
								</h3>
								<div style="float: right;">
                                    <a href="?module=admin.course.apply.export.excel&site=<?php echo htmlspecialchars($site); ?>">导出</a>
								</div>
							</div>
							<div class="box-content nopadding">
								<table class="table table-nomargin table-striped">
									<thead>
										<tr>
											<th style="width: 30px;">id</th>
                                            <th>姓名</th>
                                            <th>身份证号</th>
                                            <th>手机号</th>
                                            <th>报名时间</th>
										</tr>
									</thead>
									<tbody>
<?php
foreach ( $list->list as $news )
{
?>
										<tr>
											<td><?php echo $news->id; ?></td>
											<td><?php echo $news->name; ?></td>
                                            <td><?php echo $news->idcard; ?></td>
                                            <td><?php echo $news->phone; ?></td>
                                            <td><?php echo $news->ts; ?></td>
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
	$('.delete_news').click(function(e){
		e.preventDefault();
		if (confirm('确认删掉这条内容？')) {
			window.location = this.href;
		}
	});

	$('#site').change(function(){
		var loc = window.location.href;

		loc = loc.replace( /[\?&]page=\d+/, '' ).replace( /[\?&]site=[^&]+/, '' );

		var conn_str = loc.search( /\?/ ) ? '&' : '?';

		var cat = $(':selected', this).val();

		if ( cat )
		{
			location = loc + conn_str + 'site=' + $(this).val();
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