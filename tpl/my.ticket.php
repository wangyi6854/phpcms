<?php
include ROOT . '/tpl/header.php';
include ROOT . '/tpl/my.nav.php';

?>

<section class="paddingTop-20 ">
    <div class="container">
        <div class="row ">
            <div class="col-lg-12 text-center py-3">
                <h3 class="text-white"><i class="ti-receipt pr-2"></i><strong>活动抢票</strong></h3>
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
                        已预约
                    </div>
                    <?php
                    }
                    else
                    {
                    ?>
                        <div class="col-6 text-left font-size-16 text-danger pt-1">
                            您尚未预约
                        </div>
                    <div class="col-6 text-right ">
                        <a href="./?module=ticket.apply" class="btn btn-icon btn-pill btn-info btn-sm px-3"><i class="ti-pencil-alt mr-2"></i><span>活动抢票</span></a>
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
                        <h5  class="pt-3"><strong><?php echo htmlspecialchars($e['title']); ?></strong></h5>
                        <p class="font-size-16 ">
                            <?php echo htmlspecialchars($e['start']); ?><br>
                            <?php echo htmlspecialchars($e['address']); ?><br>
                        </p>
						<p class="font-size-16 text-center ">
							<a class="btn btn-pill btn-info btn-sm px-2 py-1 cancel-course" style="font-size: 0.8em;" data-id="<?php echo htmlspecialchars($e['ticket_apply_id']); ?>">取消预定</a>
						</p>
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
                <button type="button" class="btn btn-primary btn-pill btn-info btn-sm px-3" onclick="window.location='./?module=course.apply'">更改课程</button>
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
                <button type="button" class="btn btn-primary btn-pill btn-info btn-sm px-3" id="c">取消预约</button>
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
            $.ajax("./?module=ticket.cancel&id="+$(this).data('id')).done(function (data) {
                if ( data.data.success ) {
                    show_message( data.data.message, "./?module=my.ticket" );
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
    });
</script>


</body>
</html>
