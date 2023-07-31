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
</head>
<body>

<div id="app">
	<div data-v-b0a8ade8="" class="container">

		<?php include ROOT . '/tpl/show.nav.php'; ?>

        <p data-v-2f71c6c3=""
           style="padding: 0.1rem 1rem; line-height: 1.8; color: rgb(102, 102, 102); font-size: 0.7rem; text-indent: 2em;"><?php echo htmlspecialchars( $poll->summary ); ?></p>
        <section data-v-2f71c6c3="" class="search"><span data-v-2f71c6c3=""></span><input data-v-2f71c6c3="" type="text" id="keyword"
                                                                                          placeholder="请输入作品编号或姓名进行查询">
            <div data-v-2f71c6c3="" class="smart_button smart_button_default  smart_button_main" id="s"
                 style="margin-left: 10px; height: 1.7rem; line-height: 1.7rem; background: rgb(4, 148, 255) none repeat scroll 0% 0%; border: medium none;">
                搜索
            </div>
        </section>
        <section data-v-2f71c6c3="" class="tags_box">
            <div data-v-2f71c6c3="" class="tags">
            </div>
        </section>
        <section data-v-2f71c6c3="" class="list">
        </section>
        <div data-v-2f71c6c3="" id="btn" class="submit"></div>

        <?php include ROOT . '/tpl/show.tabbar.php'; ?>
	</div>
</div>

<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/site.js"></script>
<script>
    var current_tab_id = '';
    var list = [];
    $(function (){

        switch_tabbar_item(<?php echo $tabbar_index; ?>)

        bind_tabbar_switching_event();

        $.get('./?module=show.list.data&poll_id=<?php echo $id; ?>', function( data ) {
            list = data.data;

            $.each( list, function(i, v){
                add_tab_item( v['catId' ], v['catTitle'] );
            });

            $('.tags-item:first').click();
        });

        $('.tags').on('click', '.tags-item', function(){
            $('.tags-item').removeClass('active');
            $(this).addClass('active');

            add_tab_list(select_list_by_optionCat(list, $(this).data('id')));
        });

        $('.list').on('click', '.btn_vote', function(){
            window.location = './?module=show.detail&id='+$(this).data('id');
        });

        $('.list').on('click', '.list_item', function(){
            if ( $('.checkbox', this).hasClass('is_checked')) {
                $('.checkbox', this).removeClass('is_checked');
            }
            else {
                if ($('.is_checked').length < 5) {
                    $('.checkbox', this).addClass('is_checked');
                }
                else {
                    alert('每人最多投5票');
                }
            }
        });

        $('#s').click(function(){
            let keyword = $('#keyword').val();

            if ( keyword ) {
                if ( parseInt( keyword ) ) {
                    add_tab_list(search_by_id( keyword));
                }
                else {
                    add_tab_list(search_by_name( keyword));
                }
            }
        });

        $('#btn').click(function(){
            var votes = [];

            $('.is_checked').each(function(){
                votes.push($(this).data('id'));
            });

            if ( votes.length ) {
                $.get("./?module=show.vote&votes="+encodeURIComponent(votes.join(',')), function (data) {
                    alert(data.data);
                });
            }
        });
    });


    function add_tab_item(id, title) {
        $('.tags').append('<div data-v-2f71c6c3="" data-id="'+id+'" class="tags-item">'+title+'</div>');
    }

    function add_tab_list(data) {
        clear_list();

        $.each(data, function(ii, vv){
            add_list_item(vv);
        });
    }

    function select_list_by_optionCat(data, optionCat) {
        var r = [];

        $.each(data, function(i, v) {
            if ( v[ 'catId' ] == optionCat ) {
                r = v[ 'list' ];
            }
        });

        return r;
    }

    function add_list_item(data) {
        var html = `
            <div data-v-2f71c6c3="" class="list_item"><label data-v-2f71c6c3="" data-id="${data['id']}" class="smart_checkbox checkbox"><span
                            class="smart_checkbox_input"><span class="smart_checkbox_input_inner"></span><input
                                type="checkbox"></span><span class="smart_checkbox_label"></span></label>
                <div data-v-2f71c6c3="" class="image">
                    <img data-v-2f71c6c3="" src="${data['image']}">
                </div>
                <div data-v-2f71c6c3="" class="info"><p data-v-2f71c6c3="">姓名：<span data-v-2f71c6c3="">${data['name']}</span>
                    </p>
                    <p data-v-2f71c6c3="">编号：<span data-v-2f71c6c3="">${data['id']}</span></p>
                    <p data-v-2f71c6c3="">票数：<span data-v-2f71c6c3="">${data['count']}</span></p>
                    <div data-v-2f71c6c3="" data-id="${data['id']}" class="smart_button smart_button_default btn_vote  smart_button_main"
                         style="margin-top: 0.3rem; color: rgb(255, 255, 255); width: 100%; text-align: center;">详情
                    </div>
                </div>
            </div>
        `;
        $('.list').append(html);
    }

    function clear_list() {
        $('.list').empty();
    }

    function search_by_id(id) {
        var r = [];

        $.each(list, function(i,v){
            $.each(v['list'], function(ii,vv){
                if( vv['id'] == id ) {
                    r.push(vv);
                }
            });
        });

        return r;
    }

    function search_by_name(name) {
        var r = [];

        $.each(list, function(i,v){
            $.each(v['list'], function(ii,vv){
                if( vv['name'].includes(name) ) {
                    r.push(vv);
                }
            });
        });

        return r;
    }



</script>
</body>
</html>