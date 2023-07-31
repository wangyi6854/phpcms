<?php

include ROOT . '/tpl/admin.header.php';

?>

<div class="container-fluid" id="content">
		<div id="main">

				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i>法院编辑</h3>
							</div>
								<div class="box-content nopadding">
								<form action="#" method="POST" class='form-horizontal form-column'>
									<div class="span12">
										<div class="control-group">
											<label for="name" class="control-label">名称</label>
											<div class="controls">
												<input type="text" name="name" id="name" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $court->name ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="username" class="control-label">用户名</label>
											<div class="controls">
												<span><?php echo htmlspecialchars( $court->username ); ?></span>
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">密码</label>
											<div class="controls">
												<input type="text" name="password" id="password" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $court->password ? $court->password : gen_password() ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="abbr" class="control-label">简写</label>
											<div class="controls">
												<input type="text" name="abbr" id="abbr" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $court->abbr ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="logo" class="control-label">logo</label>
											<div class="controls">
												<input type="text" name="logo" id="logo" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $court->logo ); ?>">
												<input type="button" value="上传" id="upload_logo" />
											</div>
										</div>
										<div class="control-group">
											<label for="small_logo" class="control-label">小logo</label>
											<div class="controls">
												<input type="text" name="small_logo" id="small_logo" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $court->small_logo ); ?>">
												<input type="button" value="上传" id="upload_small_logo" />
											</div>
										</div>
										<div class="control-group">
											<label for="order" class="control-label">顺序</label>
											<div class="controls">
												<input type="text" name="order" id="order" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $court->order ); ?>">
												(越小越靠前)
											</div>
										</div>
									</div>

									<div class="span12">
										<div class="form-actions">
											<button type="submit" class="btn btn-primary">保存</button>
											<input type="hidden" name="id" value="<?php echo $court->id; ?>">
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>



			</div>
		</div></div>
<form action="lib/umeditor1_2_2-utf8-php/php/imageUp.php?type=ajax" style="display: none;" id="file_form" method="post" enctype="multipart/form-data">
	<input type="file" name="upfile" id="upfile" />
</form>

<form action="lib/umeditor1_2_2-utf8-php/php/imageUp.php?type=ajax" style="display: none;" id="file_form2" method="post" enctype="multipart/form-data">
	<input type="file" name="upfile" id="upfile2" />
</form>


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
						$('#logo').val(realpath(data.url));
					} else {
						alert('照片上传出错');
					}
				}
			});
		}
	});

	$('#upload_logo').click(function(){
		$('#upfile').click();
	});

	$('#upfile2').change(function(){
		if ($('#upfile2').fieldValue()) {
			$('#file_form2').ajaxSubmit({
				dataType:	'json',
				clearForm:	true,
				success:	function(data){
					if (data.state == 'SUCCESS') {
						$('#small_logo').val(realpath(data.url));
					} else {
						alert('照片上传出错');
					}
				}
			});
		}
	});

	$('#upload_small_logo').click(function(){
		$('#upfile2').click();
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
  return getPath(path.join('/'));
}
</script>

<?php include ROOT . '/tpl/admin.footer.php'; ?>
