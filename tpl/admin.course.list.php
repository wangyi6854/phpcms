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
									课程管理
									[<a href="./?module=admin.course.modify&site=<?php echo htmlspecialchars( $site ); ?>" style="font-size: smaller;">添加</a>]
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
                                    [<a id="export" href="./?module=admin.course.apply.export.excel" style="font-size: smaller;">导出</a>]

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
                                            <th style="width: 40px;">报名量</th>
                                            <th style="width: 40px;">导出</th>
											<th style="width: 30px;">修改</th>
											<th style="width: 30px;">删除</th>
										</tr>
									</thead>
									<tbody>
<?php
foreach ( $list->list as $news )
{
?>
										<tr>
											<td><?php echo $news->id; ?></td>
											<td><a href="../?module=course&id=<?php echo $news->id; ?>" target="_blank"><?php echo $news->title; ?></a></td>
                                            <td><?php echo $news->count; ?>/<?php echo $news->maxCount; ?></td>
                                            <td><a href="./?module=admin.course.apply.export.excel&course=<?php echo htmlspecialchars($news->id); ?>">导出</a></td>
											<td><a href="./?module=admin.course.modify&id=<?php echo $news->id; ?>">修改</a></td>
											<td><a href="./?module=admin.course.delete&id=<?php echo $news->id; ?>" class="delete_news">删除</a></td>
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