<!doctype html>
<html>
<head>
	<meta charset="utf8">
	<meta http-equiv="X-UA-Compatible" content="IE=9" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />

	<title><?php echo $page_title; ?></title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
	<!-- jQuery UI -->
	<link rel="stylesheet" href="css/plugins/jquery-ui/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="css/plugins/jquery-ui/smoothness/jquery.ui.theme.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="css/themes.css">
	<link rel="stylesheet" href="css/main.css">

	<!-- Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png" />

	<?php echo $extra_header; ?>

</head>

<body>
	<div id="navigation">
		<div class="container-fluid">
			<a href="./" id="brand"><?php echo $config['site_name']; ?>管理</a>
			<ul class='main-nav'>
				<li id="nav-index">
					<a href="./">
						<i class="icon-home"></i>
						<span>管理首页</span>
					</a>
				</li>
				<li id="nav-news">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<i class="icon-edit"></i>
						<span>新闻</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li class='active'>
							<a href="./?module=admin.news.list">新闻管理</a>
						</li>
						<li>
							<a href="./?module=admin.news.cat.list">新闻分类管理</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="./?module=admin.people.list">
						<i class="icon-home"></i>
						<span>失信人员/组织管理</span>
					</a>
				</li>
				<li>
					<a href="./?module=admin.csgg.list">
						<i class="icon-home"></i>
						<span>催收公告管理</span>
					</a>
				</li>
				<li>
					<a href="./?module=admin.jubao.list">
						<i class="icon-home"></i>
						<span>举报管理</span>
					</a>
				</li>
				<li>
					<a href="./?module=admin.jiandu.list">
						<i class="icon-home"></i>
						<span>监督管理</span>
					</a>
				</li>
				<li>
					<a href="./?module=admin.bank.list">
						<i class="icon-home"></i>
						<span>银行管理</span>
					</a>
				</li>
				<li>
					<a href="./?module=admin.court.list">
						<i class="icon-home"></i>
						<span>法院管理</span>
					</a>
				</li>
				<li>
					<a href="./?module=admin.slide.list">
						<i class="icon-home"></i>
						<span>首页轮播</span>
					</a>
				</li>
			</ul>
			<div class="user">
				<div class="dropdown">
					<a href="../" target="_blank"><?php echo $config['site_name']; ?>首页</a>
				</div>
				<div class="dropdown">
					<a href="#" class='dropdown-toggle' data-toggle="dropdown"><?php echo $_SESSION[ 'username' ]; ?></a>
					<ul class="dropdown-menu pull-right">
						<li>
							<a href="./?module=admin.password.modify">修改密码</a>
						</li>
						<li>
							<a href="./?module=admin.logout">安全退出</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
