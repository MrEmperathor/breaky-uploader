<?php
    $url = $_GET['u'];
    echo shell_exec("python3.7 /var/www/html/panel2/panel/inc/include/fembed_720.py -L '".$url."'");
?>
