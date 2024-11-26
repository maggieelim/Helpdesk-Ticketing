@extends('layout/login')
@section('dahsboardContent1')
<div class="content-wrapper flex-column d-flex justify-content-center align-items-center" style="background-color:white">
  <div class="w-50 border rounded px-3 py-3 mb-5">
    <h1 class="text-center">OTP Verification</h1>
    <form id="otpVerifyForm" method="POST" action="{{ url('/otpVerification') }}">
      @csrf
      <!-- Hidden input for MID -->
      <input type="hidden" name="MID" value="{{ session('MID') }}"> <!-- Pastikan MID di-set di session sebelumnya -->
      <div class="form-group">
        <label for="otp">OTP:</label>
        <input type="text" class="form-control" id="otp" name="otp" required>
      </div>

      <button type="submit" class="btn custom-card-header">Verify OTP</button>
    </form>
  </div>
  <img class="center mt-5" src="{{ asset('images/Indopay.png') }}" alt="IndopayLogo" style="max-width: 15%; height: auto;">
</div>
@endsection