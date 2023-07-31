<?php





$extra_header = <<<EOF

    <link href="lib/umeditor1_2_3-utf8-php/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">

EOF;

$extra_footer = <<<EOF

    <script type="text/javascript" charset="utf-8" src="lib/umeditor1_2_3-utf8-php/umeditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="lib/umeditor1_2_3-utf8-php/umeditor.min.js"></script>
    <script type="text/javascript" src="lib/umeditor1_2_3-utf8-php/lang/zh-cn/zh-cn.js"></script>

EOF;


include ROOT . '/tpl/admin.header.php';

?>

<div class="container-fluid" id="content">
		<div id="main">

				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i>内容编辑</h3>
							</div>
							<div class="box-content nopadding">
								<form action="#" method="POST" class='form-horizontal form-column'>
									<div class="span6">
										<div class="control-group">
											<label for="title" class="control-label">内容标题</label>
											<div class="controls">
												<input type="text" name="title" id="title" placeholder="" class="input-xlarge" style="width: 560px;" value="<?php echo htmlspecialchars( $news->title ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="postdate" class="control-label">添加日期</label>
											<div class="controls">
												<input type="text" name="postDate" id="postDate" placeholder="日期格式: <?php echo date('Y-m-d H:i:s'); ?>" class="input-xlarge" value="<?php echo htmlspecialchars( $news->postDate ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="editor" class="control-label">编辑</label>
											<div class="controls">
												<input type="text" name="editor" id="editor" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $news->editor ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="source" class="control-label">来源</label>
											<div class="controls">
												<input type="text" name="source" id="source" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $news->source ); ?>">
											</div>
										</div>
										<div class="control-group">
											<label for="order" class="control-label">显示顺序</label>
											<div class="controls">
												<input type="text" name="order" id="order" placeholder="默认255，顺序相同按时间倒序。" class="input-xlarge" value="<?php echo htmlspecialchars( $news->order ); ?>">越小越靠前
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">位置控制</label>
											<div class="controls">
												<label class='checkbox'>
													<input type="checkbox" name="top" <?php if ( $news->top ) echo 'checked="checked"'; ?> value="1"> 推荐
												</label>
												<!--
												<label class='checkbox'>
													<input type="checkbox" name="hide" <?php if ( $news->hide ) echo 'checked="checked"'; ?> value="1"> 隐藏
												</label>
												-->
											</div>
										</div>
										<div class="control-group">
											<label for="summary" class="control-label">简介</label>
											<div class="controls">
												<textarea name="summary" id="summary" rows="5" class="input-block-level"><?php echo htmlspecialchars( $news->summary ); ?></textarea>
											</div>
										</div>
										<div class="control-group">
											<label for="content" class="control-label">内容</label>
											<div class="controls">
												<script type="text/plain" id="text_content" name="content" style="width: 200%;"><?php echo $news->content; ?></script>
											</div>
										</div>
									</div>
									<div class="span6">
										<div class="control-group">
											<label for="cat" class="control-label">分类</label>
											<div class="controls">
												<select name="cat" id="cat" class="input-large">
<?php
foreach ( $catList->list as $entry )
{
?>
													<option value="<?php echo $entry->id; ?>" <?php if ( $entry->id == $news->cat || $entry->id == $cat ) echo 'selected="selected"'?>><?php echo htmlspecialchars( $entry->name ); ?></option>
<?php
}
?>
												</select>
											</div>
										</div>
										<div class="control-group">
											<label for="cat2" class="control-label">第二分类</label>
											<div class="controls">
												<select name="cat2" id="cat2" class="input-large">
<?php
foreach ( $catList->list as $entry )
{
?>
													<option value="<?php echo $entry->id; ?>" <?php if ( $entry->id == $news->cat2 ) echo 'selected="selected"'?>><?php echo htmlspecialchars( $entry->name ); ?></option>
<?php
}
?>
												</select>
											</div>
										</div>
										<div class="control-group">
											<label for="redirect_url" class="control-label">转向地址</label>
											<div class="controls">
												<input type="text" name="redirectUrl" id="redirectUrl" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $news->redirectUrl ); ?>">
											</div>
										</div>
										<!--
										<div class="control-group">
											<label for="read" class="control-label">访问次数</label>
											<div class="controls">
												<input type="text" name="read" id="read" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $news->read ); ?>">
											</div>
										</div>
										-->
										<div class="control-group">
											<label for="titleImage" class="control-label">标题图</label>
											<div class="controls">
												<input type="text" name="titleImage" id="titleImage" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $news->titleImage ); ?>">
												<input type="button" value="上传" id="upload_btn" />

											</div>
										</div>
										<div class="control-group">
											<label for="videoPoster" class="control-label">视频海报</label>
											<div class="controls">
												<input type="text" name="videoPoster" id="videoPoster" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $news->videoPoster ); ?>">
												<input type="button" value="上传" id="upload_videoPoster_btn" />

											</div>
										</div>
										<div class="control-group">
											<label for="video" class="control-label">视频</label>
											<div class="controls">
												<input type="text" name="video" id="video" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $news->video ); ?>">
												<input type="button" value="上传" id="upload_video_btn" />
												(mp4格式)
											</div>
										</div>
										<div class="control-group">
											<label for="pdf" class="control-label">pdf</label>
											<div class="controls">
												<input type="text" name="pdf" id="pdf" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $news->pdf ); ?>">
												<input type="button" value="上传" id="upload_pdf_btn" />
											</div>
										</div>
									</div>
									<div class="span12">
										<div class="form-actions">
											<button type="submit" class="btn btn-primary">保存</button>
											<input type="hidden" name="id" value="<?php echo $news->id; ?>">
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

