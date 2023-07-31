			<!-- 1 -->
			<div id="s1" style="display: none;">
             <div class="row form-group">
                <label for="name" class="col-3 col-form-label text-right">姓名:</label>
                <div class="col-9">
                  <input class="form-control" type="text" name="name" placeholder="" value="<?php echo htmlspecialchars( $people->name ); ?>" id="name" required>
                </div>
              </div>
              <div class="row form-group">
                <label for="sex" class="col-3 col-form-label text-right">性别:</label>
                <div class="col-9">
                  <div class="input-group mb-3">
                    <select class="form-control custom-select" name="sex" id="sex" required>
                      <option value="女" <?php if ( $people->sex == '女' ) echo 'selected="selected"';?>>女</option>
                      <option value="男" <?php if ( $people->sex == '男' ) echo 'selected="selected"';?>>男</option>
                    </select>
                  </div>
                </div>
              </div>

               <div class="row form-group">
                <label for="age" class="col-3 col-form-label text-right">年龄:</label>
                <div class="col-2  pr-0">
                  <input class="form-control" type="number" min="18" max="70" placeholder="" id="age" name="age" value="<?php echo htmlspecialchars( $people->age ); ?>" required>
                </div>
                <div class="col-1  pt-2">岁</div>
              </div>
               <div class="row form-group">
                <label for="mobile" class="col-3 col-form-label text-right">手机号:</label>
                <div class="col-9">
                  <input class="form-control" type="tel" pattern="1[3456789]\d{9}" placeholder="" id="mobile" name="mobile" value="<?php echo htmlspecialchars( $people->mobile ); ?>" required>
                </div>
              </div>

               <div class="row form-group">
                <label for="company" class="col-3 col-form-label text-right">所属公司/机构:</label>
                <div class="col-9">
                  <input class="form-control" type="text" id="company" name="company" value="<?php echo htmlspecialchars( $people->company ); ?>" required>
                </div>
              </div>
               <div class="row form-group">
                <label for="shuxiang" class="col-3 col-form-label text-right">属相:</label>
                <div class="col-9">
<?php
foreach ( $shuxiang_enum as $n )
{
?>
					<label class="ec-radio check-outline mb-3 mr-4">
						<input type="radio" name="shuxiang" value="<?php echo $n; ?>" <?php if ( $people->shuxiang == $n ) echo 'checked';?> required>
						<span class="ec-radio__lebel pr-2"><?php echo $n; ?></span>
						<span class="ec-radio__control"></span>
					</label>
<?php
}
?>
                </div>
              </div>
               <div class="row form-group">
                <label for="quyu" class="col-3 col-form-label text-right">服务区域:</label>
                <div class="col-9">
<?php
foreach ( $quyu_enum as $n )
{
?>
					<label class="ec-checkbox check-outline mb-3 mr-4">
						<input type="checkbox" name="quyu[]" value="<?php echo $n; ?>" <?php if ( in_array( $n, $people->quyu ) ) echo 'checked';?> required>
						<span class="ec-checkbox__lebel pr-2"><?php echo $n; ?></span>
						<span class="ec-checkbox__control"></span>
					</label>
<?php
}
?>
				</div>
              </div>
              <div class="row form-group">
                <label for="jingyan" class="col-3 col-form-label text-right">工作时间:</label>
                <div class="col-2  pr-0">
                  <input class="form-control" type="num" id="jingyan" name="jingyan" min="0" max="70" value="<?php echo htmlspecialchars( $people->jingyan ); ?>" required>
                </div>
                <div class="col-1  pt-2">年</div>
              </div>

              <div class="row form-group">
                <label for="techang" class="col-3 col-form-label text-right">特长:</label>
                <div class="col-9">
<?php
foreach ( $neirong_enum as $n )
{
?>
					<label class="ec-checkbox check-outline mb-3 mr-4">
						<input type="checkbox" name="neirong[]" value="<?php echo $n; ?>" <?php if ( in_array( $n, $people->neirong ) ) echo 'checked';?> required>
						<span class="ec-checkbox__lebel pr-2"><?php echo $n; ?></span>
						<span class="ec-checkbox__control"></span>
					</label>
<?php
}
?>
                  <textarea class="form-control" rows="5" id="techang" name="techang" maxlength="255"><?php echo htmlspecialchars( $people->techang ); ?></textarea>
                </div>
              </div>
              <div class="row">
               	  <div class="col-6 text-right">
                 </div>
                 <div class="col-6">
                 	  <a href="" class="btn btn-icon btn-primary mr-2 mb-3 btn-step" data-step="2">
                     <span>继续</span>
                     <i class="ti-angle-double-right ml-2"></i>
                    </a>
                 </div>
              </div>
			</div>
			<!-- 1 end -->
