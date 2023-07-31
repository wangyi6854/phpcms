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
									反馈管理
                                    <a href="./?module=admin.feedback.export.excel"">导出</a>
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-nomargin table-striped">
									<thead>
										<tr>
											<th style="width: 30px;">id</th>
											<th style="width: 200px;">标题</th>
											<th>内容</th>
										</tr>
									</thead>
									<tbody>
<?php
foreach ( $list->list as $news )
{
?>
										<tr>
											<td><?php echo $news->id; ?></td>
											<td><?php echo htmlspecialchars($news->title); ?></td>
                                            <td><?php echo htmlspecialchars($news->content); ?></td>
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