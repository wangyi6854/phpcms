<?php
ob_start();

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

$html = ob_get_clean();

echo json_encode( [
	'html'		=> $html,
	'start_id'	=> $start_id,
	'has_next_record'	=> $list->hasNextRecord,
] );

