@extends('layout/login')
@section('dahsboardContent1')

<div class="content-wrapper d-flex flex-column justify-content-center align-items-center" style="background-color:white">
  <div class="w-50 border rounded px-3 py-3 mb-5">
    <h1 class="text-center">Employee Login</h1>
    <form action="/session/login" method="post">
      @csrf
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <div class="mb-3 d-grid">
        <button name="submit" type="submit" class="btn custom-card-header">Login</button>
      </div>
    </form>
  </div>
  <img class="center mt-5" src="{{ asset('images/Indopay.png') }}" alt="IndopayLogo" style="max-width: 15%; height: auto;">
</div>

@endsection