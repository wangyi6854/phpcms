<?php
include ROOT . '/tpl/header.php';
include ROOT . '/tpl/my.nav.php';

?>

<section class="paddingTop-20 ">
    <div class="container">
        <div class="row ">
            <div class="col-lg-12 text-center py-3">
                <h3 class="text-white"><i class="ti-receipt pr-2"></i><strong>我的预约</strong></h3>
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
                        您的预约
                    </div>
                    <?php
                    }
                    else
                    {
                    ?>
                        <div class="col-12 text-center font-size-16 text-danger pt-1 padding-10">
                            您目前没有预约
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <?php
                $lht_applied = false;
                $normal_venue_applied = false;
                foreach ( $list as $e )
                {
                    if ( $e[ 'name' ] == '非物质文化遗产展厅' )
                    {
                        $lht_applied = true;
                    }
                    else
                    {
                        $normal_venue_applied = true;
                    }
                ?>
                    <div class="col-12 bg-bgrey rounded py-1 mb-3">
                            <h5  class="pt-3"><strong><?php echo htmlspecialchars($e['name']); ?></strong></h5>
                            <p class="font-size-16 text-left">
                                <button type="button" class="btn btn-icon btn-pill btn-info btn-sm px-3 float-right cancel-apply"  data-id="<?php echo $e[ 'venue_apply_id' ]?>" data-toggle="modal">
                                    <i class="ti-pencil-alt mr-2"></i><span>取消预约</span>
                                </button>
                                <?php echo htmlspecialchars($e['date']); ?><br>
                                <?php echo date( 'H:i', strtotime( $e['periodFrom'] ) ); ?> - <?php echo date( 'H:i', strtotime( $e['periodTo'] ) ); ?> <br>
                            </p>
                    </div>

	                <?php
                }
                ?>

                <div class="col-12 text-center padding-10">
                    <?php
                    if ( !$lht_applied )
                    {
                        ?>
                        <a href="./?module=venue.apply&step=2&venue=<?php echo rawurlencode( '非物质文化遗产展厅' ); ?>"  class="btn btn-icon btn-pill btn-info btn-sm px-3"><span>预约非遗展厅</span></a>
                    <?php
                    }

                    if ( !$normal_venue_applied )
                    {
                        ?>
                        <a href="./?module=venue.apply" class="btn btn-icon btn-pill btn-info btn-sm px-3"><span>预约场馆</span></a>
                    <?php
                    }
                    ?>
                </div>

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
                <button type="button" class="btn btn-primary btn-pill btn-info btn-sm px-3 confim-cancel" id="c">取消预约</button>
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
            $.ajax("./?module=venue.cancel&id="+$(this).data('id')).done(function (data) {
                if ( data.data.success ) {
                    show_message( data.data.message, "./?module=my.venue" );
                }
                else {
                    show_message( data.data.message );
                }
            });
        });

        $(document).on('click', '.cancel-apply', function (){
            const id = $(this).data('id');
            $('.confim-cancel').data('id', id);
            $('#exampleModal1').modal('show');
        });
    });
</script>


</body>
</html>
