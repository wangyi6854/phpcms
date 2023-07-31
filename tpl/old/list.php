<?php
include ROOT . '/tpl/header.php';

?>


<!-- 主图-->
     <div class="padding-y-60 bg-cover" data-dark-overlay="2" style="background:url(assets/img/top-1.jpg) no-repeat">
       <div class="container">
         <h1 class="text-white">
           <?php echo htmlspecialchars( $newscat->name ); ?>
         </h1>
         <ol class="breadcrumb breadcrumb-double-angle text-white bg-transparent p-0">
           <li class="breadcrumb-item"><a href="./">首页</a></li>
           <li class="breadcrumb-item"><?php echo htmlspecialchars( $newscat->name ); ?></li>
         </ol>
       </div>
     </div>
<!-- END 主图-->



<section class="paddingTop-50 paddingBottom-100 bg-light-v2" id="list">
  <div class="container">
   <div class="row ">



  <div class="col-lg-9 order-2 order-lg-1">


<?php
if ( count( $list->list ) )
{

	foreach ( $list->list as $news )
	{
?>
     <div class="list-card align-items-center shadow-v1 mb-4">
       <div class="col-lg-5 px-lg-4 my-4">
	   <a href="./?module=news&id=<?php echo htmlspecialchars( $news->id ); ?>">
         <img class="w-100" src="<?php echo htmlspecialchars( $news->titleImage ); ?>" alt="">
		 </a>
       </div>
       <div class="col-lg-7 pr-lg-4 my-4">
         <a href="./?module=news&id=<?php echo htmlspecialchars( $news->id ); ?>" class="h4"><?php echo htmlspecialchars( $news->title ); ?></a>
         <p><?php echo htmlspecialchars( localdate( $news->postDate ) ); ?></p>
       </div>
     </div>
<?php

		$start_id = $news->id;
	}
}
else
{
?>
     <div class="list-card align-items-center shadow-v1 mb-4">
       <div class="col-lg-7 pr-lg-4 my-4">
			没有找到新闻
		</div>
	  </div>

<?php
}
?>



			<div class="text-center widget" id="next" style="display: none;">
            <a href="#" target="_blank" id="next_link"><img src="img/gengduo.png"></a>
          </div>

<script type="text/javascript" src="assets/js/jquery-3.5.0.min.js"></script>
<script type="text/javascript">
pagesize = <?php echo $pagesize;?>;
start_id = <?php echo $start_id; ?>;
news_count = <?php echo count( $list->list ); ?>;
has_next_record = <?php echo $list->hasNextRecord ? 'true' : 'false' ?>;

$(function(){

	toggle_page_div();

	$('#next_link').click(function(e){
		e.preventDefault();
		$.getJSON( "./?module=list.pure&cat=<?php echo $cat; ?>&cat2=<?php echo $cat2; ?>&pagesize="+pagesize+"&start_id="+start_id, function(data){
			$('#list').append(data.html);
			start_id = data.start_id;
			has_next_record = data.has_next_record;
			toggle_page_div();
		});
	});
});

function toggle_page_div() {
	if ( has_next_record ) {
		$('#next').show();
	}
	else {
		$('#next').hide();
	}
}
</script>




  </div> <!-- END col-lg-9 -->


	<?php include ROOT . '/tpl/sidenav.php'; ?>


   </div> <!-- END row-->

  </div> <!-- END container-->
</section>



<?php

include ROOT . '/tpl/footer.php';
