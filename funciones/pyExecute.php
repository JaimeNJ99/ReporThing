<?php
    if(isset($_REQUEST['zona'])){
        $zona = $_REQUEST['zona'];
        $hora = date("H");
        $out = shell_exec("python ../KNN/tipoSucesoknn.py '$zona' '$hora'");
        echo $out; 
    }
?>