@extends('layouts.WMS')
@section('content')

<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{route('wms.summary')}}">Weather Monitoring</a>
  </li>
  <li class="breadcrumb-item active">Summary</li>
</ol>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.2/moment.min.js"></script>

<link rel="stylesheet" href="{{asset('/dist/jquery.CalendarHeatmap.css')}}">
<script src="{{asset('/dist/jquery.CalendarHeatmap.min.js')}}"></script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<div class="card mb-3">
    <div class="card-header"><i class="fa fa-fw fa-dashboard"></i> WMS Summary</div>
        <div class="card-body">
          <!-- temp: C
          pressure: pascal
          humidity: %
          rain intensity: db
          wind speed: km/h
          direction: degrees -->

          <form>
          <button type=submit name="parameter" value="Temperature" id="temp_button" class="btn btn-info pull-left" style="background-color:#ee6d6d; border:none">Temperature</button>
          <button type=submit name="parameter" value="Pressure" id="pres_button" class="btn btn-info pull-left" style="background-color:#ec7c7c; border:none">Pressure</button>
          <button type=submit name="parameter" value="Humidity" id="hum_button" class="btn btn-info pull-left" style="background-color:#ee876d; border:none">Humidity</button>
          <button type=submit name="parameter" value="Rain rate" id="rain_rate_button" class="btn btn-info pull-left" style="background-color:#5e8692; border:none">Rain rate</button>
          <button type=submit name="parameter" value="Total rain" id="tota_rain_button" class="btn btn-info pull-left" style="background-color:#5e8692; border:none">Total rain</button>
          <button type=submit name="parameter" value="Sound level" id="sound_level_button" class="btn btn-info pull-left" style="background-color:#5e8692; border:none">Sound level</button>
          <button type=submit name="parameter" value="Wind speed" id="wind_button" class="btn btn-info pull-left" style="background-color:#586d92; border:none">Wind speed</button>
          <button type=submit name="parameter" value="Wind direction" id="dir_button" class="btn btn-info pull-left" style="background-color:#4f6283; border:none;">Wind Direction</button>
          </form>
          <div style="margin-top: 4em" class="mx-auto" id="heatmap-demo" width="100%" height="50"> </div>

          <div class="mx-auto" id="averageData" width="100%" height="50"></div>

          <div class="mx-auto" id="highLow" width="100%" height="50"></div>

            <script>

            // var avgData = [
            //     {count: 1, date: "2017-10-23"},
            //     {count: 2, date: "2017-11-11"},
            //     {count: 3, date: "2017-11-13"},
            //     {count: 4, date: "2017-11-21"},
            // ];

            function storeValue(key, value) {
                if (localStorage) {
                    localStorage.setItem(key, value);
                } else {
                    $.cookies.set(key, value);
                }
            }

            function getStoredValue(key) {
                if (localStorage) {
                    return localStorage.getItem(key);
                } else {
                    return $.cookies.get(key);
                }
            }

            // var $temp_button = $('#temp_button');
            // var $pres_button = $('#pres_button');
            // var $hum_button = $('#hum_button');
            // var $rain_button = $('#rain_button');
            // var $wind_button = $('#wind_button');
            // var $dir_button = $('#dir_button');

            var avgData = <?php echo $daily_data; ?>;
            var parameter = {!!$parameter!!};
            var color;

            // ['#ee6d6d','#ec7c7c','#ee876d','#5e8692','#586d92','#4f6283'],
            if(parameter == 'Temperature'){
                color = "red";
            }else if(parameter == 'Pressure'){
                color = "peach";
            }else if(parameter == 'Humidity'){
                color = "yellow";
            }else if(parameter == 'Rain rate'){
                color = "blue";
            }else if(parameter == 'Total rain'){
                color = "blue";
            }else if(parameter == 'Sound level'){
                color = "blue";
            }else if(parameter == 'Temperature'){
                color = "teal";
            }else if(parameter == 'Wind speed'){
                color = "green";
            }else if(parameter == 'Wind direction'){
                color = "teal";
            }

            // console.log(avgData);
            var options = {
              itemSelector: '#heatmap-demo',
              // title of the calendar heatmap
              title: "<center>Overview </br>" +
              " <h6>Average "+ parameter +" in 2018</h6> </center>",

              data: avgData,

              // legendColors: {
              //   min: "#f55d3e",
              //   max: "#f7e287"
              // },


              // legendColors: ["#f55d3e","#f7e287"],

              start: new Date(2018,0),

              // the number of months to display
              months: 12,

              // last month
              lastMonth: moment().month()+1,

              // last year
              lastYear: moment().year(),

              // color gradients
              coloring: color,

              // custom labels
              labels: {
                  days: true,
                  months: true,
                  custom: {
                      weekDayLabels: null,
                      monthLabels: null
                  }
              },

              // custom legend

              legend: {
                  show: true,
                  align: "right",
                  minLabel: "Less",
                  maxLabel: "More"
              }

              // custom tooltips
              // requires <a href="https://www.jqueryscript.net/tags.php?/Bootstrap/">Bootstrap</a>
              // tooltips: {
              //     show: false,
              //     options: {}
              // }

            };

            var cal = $("#heatmap-demo").CalendarHeatmap(avgData, options);

            // $pres_button.click(function () {
            //   avgData = <?php //echo $pres_daily_data; ?>;
            //   storeValue('avgData', avgData);
            //   location.reload();
            // });
            //
            // $rain_button.click(function () {
            //   avgData = <?php //echo $rain_daily_data; ?>;
            //   storeValue('avgData', avgData);
            //   location.reload();
            // });
            //
            // $temp_button.click(function () {
            //     avgData = <?php //echo $temp_daily_data; ?>;
            //     localStorage.setItem("avgData", avgData);
            //     location.reload();
            // });
            //
            // $wind_button.click(function () {
            //     avgData = <?php //echo $wind_daily_data; ?>;
            //     localStorage.setItem("avgData", avgData);
            //     location.reload();
            // });
            //
            // $dir_button.click(function () {
            //     avgData = <?php //echo $dir_daily_data; ?>;
            //     localStorage.setItem("avgData", avgData);
            //     location.reload();
            // });
            //
            // $hum_button.click(function () {
            //     avgData = <?php //echo $hum_daily_data; ?>;
            //     localStorage.setItem("avgData", avgData);
            //     location.reload();
            // });

            //Average high and low data
            Highcharts.chart('highLow', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Average High/Low ' + {!!$parameter!!}
            },
            subtitle: {
                text: 'in 2018'
            },
            xAxis: {
                categories: [
                  'Sun',
                  'Mon',
                  'Tues',
                  'Wed',
                  'Thurs',
                  'Fri',
                  'Sat'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Rainfall (mm)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'High',
                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6]

            }, {
                name: 'Low',
                data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4]

            }]
        });

        //Average data
        Highcharts.chart('averageData', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Average ' + {!!$parameter!!}
        },
        subtitle: {
            text: 'in 2018'
        },
        xAxis: {
            categories: [
              'Sun',
              'Mon',
              'Tues',
              'Wed',
              'Thurs',
              'Fri',
              'Sat'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Rainfall (mm)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Average',
            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6]

        }]
    });

            </script>


        </div>
<div class="card-footer small text-muted">Last updated at </div>
</div>
@stop
