@extends('layout/main')
@section('dahsboardContent')
<div class="content-wrapper">
  <div class="content-header custom-margin">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Employees</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item active">Employees</li>
        </ol>
      </div>
    </div>
  </div>

  <div class="card custom-margin">
    <div class="card-body">
      <div class="container-fluid">
        <div class="row mb-3 align-items-center">
          <div class="col-md-2 mb-3">
            <a href="/employee/create" class="btn custom-card-header">+ Add Employee</a>
          </div>
          <div class="col-md-10 card card-default collapsed-card">
            <div class="card-header">
              <h3 class="card-title">Filter</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <form action="{{ route('employee.index') }}" method="GET">
                <div class="row">
                  <!-- <div class="col-md-4 status-filter-group"> -->
                  <div class="col-md-4 ">
                    <div class="form-group">
                      <label>Status</label>
                      <select name="status" class="form-control select2bs4" style="width: 100%;">
                        <option value="allEmployees" {{ request('status') == 'allEmployees' ? 'selected' : '' }}>All Employees</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>NIP</label>
                      <select name="nip" class="form-control select2bs4" style="width: 100%;">
                        <option selected="selected">All</option>
                        @foreach($nip as $nip1)
                        <option value="{{ $nip1->NIP }}" {{ request('nip') == $nip1->NIP ? 'selected' : '' }}>
                          {{ $nip1->NIP }}
                        </option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Division</label>
                      <select name="roleGroup" class="form-control select2bs4" style="width: 100%;">
                        <option selected="selected">All</option>
                        @foreach($roleGroup as $role)
                        <option value="{{ $role->id }}" {{ request('roleGroup') == $role->id ? 'selected' : '' }}>
                          {{ $role->roleGroup }}
                        </option>
                        @endforeach
                      </select>
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
              <th class="text-center">NIP</th>
              <th class="text-center">Name</th>
              <th class="text-center">Email</th>
              <th class="text-center">Position</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody class="alldata">
            @foreach($data as $item)
            <tr>
              <td class="text-center">{{ $item->NIP }}</td>
              <td class="text-center">{{ $item->first_name}} {{ $item->last_name }}</td>
              <td class="text-center">{{ $item->email }}</td>
              <td class="text-center">{{ $item->roleGroup->role }}</td>
              <td class="text-center">
                <a class="btn btn-info" href='{{url('/employee/'.$item->NIP)}}'><i class="fas fa-eye"></i></a>
                <a class="btn btn-warning" href='{{url('/employee/'.$item->NIP.'/edit')}}'><i class="fas fa-edit"></i></a>
                <form onsubmit="return confirm('Are you sure want to delete {{ $item->employeeName }}')" class="d-inline" action="{{'/employee/'.$item->NIP}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger " type="submit"><i class="fas fa-trash-alt"></i></button>
                </form>

                <div class="d-inline">
                  <button type="button" class="btn btn-secondary " data-toggle="dropdown">
                    <i class="fas fa-cog"></i>
                  </button>
                  <div class="dropdown-menu" role="menu">
                    @if($item->isDelete == 0)
                    <form action="{{ '/employee/'.$item->NIP.'/setInactive' }}" onsubmit="return confirm('Are you sure want to set this employee inactive?')" method="POST">
                      @csrf
                      @method('PUT')
                      <button class="dropdown-item" type="submit" href="#">Set Inactive</button>
                    </form>
                    @elseif($item->isDelete == 1)
                    <form action="{{ '/employee/'.$item->NIP.'/setActive' }}" onsubmit="return confirm('Are you sure want to set this employee active?')" method="POST">
                      @csrf
                      @method('PUT')
                      <button class="dropdown-item" type="submit" href="#">Set Active</button>
                    </form>

                    @endif
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </div>
                </div>
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
</div>
<style>
  td {
    font-size: 16px;
  }

  .fas {
    height: 8px;
  }
</style>
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

  document.addEventListener('DOMContentLoaded', function() {
    const hideStatusFilter = true;
    if (hideStatusFilter) {
      document.querySelector('.status-filter-group').style.display = 'none';
    }
  });
</script>
@endsection