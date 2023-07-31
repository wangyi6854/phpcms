       <div class="card  shadow-v1 border border-light">
         <h6 class="card-header border-bottom mb-0 fin-16p pl-3 pb-2 pt-2"><i class="ti-medall pr-1"></i>热点资讯</h6>
         <ul class="card-body list-unstyled pl-md-3 pt-3 pr-2 pb-1">
<?php

foreach ( $sidenav_news->list as $n )
{
?>
          <li class="mb-2  fin-14p"><a href="./?module=news&id=<?php echo $n->id; ?>"><?php echo htmlspecialchars( $n->title ); ?></a></li>
<?php
}
?>

         </ul>
       </div>

