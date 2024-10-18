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
  <div class="custom-margin">
    <div class="card "> <!-- Add ID here -->
      <form class="form-horizontal">
        <div class="card-body">
          <div class="col" id="printable-area">
            <div class="my-3" style="width: 40%;">
              <img src="{{ asset('images/Indopay.png') }}" style="max-width: 50%; height: auto;">
              <p>{{ $address->address }}</p>
            </div>
            <div class="row d-flex justify-content-between p-2">
              <p style="font-weight: bold;">PO Number: {{ $data->po_number }}</p>
              <p style="font-weight: bold;">PO Date: {{ $data->po_date }}</p>
            </div>
            <div class="mb-3">
              <h5 class="my-0" style="font-weight: bold;">Supplier Detail:</h5>
              <p class="my-0">Address: {{ $data->supplier->address }}</p>
              <p class="my-0">Phone Number: {{ $data->supplier->phoneNum }}</p>
              <p class="my-0">Email: {{ $data->supplier->email }}</p>
              <p class="my-0">PIC Name: {{ $data->supplier->PIC_name }}</p>
              <p class="my-0">PIC Phone: {{ $data->supplier->PIC_phone }}</p>
            </div>
            <h5 style="font-weight: bold;">Purchased Items:</h5>
            <table class="table ">
              <thead>
                <tr>
                  <th class="text-center">Item Code</th>
                  <th class="text-center">Item Name</th>
                  <th class="text-center">Quantity</th>
                  <th class="text-center">Unit Price</th>
                  <th class="text-right">Amount</th>
                </tr>
              </thead>
              <tbody class="alldata">
                @foreach($item as $item)
                <tr>
                  <td class="text-center">{{ $item->item->item_code }}</td>
                  <td class="text-center">{{ $item->item->item_name }}</td>
                  <td class="text-center">{{ $item->qty }}</td>
                  <td class="text-center">Rp.{{ number_format($item->item_price, 0, '.', '.') }}</td>
                  <td class="text-right">Rp.{{ number_format($item->subtotal, 0, '.', '.') }}</td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th style="border: none;" colspan="4" class="text-right">Subtotal:</th>
                  <th style="width:20%; border: none" class="text-right">Rp {{ number_format($data->total, 0, '.', '.') }}</th>
                </tr>
                <tr>
                  <th style="border: none;" colspan="4" class="text-right">PPN 11%:</th>
                  <th style="width:20%; border: none" class="text-right">Rp {{ number_format($data->ppn, 0, '.', '.') }}</th>
                </tr>
                <tr>
                  <th style="border: none;" colspan="4" class="text-right">Total:</th>
                  <th style="width:20%; border: none" class="text-right">Rp {{ number_format($data->totalPPN, 0, '.', '.') }}</th>
                </tr>
              </tfoot>
            </table>
            <div class="row">
              <div class="col-sm-2">
                <p>Prepared By</p>
                <br>
                <br>
                <br>
                <hr class="my-0" style="width: 80%;border-color:black; margin-left:0px">
                <p>Date:</p>
              </div>
              <div class="col-sm-2">
                <p>Approved By</p>
                <br>
                <br>
                <br>
                <hr class="my-0" style="width: 80%;border-color:black; margin-left:0px">
                <p>Date:</p>
              </div>
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