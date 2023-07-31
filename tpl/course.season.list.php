<?php
include ROOT . '/tpl/header.php';
include ROOT . '/tpl/course.nav.php';

?>


<section>
    <div class="container">
        <div class="row ">
            <div class="col-12  py-3">
                <h2 class="text-white text-center"><strong>课程报名</strong></h2>
            </div>
        </div>
        <div class="row ">
            <div class="col-12  pb-2">
                <h4 class="rounded py-2 text-white "><i class="ti-layers pr-2"></i><strong><?php echo htmlspecialchars( $site ); ?></strong></h4>
            </div>
        </div>

        <?php
        foreach ( $courseSeasonList->list as $e )
        {
        ?>
            <div class="row  mb-3 ">
                <div  class="col-11  p-3 my-2 bg-white mx-auto rounded ">

                    <p class="text-center mb-0">
                        <a href="./?module=course.apply&step=1&season=<?php echo $e->id; ?>"  class="btn btn-info my-3 font-size-16">
                            <strong><?php echo $e->name; ?></strong>
                        </a>
                    </p>
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
