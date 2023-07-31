<?php
include ROOT . '/tpl/header.php';
include ROOT . '/tpl/my.nav.php';

?>

<section class="paddingTop-20 ">
    <div class="container">
        <div class="row ">
            <div class="col-lg-12 text-center py-3">
                <h3 class="text-white"><i class="ti-receipt pr-2"></i><strong>课程报名</strong></h3>
            </div>
        </div>

        <div class="card shadow-v2">
            <div class="card-body p-3">
                <div class="row pb-3">
                    <?php
                    if ( $list )
                    {
                    ?>
                    <div class="col-12 text-left font-size-16 text-danger pt-1">
                        您已报名的课程
                    </div>
                    <?php
                    }
                    else
                    {
                    ?>
                        <div class="col-6 text-left font-size-16 text-danger pt-1">
                            您尚未报名课程
                        </div>
                    <div class="col-6 text-right ">
                        <a href="./?module=course.apply" class="btn btn-icon btn-pill btn-info btn-sm px-3"><i class="ti-pencil-alt mr-2"></i><span>报新课</span></a>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <?php
                foreach ( $list as $e )
                {
                ?>
                    <div class="col-12 bg-bgrey rounded py-1 mb-3">
						<h5  class="pt-3"><strong><?php echo htmlspecialchars($e['season_name']); ?></strong></h5>
						<h5  class="pt-3"><strong><?php echo htmlspecialchars($e['title']); ?></strong></h5>
                        <p class="font-size-16 ">
                            <?php echo htmlspecialchars($e['classroom']); ?><br>
                            <?php echo htmlspecialchars($e['start']); ?><br>
                        </p>
                        <!--
                        <p class="font-size-16 text-left">
                            参课人：<br>
                            <?php echo htmlspecialchars($e['gname']); ?> <br>
                            <?php
                            if ( strtotime( $e[ 'applyStart' ] ) < time() && strtotime( $e[ 'applyEnd' ] ) > time()  )
                            {
                                ?>
                        <div class="col-12 text-center">
                            <a href="./?module=course.apply&step=4&site=<?php echo htmlspecialchars($e['site']); ?>&id=<?php echo htmlspecialchars($e['courseId']); ?>" class="btn btn-icon btn-pill btn-info btn-sm px-3"><i class="ti-pencil-alt mr-2"></i><span>添加参课人</span></a>
                        </div>
                        <?php
                            }
                            ?>
                        </p>
                            -->
                        <div class="col-12 text-center ">
                                <button type="button" class="btn btn-icon btn-pill btn-info btn-sm px-3 alt-course" data-toggle="modal" data-id="<?php echo $e[ 'id' ]; ?>" data-season="<?php echo $e[ 'seasonId' ]; ?>" data-target="#exampleModal">
                                    <i class="ti-pencil-alt mr-2"></i><span>更改课程</span>
                                </button>
                                <button type="button" class="btn btn-icon btn-pill btn-info btn-sm px-3 cancel-course" data-toggle="modal" data-id="<?php echo $e[ 'id' ]; ?>">
                                    <i class="ti-pencil-alt mr-2"></i><span>取消课程</span>
                                </button>
                        </div>

                    </div>
                <?php
                }
                ?>

                <div class="row pb-3">
                    <div class="col-12 text-center ">
                        <a href="./?module=logout" class="btn btn-icon btn-pill btn-info btn-sm px-3"><i class="ti-pencil-alt mr-2"></i><span>退出登录</span></a>
                    </div>

                </div>

            </div>
        </div>

        <!-- END row-->
    </div>
    <!-- END container-->
</section>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">提示</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                每人只能报一门课。如报名其它课程，已报课程将自动取消。
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-pill btn-info btn-sm px-3" data-dismiss="modal">保持已报课程</button>
                <button type="button" class="btn btn-primary btn-pill btn-info btn-sm px-3" id="alt_c">更改课程</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">提示</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                确定取消吗？
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-pill btn-info btn-sm px-3" data-dismiss="modal">保持不变</button>
                <button type="button" class="btn btn-primary btn-pill btn-info btn-sm px-3" id="c">取消报名</button>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/vendors.bundle.js"></script>
<script src="assets/js/app.min.js"></script>
<script src="js/site.js"></script>
<script>
    $(function () {
        $('#c').click(function () {
            $.ajax("./?module=course.cancel&id="+$(this).data('id')).done(function (data) {
                if ( data.data.success ) {
                    show_message( data.data.message, "./?module=my.course" );
                }
                else {
                    show_message( data.data.message );
                }
            });
        });

        $(document).on('click', '.cancel-course', function (){
            const id = $(this).data('id');
            $('#c').data('id', id);
            $('#exampleModal1').modal('show');
        });

        $(document).on('click', '.alt-course', function (){
            var season = $(this).data('season');

            $('#alt_c').click(function () {
				window.location = './?module=course.apply&step=1&season='+season;
            });
        });
    });
</script>


</body>
</html>
