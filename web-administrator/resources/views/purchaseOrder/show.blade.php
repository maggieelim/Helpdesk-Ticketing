@extends('layout/main')

@section('dahsboardContent')
<div class="content-wrapper">
  <div class="content-header custom-margin">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Purchase Order</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="{{ route('purchaseOrderList.index') }}">Purchase Order List</a></li>
          <li class="breadcrumb-item active">Detail</li>
        </ol>
      </div>
    </div>
  </div>
  <div class="custom-margin">
    <div class="card"> <!-- Add ID here -->
      <form class="form-horizontal">
        <div class="card-body">
          <div class="col p-5" id="printable-area">
            <div style="max-width: 40%;">
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
                  <th class="text-center">Amount</th>
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
          <a type="button" href="{{ url('/purchaseOrder/print/' . rawurlencode(rawurlencode($item->po_number))) }}" class="btn custom-card-header print-button m-5" target="_blank"><i class="fas fa-print"></i> Print</a>
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

@endsection