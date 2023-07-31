<?php
include ROOT . '/tpl/header.php';

?>



<!-- 主图-->
     <div class="padding-y-60 bg-cover" data-dark-overlay="2" style="background:url(assets/img/top-1.jpg) no-repeat">
       <div class="container">
         <h1 class="text-white">
           家政服务
         </h1>
         <ol class="breadcrumb breadcrumb-double-angle text-white bg-transparent p-0">
           <li class="breadcrumb-item"><a href="./">首页</a></li>
           <li class="breadcrumb-item">家政服务</li>
         </ol>
       </div>
     </div>
<!-- END 主图-->

<!-- 分类 -->
    <section class="padding-y-20 mt-3">
       <div class="container">

	   <form id="f">

         <div class="row mb-3">
            <div class="col-sm-12 col-md-2 col-lg-2 fen-text fin-9p pb-2"> 类&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;型:
             	<span><a href="#" class="fen-nav  pr-2">不限</a></span>
           </div>
             <div class="col-sm-0 col-md-10 col-lg-10 fen fin-9p pl-lg-0">
<?php
foreach ( $leixing_enum as $v )
{
	$checked = '';
	if ( in_array( $v, $leixing ) )
	{
		$checked = 'checked';
	}
?>
              <label class="ec-checkbox check-xs mr-3 ">
                <input type="checkbox" name="leixing[]" value="<?php echo $v; ?>" <?php echo $checked; ?>>
                <span class="ec-checkbox__control"></span>
                <span class="ec-checkbox__lebel"><?php echo $v; ?></span>
              </label>

<?php
}
?>

             </div>
         </div>

         <div class="row mb-3">
            <div class="col-sm-12 col-md-2 col-lg-2 fen-text fin-9p pb-2">区&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;域:
             	<span><a href="#" class="fen-nav  pr-2">不限</a></span>
           </div>
             <div class="col-sm-0 col-md-10 col-lg-10 fin-9p pl-lg-0 ">

<?php
foreach ( $quyu_enum as $v )
{
	$checked = '';
	if ( in_array( $v, $quyu ) )
	{
		$checked = 'checked';
	}
?>
              <label class="ec-checkbox check-xs mr-3 ">
                <input type="checkbox" name="quyu[]" value="<?php echo $v; ?>" <?php echo $checked; ?>>
                <span class="ec-checkbox__control"></span>
                <span class="ec-checkbox__lebel"><?php echo $v; ?></span>
              </label>

<?php
}
?>

            </div>
         </div>

         <div class="row mb-3">
            <div class="col-sm-12 col-md-2 col-lg-2 fen-text fin-9p pb-2">级&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别:
             	<span><a href="#" class="fen-nav  pr-2">不限</a></span>
           </div>
             <div class="col-sm-0 col-md-10 col-lg-10 fin-9p pl-lg-0">

