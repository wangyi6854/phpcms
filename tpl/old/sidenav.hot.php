            <!-- 文章列表 -->
            <div class="widget marginTop-15 marginBottom-15">
                <h2 class="widget-title border-bottom border-light mb-10">
                  <a href="./?module=list&cat=16">热门关注</a>
                  <div class="ml-1 width-4rem bg-darkpuple height-2 mt-2"></div>
                </h2>
                <ul class="font-size-16">
<?php

foreach ( $app->liteList( 16, 6 )->list as $n )
{
?>
                  <li><a href="./?module=news&id=<?php echo $n->id; ?>" target="_blank"><?php echo htmlspecialchars( $n->title ); ?></a></li>
<?php
}
?>
                </ul>
              </div>
              <!--文章列表end-->
