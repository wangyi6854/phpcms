<?php
include ROOT . '/tpl/header.php';

?>
<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>


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
            <form action="" method="POST" class="px-lg-4" id="f">
              <div class="input-group input-group--focus mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-white ti-user"></span>
                </div>
                <input name="username" type="text" class="form-control border-left-0 pl-0" placeholder="姓名">
              </div>
              <div class="input-group input-group--focus mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-white ti-lock"></span>
                </div>
                <input name="password" type="password" class="form-control border-left-0 pl-0" placeholder="密码">
              </div>
              <button class="btn btn-block btn-primary">登录</button>
              <p class="my-5 text-center">
                没有账号？ <a href="./?module=register" class="text-primary">注册</a>
              </p>
            </form>
          </div>
        </div>
      </div>
    </div> <!-- END row-->
  </div> <!-- END container-->
</section>




<script type="text/javascript">
$.noConflict();
jQuery( document ).ready(function($){
    var options = {
        success: function (r)  {

			alert( r.data.message );

			if ( r.data.result == 0 )
			{
				window.location = './?module=apply&step=5';
			}
		},

        clearForm: false,
        resetForm: false
    };

	$('#f').ajaxForm(options);
});


</script>




<?php

include ROOT . '/tpl/footer.php';
