<?php

$extra_header = <<<EOF
<link rel="stylesheet" href="./lib/summernote-0.8.18-dist/summernote-bs4.min.css">

EOF;

?>
<?php include ROOT . '/tpl/admin.header.php'; ?>
    <body class="hold-transition sidebar-mini">
<div class="wrapper">

    <?php include ROOT . '/tpl/admin.navbar.php'; ?>

    <?php include ROOT . '/tpl/admin.sidebar.php'; ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">新闻编辑</h3>

                    </div>
                    <!-- /.card-header -->
                    <form method="post">
                    <div class="card-body">


                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">标题</label>
                                    <input type="text" class="form-control" placeholder="" name="title" value="<?php echo $news->title; ?>">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>分类1</label>
                                    <select class="form-control" name="cat">
                                        <option>青岛</option>
                                        <option>山东</option>
                                        <option>国际</option>
                                        <option>娱乐</option>
                                        <option>房产</option>
                                        <option>健康</option>
                                        <option>胶州</option>
                                        <option>黄岛</option>
                                        <option>汽车</option>
                                        <option>人文</option>
                                        <option>历史</option>
                                        <option>经济</option>
                                        <option>股市</option>
                                        <option>短视频</option>
                                        <option>直播</option>
                                        <option>段子</option>
                                    </select>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>分类2</label>
                                    <select class="form-control" name="cat2">

                                    </select>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">转向地址</label>
                                    <input type="text" class="form-control" placeholder="" name="redirectUrl" value="<?php echo $news->redirectUrl; ?>">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">头图</label>
                                    <input type="text" class="form-control" placeholder="" name="titleImage" value="<?php echo $news->titleImage; ?>">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">杂项</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="top">
                                        <label class="form-check-label">置顶</label>
                                    </div>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>摘要</label>
                                    <textarea class="form-control" rows="3" placeholder="" name="summary"><?php echo $news->summary; ?></textarea>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->


                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>内容</label>
                                    <textarea id="summernote" rows="10" name="content"><?php echo $news->content; ?></textarea>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->


                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">提交</button>
                    </div>

                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="postDate" value="<?php echo $news->postDate; ?>">

                    </form>

                </div>
                <!-- /.card -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <?php include ROOT . '/tpl/admin.content.footer.php'; ?>


</div>
<!-- ./wrapper -->





<?php include ROOT . '/tpl/admin.footer.script.php'; ?>

<script src="./lib/summernote-0.8.18-dist/summernote-bs4.min.js"></script>
<script src="./lib/summernote-0.8.18-dist/lang/summernote-zh-CN.js"></script>

<script>
    $(function () {
        // Summernote
        $('#summernote').summernote({
            placeholder: '',
            tabsize: 4,
            height: '50em',
            lang: 'zh-CN',
            callbacks: {
                onImageUpload: function (files) {
                    sendFile(files[0]);
                }
            }
        });

        function sendFile(file) {
            data = new FormData();
            data.append("file", file);
            $.ajax({
                data: data,
                type: "POST",
                url: "./?module=admin.file.upload",
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {
                    var image = $('<img>').attr('src', url);
                    $('#summernote').summernote("insertNode", image[0]);
                }
            });
        }


    })
</script>



<script type="text/javascript">
    $(function(){
        $('.delete_news').click(function(e){
            e.preventDefault();
            if (confirm('确认删掉这条内容？')) {
                window.location = this.href;
            }
        });

        $('#site').change(function(){
            var loc = window.location.href;

            loc = loc.replace( /[\?&]page=\d+/, '' ).replace( /[\?&]site=[^&]+/, '' );

            var conn_str = loc.search( /\?/ ) ? '&' : '?';

            var cat = $(':selected', this).val();

            if ( cat )
            {
                location = loc + conn_str + 'site=' + $(this).val();
            }
            else
            {
                location = loc;
            }
        });


    });
</script>

<?php include ROOT . '/tpl/admin.footer.php';


