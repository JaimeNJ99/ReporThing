<?php
    require "../conexion.php";
    require "../conexionReplica.php";
    $conn = conexion(); //conexion a la BD
    $bandera=0;
    if(!$conn){
      $bandera=1;
      $conn=conexionR();
    }

    $sql1="SELECT COUNT(*) FROM reportes WHERE tipo = 1 AND estatus = 1";
    $result1=pg_query($conn,$sql1);
    
    while($ver=pg_fetch_row($result1)) {
        $valores[0]=$ver[0];
    }
    
    $sql2="SELECT COUNT(*) FROM reportes WHERE tipo = 2 AND estatus = 1";
    $result2=pg_query($conn,$sql2);
    while($ver2=pg_fetch_row($result2)) {
        $valores[1]=$ver2[0];
    }

    $sql3="SELECT COUNT(*) FROM reportes WHERE tipo = 3 AND estatus = 1";
    $result3=pg_query($conn,$sql3);
    while($ver3=pg_fetch_row($result3)) {
        $valores[2]=$ver3[0];
    }

    $sql4="SELECT COUNT(*) FROM reportes WHERE tipo = 4 AND estatus = 1";
    $result4=pg_query($conn,$sql4);
    while($ver4=pg_fetch_row($result4)) {
        $valores[3]=$ver4[0];
    }

    $sql5="SELECT COUNT(*) FROM reportes WHERE tipo = 5 AND estatus = 1";
    $result5=pg_query($conn,$sql5);
    while($ver5=pg_fetch_row($result5)) {
        $valores[4]=$ver5[0];
    }

    $datos=json_encode($valores);
?>

<div id="total_reportes"></div>
   
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

	Plotly.newPlot('total_reportes', data, layout);
</script>