<?php
foreach ( $jibie_enum as $v )
{
	$checked = '';
	if ( in_array( $v, $jibie ) )
	{
		$checked = 'checked';
	}
?>
              <label class="ec-checkbox check-xs mr-3 ">
                <input type="checkbox" name="jibie[]" value="<?php echo $v; ?>" <?php echo $checked; ?>>
                <span class="ec-checkbox__control"></span>
                <span class="ec-checkbox__lebel"><?php echo $v; ?></span>
              </label>

<?php
}
?>

            </div>
         </div>

         <div class="row mb-3">
            <div class="col-sm-12 col-md-2 col-lg-2 fen-text fin-9p pb-2">服务经验:
            	<span><a href="#" class="fen-nav  pr-2">不限</a></span>
            </div>
             <div class="col-sm-0 col-md-10 col-lg-10 fin-9p pl-lg-0">

              <label class="ec-radio check-xs mr-3 ">
                <input type="radio" name="exp" value="1" <?php echo $exp == 1 ? 'checked' : ''; ?>>
                <span class="ec-radio__control"></span>
                <span class="ec-radio__lebel">1年以下</span>
              </label>
              <label class="ec-radio check-xs lit-hih mr-4">
                <input type="radio" name="exp" value="2" <?php echo $exp == 2 ? 'checked' : ''; ?>>
                <span class="ec-radio__control"></span>
                <span class="ec-radio__lebel">1年-3年</span>
              </label>
              <label class="ec-radio check-xs mr-3 ">
                <input type="radio" name="exp" value="3" <?php echo $exp == 3 ? 'checked' : ''; ?>>
                <span class="ec-radio__control"></span>
                <span class="ec-radio__lebel">3年-5年</span>
              </label>
              <label class="ec-radio check-xs lit-hih mr-3">
                <input type="radio" name="exp" value="4" <?php echo $exp == 4 ? 'checked' : ''; ?>>
                <span class="ec-radio__control"></span>
                <span class="ec-radio__lebel">5年-7年</span>
              </label>
              <label class="ec-radio check-xs lit-hih mr-3">
                <input type="radio" name="exp" value="5" <?php echo $exp == 5 ? 'checked' : ''; ?>>
                <span class="ec-radio__control"></span>
                <span class="ec-radio__lebel">7年以上</span>
              </label>
            </div>
         </div>

         <div class="row mb-3">
            <div class="col-sm-12 col-md-2 col-lg-2 fen-text fin-9p pb-2">年&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;龄:
            	<span><a href="#" class="fen-nav  pr-2">不限</a></span>
            </div>
             <div class="col-sm-0 col-md-10 col-lg-10 fin-9p pl-lg-0">

              <label class="ec-radio check-xs mr-3 ">
                <input type="radio" name="age" value="1" <?php echo $age == 1 ? 'checked' : ''; ?>>
                <span class="ec-radio__control"></span>
                <span class="ec-radio__lebel">30岁以下</span>
              </label>
              <label class="ec-radio check-xs lit-hih mr-3">
                <input type="radio" name="age" value="2" <?php echo $age == 2 ? 'checked' : ''; ?>>
                <span class="ec-radio__control"></span>
                <span class="ec-radio__lebel">30岁-40岁</span>
              </label>
              <label class="ec-radio check-xs mr-3 ">
                <input type="radio" name="age" value="3" <?php echo $age == 3 ? 'checked' : ''; ?>>
                <span class="ec-radio__control"></span>
                <span class="ec-radio__lebel">40岁-50岁</span>
              </label>
              <label class="ec-radio check-xs lit-hih mr-3">
                <input type="radio" name="age" value="4" <?php echo $age == 4 ? 'checked' : ''; ?>>
                <span class="ec-radio__control"></span>
                <span class="ec-radio__lebel">50岁以上</span>
              </label>
            </div>
         </div>

         <div class="row mb-3">
            <div class="col-sm-12 col-md-2 col-lg-2 fen-text fin-9p  pb-2">服务内容:
            	<span><a href="#" ">不限</a></span>
            </div>
             <div class="col-sm-0 col-md-10 col-lg-10 fin-9p pl-lg-0">
<?php
foreach ( $neirong_enum as $v )
{
	$checked = '';
	if ( in_array( $v, $neirong ) )
	{
		$checked = 'checked';
	}
?>
              <label class="ec-checkbox check-xs mr-3 ">
                <input type="checkbox" name="neirong[]" value="<?php echo $v; ?>" <?php echo $checked; ?>>
                <span class="ec-checkbox__control"></span>
                <span class="ec-checkbox__lebel"><?php echo $v; ?></span>
              </label>

<?php
}
?>
            </div>
         </div>

         <div class="row mb-3">
            <div class="col-sm-12 col-md-2 col-lg-2 fen-text fin-9p pb-2">属&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;相:
             	<span><a href="#">不限</a></span>
           </div>
             <div class="col-sm-0 col-md-10 col-lg-10 fin-9p pl-lg-0">
<?php
foreach ( $shuxiang_enum as $v )
{
	$checked = '';
	if ( $v == $shuxiang )
	{
		$checked = 'checked';
	}
?>
              <label class="ec-radio radio-xs mr-3 ">
                <input type="radio" name="shuxiang" value="<?php echo $v; ?>" <?php echo $checked; ?>>
                <span class="ec-radio__control"></span>
                <span class="ec-radio__lebel"><?php echo $v; ?></span>
              </label>

<?php
}
?>
            </div>
         </div>

         <div class="row mb-2">
			<input type="button" value="搜索" id="search"class="rounded btn-primary ml-3 mt-2 px-4 ">
			<input type="hidden" value="service" name="module">
			<input type="hidden" value="0" name="orderid" id="order">
			<input type="hidden" value="<?php echo $page; ?>" name="page" id="page">
         </div>

		</form>

       </div>
    </section>
