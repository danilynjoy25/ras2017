<html>
<head>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
$(function() {
        // Create the chart
        $('#container').highcharts('StockChart', {


            rangeSelector : {
                selected : 1,
                inputEnabled: $('#container').width() > 480
            },

            title : {
                text : 'AAPL Stock Price'
            },

             series: [{
     name: 'AAPL Stock Price',
     data: [
         [1364463576000, 46906],
         [1364463578000, 50379],
         [1364463580000, 33733],
         [1364463582000, 5612],
         [1364463981000, 14213],
         [1364464007000, 11208],
         [1364490137000, 38047],
         [1364665254000, 14964],
         [1364665256000, 11443],
         [1364665257000, 9005],
         [1364665259000, 5283],
         [1364665260000, 1731]
     ],
     marker: {
         enabled: true,
         radius: 3
     },
     shadow: true,
     tooltip: {
         valueDecimals: 2
     }
 }]
        });

});


</script>
</head>
<body>
<script src="http://code.highcharts.com/stock/highstock.js"></script>
<script src="http://code.highcharts.com/stock/modules/exporting.js"></script>
<div id="container" style="height: 400px; min-width: 600px"></div>


</body>
</html>
