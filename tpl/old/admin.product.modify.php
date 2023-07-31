<?php

include ROOT . '/tpl/admin.header.php';

?>

<div class="container-fluid" id="content">
		<div id="main">

				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i>线路编辑</h3>
							</div>
							<div class="box-content nopadding">
								<form action="#" method="POST" class='form-horizontal form-column'>
									<div class="span6">
										<div class="control-group">
											<label for="name" class="control-label">线路名称</label>
											<div class="controls">
												<input type="text" name="name" id="name" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $product->name ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="cat2" class="control-label">类别</label>
											<div class="controls">
												<input type="text" name="cat2" id="cat2" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $product->cat2 ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="photo1" class="control-label">图1</label>
											<div class="controls">
												<input type="text" name="photo1" id="photo1" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $product->photo1 ); ?>">
												<input type="button" value="上传" class="upload_btn" tag="photo1" />
												(780x500)
											</div>
										</div>
										<div class="control-group">
											<label for="photo2" class="control-label">图2</label>
											<div class="controls">
												<input type="text" name="photo2" id="photo2" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $product->photo2 ); ?>">
												<input type="button" value="上传" class="upload_btn" tag="photo2" />
												(780x500)
											</div>
										</div>
										<div class="control-group">
											<label for="photo3" class="control-label">图3</label>
											<div class="controls">
												<input type="text" name="photo3" id="photo3" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $product->photo3 ); ?>">
												<input type="button" value="上传" class="upload_btn" tag="photo3" />
												(780x500)
											</div>
										</div>
										<div class="control-group">
											<label for="photo4" class="control-label">图4</label>
											<div class="controls">
												<input type="text" name="photo4" id="photo4" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $product->photo4 ); ?>">
												<input type="button" value="上传" class="upload_btn" tag="photo4" />
												(780x500)
											</div>
										</div>
										<div class="control-group">
											<label for="photo5" class="control-label">图5</label>
											<div class="controls">
												<input type="text" name="photo5" id="photo5" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $product->photo5 ); ?>">
												<input type="button" value="上传" class="upload_btn" tag="photo5" />
												(780x500)
											</div>
										</div>
										<div class="control-group">
											<label for="photo6" class="control-label">图6</label>
											<div class="controls">
												<input type="text" name="photo6" id="photo6" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $product->photo6 ); ?>">
												<input type="button" value="上传" class="upload_btn" tag="photo6" />
												(780x500)
											</div>
										</div>
										<div class="control-group">
											<label for="photo7" class="control-label">图7</label>
											<div class="controls">
												<input type="text" name="photo7" id="photo7" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $product->photo7 ); ?>">
												<input type="button" value="上传" class="upload_btn" tag="photo7" />
												(780x500)
											</div>
										</div>
										<div class="control-group">
											<label for="photo8" class="control-label">图8</label>
											<div class="controls">
												<input type="text" name="photo8" id="photo8" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $product->photo8 ); ?>">
												<input type="button" value="上传" class="upload_btn" tag="photo8" />
												(780x500)
											</div>
										</div>
										<div class="control-group">
											<label for="photo9" class="control-label">图9</label>
											<div class="controls">
												<input type="text" name="photo9" id="photo9" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $product->photo9 ); ?>">
												<input type="button" value="上传" class="upload_btn" tag="photo9" />
												(780x500)
											</div>
										</div>
										<div class="control-group">
											<label for="photo10" class="control-label">图10</label>
											<div class="controls">
												<input type="text" name="photo10" id="photo10" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $product->photo10 ); ?>">
												<input type="button" value="上传" class="upload_btn" tag="photo10" />
												(780x500)
											</div>
										</div>
										<div class="control-group">
											<label for="title_image" class="control-label">标题图</label>
											<div class="controls">
												<input type="text" name="title_image" id="title_image" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $product->titleImage ); ?>">
												<input type="button" value="上传" class="upload_btn" tag="title_image" />
												(275x180)
											</div>
										</div>
										<div class="control-group">
											<label for="destination" class="control-label">目的地</label>
											<div class="controls">
												<input type="text" name="destination" id="destination" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $product->destination ); ?>">
											</div>
										</div>

										<div class="control-group">
											<label for="intro" class="control-label">项目介绍</label>
											<div class="controls">
												<textarea name="intro" id="intro" rows="5" class="input-block-level"><?php echo htmlspecialchars( $product->intro ); ?></textarea>
											</div>
										</div>
										<div class="control-group">
											<label for="description" class="control-label">行程描述</label>
											<div class="controls">
												<textarea name="description" id="description" rows="5" class="input-block-level"><?php echo htmlspecialchars( $product->description ); ?></textarea>
											</div>
										</div>
										<div class="control-group">
											<label for="price_desc" class="control-label">费用说明</label>
											<div class="controls">
												<textarea name="price_desc" id="price_desc" rows="5" class="input-block-level"><?php echo htmlspecialchars( $product->price_desc ); ?></textarea>
											</div>
										</div>
									</div>
									<div class="span6">
										<div class="control-group">
											<label for="color" class="control-label">价钱</label>
											<div class="controls">
												<input type="text" name="price" id="price" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $product->price ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="duration" class="control-label">出行天数</label>
											<div class="controls" id="subcat_con">
												<input type="text" name="duration" id="duration" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $product->duration ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="photo_text1" class="control-label">图1标题</label>
											<div class="controls">
												<input type="text" name="photo_text1" id="photo_text1" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $product->photoText1 ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="photo_text2" class="control-label">图2标题</label>
											<div class="controls">
												<input type="text" name="photo_text2" id="photo_text2" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $product->photoText2 ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="photo_text3" class="control-label">图3标题</label>
											<div class="controls">
												<input type="text" name="photo_text3" id="photo_text3" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $product->photoText3 ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="photo_text4" class="control-label">图4标题</label>
											<div class="controls">
												<input type="text" name="photo_text4" id="photo_text4" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $product->photoText4 ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="photo_text5" class="control-label">图5标题</label>
											<div class="controls">
												<input type="text" name="photo_text5" id="photo_text5" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $product->photoText5 ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="photo_text6" class="control-label">图6标题</label>
											<div class="controls">
												<input type="text" name="photo_text6" id="photo_text6" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $product->photoText6 ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="photo_text7" class="control-label">图7标题</label>
											<div class="controls">
												<input type="text" name="photo_text7" id="photo_text7" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $product->photoText7 ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="photo_text8" class="control-label">图8标题</label>
											<div class="controls">
												<input type="text" name="photo_text8" id="photo_text8" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $product->photoText8 ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="photo_text9" class="control-label">图9标题</label>
											<div class="controls">
												<input type="text" name="photo_text9" id="photo_text9" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $product->photoText9 ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="photo_text10" class="control-label">图10标题</label>
											<div class="controls">
												<input type="text" name="photo_text10" id="photo_text10" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $product->photoText10 ); ?>">
											</div>
										</div>
















										<div class="control-group">
											<label for="runner" class="control-label">活动运营商</label>
											<div class="controls" id="subcat_con">
												<input type="text" name="runner" id="runner" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $product->runner ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="people" class="control-label">适应人群</label>
											<div class="controls">
												<input type="text" name="people" id="people" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $product->people ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="hide" class="control-label"></label>
											<label class='checkbox'>
												<input type="checkbox" name="hide" id="hide" <?php if ( $product->hide ) echo 'checked="checked"'; ?> value="1"> 隐藏
											</label>
										</div>
									</div>

									<div class="span12">
										<div class="form-actions">
											<button type="submit" class="btn btn-primary">保存</button>
											<input type="hidden" name="id" value="<?php echo $product->id; ?>">
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