<script type="text/javascript" src="js/jquery-3.5.1.slim.min.js"></script>
<script type="text/javascript">

$(function(){
	$('a', '#f').click(function(e){
		e.preventDefault();

		$('input', $(this).parent().parent().parent()).prop('checked', false).prop('selected', false);
	});

	$('#search').click(function(){
		$('#f').submit();
	});

	$('a', '#o').click(function(e){
		e.preventDefault();

		$('#order').val($(this).data('id'));
		$('#f').submit();
	});

	$('a[data-id=<?php echo $orderid; ?>]', '#o').addClass('active');

	$('#pp').click(function(e){
		e.preventDefault();

		$('#page').val(<?php echo $page - 1; ?>);
		$('#f').submit();
	});

	$('#np').click(function(e){
		e.preventDefault();

		$('#page').val(<?php echo $page + 1; ?>);
		$('#f').submit();
	});

});


</script>
<!-- END分类 -->


<!-- 列表展示 -->
  <section class="padding-y-60">
     <div class="container">

     <div class="row">
      <div class="col-12">

       <ul class="nav tab-line tab-line tab-line--3x border-bottom mb-4" role="tablist" id="o">
         <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#Tabs_4-1" role="tab" aria-selected="true" data-id="0">
            默认排序
          </a>
         </li>
         <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#Tabs_4-2" role="tab" aria-selected="true" data-id="1">
           服务经验长
          </a>
         </li>
          <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#Tabs_4-3" role="tab" aria-selected="true" data-id="2">
           年龄最小
          </a>
         </li>
         <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#Tabs_4-4" role="tab" aria-selected="true" data-id="3">
           年龄最大
          </a>
         </li>
       </ul>

        <div class="tab-content">
          <div class="tab-pane fade show active" id="Tabs_4-1" role="tabpanel">
<?php
if ( $data )
{
	foreach ( $data as $d )
	{
?>
              <div class="list-card align-items-center col-border-bm marginTop-30">
                <div class="col-lg-2 px-lg-4 my-4">
                   <img class="w-100" src="<?php echo $d[ 'photo' ]; ?>" alt="">
                </div>
                <div class="col-lg-10 paddingRight-30 my-4">
                   <h4><?php echo $d[ 'name' ]; ?></h4>
                   <p><?php echo $d[ 'age' ]; ?>岁 / <?php echo $d[ 'jiguan' ]; ?> / <?php echo $d[ 'jingyan' ]; ?>年经验</p>
                   <p><?php echo $d[ 'jiangxiang' ]; ?></p>
                   <p>属相：<?php echo $d[ 'shuxiang' ]; ?></p>
                   <p><?php echo str_replace( ',', ' / ', $d[ 'neirong' ] ); ?></p>
                </div>
              </div>
<?php
	}
}
else
{
?>
	没有找到家政人员
<?php
}
?>
          </div>

     <div class="col-12 mt-5">
        <ul class="pagination pagination-primary justify-content-center">
<?php
if ( $page > 1 )
{
?>
          <li class="page-item mx-1">
            <a class="page-link iconbox rounded-0" href="#" id="pp">
              <i class="ti-angle-left small"></i>
            </a>
          </li>
<?php
}
if ( $has_next_page )
{
?>
		  <li class="page-item mx-1">
            <a class="page-link iconbox rounded-0" href="#" id="np">
              <i class="ti-angle-right small"></i>
            </a>
          </li>
<?php
}
?>
		</ul>

      </div>
    </div>

        </div> <!-- END tab-content-->
      </div> <!-- END col-12 -->
    </div> <!-- END row-->

     </div>
  </section>

<!-- END 列表展示-->





<?php

include ROOT . '/tpl/footer.php';
