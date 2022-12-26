<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chart</title>
</head>
<body>
  
    <canvas id="myChart"></canvas>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.min.js"></script>

<script type="text/javascript">

 var dateLavels= JSON.parse(@json($dateLavels));
 var dateDate= JSON.parse(@json($dateData));

var canvas = document.getElementById('myChart');
var data = {
    labels: dateLavels,
    datasets: [
        {
            label: "Referral User",
            fill: false,
            lineTension: 0.1,
            backgroundColor: "rgba(75,192,192,0.4)",
            borderColor: "rgba(75,192,192,1)",
            pointBorderColor: "rgba(75,192,192,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(75,192,192,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 5,
            pointHitRadius: 10,
            data: dateDate,
        }
    ]
};

var option = {
  showLines: true
};
var myLineChart = Chart.Line(canvas,{
  data:data,
  options:option
});

</script>

<style>
    #myChart{
        width: 100% !important;
        height: 80% !important;
         }
</style>
</body>
</html>