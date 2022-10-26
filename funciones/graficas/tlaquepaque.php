<?php
    require "../conexion.php";
    $conn = conexion(); //conexion a la BD
    $sql = "SELECT COUNT(*) FROM reportes WHERE zona = 'tlaquepaque' AND fecha > CURRENT_DATE - INTERVAL '1' MONTH";
    $res = pg_query($conn,$sql);
    if($res != 0){
        $sql1="SELECT COUNT(*) FROM reportes WHERE tipo = 1 AND estatus = 1 AND zona = 'tlaquepaque' AND fecha > CURRENT_DATE - INTERVAL '1' MONTH";
        $result1=pg_query($conn,$sql1);
        while($ver=pg_fetch_row($result1)) {
            $valores[0]=$ver[0];
        }
    
        $sql2="SELECT COUNT(*) FROM reportes WHERE tipo = 2 AND estatus = 1 AND zona = 'tlaquepaque' AND fecha > CURRENT_DATE - INTERVAL '1' MONTH";
        $result2=pg_query($conn,$sql2);
        while($ver2=pg_fetch_row($result2)) {
            $valores[1]=$ver2[0];
        }

        $sql3="SELECT COUNT(*) FROM reportes WHERE tipo = 3 AND estatus = 1 AND zona = 'tlaquepaque' AND fecha > CURRENT_DATE - INTERVAL '1' MONTH";
        $result3=pg_query($conn,$sql3);
        while($ver3=pg_fetch_row($result3)) {
            $valores[2]=$ver3[0];
        }

        $sql4="SELECT COUNT(*) FROM reportes WHERE tipo = 4 AND estatus = 1 AND zona = 'tlaquepaque' AND fecha > CURRENT_DATE - INTERVAL '1' MONTH";
        $result4=pg_query($conn,$sql4);
        while($ver4=pg_fetch_row($result4)) {
            $valores[3]=$ver4[0];
        }

        $sql5="SELECT COUNT(*) FROM reportes WHERE tipo = 5 AND estatus = 1 AND zona = 'tlaquepaque' AND fecha > CURRENT_DATE - INTERVAL '1' MONTH";
        $result5=pg_query($conn,$sql5);
        while($ver5=pg_fetch_row($result5)) {
            $valores[4]=$ver5[0];
        }

        $datos=json_encode($valores);
    }
?>

<div id="ultimo_mes_tlaquepaque"></div>
   
<script>
  function CrearCadenaPastel(json){
      var parsed = JSON.parse(json);
      var arr =[];
      for(var x in parsed) {
           arr.push(parsed[x]);
      }
      return arr;
   }
</script>

<script>
    <?php if(isset($datos)){ ?>
    var datos = CrearCadenaPastel('<?php echo $datos ?>');
	
	var data = [{
	  values: datos,
	  labels: ['Asalto', 'Accidente', 'Acoso', 'Precaución', 'Otro'],
	  type: 'pie'
	}];

	var layout = {
	  height: 300,
	  width: 400
	};

	Plotly.newPlot('ultimo_mes_tlaquepaque', data, layout);
    <?php } ?>
</script>