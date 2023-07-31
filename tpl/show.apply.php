<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
	<link rel="icon" href="favicon.ico">
	<title><?php echo htmlspecialchars( $poll->title ); ?></title>
	<meta name="description" content="快来秀出你的才艺吧！">
	<link href="css/chunk-vendors.css" rel="stylesheet">
	<link href="css/app.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/chunk.css">
	<link rel="stylesheet" type="text/css" href="css/chunk-71ab03ce.6f891a93.css">
	<link rel="stylesheet" type="text/css" href="css/chunk-27ffe534.55feed27.css">
</head>
<body>

<div id="app">
	<div data-v-2f71c6c3="" class="container">

		<?php include ROOT . '/tpl/show.nav.php'; ?>

		<section data-v-6a2460cd="" class="tab">
			<div data-v-6a2460cd="">
				<div data-v-6a2460cd="" class="smart_button smart_button_default t1" style="width: 5rem; text-align: center;">居民</div>
				<div data-v-6a2460cd="" class="smart_button smart_button_default t2" style="width: 5rem; text-align: center;">单位</div>
			</div>
			<form data-v-6a2460cd="" id="f" action="./?module=show.apply.submit" method="post">
				<div data-v-6a2460cd="" class="field"><span data-v-6a2460cd="">参赛项目</span>
					<div data-v-6a2460cd="">
						<div data-v-b893a73a="" data-v-6a2460cd="" style="width: 100%;">
							<div data-v-b893a73a="" class="picker">
								<div data-v-6a2460cd="" class="smart_field" data-v-b893a73a="" style="">
									<select name="optionCat" id="option_cat">
										<option value="0">请选择参赛项目</option>
										<?php
										foreach ( $optionCatList as $oc )
										{
											?>
											<option value="<?php echo $oc[ 'id' ]; ?>"><?php echo htmlspecialchars( $oc[ 'title' ] ); ?></option>
											<?php
										}
										?>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div data-v-6a2460cd="" class="field" id="f1_1"><span data-v-6a2460cd="">所属街道</span>
					<div data-v-6a2460cd="">
						<div data-v-b893a73a="" data-v-6a2460cd="" style="width: 100%;">
							<div data-v-b893a73a="" class="picker">
								<div data-v-6a2460cd="" class="smart_field" data-v-b893a73a="">
									<select name="street" id="street">
										<option value="">请选择所属街道</option>
										<?php
										foreach ( $streetList as $oc )
										{
											?>
											<option value="<?php echo htmlspecialchars( $oc ); ?>"><?php echo htmlspecialchars( $oc ); ?></option>
											<?php
										}
										?>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div data-v-6a2460cd="" class="field" id="f1_2"><span data-v-6a2460cd="">单位名称</span>
					<div data-v-6a2460cd="">
						<div data-v-b893a73a="" data-v-6a2460cd="" style="width: 100%;">
							<div data-v-b893a73a="" class="picker">
								<div data-v-6a2460cd="" class="smart_field" data-v-b893a73a=""
										style="">
									<input name="orgName" id="orgName" placeholder="请输入名称">
								</div>
							</div>
						</div>
					</div>
				</div>


				<!---->
				<div data-v-6a2460cd="" class="field type"><span data-v-6a2460cd="">团队/个人</span>
					<div data-v-6a2460cd="" style="display: flex; justify-content: space-around;">
						<label data-v-6a2460cd="">
							<input type="radio" name="type2" value="团队" checked> 团队
						</label>
						<label data-v-6a2460cd="">
							<input type="radio" name="type2" value="个人"> 个人
						</label>
					</div>
				</div>
				<div data-v-6a2460cd="" class="field"><span data-v-6a2460cd="" id="n">团队名称</span>
					<div data-v-6a2460cd="">
						<div data-v-6a2460cd="" class="smart_field"><input type="text" name="name" placeholder="请输入名称"
									class="smart_input smart_placeholder"></div>
					</div>
				</div>
				<div data-v-6a2460cd="" class="field"><span data-v-6a2460cd="" id="tel">领队电话</span>
					<div data-v-6a2460cd="">
						<div data-v-6a2460cd="" class="smart_field"><input type="number" name="phone" placeholder="请输入手机号"
									class="smart_input smart_placeholder"></div>
					</div>
				</div>
				<div data-v-6a2460cd="" class="field"><span data-v-6a2460cd="">作品名</span>
					<div data-v-6a2460cd="">
						<div data-v-6a2460cd="" class="smart_field"><input type="text" placeholder="请输入作品名" name="title" id="title"
									class="smart_input smart_placeholder"></div>
					</div>
				</div>
				<div data-v-6a2460cd="" class="field"><span data-v-6a2460cd="">简介</span>
					<div data-v-6a2460cd="">
						<div data-v-6a2460cd="" class="smart_field"><textarea placeholder="200字以内团队、个人或者作品介绍" rows="5"
									class="smart_placeholder smart_textarea" name="summary"></textarea>
						</div>
					</div>
				</div>

				<div data-v-6a2460cd="" class="field" style="flex-wrap: wrap;" id="video">
		            <span data-v-6a2460cd="">作品提交</span>
					<p data-v-6a2460cd="" style="width: 100%;">视频（请自行压缩至500M以内）</p>
					<div class="upload">
						<div>
							<button type="button" id="u" class="el-button">上传视频</button>
							<input type="file" id="fileUpload" style="display: none;" accept="video/mp4">
							<span ><i id="status"></i></span>
							<span class="progress" style="display: none;">上传进度: <i id="auth-progress">0</i> %</span>
						</div>
					</div>
		            <div id="video-preview" style="display: none;">
		                <video style="width: 100%" controls>
		                    <source>
		                </video>
		                <a class="el-button">删除重新上传</a>
		            </div>
				</div>

		        <div data-v-6a2460cd="" class="field" style="flex-wrap: wrap; display: none;" id="photo">
		            <span data-v-6a2460cd="">作品提交</span>
		            <p data-v-6a2460cd="" style="width: 100%;">照片（最多10张）</p>
		            <div class="upload">
		                <div>
		                    <button type="button" id="u" class="el-button">上传照片</button>
		                    <input type="file" id="picUpload" style="display: none;" accept="image/*">
		                </div>
		            </div>
		            <div id="photo-preview"></div>
		        </div>


		        <div data-v-6a2460cd="" id="s" class="smart_button smart_button_default  smart_button_main"
						style="width: 100%; text-align: center;">提交
				</div>
				<input type="hidden" name="content" id="content">
				<input type="hidden" name="type1" id="type1">
				<input type="hidden" name="image" id="image">
				<input type="hidden" name="pollId" value="<?php echo $id; ?>">
			</form>

		</section>
		<?php include ROOT . '/tpl/show.tabbar.php'; ?>

	</div>
</div>



<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/jquery.form.js"></script>
<script src="js/site.js"></script>
<script src="./js/aliyun-upload-sdk-1.5.3.min.js"></script>
<script src="./js/lib/es6-promise.min.js"></script>
<script src="./js/lib/aliyun-oss-sdk-6.17.1.min.js"></script>

<script>
    const tabbar_index = <?php echo $tabbar_index; ?>
</script>

<script src="js/show.apply.js"></script>

</body>
</html>