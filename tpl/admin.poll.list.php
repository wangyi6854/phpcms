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
									投票管理
									[<a href="./?module=admin.poll.modify" style="font-size: smaller;">添加</a>]
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
											<th>标题</th>
                                            <th style="width: 30px;">管理</th>
                                            <th style="width: 30px;">修改</th>
										</tr>
									</thead>
									<tbody>
<?php
foreach ( $list->list as $news )
{
?>
										<tr>
											<td><?php echo $news->id; ?></td>
											<td><?php echo $news->title; ?></td>
                                            <td><a href="./?module=admin.poll.option.list&id=<?php echo $news->id; ?>">管理</a></td>
                                            <td><a href="./?module=admin.poll.modify&id=<?php echo $news->id; ?>">修改</a></td>
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

    /*
    $('#export').click(function (){
        let courses = <?php echo json_encode( $courses ); ?>;
        $.each( courses, function ( k, c ){
            $('#export-target').prop('src', './?module=admin.course.apply.export.excel&course='+c);
        });
        return false;
    });
    */

});
</script>
<style>

</style>
<iframe id="export-target" style="display:none;"></iframe>
<?php include ROOT . '/tpl/admin.footer.php'; ?>