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
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active"><a href="{{ route('employee.index') }}"> Employee</a></li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
      </div>
    </div>
  </div>

  <div class="custom-margin">
    <div class="card ">
      <div class="card-header custom-card-header">
        <h1 class="card-title">NIP {{ $data->NIP }}</h1>
      </div>
      <form class="form-horizontal" method="post" action="{{'/employee/'.$data->NIP}}">
        @csrf
        @method('put')
        <div class="card-body">
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <span class="text-danger font-weight-bold">*</span>
                <input type="text" id="name" class="form-control" name="name" value="{{$data->employeeName}}">
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <span class="text-danger font-weight-bold">*</span>
                <input type="text" id="email" class="form-control" name="email" value="{{$data->employeeEmail}}">
              </div>
              <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <span class="text-danger font-weight-bold">*</span>
                <input type="text" id="phone" class="form-control" name="phone" value="{{$data->employeePhone}}">
              </div>
              <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <span class="text-danger font-weight-bold">*</span>
                <textarea type="text" id="address" class="form-control" name="address">{{ $data->employeeAddress }}</textarea>
              </div>
              <div class="mb-3">
                <label for="maritalStatus" class="form-label">Marital Status</label>
                <span class="text-danger font-weight-bold">*</span>
                <select name="maritalStatus" class="form-control " style="width: 100%;">
                  @foreach($maritalStatus as $status)
                  <option value="{{ $status->ID }}" @if($status->ID == $data->marital_status) selected
                    @endif>{{ $status->status }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="contractType" class="form-label">Contract Type</label>
                <span class="text-danger font-weight-bold">*</span>
                <select name="contractType" class="form-control " style="width: 100%;">
                  @foreach($contractType as $contract)
                  <option value="{{ $contract->id }}" @if($contract->id == $data->contract_id) selected
                    @endif>{{ $contract->contract }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="roleGroup" class="form-label">Division</label>
                <span class="text-danger font-weight-bold">*</span>
                <select name="roleGroup" class="form-control " style="width: 100%;">
                  @foreach($roleGroup as $role)
                  <option value="{{ $role->id }}" @if($role->id == $data->roleGroupId) selected
                    @endif>{{ $role->roleGroup }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="idType" class="form-label">ID Type</label>
                <span class="text-danger font-weight-bold">*</span>
                <select name="idType" class="form-control " style="width: 100%;">
                  @foreach($idType as $type)
                  <option value="{{ $type->id }}" @if($type->id == $data->id_type) selected
                    @endif>{{ $type->type }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="idNumber" class="form-label">ID Number</label>
                <span class="text-danger font-weight-bold">*</span>
                <input type="text" id="idNumber" class="form-control" name="idNumber" value="{{ $data->id_number }}">
              </div>
              <div class="mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <span class="text-danger font-weight-bold">*</span>
                <input type="date" id="start_date" class="form-control" name="start_date" value="{{$data->start_date}}">
              </div>
            </div>
          </div>
          <button type="submit" class="btn">UPDATE</button>
        </div>
      </form>
    </div>
  </div>
</div>

<style>
  .btn {
    background-color: rgba(12, 40, 131, 0.9);
    color: white;
  }
</style>
@endsection