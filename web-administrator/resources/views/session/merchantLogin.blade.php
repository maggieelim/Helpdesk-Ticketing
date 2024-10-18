@extends('layout/login')
@section('dahsboardContent1')

<div class="content-wrapper d-flex justify-content-center align-items-center" style="background-color:white">
  <div class="w-50 border rounded px-3 py-3">
    <h1 class="text-center">Merchant Login</h1>
    <form id="otpForm" method="POST" action="{{ url('/send-otp') }}">
      @csrf
      <div class="form-group">
        <label for="MID">MID:</label>
        <input type="text" class="form-control" id="MID" name="MID" required>
      </div>
      <button type="submit" class="btn btn-primary">Send OTP</button>
    </form>
  </div>
</div>

@endsection