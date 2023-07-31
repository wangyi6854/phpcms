			<!-- 4 -->
 			<div id="s4" style="display: none;">
             <div class="row form-group  py-2  py-4">
                <label for="example-textarea" class="col-lg-3 col-form-label ">1寸免冠彩色照片:</label>
				<div id="p1" class="image-con">
<?php
foreach ( $people->photo as $p )
{
?>
<div class="col-sm-1 col-md-3 col-lg-3 pr-lg-0 img-con">
	<div class="img-wrap">
		<span class="close">&times;</span>
		<img src="<?php echo htmlspecialchars( $p->path ); ?>" data-id="<?php echo htmlspecialchars( $p->id ); ?>">
		<input type="hidden" name="photo[]" value="<?php echo htmlspecialchars( $p->id ); ?>">
	</div>
</div>

<?php
}
?>
				</div>
                <div  class="col-sm-5 col-md-5 col-lg-5 pt-2">    
                     <button class="btn btn-icon btn-info btn-xs btn-up" data-target="p1">
                       <i class="ti-export mr-2"></i>
                       上传照片
                     </button>
                     <p class="mb-0"><small>（1寸免冠彩色照片）</small> </p>
                </div>
              </div>

               <div class="row form-group py-2  py-4">
                <label for="example-textarea" class="col-lg-3 col-form-label">身份证正面上传:</label>
				<div id="p2" class="image-con">

<?php
if ( $p = $people->idcard[ 0 ] )
{
?>
					<div class="col-sm-2 col-md-2 col-lg-3 pr-0 img-con">
						<div class="img-wrap">
							<span class="close">&times;</span>
							<img src="<?php echo htmlspecialchars( $p->path ); ?>" data-id="<?php echo htmlspecialchars( $p->id ); ?>">
							<input type="hidden" name="idcard[]" value="<?php echo htmlspecialchars( $p->id ); ?>">
						</div>
					</div>
<?php
}
?>

				</div>
                	<div  class="col-sm-5 col-md-5 col-lg-5 pt-2">                		
                     <button class="btn btn-icon btn-info btn-xs btn-up " data-target="p2">
                       <i class="ti-export mr-2"></i>
                       上传照片
                     </button>
                      <p class="mb-0"><small>（身份证正面上传）</small> </p>

                  </div>
              </div>

               <div class="row form-group  py-2  py-4">
                <label for="example-textarea" class="col-lg-3 col-form-label">身份证反面上传:</label>
				<div id="p3" class="image-con">

<?php
if ( $p = $people->idcard[ 1 ] )
{
?>
					<div class="col-sm-2 col-md-2 col-lg-3 pr-0 img-con">
						<div class="img-wrap">
							<span class="close">&times;</span>
							<img src="<?php echo htmlspecialchars( $p->path ); ?>" data-id="<?php echo htmlspecialchars( $p->id ); ?>">
							<input type="hidden" name="idcard[]" value="<?php echo htmlspecialchars( $p->id ); ?>">
						</div>
					</div>
<?php
}
?>

				</div>
                	<div  class="col-sm-5 col-md-5 col-lg-5 pt-2">
                		 
                     <button class="btn btn-icon btn-info btn-xs btn-up " data-target="p3">
                       <i class="ti-export mr-2"></i>
                       上传照片
                     </button>
                     <p class="mb-0"><small>（身份证反面上传）</small> </p>

                  </div>
              </div>

              <div class="row form-group  py-2  py-4">
                <label for="example-textarea" class="col-lg-3 col-form-label ">证书上传:</label>
               <div  class="col-3  pt-2">                	   
                     <button class="btn btn-icon btn-info btn-xs btn-up " data-target="p4">
                       <i class="ti-export mr-2"></i>
                       上传照片
                     </button>
                     <p class="mb-0"><small>（证书照片上传）</small> </p>
                </div>
                <div class="col-6 ">
                	 <div class="row image-con" id="p4">
<?php
foreach ( $people->cert as $p )
{
?>
<div class="col-sm-6 col-md-4 col-lg-4 pr-0 pb-1 img-con">
	<div class="img-wrap">
		<span class="close">&times;</span>
		<img src="<?php echo htmlspecialchars( $p->path ); ?>" data-id="<?php echo htmlspecialchars( $p->id ); ?>">
		<input type="hidden" name="cert[]" value="<?php echo htmlspecialchars( $p->id ); ?>">
	</div>
</div>

<?php
}
?>
                   </div>
                </div>

              </div>
              <div class="row">
               	  <div class="col-6 text-right">
               	    <a href="" class="btn btn-icon btn-outline-light mb-3  btn-step" data-step="3">
                     <i class="ti-angle-double-left mr-2"></i>
                     <span>上一步</span>
                    </a>
                 </div>
                 <div class="col-6">
                 	  <a href="" class="btn btn-icon btn-primary mr-2 mb-3 btn-step" data-step="5">
                     <span>继续</span>
                     <i class="ti-angle-double-right ml-2"></i>
                    </a>
                 </div>
              </div>
            </div>
			<!-- 4 end -->
