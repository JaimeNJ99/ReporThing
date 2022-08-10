<?php
    require "../conexion.php";
    $conn = conexion(); //conexion a la BD

    $sql1="SELECT COUNT(*) FROM reportes WHERE tipo = 1 AND estatus = 1 AND zona = 'tonala' AND fecha > (NOW() - INTERVAL 1 MONTH)";
    $result1=mysqli_query($conn,$sql1);
    
    while($ver=mysqli_fetch_row($result1)) {
        $valores[0]=$ver[0];
    }
    
    $sql2="SELECT COUNT(*) FROM reportes WHERE tipo = 2 AND estatus = 1 AND zona = 'tonala' AND fecha > (NOW() - INTERVAL 1 MONTH)";
    $result2=mysqli_query($conn,$sql2);
    while($ver2=mysqli_fetch_row($result2)) {
        $valores[1]=$ver2[0];
    }

    $sql3="SELECT COUNT(*) FROM reportes WHERE tipo = 3 AND estatus = 1 AND zona = 'tonala' AND fecha > (NOW() - INTERVAL 1 MONTH)";
    $result3=mysqli_query($conn,$sql3);
    while($ver3=mysqli_fetch_row($result3)) {
        $valores[2]=$ver3[0];
    }

    $sql4="SELECT COUNT(*) FROM reportes WHERE tipo = 4 AND estatus = 1 AND zona = 'tonala' AND fecha > (NOW() - INTERVAL 1 MONTH)";
    $result4=mysqli_query($conn,$sql4);
    while($ver4=mysqli_fetch_row($result4)) {
        $valores[3]=$ver4[0];
    }

    $sql5="SELECT COUNT(*) FROM reportes WHERE tipo = 5 AND estatus = 1 AND zona = 'tonala' AND fecha > (NOW() - INTERVAL 1 MONTH)";
    $result5=mysqli_query($conn,$sql5);
    while($ver5=mysqli_fetch_row($result5)) {
        $valores[4]=$ver5[0];
    }

    $datos=json_encode($valores);
?>

<div id="ultimo_mes_tonala"></div>
   
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
	  labels: ['Asalto', 'Accidente', 'Acoso', 'Precaucion', 'Otro'],
	  type: 'pie'
	}];

	var layout = {
	  height: 300,
	  width: 400
	};

	Plotly.newPlot('ultimo_mes_tonala', data, layout);
</script>