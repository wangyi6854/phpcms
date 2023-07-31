<?php
include ROOT . '/tpl/header.php';

?>

    <!--主体-->


    <section class="paddingBottom-50 bg-light">
        <div class="container">
            <div class="row">
                <!-- 左边 -->
                <!-- 列表新闻 -->
                <div class="col-lg-8">
				   <div class="card marginTop-20">
					<div class="card-body">
					  <div class="text-white bg-white font-size-12 my-0">
						<div class="row align-items-center">
						  <ol class="breadcrumb justify-content-md-end bg-transparent text-v2 mb-2">
							<li class="breadcrumb-item">
							  <a href="./">首页</a>
							</li>
							<li class="breadcrumb-item">
							  <?php echo htmlspecialchars( $newscat->name ); ?>
							</li>
						  </ol>
						</div>
					  </div>
				  </div>
				  </div>

                    <div class="bg-white ">
                        <div class="container">

			<div id="list">

<?php
if ( count( $list->list ) )
{

	foreach ( $list->list as $k => $news )
	{
		if ( $k % 4 == 0 )
		{
?>
                            <div class="row mt-3 border-bottom border-light paddingTop-20">
<?php
		}
		if ( $news->titleImage )
		{
?>
                                <div class="col-lg-3 col-md-6 col-6 padding-10">
                                    <div class="card height-100p">
                                        <a href="./?module=news&id=<?php echo htmlspecialchars( $news->id ); ?>" target="_blank">
										   <div class="ar150">
												<img class="card-img-top" src="<?php echo htmlspecialchars( $news->titleImage ); ?>" alt="<?php echo htmlspecialchars( $news->title ); ?>">
											</div>
										</a>
                                        <div class="pt-3 px-1">
                                            <a href="./?module=news&id=<?php echo htmlspecialchars( $news->id ); ?>" target="_blank" class="font-size-16 text-ws"><?php echo htmlspecialchars( $news->title ); ?></a>
                                            <p class="font-size-12"><?php echo htmlspecialchars( localdate( $news->postDate ) ); ?></p>
                                        </div>
                                    </div>
                                </div>
<?php
		}

		$start_id = $news->id;

		if ( $k % 4 == 3 )
		{
?>
                            </div>
<?php
		}
	}

	if ( count( $list->list ) % 4 != 0 )
	{
?>
                            </div>
<?php
	}
}
else
{
?>
          <div class="list-card align-items-center border-bottom border-light">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12  padding-lg-15 pr-0  pl-0">
              <div class="media justify-content-between  ">
                <div class="group">
                	没有找到新闻
                </div>
              </div>
            </div>
            <hr class="simple d-sm-block d-md-none" color="#6f5499" />
          </div>

<?php
}
?>
        </div>

          <div class="text-center widget" id="next" style="display: none;">
            <a href="#" target="_blank" id="next_link"><img src="img/gengduo.png"></a>
          </div>


        </div>
        </div>
        </div>
        <!--列表新闻end  -->
        <!--左边 END  -->

        <!-- 右边 -->
		<?php include ROOT . '/tpl/sidenav.php'; ?>
        <!-- 右边END -->
      </div>
      <!-- END row-->
    </div>
    <!-- END container-->
  </section>



  <!--主体end-->

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
		$.getJSON( "./?module=list.pure&cat=<?php echo $cat; ?>&pagesize="+pagesize+"&start_id="+start_id, function(data){
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


<?php

include ROOT . '/tpl/footer.php';
