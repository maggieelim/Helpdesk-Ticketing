<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Print Chart</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flot/jquery.flot.min.js"></script>

  <style>
    body {
      margin: 20px;
    }

    #chart-container {
      width: 600px;
      height: 400px;
      margin: auto;
    }
  </style>
</head>

<body>
  <div class="m-4">
    <img src="{{ asset('images/Indopay.png') }}" style="max-width: 15%; height: auto;">
    <p style="width: 50%;">{{ $address->address }}</p>
  </div>
  <div class="custom-margin ">
    <h2 style="text-align: center;" id="chart-title">Print Chart</h2>
    <div id="chart-container"></div>
  </div>
  <script>
    $(document).ready(function() {
      // Ambil data dari localStorage
      const chartData = JSON.parse(localStorage.getItem('chartData'));
      const chartType = localStorage.getItem('chartType');

      if (!chartData) {
        alert('No chart data available!');
        return;
      }

      const titleElement = $('#chart-title');
      if (chartType === 'bar') {
        titleElement.text('Total of Tickets Resolved');
      } else if (chartType === 'line') {
        titleElement.text('Average Resolution Time');
      }

      // Render chart berdasarkan tipe
      if (chartType === 'bar') {
        // Bar Chart
        $.plot('#chart-container', [{
          data: chartData.map((item, index) => [index + 1, item.ticket]), // Sesuaikan data untuk bar chart
          bars: {
            show: true,
            barWidth: 0.5,
            align: 'center',
            fillColor: {
              colors: [{
                opacity: 0.8
              }, {
                opacity: 0.6
              }]
            }
          },
          color: '#3c8dbc',
        }], {
          xaxis: {
            ticks: chartData.map((item, index) => [index + 1, item.employee])
          },
          grid: {
            borderWidth: 1,
            borderColor: '#f3f3f3',
            tickColor: '#f3f3f3'
          }
        });
      } else if (chartType === 'line') {
        // Line Chart
        const plotData = chartData.map((item, index) => [index + 1, item.avgResolutionTime]);
        const baselineData = chartData.map((item, index) => [index + 1, item.overallAvg]);


        $.plot('#chart-container', [{
            data: plotData,
            color: '#3c8dbc',
            label: 'Resolution Time'
          },
          {
            data: baselineData,
            color: '#FF0000',
            label: 'Overall Average Resolution Time',
            lines: {
              show: true,
              lineWidth: 1,
              fill: false,
              points: true
            },
            points: {
              show: false
            }
          }
        ], {
          grid: {
            hoverable: true,
            borderColor: '#f3f3f3',
            borderWidth: 1,
            tickColor: '#f3f3f3'
          },
          series: {
            shadowSize: 0,
            lines: {
              show: true
            },
            points: {
              show: true
            }
          },
          lines: {
            fill: false
          },
          yaxis: {
            show: true,
            tickFormatter: function(val) {
              return val + ' Hours'; // Display units on the y-axis
            }
          },
          xaxis: {
            show: true,
            mode: 'categories', // Use categories for x-axis
            ticks: chartData.map((item, index) => [index + 1, item.employee]),
            tickLength: 0 // Optional: adjust tick length
          }
        });
        $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
          position: 'absolute',
          display: 'none',
          opacity: 0.8
        }).appendTo('body');
        $('#line-chart').bind('plothover', function(event, pos, item) {
          if (item) {
            var x = item.datapoint[0] + 1,
              y = item.datapoint[1].toFixed(2);

            $('#line-chart-tooltip').html(item.series.label + ' of Ticket ' + x + ' = ' + y + ' Hours')
              .css({
                top: item.pageY + 5,
                left: item.pageX + 5
              })
              .fadeIn(200);
          } else {
            $('#line-chart-tooltip').hide();
          }
        });
      }

      // Cetak otomatis saat halaman dimuat
      window.onload = function() {
        window.print();
      };
    });
  </script>
</body>

</html>