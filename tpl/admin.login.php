<?php
require_once ROOT . '/tpl/admin.header.php';
?>
<body class="hold-transition login-page dark-mode">
<div class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <b><?php echo $config[ 'site_name' ]; ?></b>
        </div>
        <div class="card-body">
            <p class="login-box-msg">登录</p>

            <form action="./?module=admin.login" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="username" placeholder="用户名">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="密码">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-block">登录</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>


        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <div class="card" id="debug-message"></div>
</div>
<!-- /.login-box -->


<!-- jQuery -->
<script src="lib/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="lib/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="lib/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>






</body></html>