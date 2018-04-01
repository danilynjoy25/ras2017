@extends('layouts.WMS')
@section('content')

<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{route('wms.summary')}}">Weather Monitoring</a>
  </li>
  <li class="breadcrumb-item active">Chart</li>
  <li class="breadcrumb-item active">Live</li>
</ol>

<div class="card mb-3">
    <div class="card-header"><i class="fa fa-area-chart"></i> WMS Live Chart</div>
        <div class="card-body">
          {{ Form::select('station', $stationsArray, null, array('onchange' => 'this.form.submit();')) }}
          <div id="container" width="100%" height="30"></div>
        </div>
<div class="card-footer small text-muted">Last updated at <?php echo str_replace('"','',$lastDate); ?> </div>
</div>

<div class="form-inline" style="margin-bottom: 1em;">

<script type="text/javascript">

var chart;

function requestData() {
    $.ajax({
        url: '{{route("wms.lastTemp")}}',
        success: function(point) {
            var series = chart.series[0];

            // add the point
            chart.series[0].addPoint(point, true, true);

            // call it again after one second
            setTimeout(requestData, 1000);
            console.log(point);
        },
        cache: false
    });
};

  $(document).ready(function(){

      var temp_data = <?php echo $temp_dataFinal; ?>;
      var hum_data = <?php echo $hum_dataFinal; ?>;
      var wind_data = <?php echo $wind_dataFinal; ?>;
      var rain_rate_data = <?php echo $rain_rate_dataFinal; ?>;
      var total_rain_data = <?php echo $total_rain_dataFinal; ?>;
      var sound_level_data = <?php echo $sound_level_dataFinal; ?>;
      var dir_data = <?php echo $dir_dataFinal; ?>;
      var pres_data = <?php echo $pres_dataFinal; ?>;
      var stationName= <?php echo $stationName; ?>

      var config = {
                    chart: {
                        renderTo: 'container',
                        type: 'spline',
                        events: {
                            //load: requestData
                            load: function () {
                               // set up the updating of the chart each second
                               // var series = this.series[0];
                               //
                               // setInterval(function () {
                               //    var x = (new Date()).getTime(), // current time
                               //    y = Math.random();
                               //    series.addPoint([x, y], true, true);
                               // }, 1000);
                              setInterval(function () {
                                 $.ajax({
                                     url: '{{route("wms.lastTemp")}}',
                                     success: function(point) {
                                         var series = chart.series[0];

                                         // call it again after one second

                                           // add the point
                                           series.addPoint(point, true, true);

                                         console.log(point);
                                     },
                                     cache: false
                                 })}, 1000);
                            }
                        }
                    },
                    colors: ['#ee6d6d','#ec7c7c','#ee876d','#67a1bd','#5e8692','#586d92','#4f6283'],
                    rangeSelector: {
                        selected: 1
                    },
                    title: {
                        text: "Sensor data at " + stationName
                    },
                    plotOptions: {
                        series: {
                            compare: 'percent',
                            showInNavigator: true,
                            events: {
                              legendItemClick: function(event) {
                                  var selected = this.index;
                                  var allSeries = this.chart.series;

                                  $.each(allSeries, function(index, series) {
                                      selected == index ? series.show() : series.hide();
                                  });

                                  return false;
                              }
                          }
                        }
                    },

                    navigator: {
                        series: {
                            type: 'spline'
                        }
                    },
                    legend: {
                        enabled: true,
                        align: 'left',
                        // backgroundColor: '#FCFFC5',
                        // borderColor: 'black',
                        // borderWidth: 2,
                        layout: 'vertical',
                        verticalAlign: 'top',
                        y: 100,
                        // shadow: true
                    },

                    rangeSelector: {
                        selected: 1
                    },
                    series: [{
                        name: "Temperature",
                        data:  temp_data,
                        type: 'spline',
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
                        },
                        visible: true
                    },
                    {
                        name: "Pressure",
                        data:  pres_data,
                        type: 'spline',
                        threshold: null,
                        tooltip: {
                            valueDecimals: 2
                        },
                        marker: {
                            enabled: true,
                            radius: 3
                        },
                        fillColor: {
                            linearGradient: {
                                x1: 0,
                                y1: 0,
                                x2: 0,
                                y2: 1
                            },
                            stops: [
                                [0, Highcharts.getOptions().colors[1]],
                                [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                            ]
                        },
                        visible: false
                    },
                    {
                        name: "Humidity",
                        data:  hum_data,
                        type: 'line',
                        dashStyle: 'longdash',
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
                                [0, Highcharts.getOptions().colors[2]],
                                [1, Highcharts.Color(Highcharts.getOptions().colors[2]).setOpacity(0).get('rgba')]
                            ]
                        },
                        visible: false
                    },
                    {
                        name: "Rain rate",
                        data:  rain_rate_data,
                        // type: 'areaspline',
                        //dashStyle: 'longdash',
                        step: true,
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
                        },
                        visible: false
                    },
                    {
                        name: "Total rain",
                        data:  total_rain_data,
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
                        },
                        visible: false
                    },
                    {
                        name: "Sound level",
                        data:  sound_level_data,
                        type: 'column',
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
                                [0, Highcharts.getOptions().colors[3]],
                                [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                            ]
                        },
                        visible: false
                    },
                    {
                        name: "Wind speed",
                        data:  wind_data,
                        dashStyle: 'shortdot',
                        type: 'spline',
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
                                [0, Highcharts.getOptions().colors[5]],
                                [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                            ]
                        },
                        visible: false
                    },
                  ]

          };

          chart = new Highcharts.StockChart(config);
  });

  // colors: ['#ee6d6d','#ec7c7c','#ee876d','#5e8692','#586d92','#4f6283']

</script>


<script src="http://code.highcharts.com/stock/highstock.js"></script>
<script src="http://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>

@stop
