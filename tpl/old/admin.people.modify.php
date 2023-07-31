<?php





$extra_header = <<<EOF
<style type="text/css">
input[type=checkbox] { margin: 0 5px;}
input[type=radio] { margin: 0 5px;}
#f img { max-width: 200px; }
.img-wrap {
    position: relative;
	max-width: 200px;
}
.img-wrap .close-btn {
    position: absolute;
    top: 2px;
    right: 2px;
    z-index: 100;
	width: 30px;
	height: 30px;
	text-align: center;
	line-height: 30px;
	background-color: #F2F3F4;
	color: #3498DB;
	font-weight: bold;
	cursor: pointer;
	font-size: 2em;
}
</style>

<link href="js/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet">


EOF;

$extra_footer = <<<EOF
<script src="js/jquery-ui-1.12.1/jquery-ui.min.js"></script>

EOF;


include ROOT . '/tpl/admin.header.php';

?>

<div class="container-fluid" id="content">
		<div id="main">

				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i>人员编辑</h3>
							</div>
							<div class="box-content nopadding">
								<form action="#" method="POST" class='form-horizontal form-column' id="f">
									<div class="span6">
										<div class="control-group">
											<label for="name" class="control-label">姓名</label>
											<div class="controls">
												<input type="text" name="name" id="name" placeholder="" class="input-xlarge" style="width: 560px;" value="<?php echo htmlspecialchars( $people->name ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="leixing" class="control-label">类型</label>
											<div class="controls">
												<?php echo html_checkbox( 'leixing[]', $leixing_enum, $leixing_enum, $people->leixing ); ?>
											</div>
										</div>
										<div class="control-group">
											<label for="jibie" class="control-label">级别</label>
											<div class="controls">
												<?php echo html_checkbox( 'jibie[]', $jibie_enum, $jibie_enum, $people->jibie ); ?>
											</div>
										</div>
										<div class="control-group">
											<label for="jingyan" class="control-label">服务经验</label>
											<div class="controls">
												<input type="text" name="jingyan" id="jingyan" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $people->jingyan ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="age" class="control-label">年龄</label>
											<div class="controls">
												<input type="text" name="age" id="age" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $people->age ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="neirong" class="control-label">服务内容</label>
											<div class="controls">
												<?php echo html_checkbox( 'neirong[]', $neirong_enum, $neirong_enum, $people->neirong ); ?>
											</div>
										</div>
										<div class="control-group">
											<label for="shuxiang" class="control-label">属相</label>
											<div class="controls">
												<?php echo html_radiobox( 'shuxiang', $shuxiang_enum, $shuxiang_enum, $people->shuxiang ); ?>
											</div>
										</div>
										<div class="control-group">
											<label for="jiguan" class="control-label">籍贯</label>
											<div class="controls">
												<input type="text" name="jiguan" id="jiguan" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $people->jiguan ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="jiangxiang" class="control-label">奖项</label>
											<div class="controls">
												<input type="text" name="jiangxiang" id="jiangxiang" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $people->jiangxiang ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="quyu" class="control-label">区域</label>
											<div class="controls">
												<?php echo html_checkbox( 'quyu[]', $quyu_enum, $quyu_enum, $people->quyu ); ?>
											</div>
										</div>
										<div class="control-group">
											<label for="sex" class="control-label">性别</label>
											<div class="controls">
												<input type="text" name="sex" id="sex" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $people->sex ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="company" class="control-label">公司</label>
											<div class="controls">
												<input type="text" name="company" id="company" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $people->company ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="techang" class="control-label">特长</label>
											<div class="controls">
												<input type="text" name="techang" id="techang" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $people->techang ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="mobile" class="control-label">手机</label>
											<div class="controls">
												<input type="text" name="mobile" id="mobile" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $people->mobile ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="p1" class="control-label">照片</label>
											<div class="controls">
												<div id="p1">
												</div>
												<input type="button" value="上传" data-target="p1" class="upload_btn" />
											</div>
										</div>
										<div class="control-group">
											<label for="p2" class="control-label">身份证（正面）</label>
											<div class="controls">
												<div id="p2"></div>
												<input type="button" value="上传" data-target="p2" class="upload_btn" />
											</div>
										</div>
										<div class="control-group">
											<label for="p3" class="control-label">身份证（反面）</label>
											<div class="controls">
												<div id="p3"></div>
												<input type="button" value="上传" data-target="p3" class="upload_btn" />
											</div>
										</div>
										<div class="control-group">
											<label for="p4" class="control-label">证书</label>
											<div class="controls">
												<div id="p4"></div>
												<input type="button" value="上传" data-target="p4" class="upload_btn" />

											</div>
										</div>
									</div>
									<div class="span12">
										<div class="form-actions">
											<button type="submit" class="btn btn-primary">保存</button>
											<input type="hidden" name="id" value="<?php echo $people->id; ?>">
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>



			</div>
		</div></div>
