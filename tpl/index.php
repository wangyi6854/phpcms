<?php
include ROOT . '/tpl/header.php';
include ROOT . '/tpl/course.nav.php';

?>

<section class="paddingTop-10 ">
    <div class="container">
        <div class="row ">
            <div class="col-11 mx-auto">
                <div class="card shadow-v2">
                    <div class="col-lg-12 text-center mt-5">
                        <div  style="width:60px" class="mx-auto"><img src="assets/img/logo-1.jpg"></div>
                        <p class="font-size-20 text-drak mt-3">市南区文化馆</p>
                    </div>
                    <div class="card-body">

                        <form action="#" method="POST" class="px-lg-4" id="f">
                            <div class="form-group mb-4 ">
                                <input	type="text"	class="form-control rounded" id="mobile" name="mobile"	placeholder="手机号"/>
                            </div>
                            <div class="input-group input-group--focus mb-4">
                                <input	type="text"	class="form-control" placeholder="验证码" name="code" id="code" @keyup.native="checkcodeInput" maxlength="4"	/>
                                <div class="input-group-append">
                                    <a class="btn btn-outline-light input-group-text font-size-14" id="get_code">获取验证码</a>
                                </div>
                            </div>
                            <div class="d-md-flex justify-content-between my-4">
                                <a href="" class="btn btn-block btn-danger" id="login">登录</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- END row-->
    </div>
    <!-- END container-->
</section>

<script src="assets/js/vendors.bundle.js"></script>
<script src="assets/js/app.min.js"></script>

<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/site.js"></script>
<script>
    $.noConflict();
    jQuery( document ).ready(function( $ ) {
        $('#get_code').click(function (){
            if ( $(this).prop('disabled') ) {
                return false;
            }

            var mobile = $('#mobile').val();
            if (is_mobile(mobile)) {
                $(this).prop('disabled', true);

                $.ajax('./?module=message.send&mobile='+mobile, function (data) {});
                show_message( '验证码已发送' );
                start_timer(60, '#get_code', function (label){
                    $('#get_code').text(label).prop('disabled', false);
                });
            }
            else {
                show_message( '手机号码格式不对' );
            }
        });

        $('#login').click(function (){
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

            $.ajax('./?module=login&mobile='+mobile+'&code='+code).done(function (data){
                if ( data.data ) {
                    window.location = '<?php echo $_SESSION[ 'return_to' ] ?? './?module=my.course'?>';
                    return false;
                }
                else {
                    show_message('验证码错误');
                    return false;
                }
            });

            return false;
        });
    });
</script>



<?php
include ROOT . '/tpl/footer.php';
?>
