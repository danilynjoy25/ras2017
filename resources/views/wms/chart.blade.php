@extends('layouts.WMS')
@section('content')

<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{route('wms.summary')}}">Weather Monitoring</a>
  </li>
  <li class="breadcrumb-item active">Chart</li>
  <li class="breadcrumb-item active">Line</li>
</ol>

<div class="card mb-3">
    <div class="card-header"><i class="fa fa-area-chart"></i> WMS Chart</div>
        <div class="card-body">
          {{ Form::select('station', $stationsArray, null, array('onchange' => 'this.form.submit();')) }}
          <div id="container" width="100%" height="30"></div>
        </div>
<div class="card-footer small text-muted">Last updated at <?php echo str_replace('"','',$lastDate); ?> </div>
</div>

<div class="form-inline" style="margin-bottom: 1em;">
<form method="get" action="">

  <!-- temp: C
  pressure: pascal
  humidity: %
  rain intensity: db
  wind speed: km/h
  direction: degrees -->
  {{-- Using the Laravel HTML Form Collective to create our form --}}

          <!-- {/{/ Form::select('station', $stationsArray, null, []) }} -->
          <!-- {/{/ Form::submit('Update', array('class'=>'btn')) }} -->
          <!-- onchange="this.form.submit(); -->
          <!-- {{ Form::select('station', $stationsArray, null, array('onchange' => 'this.form.submit();')) }} -->

          <!-- Station: -->
          <!-- {/{/ Form::select('parameter', $parametersArray, null, []) }/}/ -->

          <!-- <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
          <label class="form-check-label" for="defaultCheck1">
            Temperature
          </label>
          <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
          <label class="form-check-label" for="defaultCheck1">
            Pressure
          </label>
          <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
          <label class="form-check-label" for="defaultCheck1">
            Humidity
          </label>
          <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
          <label class="form-check-label" for="defaultCheck1">
            Rain intensity
          </label>
          <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
          <label class="form-check-label" for="defaultCheck1">
            Wind direction
          </label>
          <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
          <label class="form-check-label" for="defaultCheck1">
            Wind speed
          </label> -->


</form>
<!-- <button type=submit name="parameter" value="Temperature" id="temp_button" class="btn btn-info pull-left" style="background-color:#E5E5E5; border:none">Temperature</button>
<button type=submit name="parameter" value="Pressure" id="pres_button" class="btn btn-info pull-left" style="background-color:#E5E5E5; border:none">Pressure</button>
<button type=submit name="parameter" value="Humidity" id="hum_button" class="btn btn-info pull-left" style="background-color:#E5E5E5; border:none">Humidity</button>
<button type=submit name="parameter" value="Rain rate" id="rain_rate_button" class="btn btn-info pull-left" style="background-color:#E5E5E5; border:none">Rain rate</button>
<button type=submit name="parameter" value="Total rain" id="total_rain_button" class="btn btn-info pull-left" style="background-color:#E5E5E5; border:none">Total rain</button>
<button type=submit name="parameter" value="Sound level" id="sound_level_button" class="btn btn-info pull-left" style="background-color:#E5E5E5; border:none">Sound level</button>
<button type=submit name="parameter" value="Wind speed" id="wind_button" class="btn btn-info pull-left" style="background-color:#E5E5E5; border:none">Wind speed</button> -->
<!-- <button type=submit name="parameter" value="Wind direction" id="dir_button" class="btn btn-info pull-left" style="background-color:#E5E5E5; border:none">Wind Direction</button> -->
</form>
</div>

<script type="text/javascript">

