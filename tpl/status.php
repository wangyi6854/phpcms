<?php
include ROOT . '/tpl/header.php';

?>
<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>

<div class="padding-y-40 bg-cover" data-dark-overlay="2" style="background:url(assets/img/top-1.jpg) no-repeat">
  <div class="container">
    <h1 class="text-white">
      审核进度
    </h1>
    <ol class="breadcrumb breadcrumb-double-angle text-white bg-transparent p-0">
      <li class="breadcrumb-item"><a href="./">首页</a></li>
      <li class="breadcrumb-item">审核进度</li>
    </ol>
  </div>
</div>





  <!-- END 注册-->
<section class="padding-y-60 bg-light">
  <div class="container">
  	<div class="row">
      <div class="col-12 text-center mb-md-4">
        <h2 class="mb-4">
          审核进度
        </h2>
        <div class="width-3rem height-4 rounded bg-primary mx-auto"></div>
      </div>
    </div>

    <div class="row">

      <div class="col-lg-6 mx-auto" id="pending" style="display: none;">
        <div class="card shadow-v2">
         <div class="card-header px-lg-5 border-bottom">
          <h6 class="mt-4">
            <?php echo htmlspecialchars( $people->name ); ?>的申请进度
          </h6>
         </div>
          <div class="card-body">

           <div class="d-md-flex">
              <ul class="list-inline my-3">
                <li class="list-inline-item mr-3 text-center"><p>提交资料</p><a class="iconbox iconbox-xl <?php echo $current_step <= 1 ? 'btn-warning' : 'btn-secondary'; ?> hover:primary" href=""><i class="ti-check-box"> </i></a></li>
                <li class="list-inline-item mr-3 "> >> </li>
                <li class="list-inline-item mr-3 text-center"><p>初级审核通过</p><a class="iconbox iconbox-xl <?php echo $current_step == 2 ? 'btn-warning' : 'btn-secondary'; ?> hover:primary" href=""><i class="ti-check-box "> </i></a></li>
                <li class="list-inline-item mr-3 "> >> </li>
                <li class="list-inline-item text-center"><p>等待家协审核</p><a class="iconbox iconbox-xl <?php echo $current_step == 3 ? 'btn-warning' : 'btn-secondary'; ?> hover:primary" href=""><i class="ti-check-box"> </i></a></li>
              </ul>
            </div>

            <div class="table-responsive my-4">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">审核进度：</th>

                    </tr>
                  </thead>
                  <tbody>
<?php
foreach ( $list as $d )
{
?>
                    <tr>
                      <th scope="row">
                       <?php echo $d[ 'ts' ]; ?>
                       <?php echo $d[ 'status' ]; ?>
                       <a href="#" class="text-primary"><?php echo $d[ 'comment' ]; ?></a>
                      </th>
                    </tr>
<?php
}
?>

                  </tbody>
                </table>
              </div>

              <div class="row">
               	  <div class="col-lg-6 text-right">
               	    <a href="./?module=apply&step=5" class="btn btn-icon btn-primary mb-3">
                     <span>修改资料</span>
                    </a>
                 </div>
                 <div class="col-lg-6">
                 	  <a href="./" class="btn btn-icon btn-primary mr-2 mb-3">
                     <span>返回首页</span>
                    </a>
                 </div>
              </div>
          </div>
        </div>
      </div>


      <div class="col-lg-6 mx-auto" id="finished" style="display: none;">
        <div class="card shadow-v2">
         <div class="card-header px-lg-5 border-bottom">


          <h4 class="mt-4 text-warning text-center">
           祝贺<?php echo htmlspecialchars( $people->name ); ?>  您的申请审核已通过
          </h4>
         </div>
         <div class="card-body text-center">
           <div class="list-inline-item mr-3 text-center"><a class="iconbox iconbox-xxxl btn-warning hover:primary" href=""><i class="ti-check-box"> </i> </a><p class="pt-3 text-warning">审核通过</p></div>
            <a href="./"  class="btn btn-block btn-primary mt-5">返回网站首页</a>
         </div>
        </div>
      </div>






    </div> <!-- END row-->
  </div> <!-- END container-->
</section>


<script type="text/javascript">
jQuery( document ).ready(function( $ ) {

	var finished = <?php echo $finished ? 'true' : 'false'; ?>;

	if ( finished )
	{
		$('#finished').show(1000);
	}
	else
	{
		$('#pending').show(1000);
	}
});

</script>




<?php

include ROOT . '/tpl/footer.php';
