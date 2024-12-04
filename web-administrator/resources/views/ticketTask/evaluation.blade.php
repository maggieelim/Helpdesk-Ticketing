@extends('layout/main')
@section('dahsboardContent')
<div class="content-wrapper">
  <div class="content-header custom-margin">
    <div class="row ">
      <div class="col-sm-6">
        <h1>Report Dashboard</h1>
      </div>
    </div>
  </div>

  <div class="card custom-margin">
    <div class="card-body">
      <div class="col-md-12 card card-default collapsed-card">
        <div class="card-header">
          <h3 class="card-title">Filter</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <form method="GET" action="{{ route('tsReport') }}"> <!-- Replace with your actual route -->
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Start Date</label>
                  <input type="date" name="start" class="form-control" value="{{ request('start') }}" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>End Date</label>
                  <input type="date" name="end" class="form-control" value="{{ request('end') }}" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                </div>
              </div>
            </div>
            <div class="col-12">
              <button type="submit" class="btn custom-card-header">Apply Filter</button>
            </div>
          </form>
        </div>
      </div>
      <div class="container-fluid">
        <table class="table mt-3">
          <thead>
            <tr>
              <th class="text-center">Number of Tickets Resolved</th>
              <th class="text-center">Total Resolution Time</th>
              <th class="text-center">Average Resolution Time</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data['ticket_details'] as $item)
            <tr>
              <td id="TID" hidden class="text-center">{{ $item['ticket_number'] }}</td>
              <td id="res" hidden class="text-center">{{ $item['resolution_time'] }}</td>
            </tr>
            @endforeach
            @foreach($categoryCounts as $cat)
            <tr>
              <td id="category" hidden class="text-center">{{ $cat->category }}</td>
              <td id="totalCat" hidden class="text-center">{{ $cat->totalcategory }}</td>
            </tr>
            @endforeach

            @foreach($urgencyCounts as $cat)
            <tr>
              <td id="urgency" hidden class="text-center">{{ $cat->urgency }}</td>
              <td id="totalUrg" hidden class="text-center">{{ $cat->totalurgency }}</td>
            </tr>
            @endforeach

            <tr>
              <td class="text-center"> {{ $data['total_tickets'] }}</td>
              <td class="text-center"> {{ $data['total_resolution_time'] }} Hours</td>
              <td class="text-center"> {{ $data['avg_resolution_time'] }} Hours</td>
            </tr>
          </tbody>

        </table>

        <div class="col">
          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Line Chart Resolution Time
                </h3>

                <div class="card-tools">
                  <a id="print-line-chart"
                    href="#"
                    class="btn btn-tool"
                    target="_blank">
                    <i class="fas fa-print"></i>
                  </a>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div id="line-chart" style="height: 300px;"></div>
              </div>
              <!-- /.card-body-->
            </div>
          </div>
          <div class="row">
            <!-- Donut Chart 1 -->
            <div class="col-md-6">
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="far fa-chart-bar"></i>
                    Donut Chart Ticket Category
                  </h3>

                  <div class="card-tools">
                    <a id="print-donut-chart"
                      href="#"
                      class="btn btn-tool"
                      target="_blank">
                      <i class="fas fa-print"></i>
                    </a>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
            </div>

            <!-- Donut Chart 2 -->
            <div class="col-md-6">
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="far fa-chart-bar"></i>
                    Donut Chart Ticket Urgency
                  </h3>

                  <div class="card-tools">
                    <a id="print-donut1-chart"
                      href="#"
                      class="btn btn-tool"
                      target="_blank">
                      <i class="fas fa-print"></i>
                    </a>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="donutChart1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    var chartData = [];

    // Loop through each row of the table
    $('table tbody tr').each(function(index) {
      var ticketNumber = index + 1; // Start numbering tickets from 1
      var x_val = $(this).find('#TID').text(); // Get TID for ticket number
      var resolutionTimeText = $(this).find('#res').text(); // Get resolution time text
      var resolutionTime = parseInt(resolutionTimeText);

      // Only add rows with valid resolution time data
      if (!isNaN(resolutionTime) && resolutionTime > 0) {
        chartData.push([ticketNumber, resolutionTime]);
      }
    });

    console.log(chartData); // Debug: Check the extracted data

    // Print Line Chart
    $('#print-line-chart').click(function(e) {
      e.preventDefault();
      localStorage.setItem('chartData', JSON.stringify(chartData));
      localStorage.setItem('chartType', 'line'); // Mark chart type
      window.open('/ticketTaskEvaluation/print/line-chart', '_blank');
    });

    // Print Donut Chart 1
    $('#print-donut-chart').click(function(e) {
      e.preventDefault();
      var donutData = {
        labels: [],
        datasets: [{
          data: [],
          backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40']
        }]
      };
      $('table tbody tr').each(function() {
        var category = $(this).find('#category').text(); // Get category name
        var totalCategory = parseInt($(this).find('#totalCat').text()); // Get total tickets

        if (!isNaN(totalCategory) && totalCategory > 0) {
          donutData.labels.push(category);
          donutData.datasets[0].data.push(totalCategory);
          console.log(category, totalCategory); // Debug: Check if category data is added

        }
      });
      // Store the data and chart type in localStorage
      localStorage.setItem('donutData', JSON.stringify(donutData));
      localStorage.setItem('chartType', 'donut'); // Mark chart type as donut
      window.open('/ticketTaskEvaluation/print/donut-chart', '_blank');
    });

    // Print Donut Chart 2 (Urgency)
    $('#print-donut1-chart').click(function(e) {
      e.preventDefault();
      var donutData1 = {
        labels: [],
        datasets: [{
          data: [],
          backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
        }]
      };
      $('table tbody tr').each(function() {
        var urgency = $(this).find('#urgency').text(); // Get urgency name
        var totalUrgency = parseInt($(this).find('#totalUrg').text()); // Get total tickets for urgency

        if (!isNaN(totalUrgency) && totalUrgency > 0) {
          donutData1.labels.push(urgency);
          donutData1.datasets[0].data.push(totalUrgency);
        }
      });
      // Store the data and chart type in localStorage
      localStorage.setItem('donutData1', JSON.stringify(donutData1));
      localStorage.setItem('chartType', 'donut1'); // Mark chart type as donut1
      window.open('/ticketTaskEvaluation/print/donut1-chart', '_blank');
    });

    // Create the line chart
    $.plot('#line-chart', [{
      data: chartData,
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
        mode: 'categories', // Use categories for x-axis
        tickLength: 0 // Optional: adjust tick length
      }
    });

    // Tooltip for line chart
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

    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData = {
      labels: [],
      datasets: [{
        data: [],
        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40']
      }]
    };
    // Loop through each row of the table
    $('table tbody tr').each(function() {
      var category = $(this).find('#category').text(); // Get the category name
      var totalCategory = parseInt($(this).find('#totalCat').text()); // Get the total tickets

      // Only add rows with valid totalCategory
      if (!isNaN(totalCategory) && totalCategory > 0) {
        donutData.labels.push(category);
        donutData.datasets[0].data.push(totalCategory);
      }
    });

    var donutOptions = {
      maintainAspectRatio: false,
      responsive: true,
    }

    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })

    var donutChartCanvas1 = $('#donutChart1').get(0).getContext('2d');
    var donutData1 = {
      labels: [],
      datasets: [{
        data: [],
        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
      }]
    };

    // Loop through each row of the table
    $('table tbody tr').each(function() {
      var urgency = $(this).find('#urgency').text(); // Get the urgency name
      var totalUrgency = parseInt($(this).find('#totalUrg').text()); // Get the total tickets for urgency

      // Only add rows with valid totalUrgency
      if (!isNaN(totalUrgency) && totalUrgency > 0) {
        donutData1.labels.push(urgency); // Corrected to push `urgency`
        donutData1.datasets[0].data.push(totalUrgency);
      }
    });

    var donutOptions1 = {
      maintainAspectRatio: false,
      responsive: true,
    };

    new Chart(donutChartCanvas1, {
      type: 'doughnut',
      data: donutData1,
      options: donutOptions1
    });

  });
</script>

@endsection