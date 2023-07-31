<?php
include ROOT . '/tpl/header.php';
include ROOT . '/tpl/course.nav.php';

?>


<section class="paddingTop-20 ">
    <div class="container">
        <div class="row ">
            <div class="col-lg-12 text-center py-3">
                <h3 class="text-white"><strong><?php echo $notice_title; ?></strong></h3>
            </div>
        </div>

        <div class="card shadow-v2">
            <div class="card-body p-3">
				<?php echo $notice_content; ?>
                <div class="d-md-flex justify-content-between my-4 text-center ">
                    <button class="btn btn-sm btn-danger font-size-14 px-3" onclick="window.location='./?module=course.apply&step=3&site=<?php echo rawurlencode($site); ?>&season=<?php echo $season; ?>'">同意</button>
                </div>
            </div>
        </div>

        <!-- END row-->
    </div>
    <!-- END container-->
</section>




<script src="assets/js/vendors.bundle.js"></script>
<script src="assets/js/app.min.js"></script>

<?php
include ROOT . '/tpl/footer.php';
?>