<form action="lib/umeditor1_2_3-utf8-php/php/imageUp.php?type=ajax" style="display: none;" id="file_formVideoPoster" method="post" enctype="multipart/form-data">
	<input type="file" name="upfile" id="upfileVideoPoster" accept=".jpg,.jpeg,.png,.gif,.bmp" />
</form>

<form action="lib/umeditor1_2_3-utf8-php/php/imageUp.php?type=ajax" style="display: none;" id="file_formVideo" method="post" enctype="multipart/form-data">
	<input type="file" name="upfile" id="upfileVideo" accept=".mp4" />
</form>

<form action="lib/umeditor1_2_3-utf8-php/php/imageUp.php?type=ajax" style="display: none;" id="file_formPDF" method="post" enctype="multipart/form-data">
	<input type="file" name="upfile" id="upfilePDF" accept=".pdf" />
</form>

<textarea name="content" id="plain-content" style="width: 200%; height: 20em; display: none;"><?php echo htmlspecialchars( $news->content ); ?></textarea>

<?php include ROOT . '/tpl/admin.footer.script.php'; ?>

<script type="text/javascript">
/*
function change_subcat( cat )
{
	$('#subcat_con').load('./?module=admin.news.cat.list&id='+cat+'&output=select');
}
*/
$(function(){

	plain_text_cats = <?php echo json_encode( $plain_text_editor_cats ); ?>;
	use_richtext = true;

	cat = <?php echo $cat ? $cat : $news->cat; ?>;
	if ( plain_text_cats.includes( cat ) )
	{
		$('#text_content').replaceWith( $('#plain-content') );
		$( '#plain-content' ).show();
	}
	else
	{
		$('#plain-content').remove();
		UM.getEditor('text_content');
	}


/*
	change_subcat($('#cat').fieldValue());
	$('#cat').change(function(){
		change_subcat($('#cat').fieldValue());
	});
*/
	$('#upfile').change(function(){
		if ($('#upfile').fieldValue()) {
			$('#file_form').ajaxSubmit({
				dataType:	'json',
				clearForm:	true,
				success:	function(data){
					if (data.state == 'SUCCESS') {
						$('#titleImage').val(realpath(data.url));
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

	$('#upfileVideoPoster').change(function(){
		if ($('#upfileVideoPoster').fieldValue()) {
			$('#file_formVideoPoster').ajaxSubmit({
				dataType:	'json',
				clearForm:	true,
				success:	function(data){
					if (data.state == 'SUCCESS') {
						$('#videoPoster').val(realpath(data.url));
					} else {
						alert('照片上传出错');
					}
				}
			});
		}
	});

	$('#upload_videoPoster_btn').click(function(){
		$('#upfileVideoPoster').click();
	});

	$('#upfileVideo').change(function(){
		if ($('#upfileVideo').fieldValue()) {
			$('#file_formVideo').ajaxSubmit({
				dataType:	'json',
				clearForm:	true,
				success:	function(data){
					if (data.state == 'SUCCESS') {
						$('#video').val(realpath(data.url));
					} else {
						alert('视频上传出错');
					}
				}
			});
		}
	});

	$('#upload_video_btn').click(function(){
		$('#upfileVideo').click();
	});

	$('#upfilePDF').change(function(){
		if ($('#upfilePDF').fieldValue()) {
			$('#file_formPDF').ajaxSubmit({
				dataType:	'json',
				clearForm:	true,
				success:	function(data){
					if (data.state == 'SUCCESS') {
						$('#pdf').val(realpath(data.url));
					} else {
						alert('pdf上传出错');
					}
				}
			});
		}
	});

	$('#upload_pdf_btn').click(function(){
		$('#upfilePDF').click();
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
