
          <!--视频列表-->
          <div class="widget marginTop-20 marginBottom-15">
              <h2 class="widget-title border-bottom border-light mb-10">
                <a href="./?module=list&cat=13">视频</a>
                <div class="ml-1 width-4rem bg-darkpuple height-2 mt-2"></div>
              </h2>
<?php

foreach ( $app->liteList( 13, 6 )->list as $n )
{
?>
              <div class="list-card align-items-center border-bottom border-light ">
                <div class="col-lg-5 col-5 pr-m">
                  <a href="./?module=news&id=<?php echo $n->id; ?>" target="_blank">
				  <div class="ar66">
				  <img class="w-100" src="<?php echo htmlspecialchars( $n->videoPoster ); ?>" alt="">
				  </div>
				  </a>

                </div>
                <div class="col-lg-7 col-7 pr-m ">
                  <div class="media justify-content-between">
                    <div class="group">
                      <div class="text-line"><a href="./?module=news&id=<?php echo $n->id; ?>" target="_blank" class="font-size-16 "><?php echo htmlspecialchars( $n->title ); ?></a></div>
                    </div>
                  </div>
                </div>
              </div>
<?php
}
?>
			</div>
            <!--视频列表end-->
