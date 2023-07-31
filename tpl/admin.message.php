<!doctype html>
<html>
<head>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />


	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="css/themes.css">


	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>

	<!-- Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png" />

</head>

<body class='error'>
	<div class="wrapper">
		<div class="desc"><?php echo $message; ?></div>
<?php
if ( $return_to )
{
?>
		<div class="buttons">
			<div class="pull-left"><a href="<?php echo htmlspecialchars( $return_to ); ?>" class="btn"><i class="icon-arrow-left"></i>返回</a></div>
		</div>
<?php
	if ( !defined( 'DEBUG' ) )
	{
?>
		<script>
			setTimeout(function(){
				window.close();
				window.location = <?php echo json_encode( $return_to ); ?>;
				},
				<?php echo $timeout; ?>000
			);
		</script>
<?php
	}
}
?>
	</div>

</body>

</html>
