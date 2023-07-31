<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
	<link rel="icon" href="favicon.ico">
	<title><?php echo htmlspecialchars( $poll->title ); ?></title>
	<meta name="description" content="快来秀出你的才艺吧！">
	<link rel="stylesheet" href="css/base.css">
	<link href="css/chunk-vendors.fb20c13b.css" rel="stylesheet">
	<link href="css/app.311fc69e.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/chunk-4c28ea1c.98cde95f.css">
</head>
<body>

<div id="app">
	<div data-v-b0a8ade8="" class="container">

		<?php include ROOT . '/tpl/show.nav.php'; ?>

		<section data-v-b0a8ade8="" class="body">
			<p data-v-b0a8ade8="">
				姓名：<span data-v-b0a8ade8=""><?php echo htmlspecialchars( $poll_option->name ); ?></span>
			</p>
			<p data-v-b0a8ade8="">
				作品名：<span data-v-b0a8ade8=""><?php echo htmlspecialchars( $poll_option->title ); ?></span>
			</p>
			<p data-v-b0a8ade8="">
				作品编号：<span data-v-b0a8ade8=""><?php echo htmlspecialchars( $poll_option->id ); ?></span>
			</p>
			<p data-v-b0a8ade8="" class="flex">
				票数：<span data-v-b0a8ade8=""><?php echo htmlspecialchars( $poll_option->count ); ?></span>
			</p>
			<p data-v-b0a8ade8="">
				作品描述：</p>
			<p data-v-b0a8ade8="" style="font-size: 0.8rem; color: rgb(0, 64, 111);"><?php echo htmlspecialchars( $poll_option->summary ); ?></p>
			<p data-v-b0a8ade8="">
				作品展示：</p>
			<!---->
			<?php
			$video_width = $video_height = 1;

			foreach ( $video as $v )
			{
				$video_width = $v[ 'width' ];
				$video_height = $v[ 'height' ];
				?>
				<video data-v-b0a8ade8="" src="<?php echo htmlspecialchars( $v[ 'src' ] ); ?>" poster="<?php echo htmlspecialchars( $v[ 'poster' ] ); ?>" controls="controls" width="100%" height="200px"></video>
				<?php
			}
			foreach ( $photo as $p )
			{
				?>
				<p data-v-b0a8ade8="">
					<div data-v-b0a8ade8="" class="smart_image" style="width: 100%; height: 8rem; border: 1px solid rgb(25, 118, 210);">
						<img src="<?php
						echo htmlspecialchars( $p[ 'src' ] ); ?>" alt="" style="object-fit: cover;"><!---->
					</div>
				</p>
				<?php
			}
			?>
		</section>
		<?php include ROOT . '/tpl/show.tabbar.php'; ?>
	</div>
</div>
<!---->
<!---->
<div data-v-ce23dd8e="" class="message"></div>
<!---->



<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/site.js"></script>

<script>

    $(function (){
        switch_tabbar_item(<?php echo $tabbar_index; ?>);
        bind_tabbar_switching_event();

        const video_width = <?php echo $video_width; ?>;
        const video_height = <?php echo $video_height; ?>;

        var video = $('video');
        video.height(Math.round( video.width() * video_height / video_width ));
    });

</script>

</body>
</html>