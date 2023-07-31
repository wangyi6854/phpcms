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
								<h3><i class="icon-list"></i>投票选项编辑</h3>
							</div>
							<div class="box-content nopadding">
								<form action="#" method="POST" class='form-horizontal form-column'>
									<div class="span12">
                                        <div class="control-group">
                                            <label for="title" class="control-label">名称</label>
                                            <div class="controls">
                                                <input type="text" name="title" id="title" placeholder="" class="input-xlarge" style="width: 560px;" value="<?php echo htmlspecialchars( $news->title ); ?>">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="optionCat" class="control-label">分类</label>
                                            <div class="controls">
                                                <select name="optionCat" id="optionCat" class="input-large">
                                                    <?php
                                                    foreach ( $optioncat_list as $entry )
                                                    {
                                                        ?>
                                                        <option value="<?php echo $entry[ 'id' ]; ?>" <?php if ( $entry[ 'id' ] == $news->optionCat ) echo 'selected="selected"'?>><?php echo htmlspecialchars( $entry[ 'title' ] ); ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="type1" class="control-label">居民/单位</label>
                                            <div class="controls">
                                                <select name="type1" id="type1" class="input-large">
													<?php
													foreach ( $type1_list as $entry )
													{
														?>
                                                        <option value="<?php echo $entry; ?>" <?php if ( $entry == $news->type1 ) echo 'selected="selected"'?>><?php echo htmlspecialchars( $entry ); ?></option>
														<?php
													}
													?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="type2" class="control-label">团队/个人</label>
                                            <div class="controls">
                                                <select name="type2" id="type2" class="input-large">
													<?php
													foreach ( $type2_list as $entry )
													{
														?>
                                                        <option value="<?php echo $entry; ?>" <?php if ( $entry == $news->type2 ) echo 'selected="selected"'?>><?php echo htmlspecialchars( $entry ); ?></option>
														<?php
													}
													?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="street" class="control-label">街道</label>
                                            <div class="controls">
                                                <select name="street" id="street" class="input-large">
                                                    <option value=""></option>
													<?php
													foreach ( $street_list as $entry )
													{
														?>
                                                        <option value="<?php echo $entry; ?>" <?php if ( $entry == $news->street ) echo 'selected="selected"'?>><?php echo htmlspecialchars( $entry ); ?></option>
														<?php
													}
													?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label for="orgName" class="control-label">单位名称</label>
                                            <div class="controls">
                                                <input type="text" name="orgName" id="orgName" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $news->orgName ); ?>">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="name" class="control-label">团队/个人姓名</label>
                                            <div class="controls">
                                                <input type="text" name="name" id="name" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $news->name ); ?>">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="phone" class="control-label">团队/个人电话</label>
                                            <div class="controls">
                                                <input type="text" name="phone" id="phone" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $news->phone ); ?>">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label for="status" class="control-label">状态</label>
                                            <div class="controls">
                                                <label><input type="radio" name="status" value="未审核" <?php echo $news->status == '未审核' ? 'checked' : ''; ?>>未审核</label>
                                                <label><input type="radio" name="status" value="通过" <?php echo $news->status == '通过' ? 'checked' : ''; ?>>通过</label>
                                                <label><input type="radio" name="status" value="未通过" <?php echo $news->status == '未通过' ? 'checked' : ''; ?>>未通过</label>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label for="summary" class="control-label">简介</label>
                                            <div class="controls">
                                                <textarea name="summary"><?php echo htmlspecialchars($news->summary); ?></textarea>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label for="content" class="control-label">内容</label>
                                            <div class="controls">
                                                <textarea name="content"><?php echo htmlspecialchars($news->content); ?></textarea>
                                            </div>
                                        </div>

										<div class="control-group">
											<label for="image" class="control-label">标题图</label>
											<div class="controls">
												<input type="text" name="image" id="image" placeholder="" class="input-xlarge" value="<?php echo htmlspecialchars( $news->image ); ?>">
												<input type="button" value="上传" id="upload_btn" />

											</div>
										</div>
                                        <!--
										<div class="control-group">
											<label for="video" class="control-label">视频</label>
											<div class="controls">
												<input type="text" name="video" id="video" placeholder="" class="input-xlarge" value="<?php //echo htmlspecialchars( $news->video ); ?>">
												<input type="button" value="上传" id="upload_video_btn" />
												(mp4格式)
											</div>
										</div>
										<div class="control-group">
											<label for="pdf" class="control-label">pdf</label>
											<div class="controls">
												<input type="text" name="pdf" id="pdf" placeholder="" class="input-xlarge" value="<?php //echo htmlspecialchars( $news->pdf ); ?>">
												<input type="button" value="上传" id="upload_pdf_btn" />
											</div>
										</div>
										-->

                                    </div>
									<div class="span12">
										<div class="form-actions">
											<button type="submit" class="btn btn-primary">保存</button>
                                            <input type="hidden" name="id" value="<?php echo $news->id; ?>">
                                            <input type="hidden" name="pollId" value="<?php echo $news->pollId; ?>">
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

	//use_richtext = true;

		//$('#plain-content').remove();
		//UM.getEditor('text_content');


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
						$('#image').val(realpath(data.url));
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

    $('#change_show_end_time').click(function (){
        $('#showEnd').val(get_current_datatime());
        return false;
    });
});

function get_current_datatime(){
    var currentdate = new Date();
    var datetime = currentdate.getFullYear() + "-"
        + (currentdate.getMonth()+1)  + "-"
        + currentdate.getDate()  + " "
        + currentdate.getHours() + ":"
        + currentdate.getMinutes() + ":"
        + currentdate.getSeconds();
    return datetime;
}

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
