<?php
include ROOT . '/tpl/header.php';
include ROOT . '/tpl/venue.nav.php';

?>


<section class=" mx-1">
	<div class="container">
		<div class="row mb-3">
			<div class="col-12  py-3">
				<h2 class="text-white text-center">
                    <strong><?php echo $LHT ? '展厅预约' : '场馆预约'; ?></strong>
                </h2>
			</div>
		</div>

		<div class="card shadow-v2">

			<div class="card-body p-4">
				<div class="row border-bottom pb-2">
					<div class="col-12  font-size-16">
						<?php echo $LHT ? '展厅' : '场馆'; ?>信息：
					</div>
					<div class="col-12 font-size-18 text-danger py-2">
						<?php echo htmlspecialchars( $venueSchedule->name ); ?><br>
                        <div class="font-size-14 text-danger">
						<?php echo date( 'Y-m-d', $date ); ?> <?php echo date( 'H:i', strtotime( $venueSchedule->periodFrom ) ); ?>-<?php echo date( 'H:i', strtotime( $venueSchedule->periodTo ) ); ?><br>
                        </div>
                    </div>
					<div class="col-12 font-size-14">
                        该时间段已经预约<?php echo htmlspecialchars( $venueSchedule->count ); ?>人
					</div>
				</div>

				<div class="d-md-flex justify-content-between my-4">
					<div class="form-group">
						<label>姓名：</label>
						<input type="text" id="name" class="form-control" required value="<?php echo htmlspecialchars($lastAppliedUserinfo['user_name'] ?? ''); ?>" />
					</div>
				</div>
				<div class="d-md-flex justify-content-between my-4">
					<div class="form-group">
						<label>身份证号：</label>
						<input type="text" id="idcard" class="form-control" value="<?php echo htmlspecialchars($lastAppliedUserinfo['idcard'] ?? ''); ?>"required pattern="(^[1-9]\d{5}(18|19|([23]\d))\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$)|(^[1-9]\d{5}\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}$)" />
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

            apply_venue(id, idcard, name, 1);

            return false;
        });

        function apply_venue( id, idcard, name ) {
            $.ajax('./?module=venue.apply&step=4&id='+id+'&name='+name+'&idcard='+idcard+'&date='+<?php echo rawurlencode( $date ); ?>).done(function (data){
                if ( data.data.success ) {
                    show_message( data.data.message, './?module=my.venue&venue=<?php echo rawurlencode($venue); ?>');
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
