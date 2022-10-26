<?php
    date_default_timezone_set('America/Mexico_City');
    if(isset($_REQUEST['zona'])){
        $zona = $_REQUEST['zona'];
        $latitud = $_REQUEST['latitud'];
        $longitud = $_REQUEST['longitud'];
        $hora = date("H");
        
        $out = shell_exec("python ../KNN/tipoSucesoknn.py $zona $hora $latitud $longitud");
        if($out == 1){
            $out = 'Asalto';
        }else if($out == 2){
            $out = 'Accidente';   
        }else if($out == 3){
            $out = 'Acoso';   
        }else if($out == 4){
            $out = 'Precaución';   
        }else if($out == 5){
            $out = 'Otro';   
        }
        echo $out;
    }
?>