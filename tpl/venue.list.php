<?php
include ROOT . '/tpl/header.php';
include ROOT . '/tpl/venue.nav.php';

?>


<section>
	<div class="container">
		<div class="row ">
			<div class="col-lg-12  py-3">
				<h2 class="text-white text-center"><strong>场馆预约</strong></h2>
			</div>
		</div>
		<div class="row pb-3">
			<div class="col-12 text-center font-size-14 text-white pt-1">
				（需提前一周预约）
			</div>
		</div>

		<div class="card shadow-v2">
			<div class="card-body px-1 py-4">
				<div class="row mx-1">
					<?php
					foreach ( $venuelist as $v )
					{
                        if ( $v == '非物质文化遗产展厅' )
                        {
                            continue;
                        }
						?>
						<div  class="col-6 col-sm-6 padding-x-10">
							<a href="./?module=venue.apply&step=2&venue=<?php echo rawurlencode( $v ); ?>" class="btn btn-block btn-info mb-3 font-size-14 text-left p-3"><strong><?php echo htmlspecialchars( $v ); ?></strong></a>
						</div>
					<?php
					}
					?>
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
