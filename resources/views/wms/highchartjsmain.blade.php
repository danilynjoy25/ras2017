
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
  $(function() {
        // Create the chart
        $('#container').highcharts('StockChart', {

              rangeSelector: {
                  selected: 1
              },

              title: {
                  text: 'Temperature'
              },

              series: [{
                  name: 'Temperature',
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
                  type: 'areaspline',
                  threshold: null,
                  tooltip: {
                      valueDecimals: 2
                  },
                  fillColor: {
                      linearGradient: {
                          x1: 0,
                          y1: 0,
                          x2: 0,
                          y2: 1
                      },
                      stops: [
                          [0, Highcharts.getOptions().colors[0]],
                          [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                      ]
                  }
              }]
        });
    });

</script>

<script src="http://code.highcharts.com/stock/highstock.js"></script>
<script src="http://code.highcharts.com/stock/modules/exporting.js"></script>
<div class="card mb-3">
    <div class="card-header"><i class="fa fa-area-chart"></i> WMS Line Chart</div>
        <div class="card-body">
          <div id="container" width="100%" height="30"></div>
        </div>
<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>
