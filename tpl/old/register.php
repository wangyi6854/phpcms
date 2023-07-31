<?php
include ROOT . '/tpl/header.php';

?>
<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>





<!-- END 主图-->

<div class="padding-y-40 bg-cover" data-dark-overlay="2" style="background:url(assets/img/top-1.jpg) no-repeat">
  <div class="container">
    <h1 class="text-white">
      注册会员
    </h1>
    <ol class="breadcrumb breadcrumb-double-angle text-white bg-transparent p-0">
      <li class="breadcrumb-item"><a href="./">首页</a></li>
      <li class="breadcrumb-item">注册会员</li>
    </ol>
  </div>
</div>





  <!-- END 注册-->
<section class="padding-y-100 bg-light">
  <div class="container">
  	<div class="row">
      <div class="col-12 text-center mb-md-4">
        <h2 class="mb-4">
          注册会员
        </h2>
        <div class="width-3rem height-4 rounded bg-primary mx-auto"></div>
      </div>
    </div>
    <div class="row" id="r">
      <div class="col-lg-6 mx-auto">
        <div class="card shadow-v2">
          <div class="card-body">
            <form action="" method="POST" class="px-lg-4" id="f">
              <div class="input-group input-group--focus mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-white ti-user"></span>
                </div>
                <input id="u1" name="username" type="text" class="form-control border-left-0 pl-0" placeholder="用户名">
              </div>
              <div class="input-group input-group--focus mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-white ti-lock"></span>
                </div>
                <input name="password" type="text" class="form-control border-left-0 pl-0" placeholder="密码">
              </div>

              <a href="" class="btn btn-block btn-primary" id="a">注册</a>
              <p class="my-5 text-center">
                已经有了账号！ <a href="./?module=login" class="text-primary">登录</a>
              </p>
            </form>
          </div>
        </div>
      </div>
    </div> <!-- END row-->

	<div class="row" id="s" style="display: none;">
      <div class="col-lg-6 mx-auto">
        <div class="card shadow-v2">
          <div class="card-body">
            <form action="#" method="POST" class="px-lg-4">
                <p class="marginBottom-10 text-warning text-center"><strong id="u2"></strong></p>
                <p class="marginBottom-40 text-warning"><strong>   恭喜您注册会员成功！您可以申请注册等级会员！（如金牌月嫂、首席保姆等等）</strong></p>

              <a href="./?module=apply" class="btn btn-block btn-primary">现在申请</a>

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


			if ( r.data.result == 0 )
			{
				$('#u2').text($('#u1').val());
				$('#r').hide();
				$('#s').show();
			}
			else
			{
				alert( r.data.message );
			}
		},

        clearForm: false,
        resetForm: false
    };

	//$('#f').ajaxForm(options);

	$('#a').click(function(e){
		e.preventDefault();

		$('#f').ajaxSubmit(options);
	});
});


</script>



<?php

include ROOT . '/tpl/footer.php';
