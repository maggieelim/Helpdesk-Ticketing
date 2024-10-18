@extends('layout/main')
@section('dahsboardContent')
<div class="content-wrapper">
  <div class="content-header custom-margin">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Purchase Order List</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item active">Purchase Order List</li>
        </ol>
      </div>
    </div>
  </div>

  <div class="card custom-margin">
    <div class="card-body">
      <div class="container-fluid">
        <div class="row mb-3 align-items-center">
          <div class="col-md-3 mb-3">
            <a href="/purchaseOrder" class="btn custom-card-header">+ Create Purchase Order</a>
          </div>
          <div class="col-md-9 card card-default collapsed-card">
            <div class="card-header">
              <h3 class="card-title">Filter</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <form action="{{ route('purchaseOrderList.index') }}" method="GET">
                <div class="row">
                  <!-- <div class="col-md-4 status-filter-group"> -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Supplier</label>
                      <select name="supplier" class="form-control select2bs4" style="width: 100%;">
                        <option value="All" {{ request('supplier') == 'All' ? 'selected' : '' }}>All</option>
                        @foreach($supplier as $sup)
                        <option value="{{ $sup->id }}" {{ request('supplier') == $sup->id ? 'selected' : '' }}>
                          {{ $sup->PIC_name }} - {{ $sup->address }}
                        </option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group mx-sm-2 mb-2">
                      <label class="mr-2" for="start_date">PO Date</label>
                      <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request()->input('start_date') }}">
                    </div>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn custom-card-header">Apply Filter</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <table class="table ">
          <thead>
            <tr>
              <th class="text-center">PO Number</th>
              <th class="text-center">Supplier Name</th>
              <th class="text-center">PO Date</th>
              <th class="text-center">Quantity</th>
              <th class="text-center">Total</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody class="alldata">
            @foreach($data as $item)
            <tr>
              <td class="text-center">{{ $item->po_number }}</td>
              <td class="text-center">{{ $item->supplier->PIC_name }}</td>
              <td class="text-center">{{ $item->po_date }}</td>
              <td class="text-center">{{ $item->total_qty }}</td>
              <td class="text-center">Rp.{{ number_format($item->totalPPN, 0, '.', '.') }}</td>
              <td class="text-center">
                <a class="btn btn-info" href="{{ url('/purchaseOrderList/' . rawurlencode(rawurlencode($item->po_number))) }}"><i class="fas fa-eye"></i></a>
                <a class="btn btn-warning" href='{{url('/purchaseOrderList/'. rawurlencode(rawurlencode($item->po_number)).'/edit')}}'><i class="fas fa-edit"></i></a>
                <form onsubmit="return confirm('Are you sure want to delete {{ $item->po_number }}')" class="d-inline" action="{{'/purchaseOrderList/'. rawurlencode(rawurlencode($item->po_number))}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger " type="submit"><i class="fas fa-trash-alt"></i></button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div id="pagination-links">
          {{ $data->appends(request()->query())->links() }}
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  //paginate item modal
  $(document).on('click', '#pagination-links a', function(event) {
    event.preventDefault();
    var url = $(this).attr('href');
    fetchData(url);
  });

  function fetchData(url) {
    $.ajax({
      url: url,
      method: 'GET',
      success: function(data) {
        $('.alldata').html($(data).find('.alldata').html());
        $('#pagination-links').html($(data).find('#pagination-links').html());
      },
      error: function(xhr) {
        console.log("ajax error")
      }
    });
  }

  function numberFormat(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  }
</script>
@endsection