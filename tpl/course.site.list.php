<?php
include ROOT . '/tpl/header.php';
include ROOT . '/tpl/course.nav.php';

?>
<section>
    <div class="container">
        <div class="row mb-3">
            <div class="col-12  py-3">
                <h2 class="text-white text-center"><strong>课程报名</strong></h2>
            </div>
        </div>

        <?php
        foreach ( $sitelist->list as $e )
        {
        ?>
            <div class="row  mb-3 ">
                <div  class="col-10  p-3 my-2 bg-white mx-auto rounded ">
                    <h3 class=" text-center border-bottom py-2"><i class="ti-receipt pr-2"></i><strong><?php echo htmlspecialchars($e->name); ?></strong></h3>
                    <p class="mb-0 pt-2">地址：<?php echo htmlspecialchars( $e->address ); ?></p>
                    <p class="mb-0 pt-2">电话：<?php echo htmlspecialchars( $e->tel ); ?></p>
                    <p class="text-center mb-0"><a href="./?module=course.apply&step=2&site=<?php echo rawurlencode($e->name); ?>&season=<?php echo $season; ?>" data-id="<?php echo htmlspecialchars($e->name); ?>" class="btn btn-info my-3 font-size-16 "><strong>进入报名</strong></a> </p>
                </div>
            </div>
        <?php
        }
        ?>



        <!-- END row-->
    </div>
    <!-- END container-->
</section>


<script src="assets/js/vendors.bundle.js"></script>
<script src="assets/js/app.min.js"></script>

<?php
include ROOT . '/tpl/footer.php';
?>
