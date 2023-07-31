<?php

setcookie( session_name(), '', 0 );
session_destroy();

header('Location: ./');
exit();