@extends('layout/login')
@section('dahsboardContent1')

<div class="flex-column content-wrapper d-flex justify-content-center align-items-center" style="background-color:white">
  <img src="{{ asset('images/Indopay.png') }}" alt="IndopayLogo" style="max-width: 17%; height: auto;">
  <div class="w-50 px-3 py-3">
    <h1 class="text-center">Welcome to Helpdesk Application</h1>
    <h5 class="text-center">Choose Your Role</h5>
    <div class="d-flex flex-column">
      <a class="btn custom-card-header mb-2" href='{{url('/login/employee')}}'>Employee</a>
      <a class="btn custom-card-header mb-2" href='{{url('/login/merchant')}}'>Merchant</a>
    </div>
  </div>
</div>
@endsection