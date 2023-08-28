<?php include ROOT . '/tpl/admin.header.php'; ?>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">


  <div class="help-block text-center">
      <?php echo $message; ?>

      <?php
      if ( $return_to )
      {
          ?>
          <div class="buttons">
              <div class="pull-left"><a href="<?php echo htmlspecialchars( $return_to ); ?>" class="btn"><i class="icon-arrow-left"></i>返回</a></div>
          </div>
      <?php
      if ( !defined( 'DEBUG' ) )
      {
      ?>
          <script>
              setTimeout(function(){
                      window.close();
                      window.location = <?php echo json_encode( $return_to ); ?>;
                  },
                  <?php echo $timeout; ?>000
              );
          </script>
          <?php
      }
      }
      ?>
  </div>

</div>
<!-- /.center -->


<?php include ROOT . '/tpl/admin.footer.script.php'; ?>


<?php include ROOT . '/tpl/admin.footer.php';

