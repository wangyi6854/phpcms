<?php
ob_start();

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

$html = ob_get_clean();

echo json_encode( [
	'html'		=> $html,
	'start_id'	=> $start_id,
	'has_next_record'	=> $list->hasNextRecord,
] );

