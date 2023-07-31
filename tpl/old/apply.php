<?php
include ROOT . '/tpl/header.php';

?>
<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>


<!-- END 主图-->

<div class="padding-y-40 bg-cover" data-dark-overlay="2" style="background:url(assets/img/top-1.jpg) no-repeat">
  <div class="container">
    <h1 class="text-white">
      会员资料补全
    </h1>
    <ol class="breadcrumb breadcrumb-double-angle text-white bg-transparent p-0">
      <li class="breadcrumb-item"><a href="./">首页</a></li>
      <li class="breadcrumb-item">会员资料补全</li>
    </ol>
  </div>
</div>

  <!-- END 注册-->
<section class="padding-y-60 bg-light">
  <div class="container">
  	<div class="row">
      <div class="col-12 text-center mb-md-4">
        <h2 class="mb-4" id="section_title">
          完善资料
        </h2>
        <div class="width-3rem height-4 rounded bg-primary mx-auto"></div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-8 mx-auto">
        <div class="card shadow-v2">

          <div class="card-body">

            <form action="" method="POST" id="f" >
<?php

include 'apply.1.php';
include 'apply.2.php';
include 'apply.3.php';
include 'apply.4.php';
include 'apply.5.php';

?>
            </form>
          </div>
        </div>
      </div>
    </div> <!-- END row-->
  </div> <!-- END container-->
</section>

<form method="post" action="./?module=upload" id="ff" style="display: none;">
<input type="file" name="file" id="file">
</form>


<script type="text/javascript">

step = <?php echo $step; ?>;

jQuery( document ).ready(function( $ ) {
    var options = {
        success: function (r)  {

			if ( r.return == 1 )
			{
				alert( '修改成功。请等待审核。' );
				window.location = './?module=status';
			}
			else
			{
				alert( '修改失败。请仔细检查各项条目。' );
			}
		},

        clearForm: false,
        resetForm: false
    };

	$('.btn-submit').click(function(e){
		e.preventDefault();
		$('#f').ajaxSubmit(options);
	});

	$('a.btn-step').click(function(e){
		e.preventDefault();

		var next_step = parseInt($(this).data('step'));
		toggle_div( next_step )
	});

	toggle_div( step );

	$('.btn-up').click(function(){
		target = $(this).data('target');
		$('#file').click();
	});

	$('#file').change(function(){
		if ($('#file').fieldValue()) {
			$('#ff').ajaxSubmit({
				dataType:	'json',
				clearForm:	false,
				success:	function(data){
					if (!data.return) {
						add_image(target, data.data);
					} else {
						alert('照片上传出错');
					}
				}
			});
		}
	});

	$('.image-con').on('click', '.close', function(){
		var id = $(this).closest('.img-con').find('img').data('id');
		$(this).closest('.img-con').remove();
	});

	$('.btn-edit').click(function(){
		var target = $(this).data('target');
		toggle_div( target );
	});


	function toggle_div( s )
	{
		$('#s1, #s2, #s3, #s4, #s5').hide(1000);
		$('#section_title').html(section_title(s));
		$('#s'+s).show(1000, summary(s));
	}

	function summary(s)
	{
		if ( s == 5 )
		{
			$.each(['name', 'age', 'sex', 'mobile', 'company', 'shuxiang', 'jingyan', 'techang'], function(i, v){
				$('#s'+v).html($('#'+v).fieldValue());
			});

			$.each(['shuxiang'], function(i, v){
				$('#s'+v).html($('input[name="'+v+'"').fieldValue());
			});

			$.each(['quyu', 'neirong', 'leixing', 'jibie'], function(i, v){
				$('#s'+v).html($('input[name="'+v+'[]"').fieldValue().join(','));
			});

			$('#sphoto').html('');
			$('img', '#p1').each(function(){
				$('<div class="col-sm-6 col-md-3 col-lg-3 pr-0 pb-1">'+this.outerHTML+'</div>').appendTo('#sphoto');
			});

			$('#sidcard').html('');
			$('img', '#p2, #p3').each(function(){
				$('<div class="col-sm-6 col-md-3 col-lg-3 pr-0 pb-1">'+this.outerHTML+'</div>').appendTo('#sidcard');
			});

			$('#scert').html('');
			$('img', '#p4').each(function(){
				$('<div class="col-sm-6 col-md-3 col-lg-3 pr-0 pb-1">'+this.outerHTML+'</div>').appendTo('#scert');
			});

		}
	}

	function section_title( step )
	{
		switch ( step )
		{
			case 1:
				return '完善资料';
			case 2:
				return '选择服务类别';
			case 3:
				return '申请等级';
			case 4:
				return '上传照片';
			case 5:
				return '个人信息修改';
		}
	}

	function add_image(target, data)
	{
		if ( $.inArray(parseInt(target.substr(1)), [1,2,3]) != -1 )
		{
			$('#'+target).empty();
		}

		$('#'+target).append(image_template(parseInt(target.substr(1)), data.path, data.id));
	}

	function image_template(target, src, id )
	{
		switch ( target )
		{
			case 1:
				var c = "col-sm-1 col-md-1 col-lg-3 pr-lg-0";
				var name = 'photo[]';
				break;
			case 2:
			case 3:
				var c = "col-sm-2 col-md-2 col-lg-3 pr-0";
				var name = 'idcard[]';
				break;
			case 4:
				var c = "col-sm-6 col-md-4 col-lg-4 pr-0 pb-1";
				var name = 'cert[]';
				break;
		}

		return hereDoc = `
<div class="${c} img-con">
	<div class="img-wrap">
		<span class="close">&times;</span>
		<img src="${src}" data-id="${id}">
		<input type="hidden" name="${name}" value="${id}">
	</div>
</div>
`;

	}

});

</script>

<style type="text/css">
.img-wrap {
    position: relative;
}
.img-wrap .close {
    position: absolute;
    top: 2px;
    right: 2px;
    z-index: 100;
}
</style>
<?php

include ROOT . '/tpl/footer.php';
