<?php
include ROOT . '/tpl/header.php';
include ROOT . '/tpl/ticket.nav.php';

?>


<section>
    <div class="container">
        <div class="row ">
            <div class="col-12  py-3">
                <h2 class="text-white text-center"><strong>活动预约</strong></h2>
            </div>
        </div>

        <?php
        foreach ( $list as $e )
        {
            $could_apply = $e[ 'count' ] < $e[ 'maxCount' ] && strtotime( $e[ 'applyStart' ] ) < time() && strtotime( $e[ 'applyEnd' ] ) > time();
            $apply_text = '我要预约';
            if ( $e[ 'count' ] >= $e[ 'maxCount' ] )
            {
                $apply_text = '已报满';
            }
            if ( strtotime( $e[ 'applyStart' ] ) > time() )
            {
                $apply_text = '预约未开始';
            }
            if ( strtotime( $e[ 'applyEnd' ] ) < time() )
            {
                $apply_text = '预约已结束';
            }
        ?>
			<div class="row  mb-3 ">
				<div class="col-11  p-3 my-2 bg-white mx-auto rounded ">
					<div class="row">
						<div class="col-5 pr-0">
							<img src="<?php echo htmlspecialchars( $e['image'] ?: '/img/ticket_default.jpg' ); ?>">
						</div>
						<div class="col-7">
							<h5><strong><?php echo htmlspecialchars( $e['title'] ); ?></strong></h5>
							<ul class="list-unstyled font-size-16 mb-0">
								<li><?php echo htmlspecialchars( $e['start'] ); ?></li>
								<li><?php echo htmlspecialchars( $e['address'] ); ?></li>
								<li class="badge badge-danger mr-3 mb-2  font-size-14">已报名<?php echo htmlspecialchars( $e['count'] ); ?>人/<?php echo htmlspecialchars( $e['maxCount'] ); ?>人</li>
							</ul>
							<h4 class="mt-3">
								<a href="./?module=ticket.apply&step=2&id=<?php echo rawurlencode($e[ 'id' ]); ?>" class="btn btn-info my-3 font-size-16 <?php if ( !$could_apply ) { echo 'disabled'; } ?>">
									<strong><?php echo $apply_text; ?></strong>
								</a>
							</h4>

						</div>
					</div>
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
