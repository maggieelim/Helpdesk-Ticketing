@extends('layout/main')
@section('dahsboardContent')
<div class="content-wrapper">
  <div class="content-header custom-margin">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Employee</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{route('asset.index')}}">Employees</a></li>
          <li class="breadcrumb-item active">Create Employee</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div>

  <div class="card custom-margin">
    <div class="card-header custom-card-header">
      <h1 class="card-title">Create</h1>
    </div>
    <form class="form-horizontal" method="post" action="/employee">
      @csrf
      <div class="card-body">
        <div class="row">
          <div class="col">
            <div class="mb-3">
              <label for="NIP" class="form-label">NIP</label>
              <span class="text-danger font-weight-bold">*</span>
              <input type="text" id="NIP" class="form-control" name="NIP" value="{{Session::get('NIP')}}">
            </div>
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <span class="text-danger font-weight-bold">*</span>
              <input type="text" id="name" class="form-control" name="name" value="{{Session::get('name')}}">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <span class="text-danger font-weight-bold">*</span>
              <input type="text" id="email" class="form-control" name="email" value="{{Session::get('email')}}">
            </div>
            <div class="mb-3">
              <label for="phone" class="form-label">Phone Number</label>
              <span class="text-danger font-weight-bold">*</span>
              <input type="text" id="phone" class="form-control" name="phone" value="{{Session::get('phone')}}">
            </div>
            <div class="mb-3">
              <label for="idType" class="form-label">ID Type</label>
              <span class="text-danger font-weight-bold">*</span>
              <select name="idType" class="form-control" style="width: 100%;">
                <option value="">--Select ID Type--</option>
                @foreach($idType as $type)
                <option value="{{ $type->id }}" {{ old('idType', Session::get('idType')) == $type->id ? 'selected' : '' }}>
                  {{ $type->type }}
                </option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="idNumber" class="form-label">ID Number</label>
              <span class="text-danger font-weight-bold">*</span>
              <input type="text" id="idNumber" class="form-control" name="idNumber" value="{{Session::get('idNumber')}}">
            </div>
          </div>
          <div class="col">
            <div class="mb-3">
              <label for="address" class="form-label">Address</label>
              <span class="text-danger font-weight-bold">*</span>
              <textarea type="text" id="address" class="form-control" name="address"> {{Session::get('address')}}</textarea>
            </div>
            <div class="mb-3">
              <label for="roleGroup" class="form-label">Division</label>
              <span class="text-danger font-weight-bold">*</span>
              <select name="roleGroup" class="form-control" style="width: 100%;">
                <option value="">--Select Division--</option>
                @foreach($roleGroup as $role)
                <option value="{{ $role->id }}" {{ old('roleGroup', Session::get('roleGroup')) == $role->id ? 'selected' : '' }}>
                  {{ $role->roleGroup }}
                </option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="start_date" class="form-label">Start Date</label>
              <span class="text-danger font-weight-bold">*</span>
              <input type="date" id="start_date" class="form-control" name="start_date" value="{{Session::get('start_date')}}">
            </div>
            <div class="mb-3">
              <label for="maritalStatus" class="form-label">Marital Status</label>
              <span class="text-danger font-weight-bold">*</span>
              <select name="maritalStatus" class="form-control" style="width: 100%;">
                <option value="">--Select Marital Status--</option>
                @foreach($maritalStatus as $status)
                <option value="{{ $status->id }}" {{ old('maritalStatus', Session::get('maritalStatus')) == $status->id ? 'selected' : '' }}>
                  {{ $status->status }}
                </option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="contractType" class="form-label">Contract Type</label>
              <span class="text-danger font-weight-bold">*</span>
              <select name="contractType" class="form-control" style="width: 100%;">
                <option value="">--Select Contract Type--</option>
                @foreach($contractType as $contract)
                <option value="{{ $contract->id }}" {{ old('contractType', Session::get('contractType')) == $contract->id ? 'selected' : '' }}>
                  {{ $contract->contract }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <button type="submit" class="btn custom-card-header">SAVE</button>
      </div>
    </form>
  </div>
</div>
@endsection