<?php
    require "funciones/conexion.php";
    $conn = conexion(); //conexion a la BD

     $sql1="SELECT calificacion, Re.titulo FROM rating R, reportes RE WHERE R.id_reporte = Re.id_reporte";
    $result1=mysqli_query($conn,$sql1);
    $valoresY=array(); //tipo1
    $valoresX=array(); //tipo2
    
    while($ver=mysqli_fetch_row($result1)) {
        $valoresY[]=$ver[0];
        $valoresX[]=$ver[1];
    }
    
    $datosY=json_encode($valoresY);
    $datosX=json_encode($valoresX);
?>

<div id="grafica_barras"></div>
   
<script type"text/javascript">
  function CrearCadenaBarras(json){
      var parsed = JSON.parse(json);
      var arr =[];
      for(var x in parsed) {
           arr.push(parsed[x]);
      }
      return arr;
   }
</script>

<script type"text/javascript">
   datosX = CrearCadenaBarras('<?php echo $datosX ?>');
   datosY = CrearCadenaBarras('<?php echo $datosY ?>');

	var data = [
	  {
	    x: datosX,
	    y: datosY,
    	    type: 'bar'
  	  }
	];

	Plotly.newPlot('grafica_barras', data);
</script>