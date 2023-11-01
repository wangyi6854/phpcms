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
                        <h3 class="card-title">标签编辑</h3>

                    </div>
                    <!-- /.card-header -->
                    <form method="post">
                    <div class="card-body">


                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">名称</label>
                                    <input type="text" class="form-control" placeholder="" name="name" value="<?php echo $news->name; ?>">
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

<script>

</script>



<?php include ROOT . '/tpl/admin.footer.php';


