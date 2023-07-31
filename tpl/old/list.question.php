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



<section class="paddingTop-50 paddingBottom-100 bg-light-v2 ">
  <div class="container ">
   <div class="row">



     <div class="col-md-9">
        <div id="accordion-6" class="list-group accordion-style-6 ">



<?php
if ( count( $list->list ) )
{

	foreach ( $list->list as $news )
	{
?>
          <div class="accordion-item list-group-item">
           <a href="#acc6_2" class="accordion__title fin-16p py-1 mb-0 collapsed" data-toggle="collapse" aria-expanded="true">
            <h5 class="fin-16p">
             <span class="accordion__icon small mr-2">
              <i class="ti-angle-down"></i>
              <i class="ti-angle-up"></i>
            </span>
            <?php echo htmlspecialchars( $news->title ); ?>
            </h5>
           </a>
            <div id="acc6_2" class="collapse" data-parent="#accordion-6">
              <div class="pt-3">
                 <p class="fin-14p"><?php echo nl2br( strip_tags( $news->content ) ); ?></p>
              </div>
            </div>
          </div> <!-- END accordion-item-->
<?php
	}
}
else
{
?>
     <div class="list-card align-items-center shadow-v1 mb-4">
       <div class="col-lg-7 pr-lg-4 my-4">
			没有找到问答
		</div>
	  </div>

<?php
}
?>



        </div>
      </div> <!-- END col-lg-9 -->


	<?php include ROOT . '/tpl/sidenav.php'; ?>


   </div> <!-- END row-->

  </div> <!-- END container-->
</section>



<?php

include ROOT . '/tpl/footer.php';

