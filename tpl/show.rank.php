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
    <link rel="stylesheet" type="text/css" href="css/chunk-214bbc02.ca038a8e.css">
</head>
<body>

<div id="app">
	<div data-v-b0a8ade8="" class="container">

		<?php include ROOT . '/tpl/show.nav.php'; ?>

		<section data-v-2f71c6c3="" class="tags_box">
			<div data-v-2f71c6c3="" class="tags">
			</div>
		</section>

		<section class="list_rank">
		    <?php
		    foreach ( $data as $k => $d )
		    {
		        ?>
		        <div class="list_item"><span class="number"><?php echo $k + 1; ?></span>
		            <div class="image"><img
		                        src="<?php echo htmlspecialchars( $d['image' ] ); ?>">
		            </div>
		            <div class="info"><p class="title"><?php echo htmlspecialchars( $d['name' ] ); ?></p>
		                <p>编号：<span><?php echo htmlspecialchars( $d['id' ] ); ?></span></p>
		                <p>票数：<span><?php echo htmlspecialchars( $d['count' ] ); ?></span></p></div>
		        </div>
		    <?php
		    }
		    ?>

		</section>

        <?php include ROOT . '/tpl/show.tabbar.php'; ?>

	</div>
</div>

<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/site.js"></script>


<script>
    $(function (){

        switch_tabbar_item(<?php echo $tabbar_index; ?>)

        bind_tabbar_switching_event();

	    let option_cat_list = <?php echo json_encode( $option_cat_list ); ?>;
        $.each(option_cat_list, function (i, v) {
            add_tab_item( v['id' ], v['title'], <?php echo $code; ?> );
        });

        $('.tags').on('click', '.tags-item', function(){
            window.location = './?module=show.rank&code=' + $(this).data('id');
        });
    });


    function add_tab_item(id, title, selected) {
        let c = id == selected ? 'active' : '';
        $('.tags').append(`<div data-v-2f71c6c3="" data-id="${id}" class="tags-item ${c}">${title}</div>`);
    }



</script>
</body>
</html>