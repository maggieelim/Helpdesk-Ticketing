@extends('layout/login')
@section('dahsboardContent1')

<div class="content-wrapper d-flex flex-column justify-content-center align-items-center " style="height: 100%;background-color:white">
  <div class="w-50 border rounded px-3 py-3 mb-5">
    <h1 class="text-center">Merchant Login</h1>
    <form id="otpForm" method="POST" action="{{ url('/send-otp') }}">
      @csrf
      <div class="form-group">
        <label for="MID">MID:</label>
        <input type="text" class="form-control" id="MID" name="MID" required>
      </div>
      <button type="submit" class="btn custom-card-header">Send OTP</button>
    </form>
  </div>
  <img class="center mt-5" src="{{ asset('images/Indopay.png') }}" alt="IndopayLogo" style="max-width: 15%; height: auto;">
</div>

@endsection