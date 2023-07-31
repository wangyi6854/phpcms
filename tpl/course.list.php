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
        foreach ( $list as $e )
        {
            $could_apply = $e[ 'count' ] < $e[ 'maxCount' ] && strtotime( $e[ 'applyStart' ] ) < time() && strtotime( $e[ 'applyEnd' ] ) > time();
            if ( $e[ 'count' ] >= $e[ 'maxCount' ] )
            {
                $apply_text = '已报满';
            }
            elseif ( strtotime( $e[ 'applyStart' ] ) > time() )
            {
                $apply_text = '报名未开始';
            }
            elseif ( strtotime( $e[ 'applyEnd' ] ) < time() )
            {
                $apply_text = '报名已结束';
            }
			else
			{
				$apply_text = '我要报名';
			}
        ?>
            <div class="row  mb-3 ">
                <div  class="col-11  p-3 my-2 bg-white mx-auto rounded ">
                    <table class="table mt-2">
                        <tbody class="thead-light border">
                        <tr>
                            <th scope="row">课程</th>
                            <td><?php echo htmlspecialchars( $e['title'] ); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">培训时间</th>
                            <td><?php echo htmlspecialchars( $e['start'] ); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">授课老师</th>
                            <td><?php echo htmlspecialchars( $e['teacher'] ); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">教室</th>
                            <td><?php echo htmlspecialchars( $e['classroom'] ); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">报名人数</th>
                            <td>已报名<?php echo htmlspecialchars( $e['count'] ); ?>人/<?php echo htmlspecialchars( $e['maxCount'] ); ?>人</td>
                        </tr>
                        </tbody>
                    </table>
                    <p class="text-center mb-0">
                        <a href="./?module=course.apply&step=4&site=<?php echo rawurlencode($site); ?>&id=<?php echo rawurlencode($e[ 'id' ]); ?>&season=<?php echo $season; ?>"  class="btn btn-info my-3 font-size-16 <?php if ( !$could_apply ) { echo 'disabled'; } ?>">
                            <strong><?php echo $apply_text; ?></strong>
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