var chart;


  // function requestData(){
  //   $.ajax({
  //       url: 'http://127.0.0.1:8000/dbJson',
  //       success: function(message){
  //         var series = chart.series[0];
  //         shift = series.data.length > 1;
  //         chart.series.addPoint(message, true, shift);
  //
  //         setTimeout(requestData, 1000);
  //       }
  //       cache: false
  //     });
  // }

  $(document).ready(function(){
    
      Highcharts.setOptions({
        global: {
          useUTC: false
        }
      });

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
                      events: {
                          // load: requestData
                          // load: function() {
                          //   var series = chart.series[0];
                          //     $.ajax({
                          //       url: 'http://127.0.0.1:8000/dbJson',
                          //       success: function(message){
                          //         var x = (new Date(parseInt(message['time'])))
                          //         chart.series.addPoint([x, message['data']], true, true);
                          //
                          //         setTimeout(requestData, 1000);
                          //       },
                          //       cache: false
                          //     })
                          // }
                      },
                      type: 'spline'
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
                            valueDecimals: 2,
                            valueSuffix: " °C"
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
                            valueDecimals: 2,
                            valueSuffix: " mb"
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
                            valueDecimals: 2,
                            valueSuffix: " %"
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
                            valueDecimals: 2,
                            valueSuffix: " mm/hr"
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
                        name: "Daily rainfall",
                        data:  total_rain_data,
                        type: 'areaspline',
                        threshold: null,
                        tooltip: {
                            valueDecimals: 2,
                            valueSuffix: " mm"
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
                            valueDecimals: 2,
                            valueSuffix: " dB"
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
                            valueDecimals: 2,
                            valueSuffix: " km/h"
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

  var $temp_button = $('#temp_button');
  var $pres_button = $('#pres_button');
  var $hum_button = $('#hum_button');
  var $rain_rate_button = $('#rain_rate_button');
  var $total_rain_button = $('#total_rain_button');
  var $sound_level_button = $('#sound_level_button');
  var $wind_button = $('#wind_button');
  var $dir_button = $('#dir_button');

  // colors: ['#ee6d6d','#ec7c7c','#ee876d','#5e8692','#586d92','#4f6283']

  $temp_button.click(function () {
      var series = chart.series[0];
      if (series.visible) {
          series.hide();
          temp_button.style.backgroundColor = '#E5E5E5';
      } else {
          series.show();
          temp_button.style.backgroundColor = '#ee6d6d';
      }
  });

  $pres_button.click(function () {
      var series = chart.series[1];
      if (series.visible) {
          series.hide();
          pres_button.style.backgroundColor = '#E5E5E5';
      } else {
          series.show();
          pres_button.style.backgroundColor = '#ec7c7c';
      }
  });

  $hum_button.click(function () {
      var series = chart.series[2];
      if (series.visible) {
          series.hide();
          hum_button.style.backgroundColor = '#E5E5E5';
      } else {
          series.show();
          hum_button.style.backgroundColor = '#ee876d';
      }
  });

  $rain_rate_button.click(function () {
      var series = chart.series[3];
      if (series.visible) {
          series.hide();
          rain_rate_button.style.backgroundColor = '#E5E5E5';
      } else {
          series.show();
          rain_rate_button.style.backgroundColor = '#5e8692';
      }
  });

  $total_rain_button.click(function () {
      var series = chart.series[4];
      if (series.visible) {
          series.hide();
          total_rain_button.style.backgroundColor = '#E5E5E5';
      } else {
          series.show();
          total_rain_button.style.backgroundColor = '#5e8692';
      }
  });

  $sound_level_button.click(function () {
      var series = chart.series[5];
      if (series.visible) {
          series.hide();
          sound_level_button.style.backgroundColor = '#E5E5E5';
      } else {
          series.show();
          sound_level_button.style.backgroundColor = '#5e8692';
      }
  });

  $wind_button.click(function () {
      var series = chart.series[6];
      if (series.visible) {
          series.hide();
          wind_button.style.backgroundColor = '#E5E5E5';
      } else {
          series.show();
          wind_button.style.backgroundColor = '#586d92';
      }
  });

  $dir_button.click(function () {
      var series = chart.series[7];
      if (series.visible) {
          series.hide();
          dir_button.style.backgroundColor = '#E5E5E5';
      } else {
          series.show();
          dir_button.style.backgroundColor = '#4f6283';
      }
  });

</script>


<script src="http://code.highcharts.com/stock/highstock.js"></script>
<script src="http://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>

@stop
