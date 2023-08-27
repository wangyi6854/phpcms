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
    <!-- /.row -->
    <div class="row">
        <div class="col-12">
            <div class="card">


                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th style="width: 30px;">id</th>
                            <th>标题</th>
                            <th style="width: 40px;">数据</th>
                            <th style="width: 30px;">修改</th>
                            <th style="width: 30px;">删除</th>
                        </tr>
                        </thead>
                        <tbody>

                <?php
                foreach ( $list->list as $news )
                {
                    ?>
                    <tr>
                        <td><?php echo $news->id; ?></td>
                        <td><a href="" target="_blank"><?php echo $news->title; ?></a></td>
                        <td></td>
                        <td><a href="./?module=admin.news.modify&id=<?php echo $news->id; ?>">修改</a></td>
                        <td><a href="./?module=admin.news.delete&id=<?php echo $news->id; ?>" class="delete_news">删除</a></td>
                    </tr>
                    <?php
                }
                ?>



                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
    </section>
        <!-- /.content -->


    </div>
    <!-- /.content-wrapper -->

    <?php include ROOT . '/tpl/admin.content.footer.php'; ?>


</div>
<!-- ./wrapper -->





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


