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
                        <h3 class="card-title">新闻审核</h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">


                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <?php echo $news->title; ?>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>分类1：</label>
                                    青岛
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>分类2：</label>

                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">转向地址：</label>
                                    <a href="<?php echo $news->redirectUrl; ?>" target="_blank"><?php echo $news->redirectUrl; ?></a>
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
                                    <img src="<?php echo $news->titleImage; ?>">
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
                                    <div><?php echo $news->summary; ?></div>
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
                                    <div><?php echo $news->content; ?></div>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->


                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary">通过</button>
                        <button type="button" class="btn btn-primary">不通过</button>
                    </div>


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
            lang: 'zh-CN'
        });


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


