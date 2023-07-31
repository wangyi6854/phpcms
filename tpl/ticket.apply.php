<?php

include ROOT . '/tpl/header.php';
include ROOT . '/tpl/ticket.nav.php';

?>


<section class=" mx-1">
    <div class="container">
        <div class="row mb-3">
            <div class="col-12  py-3">
                <h2 class="text-white text-center"><strong>活动预约</strong></h2>
            </div>
        </div>

        <div class="card shadow-v2">

            <div class="card-body p-4">
                <div class="row border-bottom pb-2">
                    <div class="col-12  font-size-16">
                        活动名称：
                    </div>
                    <div class="col-12 font-size-18 text-danger py-2">
		                <?php echo htmlspecialchars( $course[ 'title' ] ); ?><br><br>
                    </div>
                    <div class="col-12  font-size-16">
                        活动时间：
                    </div>
                    <div class="col-12 font-size-18 text-danger py-2">
		                <?php echo htmlspecialchars( $course[ 'start' ] ); ?><br><br>
                    </div>
                    <div class="col-12  font-size-16">
                        活动地点：
                    </div>
                    <div class="col-12 font-size-18 text-danger py-2">
		                <?php echo htmlspecialchars( $course[ 'address' ] ); ?><br><br>
                    </div>
                    <div class="col-12 font-size-14">
                        已经申请<?php echo htmlspecialchars( $course[ 'count' ] ); ?>人
                    </div>
                </div>

                <div class="d-md-flex justify-content-between my-4">
                    <div class="form-group">
                        <label>姓名：</label>
                        <input type="text" id="name" class="form-control" required value="<?php echo htmlspecialchars($lastAppliedUserinfo['name'] ?? ''); ?>" />
                    </div>
                </div>

                <div class="d-md-flex justify-content-between my-4">
                    <div class="form-group">
                        <label>身份证号：</label>
                        <input type="text" id="idcard" class="form-control" value="<?php echo htmlspecialchars($lastAppliedUserinfo['idcard'] ?? ''); ?>"required pattern="(^[1-9]\d{5}(18|19|([23]\d))\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$)|(^[1-9]\d{5}\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}$)" />
                    </div>
                </div>

				<div class="d-md-flex justify-content-between my-4">
					<div class="form-group">
						<label>街道：</label>
						<select name="street" class="form-control">
							<option value=""></option>
							<option value="八大峡街道"></option>
							<option value="云南路街道"></option>
							<option value="中山路街道"></option>
							<option value="江苏路街道"></option>
							<option value="八大关街道"></option>
							<option value="湛山街道"></option>
							<option value="香港中路街道"></option>
							<option value="金湖路街道"></option>
							<option value="八大湖街道"></option>
							<option value="金门路街道"></option>
							<option value="珠海路街道"></option>
						</select>
					</div>
				</div>

                <div class="d-md-flex justify-content-between my-4">
                    <button class="btn btn-block btn-danger" id="b">提交预约</button>
                </div>

            </div>



        </div>


        <!-- END row-->
    </div>
    <!-- END container-->
</section>

<div class="modal" tabindex="-1" role="dialog" id="alt-course_confimation">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">活动预约</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>您已经预约过了。</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-pill btn-info btn-sm px-3" data-dismiss="modal">好的</button>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/vendors.bundle.js"></script>
<script src="assets/js/app.min.js"></script>
<script src="js/site.js"></script>
<script>
    $(function() {
        $('#get_code').click(function (){
            if ( $(this).prop('disabled') ) {
                return false;
            }

            var mobile = $('#mobile').val();
            if (is_mobile(mobile)) {
                $(this).prop('disabled', true);

                $.ajax('./?module=message.send&mobile='+mobile);
                show_message( '验证码已发送' );
                start_timer(60, '#get_code', function (label){
                    $('#get_code').text(label).prop('disabled', false);
                });
            }
            else {
                show_message( '手机号码格式不对' );
            }
        });

        $('#b').click(function (){
            var id = <?php echo $id; ?>;
            /*
            var mobile = $('#mobile').val();
            if (!is_mobile(mobile)) {
                show_message('手机号码格式不对');
                return false;
            }

            var code = $('#code').val();
            if ( !/\d{4}/.test(code) ) {
                show_message('验证码格式不对');
                return false;
            }

             */

            var name = $('#name').val();
            if ( !name.length ) {
                show_message('请填写姓名');
                return false;
            }

            var idcard = $('#idcard').val();
            if ( !/(^[1-9]\d{5}(18|19|([23]\d))\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$)|(^[1-9]\d{5}\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}$)/.test(idcard) ) {
                show_message('身份证号格式不对');
                return false;
            }

            $.ajax("./?module=ticket.check.applied&id="+id+"&idcard="+encodeURIComponent(idcard)).done(function (data) {
                if (data.data) {
                    $('#alt-course_confimation').modal('show');
                }
                else {
                    apply_ticket(id, idcard, name);
                }
            });

            $('#b1').click(function () {
                //$('#alt-course_confimation').modal('hide');
                //apply_course(id, idcard, name, 1);
            });

            return false;
        });


        function apply_ticket( id, idcard, name ) {
            $.ajax('./?module=ticket.apply&step=3&id='+id+'&name='+name+'&idcard='+idcard).done(function (data){
                if ( data.data.success ) {
                    show_message( "预约成功。", './?module=my.ticket');
                }
                else {
                    show_message(data.data.message);
                }
                return false;
            });
        }
    });
</script>

<?php
include ROOT . '/tpl/footer.php';
?>
