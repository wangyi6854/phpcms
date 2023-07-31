<?php





$extra_header = <<<EOF
<style type="text/css">
input[type=checkbox] { margin: 0 5px;}
input[type=radio] { margin: 0 5px;}
#img-con img{width: 100%; height: 100%;}
#f img { max-width: 200px; }
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
								<form id="f" action="#" method="POST" class='form-horizontal form-column'>
									<div class="span6">
										<div class="control-group">
											<label for="name" class="control-label">姓名</label>
											<div class="controls">
												<?php echo htmlspecialchars( $people->name ); ?>
											</div>
										</div>
										<div class="control-group">
											<label for="leixing" class="control-label">类型</label>
											<div class="controls">
												<?php echo implode( ', ', $people->leixing ); ?>
											</div>
										</div>
										<div class="control-group">
											<label for="jibie" class="control-label">级别</label>
											<div class="controls">
												<?php echo implode( ', ', $people->jibie ); ?>
											</div>
										</div>
										<div class="control-group">
											<label for="jingyan" class="control-label">服务经验</label>
											<div class="controls">
												<?php echo htmlspecialchars( $people->jingyan ); ?> 年
											</div>
										</div>
										<div class="control-group">
											<label for="age" class="control-label">年龄</label>
											<div class="controls">
												<?php echo htmlspecialchars( $people->age ); ?> 岁
											</div>
										</div>
										<div class="control-group">
											<label for="neirong" class="control-label">服务内容</label>
											<div class="controls">
												<?php echo implode( ', ', $people->neirong ); ?>
											</div>
										</div>
										<div class="control-group">
											<label for="shuxiang" class="control-label">属相</label>
											<div class="controls">
												<?php echo $people->shuxiang; ?>
											</div>
										</div>
										<div class="control-group">
											<label for="jiguan" class="control-label">籍贯</label>
											<div class="controls">
												<?php echo htmlspecialchars( $people->jiguan ); ?>
											</div>
										</div>
										<div class="control-group">
											<label for="jiangxiang" class="control-label">奖项</label>
											<div class="controls">
												<?php echo htmlspecialchars( $people->jiangxiang ); ?>
											</div>
										</div>
										<div class="control-group">
											<label for="quyu" class="control-label">区域</label>
											<div class="controls">
												<?php echo implode( ', ', $people->quyu ); ?>
											</div>
										</div>
										<div class="control-group">
											<label for="sex" class="control-label">性别</label>
											<div class="controls">
												<?php echo htmlspecialchars( $people->sex ); ?>
											</div>
										</div>
										<div class="control-group">
											<label for="company" class="control-label">公司</label>
											<div class="controls">
												<?php echo htmlspecialchars( $people->company ); ?>
											</div>
										</div>
										<div class="control-group">
											<label for="techang" class="control-label">特长</label>
											<div class="controls">
												<?php echo htmlspecialchars( $people->techang ); ?>
											</div>
										</div>
										<div class="control-group">
											<label for="mobile" class="control-label">手机</label>
											<div class="controls">
												<?php echo htmlspecialchars( $people->mobile ); ?>
											</div>
										</div>
										<div class="control-group">
											<label for="photo" class="control-label">照片</label>
											<div class="controls">
												<?php
												foreach ( $people->photo as $p )
												{
												?>
													<img src="<?php echo htmlspecialchars( $p->path ); ?>">
												<?php
												}
												?>
											</div>
										</div>
										<div class="control-group">
											<label for="idcard" class="control-label">身份证</label>
											<div class="controls">
												<?php
												foreach ( $people->idcard as $p )
												{
												?>
													<img src="<?php echo htmlspecialchars( $p->path ); ?>">
												<?php
												}
												?>
											</div>
										</div>
										<div class="control-group">
											<label for="cert" class="control-label">证书</label>
											<div class="controls">
												<?php
												foreach ( $people->cert as $p )
												{
												?>
													<img src="<?php echo htmlspecialchars( $p->path ); ?>">
												<?php
												}
												?>
											</div>
										</div>
										<div class="control-group">
											<label for="cert" class="control-label">评语</label>
											<div class="controls">
												<textarea style="min-width: 40em; min-height: 8em;" name="comment"></textarea>
											</div>
										</div>
									</div>
									<div class="span12">
										<div class="form-actions">
											<button type="button" id="pass" class="btn btn-primary">通过</button>
											<button type="button" id="block" class="btn btn-primary">不通过</button>
											<input type="hidden" name="id" value="<?php echo $people->id; ?>">
											<input type="hidden" name="pass" value="0">
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>



			</div>
		</div></div>
<form action="lib/umeditor1_2_3-utf8-php/php/imageUp.php?type=ajax" style="display: none;" id="file_form" method="post" enctype="multipart/form-data">
	<input type="file" name="upfile" id="upfile" accept=".jpg,.jpeg,.png,.gif,.bmp" />
</form>

<div id="img-con"><img></div>

<?php include ROOT . '/tpl/admin.footer.script.php'; ?>

<script type="text/javascript">

$(function(){

	$('#upfile').change(function(){
		if ($('#upfile').fieldValue()) {
			$('#file_form').ajaxSubmit({
				dataType:	'json',
				clearForm:	true,
				success:	function(data){
					if (data.state == 'SUCCESS') {
						$('#photo').val(realpath(data.url));
					} else {
						alert('照片上传出错');
					}
				}
			});
		}
	});

	$('#upload_btn').click(function(){
		$('#upfile').click();
	});

	$('img', '#f').click(function(){
		$('img', '#img-con').attr('src', $(this).attr('src'));
		$('#img-con').dialog();
	});

	$('#pass').click(function(){
		$('input[name=pass]').val(1);
		$('#f').submit();
	});

	$('#block').click(function(){
		$('input[name=pass]').val(0);
		$('#f').submit();
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
