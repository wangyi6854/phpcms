<?php

include ROOT . '/tpl/admin.header.php';

?>

<div class="container-fluid" id="content">
		<div id="main">

				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i>产品分类编辑</h3>
							</div>
							<div class="box-content nopadding">
								<form action="#" method="POST" class='form-horizontal form-column'>
									<div class="span6">
										<div class="control-group">
											<label for="name" class="control-label">分类名称</label>
											<div class="controls">
												<input type="text" name="name" id="name" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $productCat->name ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="img" class="control-label">分类图</label>
											<div class="controls">
												<input type="text" name="img" id="img" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $productCat->image ); ?>">
												<input type="button" value="上传" class="upload_btn" tag="img" />
												(851x201)
											</div>
										</div>
										<div class="control-group">
											<label for="ln" class="control-label">分类说明</label>
											<div class="controls">
												<input type="text" name="ln" id="ln" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $productCat->summary ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="orderid" class="control-label">显示顺序</label>
											<div class="controls">
												<input type="text" name="orderid" id="orderid" placeholder="默认255。越小越靠前。" class="input-xlarge" value="<?php echo htmlspecialchars( $productCat->order ); ?>">
											</div>
										</div>
									</div>
									<div class="span12">
										<div class="form-actions">
											<button type="submit" class="btn btn-primary">保存</button>
											<input type="hidden" name="id" value="<?php echo $id; ?>">
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
	<input type="hidden" name="field" id="field" />
</form>

<?php include ROOT . '/tpl/admin.footer.script.php'; ?>

<script type="text/javascript">

$(function(){
	$('#upfile').change(function(){
		if ($('#upfile').fieldValue()) {
			var id = $('#field').fieldValue();
			$('#file_form').ajaxSubmit({
				dataType:	'json',
				clearForm:	true,
				success:	function(data){
					if (data.state == 'SUCCESS') {
						$('#'+id).val(realpath(data.url));
					} else {
						alert('照片上传出错');
					}
				}
			});
		}
	});

	$('.upload_btn').click(function(){
		$('#field').val($(this).attr('tag'));
		$('#upfile').click();
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
