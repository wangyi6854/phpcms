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
									职位应聘列表
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-nomargin table-striped">
									<thead>
										<tr>
											<th style="width: 30px;">id</th>
											<th>姓名</th>
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
											<td><?php echo $job[ 'name' ]; ?></td>
											<td><a href="#detail" id="j<?php echo $k; ?>" class="view_detail" data-toggle="modal">详情</a></td>
											<td><a href="./?module=admin.job.delete&id=<?php echo $job[ 'id' ]; ?>" class="delete_job">删除</a></td>
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
	<div id="detail" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">应聘详情</h3>
		</div>
		<div class="modal-body">
			<table>
				<tr>
					<td width="21%">应聘岗位：</td>
					<td width="79%" id="ypgw"></td>
				</tr>
				<tr>
					<td>姓名</td>
					<td id="name"></td>
				</tr>
				<tr>
					<td>性别</td>
					<td id="sex"></td>
				</tr>
				<tr>
					<td>毕业学校</td>
					<td id="school"></td>
				</tr>
				<tr>
					<td>学历</td>
					<td id="grade"></td>
				</tr>
				<tr>
					<td>专业</td>
					<td id="major"></td>
				</tr>
				<tr>
					<td>电话</td>
					<td id="tel"></td>
				</tr>
				<tr>
					<td>E-mail</td>
					<td id="email"></td>
				</tr>
				<tr>
					<td>联系方式</td>
					<td id="contact"></td>
				</tr>
				<tr>
					<td>水平与能力：</td>
					<td id="ability"></td>
				</tr>
				<tr>
					<td>个人简历</td>
					<td id="summary"></td>
				</tr>
				<tr>
					<td>递交时间</td>
					<td id="postdate"></td>
				</tr>
			</table>
		</div>
		<div class="modal-footer">
			<button class="btn btn-primary" data-dismiss="modal">好的</button>
		</div>
	</div>
<?php include ROOT . '/tpl/admin.footer.script.php'; ?>
<script type="text/javascript">
var data = <?php echo json_encode( $list->list ); ?>;
$(function(){
	$('.view_detail').click(function(e){
		var current_data = data[this.id.substr(1)];
		$('#ypgw').html(current_data.ypgw);
		$('#name').html(current_data.name);
		$('#sex').html(current_data.sex);
		$('#school').html(current_data.school);
		$('#grade').html(current_data.grade);
		$('#major').html(current_data.major);
		$('#tel').html(current_data.tel);
		$('#email').html(current_data.email);
		$('#contact').html(current_data.contact);
		$('#ability').html(current_data.ability);
		$('#summary').html(current_data.summary);
		$('#postdate').html(current_data.postdate);
	});

	$('.delete_job').click(function(e){
		e.preventDefault();
		if (confirm('确认删掉这条应聘信息？')) {
			window.location = this.href;
		}
	});
});
</script>
<?php include ROOT . '/tpl/admin.footer.php'; ?>