<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Indopay | Login</title>

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
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {
        timeZone: 'UTC',
        initialView: 'dayGridMonth',
        events: '/api/demo-feeds/events.json',
        editable: true,
        selectable: true
      });
      calendar.render();
    });
  </script>
  <style>
    .form-check-input {
      opacity: 0;
      margin-left: 1px;
      z-index: 2;
      width: 40px;
      background-color: pink;
      height: 20px;
      cursor: pointer;
    }

    .switch {
      position: relative;
      display: inline-block;
      width: 40px;
      height: 24px;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 16px;
      width: 16px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      transition: .4s;
    }

    input:checked+.slider {
      background-color: #2196F3;
    }

    input:checked+.slider:before {
      transform: translateX(16px);
    }

    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }

    .sidebar-dark-info .nav-sidebar>.nav-item>.nav-link.active,
    .sidebar-light-info .nav-sidebar>.nav-item>.nav-link.active {
      background-color: rgba(12, 40, 131, 0.9) !important;
      color: #fff !important;
    }

    .bg-olive {
      background-color: rgb(12 40 131 / 75%) !important;
    }

    .bg-olive.btn.active,
    .bg-olive.btn:active,
    .bg-olive.btn:not(:disabled):not(.disabled).active,
    .bg-olive.btn:not(:disabled):not(.disabled):active {
      background-color: rgb(12 40 131 / 100%) !important;
      border-color: rgb(12 40 131 / 75%) !important;
      color: #fff;
    }

    .custom-card-header {
      background-color: rgba(12, 40, 131, 0.9);
      color: white;
    }

    .custom-margin {
      margin-right: 4%;
      margin-left: 4%;
    }

    .header-margin {
      margin-right: 3%;
      margin-left: 3%;
    }

    .sidebar {
      flex: 1;
      /* Adjust background as needed */
      color: white;
      overflow-y: auto;
      /* Scroll if content is too tall */
    }
  </style>
</head>

<body class="hold-transition layout-top-nav"> <!-- Menggunakan layout-top-nav untuk menyembunyikan sidebar -->
  <div class="wrapper">
    @include('component/message')

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center" style="background-color: #fff;">
      <img class="animation__shake" src="{{ asset('images/Indopay.png') }}" alt="IndopayLogo" style="max-width: 15%; height: auto;">
    </div>

    <!-- Content Wrapper. Contains page content -->
    @yield('dahsboardContent1')
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <strong>Copyright &copy; 2024 <a style="color: rgba(12, 40, 131, 1);" href="https://www.indopay.com/">Indopay Merchant Services</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
      </div>
    </footer>


  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{asset('lte/plugins/jquery/jquery.min.js')}}"></script>

  <!-- jQuery UI 1.11.4 -->
  <script src="{{asset('lte/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- ChartJS -->
  <script src="{{asset('lte/plugins/chart.js/Chart.min.js')}}"></script>
  <!-- Sparkline -->
  <script src="{{asset('lte/plugins/sparklines/sparkline.js')}}"></script>
  <!-- JQVMap -->
  <script src="{{asset('lte/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
  <script src="{{asset('lte/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{asset('lte/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
  <!-- daterangepicker -->
  <script src="{{asset('lte/plugins/moment/moment.min.js')}}"></script>
  <script src="{{asset('lte/plugins/daterangepicker/daterangepicker.js')}}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{asset('lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
  <!-- Summernote -->
  <script src="{{asset('lte/plugins/summernote/summernote-bs4.min.js')}}"></script>
  <!-- overlayScrollbars -->
  <script src="{{asset('lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('lte/dist/js/adminlte.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('lte/dist/js/demo.js')}}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{asset('lte/dist/js/pages/dashboard.js')}}"></script>

  <!-- Bootstrap 4 -->
  <script src="{{asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- Select2 -->
  <script src="{{asset('lte/plugins/select2/js/select2.full.min.js')}}"></script>
  <script src="{{asset('lte/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>

  <script>
    $(function() {
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    })
  </script>

</body>

</html>