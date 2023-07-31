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



<!-- 列表展示 -->
  <section class="padding-y-lg-20">
     <div class="container">

       <div class="row">
          <div class="col-lg-9 mt-2">

      <div class="card">


        <div class="card-body px-0 pt-0">
         <h2 class="my-4"><?php echo htmlspecialchars( $news->title ); ?></h2>

         <div class="media align-items-center justify-content-between mb-4">
          <div class="media align-items-center">
             <div class="media-body"><?php echo htmlspecialchars( localdate( $news->postDate ) ); ?></div>
          </div>
         </div>

<?php
if ( $news->hasVideo() )
{
?>
                    <video id="player1" poster="<?php echo htmlspecialchars( $news->videoPoster ); ?>" preload="none" controls="" style="width: 100%;">
                       <source src="<?php echo htmlspecialchars( $news->video ); ?>" type="video/mp4" style="width: 100%;">
                     </video>
<?php
}
?>
                <?php echo $news->content; ?>

       </div> <!-- END card-body-->
      </div> <!-- END card-->



      </div>

	<?php include ROOT . '/tpl/sidenav.php'; ?>

      </div>

     </div>
  </section>

<!-- END 列表展示-->



<?php

include ROOT . '/tpl/footer.php';