<form action="./?module=upload" style="display: none;" id="file_form" method="post">
	<input type="file" name="file" id="file">
</form>

<div id="img-con"><img></div>

<?php include ROOT . '/tpl/admin.footer.script.php'; ?>

<script type="text/javascript">

$(function(){

	$('.upload_btn').click(function(){
		target = $(this).data('target');
		$('#file').click();
	});

	$('#file').change(function(){
		if ($('#file').fieldValue()) {
			$('#file_form').ajaxSubmit({
				dataType:	'json',
				clearForm:	true,
				success:	function(data){
					if (!data.return) {
						add_image(target, data.data.path, data.data.id);
					} else {
						alert('照片上传出错');
					}
				}
			});
		}
	});

	function add_image(target, url, id)
	{
		console.log(target);
		if ( $.inArray(parseInt(target.substr(1)), [1,2,3]) != -1 )
		{
			$('#'+target).empty();
		}

		$('#'+target).append(image_template(parseInt(target.substr(1)), url, id));
	}

	function image_template(target, src, id )
	{
		switch ( target )
		{
			case 1:
				var name = 'photo[]';
				break;
			case 2:
			case 3:
				var name = 'idcard[]';
				break;
			case 4:
				var name = 'cert[]';
				break;
		}

		return hereDoc = `
<div class="img-con">
	<div class="img-wrap">
		<span class="close-btn">&times;</span>
		<img src="${src}" data-id="${id}">
		<input type="hidden" name="${name}" value="${id}">
	</div>
</div>
`;

	}

	$('.controls').on('click', '.close-btn', function(){
		var id = $(this).closest('.img-con').find('img').data('id');
		$(this).closest('.img-con').remove();
	});






	$('img', '#f').click(function(){
		$('img', '#img-con').attr('src', $(this).attr('src'));
		//$('#img-con').dialog();
	});

	$.each(<?php echo json_encode($people->photo); ?>, function(i, v){
		add_image('p1', v.path, v.id);
	});

	$.each(<?php echo json_encode(@[$people->idcard[0]]); ?>, function(i, v){
		add_image('p2', v.path, v.id);
	});

	$.each(<?php echo json_encode(@[$people->idcard[1]]); ?>, function(i, v){
		add_image('p3', v.path, v.id);
	});

	$.each(<?php echo json_encode($people->cert); ?>, function(i, v){
		add_image('p4', v.path, v.id);
	});


});


function getPath(url) {
	//
	// get from http://stackoverflow.com/questions/441755/regular-expression-to-remove-hostname-and-port-from-url
	//
	var a = document.createElement('a');
	a.href = url;
	return a.pathname.substr(0,1) === '/' ? a.pathname : '/' + a.pathname;
}

function realpath(path) {
  //  discuss at: http://phpjs.org/functions/realpath/
  // original by: mk.keck
  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //        note: Returned path is an url like e.g. 'http://yourhost.tld/path/'
  //   example 1: realpath('../.././_supporters/pj_test_supportfile_1.htm');
  //   returns 1: 'file:/home/kevin/workspace/_supporters/pj_test_supportfile_1.htm'

  var p = 0,
    arr = []; /* Save the root, if not given */
  var r = this.window.location.href; /* Avoid input failures */
  path = (path + '')
    .replace('\\', '/'); /* Check if there's a port in path (like 'http://') */
  if (path.indexOf('://') !== -1) {
    p = 1;
  } /* Ok, there's not a port in path, so let's take the root */
  if (!p) {
    path = r.substring(0, r.lastIndexOf('/') + 1) + path;
  } /* Explode the given path into it's parts */
  arr = path.split('/'); /* The path is an array now */
  path = []; /* Foreach part make a check */
  for (var k in arr) { /* This is'nt really interesting */
    if (arr[k] == '.') {
      continue;
    } /* This reduces the realpath */
    if (arr[k] == '..') {
      /* But only if there more than 3 parts in the path-array.
       * The first three parts are for the uri */
      if (path.length > 3) {
        path.pop();
      }
    } /* This adds parts to the realpath */
    else {
      /* But only if the part is not empty or the uri
       * (the first three parts ar needed) was not
       * saved */
      if ((path.length < 2) || (arr[k] !== '')) {
        path.push(arr[k]);
      }
    }
  } /* Returns the absloute path as a string */
  return getPath(path.join('/')).replace(/^\//,"");
}
</script>
<?php include ROOT . '/tpl/admin.footer.php'; ?>
