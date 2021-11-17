<div id="grafica_pastel"></div>
<script type"text/javascript">
	var data = [{
	  values: [19, 55, 26],
	  labels: ['Evento', 'Crimen', 'Accidente'],
	  type: 'pie'
	}];

	var layout = {
	  height: 300,
	  width: 400
	};

	Plotly.newPlot('grafica_pastel', data, layout);
</script>