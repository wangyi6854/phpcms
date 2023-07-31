<?php
ob_start();

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

$html = ob_get_clean();

echo json_encode( [
	'html'		=> $html,
	'start_id'	=> $start_id,
	'has_next_record'	=> $list->hasNextRecord,
] );

