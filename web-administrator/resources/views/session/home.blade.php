@extends('layout/login')
@section('dahsboardContent1')

<div class="content-wrapper d-flex justify-content-center align-items-center" style="background-color:white">
  <div class="w-50 px-3 py-3">
    <h1 class="text-center">Welcome to Helpdesk Application</h1>
    <p class="text-center">Choose Your Role</p>
    <div class="d-flex flex-column">
      <a class="btn btn-info mb-2" href='{{url('/login/employee')}}'>Employee</a>
      <a class="btn btn-info mb-2" href='{{url('/login/merchant')}}'>Merchant</a>
    </div>
  </div>
</div>
@endsection