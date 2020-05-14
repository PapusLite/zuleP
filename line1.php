<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Graph LINE1</title>
</head>
<body>
<?php
require_once "conexion.php";
$conexion= conexion();
  
$sql1= "SELECT fecha, cuba, habana FROM habanacuba order by fecha";
$result= mysqli_query($conexion,$sql1);
$valoresX=array(); //Fechas
$valoresY0=array(); //Montos
$valoresY1=array(); //Casos

while($ver= mysqli_fetch_row($result)){
  $valoresX[]=$ver[0];
  $valoresY0[]=$ver[1];
  $valoresY1[]=$ver[2];
}

$datosX=json_encode($valoresX);
$datosY0=json_encode($valoresY0); 
$datosY1=json_encode($valoresY1); 

?>

<div id="graph_line1">
</div>

<script>
  function crearCadenaLineal1(json){
    var parsed= JSON.parse(json);
    var arr=[];
    for(var x in parsed){
      arr.push(parsed[x]);
    }
    return arr;
  }
</script>
 <script>
   datosX= crearCadenaLineal1('<?php echo $datosX ?>' );
   datosY0= crearCadenaLineal1('<?php echo $datosY0 ?>' );
   datosY1= crearCadenaLineal1('<?php echo $datosY1 ?>' );
  </script>

<script>
  
var trace1 = {
  x: datosX,
  y: datosY1,
  mode: 'lines+markers',  
  name: 'Habana',
  line: {
      color: 'red',
      width: 2
    },
  marker: {
    color: 'blue',
    size: 8, 
  },
};

var trace2 = {
  x: datosX,
  y: datosY0,
  mode: 'lines+markers',  
  name: 'Cuba',
  line: {
      color: 'blue',
      width: 2
    },
  marker: {
    color: 'red',
    size: 9, 
  },
};

var data = [trace1, trace2];

var layout = {
  title: 'Casos diario Cuba vs Habana',
  xaxis: {
    title: 'Fecha'
  },
  yaxis: {
    title: '<br>Casos dia_dia'
  },
  showlegend: true,  
  legend: {
    x: 0.02,
    y: 1,
    traceorder: 'normal',
    font: {
      family: 'sans-serif',
      size: 12,
      color: '#000'
    },
    bgcolor: '#E2E2E2',
    bordercolor: '#FFFFFF',
    borderwidth: 2
  }
};

 var config = {
  responsive: true,
   toImageButtonOptions: {
     format: 'svg', // one of png, svg, jpeg, webp
     filename: 'custom_image',
     height: 350,
     width: 550,
     scale: 1 // Multiply title/legend/axis/canvas sizes by this factor
   }
 };
Plotly.newPlot('graph_line1', data, layout, config, {displaylogo: false} );   
 
</script>
</body>
</html>
