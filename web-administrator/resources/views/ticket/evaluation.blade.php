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
      <div class="container-fluid">
        <div class="row mb-3 align-items-center">
          <div class=" col-md-12 card card-default collapsed-card">
            <div class="card-header">
              <h3 class="card-title">Filter</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <form method="GET" action="">
                <div class="col">
                  <div class="form-group">
                    <label>Employee</label>
                    <select name="nip" class="form-control select2bs4" style="width: 100%;">
                      <option selected="selected">All</option>

                    </select>
                  </div>
                </div>
                <div class="col-12">
                  <button type="submit" class="btn custom-card-header">Apply Filter</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="row">
          <table class="table mt-3">
            <thead>
              <tr>
                <th class="text-center">Technical Support</th>
                <th class="text-center">Number of Tickets Resolved</th>
                <th class="text-center">Average Resolution Time</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $item)
              <tr>
                <td id="TS" class="text-center">{{ $item->employee->first_name }} {{ $item->employee->last_name }}</td>
                <td class="text-center">{{ $item->total_tickets }}</td>
                <td id="avg" class="text-center">{{ $item->avg_resolution_time }} Hours</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{ $data->links() }}
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Line Chart
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div id="line-chart" style="height: 300px;"></div>
              </div>
              <!-- /.card-body-->
            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Bar Chart
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div id="bar-chart" style="height: 300px;"></div>
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
    // Initialize an array to hold the chart data
    var chartData = [];

    // Loop through each row of the table
    $('table tr').each(function() {
      var employeeName = $(this).find('#TS').text().trim();
      var avgResolutionTime = $(this).find('#avg').text().trim().replace(' Hours', ''); // Remove " Hours"

      // Check if the data is valid
      if (employeeName && avgResolutionTime) {
        chartData.push({
          employee: employeeName,
          avgResolutionTime: parseInt(avgResolutionTime) // Convert to integer
        });
      }
    });

    console.log(chartData); // Debug: Check the extracted data

    // Prepare data for plotting (for line chart)
    var plotData = chartData.map(item => [item.employee, item.avgResolutionTime]);

    // Create the line chart
    $.plot('#line-chart', [{
      data: plotData,
      color: '#3c8dbc',
      label: 'Avg Resolution Time'
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

    // Initialize tooltip on hover for line chart
    $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
      position: 'absolute',
      display: 'none',
      opacity: 0.8
    }).appendTo('body');

    $('#line-chart').bind('plothover', function(event, pos, item) {
      if (item) {
        var x = item.datapoint[0],
          y = item.datapoint[1].toFixed(2);

        $('#line-chart-tooltip').html(item.series.label + ' of ' + x + ' = ' + y + ' Hours')
          .css({
            top: item.pageY + 5,
            left: item.pageX + 5
          })
          .fadeIn(200);
      } else {
        $('#line-chart-tooltip').hide();
      }
    });

    // Prepare data for the bar chart (using the same chartData)
    var barData = chartData.map((item, index) => [index + 1, item.avgResolutionTime]); // Create pairs for bar chart

    // Create the bar chart
    $.plot('#bar-chart', [{
      data: barData,
      bars: {
        show: true
      }
    }], {
      grid: {
        borderWidth: 1,
        borderColor: '#f3f3f3',
        tickColor: '#f3f3f3'
      },
      series: {
        bars: {
          show: true,
          barWidth: 0.5,
          align: 'center'
        },
      },
      colors: ['#3c8dbc'],
      xaxis: {
        ticks: chartData.map((item, index) => [index + 1, item.employee]) // Use employee names as ticks
      }
    });
    /* END BAR CHART */
  });
</script>





@endsection