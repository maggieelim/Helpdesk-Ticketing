@extends('layout/main')

@section('dahsboardContent')
<div class="content-wrapper">
  <div class="content-header custom-margin">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Employee</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="{{ route('employee.index') }}">Employee</a></li>
          <li class="breadcrumb-item active">Detail</li>
        </ol>
      </div>
    </div>
  </div>
  <div class="custom-margin">
    <div class="card">
      <div class="card-header custom-card-header">
        <h1 class="card-title">{{ $data->employeeName }}</h1>
      </div>
      <form class="form-horizontal">
        <div class="card-body">
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label class="form-label">NIP</label>
                <p>{{ $data->NIP }}</p>
              </div>

              <div class="mb-3">
                <label class="form-label">Email</label>
                <p>{{ $data->employeeEmail }}</p>
              </div>
              <div class="mb-3">
                <label class="form-label">Position</label>
                <p>{{ $data->roleGroup->roleGroup }}</p>
              </div>
              <div class="mb-3">
                <label class="form-label">Address</label>
                <p>{{ $data->employeeAddress }}</p>
              </div>
              <div class="mb-3">
                <label class="form-label">Contract Type</label>
                <p>{{ $data->contractType->contract }}</p>
              </div>
              <div class="mb-3">
                <label class="form-label">Marital Status</label>
                <p>{{ $data->maritalStatus->status }}</p>
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label class="form-label">Insert Date Time</label>
                <p>{{ $data->insertDateTime }}</p>
              </div>
              <div class="mb-3">
                <label class="form-label">Update Date Time</label>
                <p>{{ $data->updateDateTime }}</p>
              </div>
              <div class="mb-3">
                <label class="form-label">Delete Date Time</label>
                <p>{{ $data->deleteDateTime }}</p>
              </div>
              <div class="mb-3">
                <label class="form-label">ID Type</label>
                <p>{{ $data->idType->type }}</p>
              </div>
              <div class="mb-3">
                <label class="form-label">ID Number</label>
                <p>{{ $data->id_number }}</p>
              </div>
              <div class="mb-3">
                <label class="form-label">Start Date</label>
                <p>{{ $data->start_date }}</p>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection