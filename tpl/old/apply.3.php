			<!-- 3 -->
  			<div id="s3" style="display: none;">
             <div class="row form-group">
<?php
foreach ( $jibie_enum as $n )
{
?>
					<label class="ec-checkbox check-outline mb-3 mr-4">
						<input type="checkbox" name="jibie[]" value="<?php echo $n; ?>"  <?php if ( in_array( $n, $people->jibie ) ) echo 'checked';?> required>
						<span class="ec-checkbox__lebel pr-2"><?php echo $n; ?></span>
						<span class="ec-checkbox__control"></span>
					</label>
<?php
}
?>
              </div>
              <div class="row">
               	  <div class="col-6 text-right">
               	    <a href="" class="btn btn-icon btn-outline-light mb-3  btn-step" data-step="2">
                     <i class="ti-angle-double-left mr-2"></i>
                     <span>上一步</span>
                    </a>
                 </div>
                 <div class="col-6">
                 	  <a href="" class="btn btn-icon btn-primary mr-2 mb-3 btn-step" data-step="4">
                     <span>继续</span>
                     <i class="ti-angle-double-right ml-2"></i>
                    </a>
                 </div>
              </div>
            </div>
			<!-- 3 end -->
