<?php
include ROOT . '/tpl/header.php';
include ROOT . '/tpl/course.nav.php';

?>


<section class=" mx-1">
    <div class="container">
        <div class="row mb-3">
            <div class="col-12  py-3">
                <h2 class="text-white text-center"><strong>课程报名</strong></h2>
            </div>
        </div>

        <div class="card shadow-v2">

            <div class="card-body p-4">
                <div class="row border-bottom pb-2">
                    <div class="col-12  font-size-16">
                        课程信息：
                    </div>
                    <div class="col-12 font-size-18 text-danger py-2">
                        <?php echo htmlspecialchars( $course[ 'title' ] ); ?><br><br>
                    </div>
                    <div class="col-12 font-size-14">
                        该课程已经报名<?php echo htmlspecialchars( $course[ 'count' ] ); ?>人
                    </div>
                </div>

                <div class="d-md-flex justify-content-between my-4">
                    <div class="form-group">
                        <label>姓名：</label>
                        <input type="text" id="name" class="form-control" required value="<?php echo htmlspecialchars($lastAppliedUserinfo['name'] ?? ''); ?>" />
                    </div>
                </div>
                <!--
                <div class="d-md-flex justify-content-between my-4">
                    <div class="form-group">
                        <label>手机号：</label>
                        <input type="text" id="mobile" class="form-control" required pattern="^1[3456789]\d{9}$" value=""/>
                    </div>
                </div>
                <div class="d-md-flex justify-content-between my-4 input-group input-group--focus">
                    <input	type="text"	class="form-control" placeholder="验证码" id="code" required value="" pattern="\d{4}"/>
                    <div class="input-group-append">
                        <a class="btn btn-outline-light input-group-text font-size-14" id="get_code">获取验证码</a>
                    </div>
                </div>
                -->
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

<div class="modal" tabindex="-1" role="dialog" id="alt-course_confimation">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">更改课程</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>您已经报过名了。确定要更改课程吗？</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-pill btn-info btn-sm px-3" id="b1">更改</button>
                <button type="button" class="btn btn-secondary btn-pill btn-info btn-sm px-3" data-dismiss="modal">不改了</button>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/vendors.bundle.js"></script>
<script src="assets/js/app.min.js"></script>
<script src="js/site.js"></script>
<script>
	let season = <?php echo $season; ?>;
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

            $.ajax("./?module=course.check.applied&season="+season+"&idcard="+encodeURIComponent(idcard)).done(function (data) {
                if (data.data) {
                    $('#alt-course_confimation').modal('show');
                }
                else {
                    apply_course(id, idcard, name);
                }
            });

            $('#b1').click(function () {
                $('#alt-course_confimation').modal('hide');
                apply_course(id, idcard, name, 1);
            });

            return false;
        });


        function apply_course( id, idcard, name, alt_course = 0 ) {
            $.ajax('./?module=course.apply&step=5&season='+season+'&id='+id+'&name='+name+'&idcard='+idcard+'&alt_course='+alt_course).done(function (data){
                if ( data.data.success ) {
                    show_message( "报名成功。", './?module=my.course');
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
