<?php
echo 1;

register_shutdown_function(function () {echo 3;});
$a = new class {public function __destruct() {echo 4;}};

fastcgi_finish_request(); // This line will be commented out for discussion purpose.

// NOTE: any code starting from here still gets executed no matter if function fastcgi_finish_request() is called or not.

echo 2;
exit();
echo 5; // Unreachable code.
?>