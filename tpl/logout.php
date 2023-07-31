<?php
include ROOT . '/tpl/header.php';

?>



<!-- END 主图-->


<div class="padding-y-40 bg-cover" data-dark-overlay="2" style="background:url(assets/img/top-1.jpg) no-repeat">
  <div class="container">
    <h1 class="text-white">
      会员登录
    </h1>
    <ol class="breadcrumb breadcrumb-double-angle text-white bg-transparent p-0">
      <li class="breadcrumb-item"><a href="./">首页</a></li>
      <li class="breadcrumb-item">会员登录</li>
    </ol>
  </div>
</div>

<section class="padding-y-100 bg-light">
  <div class="container">
  	<div class="row">
      <div class="col-12 text-center mb-md-4">
        <h2 class="mb-4">
          会员登录
        </h2>
        <div class="width-3rem height-4 rounded bg-primary mx-auto"></div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 mx-auto">
        <div class="card shadow-v2">
          <div class="card-body">
            您已退出

          </div>
        </div>
      </div>
    </div> <!-- END row-->
  </div> <!-- END container-->
</section>





<script type="text/javascript">
setTimeout(function(){ window.location = "./"; }, 3000);
</script>




<?php

include ROOT . '/tpl/footer.php';
