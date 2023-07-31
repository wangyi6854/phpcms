<?php
include ROOT . '/tpl/header.php';
include ROOT . '/tpl/venue.nav.php';

?>



<section>
    <div class="container">
        <div class="row mb-2">
            <div class="col-12  py-3">
                <h2 class="text-white text-center">
                    <strong><?php echo $LHT ? '展厅预约' : '场馆预约'; ?></strong>
                </h2>
            </div>
        </div>

        <div class="row mb-3 px-1 align-items-center">
            <div class="col">
                <h4 class="text-white text-left  p-2 rounded"><i class="ti-layers pr-2"></i><strong><?php echo htmlspecialchars( $venue ); ?></strong></h4>
            </div>
        </div>

        <?php
        if ( $list )
        {
	        foreach ( $list as $date => $e )
	        {
		        ?>
                <div class="row mx-1 bg-white  rounded p-2 mb-3">
                    <div  class="col-12 col-sm-12 padding-x-10 my-2">
                <span class="font-size-20 text-left ">
                    <strong><?php echo date( 'Y-n-j', $date ); ?></strong>
                </span>
                    </div>
			        <?php
			        foreach ( $e as $s )
			        {
				        ?>
                        <div  class="col-6 col-sm-6 padding-x-10">
                            <a href="./?module=venue.apply&step=3&venue=<?php echo rawurlencode( $venue ); ?>&date=<?php echo rawurlencode( $date ); ?>&id=<?php echo rawurlencode( $s[ 'id' ] ); ?>" class="btn btn-block btn-info mb-3 font-size-14 text-center p-2">
                                <strong>
							        <?php echo date( 'H:i', strtotime( $s[ 'periodFrom' ] ) ); ?>
                                    -
							        <?php echo date( 'H:i', strtotime( $s[ 'periodTo' ] ) ); ?>
                                </strong>
                            </a>
                        </div>
				        <?php
			        }
			        ?>
                </div>
		        <?php
	        }
        }
        else
        {
            ?>
            <div class="row mb-6 px-6 align-items-center">
                <div class="col">
                    <h6 class="text-white text-center  p-2 rounded">
                        <?php
                        echo $LHT ? '该展厅目前没有开放预约' : '该场地目前没有开放预约';
                        ?>

                    </h6>
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
