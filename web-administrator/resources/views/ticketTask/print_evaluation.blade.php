<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Print Chart</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flot/jquery.flot.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    #chart-container {
      width: 600px;
      height: 400px;
      margin: auto;
    }

    .chart-container {
      margin-bottom: 40px;
    }

    canvas {
      max-width: 100%;
    }
  </style>
</head>

<body>
  <div class="m-4">
    <img src="{{ asset('images/Indopay.png') }}" style="max-width: 15%; height: auto;">
    <p style="width: 60%;">{{ $address->address }}</p>
  </div>
  <h2 style="text-align: center;" id="chart-title">Print Chart</h2>
  <div id="chart-container">
    <canvas id="donutChart"></canvas>
    <canvas id="donutChart1"></canvas>
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
      // Set title based on the chart type
      if (chartType === 'line') {
        titleElement.text('Line Chart Resolution Time');
      }
      if (chartType === 'donut') {
        titleElement.text('Donut Chart Ticket Category');
      }
      if (chartType === 'donut1') {
        titleElement.text('Donut Chart Ticket Urgency');
      }
      // Render Line Chart if chartType is 'line'
      if (chartType === 'line') {
        const plotData = chartData.map((item, index) => [index + 1, item[1]]);
        $.plot('#chart-container', [{
          data: plotData,
          color: '#3c8dbc',
          label: 'Resolution Time'
        }], {
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
            mode: 'categories',
            ticks: chartData.map((item, index) => [index + 1, 'Ticket ' + (index + 1)]),
            tickLength: 0
          }
        });
      }

      // Render Donut Chart if chartType is 'donut'
      if (chartType === 'donut') {
        const donutData = JSON.parse(localStorage.getItem('donutData'));
        const donutChartCanvas = $('#donutChart').get(0).getContext('2d');
        new Chart(donutChartCanvas, {
          type: 'doughnut',
          data: donutData,
          options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
              duration: 0 // Disable animation
            }
          }
        });
      }

      if (chartType === 'donut1') {
        const donutData1 = JSON.parse(localStorage.getItem('donutData1'));
        const donutChartCanvas1 = $('#donutChart1').get(0).getContext('2d');
        new Chart(donutChartCanvas1, {
          type: 'doughnut',
          data: donutData1,
          options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
              duration: 0 // Disable animation
            }
          }
        });
      }
      // Print automatically when page is loaded

    });
    window.onload = function() {
      setTimeout(function() {
        window.print();
      }, 100);
    };
  </script>
</body>

</html>