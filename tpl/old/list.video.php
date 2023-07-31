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



 <!--01视频 -->
<section class="padding-y-100 ">
  <div class="container">
    <div class="row">

      <div class="col-12">
      <div class="tab-content">
        <div class="tab-pane fade show active" id="tab1" role="tabpanel">
          <div class="row" id="list">

<?php
if ( count( $list->list ) )
{

	foreach ( $list->list as $news )
	{
?>
            <div class="col-lg-3 col-md-6 marginTop-30 ">
              <div class="card text-gray overflow-hidden shadow-v3 border-light">
               <span class=" lf-topge   font-size-sm bg-success text-white fin-12p">免费</span>
                <img class="card-img-top" src="<?php echo htmlspecialchars( $news->titleImage ); ?>" alt="">
                <div class="p-3">
                  <h5  class="fin-16p"><?php echo htmlspecialchars( $news->title ); ?></h5>
                  <p class="mb-0 fin-12p"><?php echo htmlspecialchars( $news->summary ); ?></p>
                </div>
                <div class="card-footer media align-items-center justify-content-between p-3">
                  <ul class="list-unstyled mb-0">
                  </ul>
                  <h4 class="h5">
                    <span class="text-primary"> <a href="./?module=news&id=<?php echo htmlspecialchars( $news->id ); ?>" class=" btn btn-primary btn-sm left-20 "> 观看视频</a></span>
                  </h4>
                </div>
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
		$.getJSON( "./?module=list.video.pure&cat=<?php echo $cat; ?>&cat2=<?php echo $cat2; ?>&pagesize="+pagesize+"&start_id="+start_id, function(data){
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


          </div>
        </div>
      </div>
      </div>


  </div>
</section>
<!-- END 01视频-->



<?php

include ROOT . '/tpl/footer.php';
