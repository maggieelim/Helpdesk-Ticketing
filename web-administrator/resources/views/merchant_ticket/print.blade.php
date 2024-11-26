<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Indopay | Administrator</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('lte/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('lte/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('lte/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('lte/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('lte/plugins/summernote/summernote-bs4.min.css')}}">
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.13/index.global.min.js"></script>
  <link rel="stylesheet" href="{{asset('lte/plugins/bs-stepper/css/bs-stepper.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('lte/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>

<body onload="window.print()">
  <div class="custom-margin m-3">
    <div class="card m-3"> <!-- Add ID here -->
      <form class="form-horizontal">
        <div class="card-body">
          <div class="section">
            <h5>Merchant</h5>
            <div class="row">
              <div class="col-6">
                <label class="form-label">Merchant ID</label>
                <p>{{ $data->merchant->MID }}</p>
              </div>
              <div class="col-6">
                <label class="form-label">Name</label>
                <p>{{ $data->merchant->merchant_name }}</p>
              </div>
            </div>
          </div>

          <div class="section">
            <h5>Technical Support</h5>
            <div class="row">
              @if($data->action == null)
              <div class="col-6">
                <label class="form-label">NIP</label>
                <p>Not assigned yet</p>
              </div>
              <div class="col-6">
                <label class="form-label">Name</label>
                <p>Not assigned yet</p>
              </div>
              @else
              <div class="col-6">
                <label class="form-label">NIP</label>
                <p>{{ $data->employee->NIP }}</p>
              </div>
              <div class="col-6">
                <label class="form-label">Name</label>
                <p>{{ $data->employee->first_name }}</p>
              </div>
              @endif
            </div>
          </div>

          <div class="section">
            <h5>Ticket Detail</h5>
            <label class="form-label">Ticket Title</label>
            <p>{{ $data->title }}</p>
            <label class="form-label">Ticket Description</label>
            <p>{{ $data->note }}</p>
            <label class="form-label">Comment</label>
            <p>{{ $data->comment }}</p>
          </div>

          <!-- Ticket Info Section -->
          <div class="row">
            <div class="col-6">
              <label class="form-label">Ticket Urgency</label>
              <p>@if($data->urgency_id == null)
                -
                @else
                {{ $data->ticketUrgensi->urgency }}
                @endif
              </p>
            </div>
            <div class="col-6">
              <label class="form-label">Ticket Status</label>
              <p> {{ $data->ticketStatus->status }}</p>
            </div>
            <div class="col-6">
              <label class="form-label">Ticket Category</label>
              <p>@if($data->category_id == null)
                -
                @else
                {{ $data->ticketCategory->category }}
                @endif
              </p>
            </div>
            <div class="col-6">
              <label class="form-label">Ticket Created Date</label>
              <p>{{ $data->created_at }}</p>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  </div>
  <script>
    function printCard() {
      var printContents = document.getElementById('printable-area').innerHTML;
      var originalContents = document.body.innerHTML;

      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
    }
  </script>
</body>

</html>