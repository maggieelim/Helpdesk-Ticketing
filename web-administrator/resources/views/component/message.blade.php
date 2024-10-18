@if($errors->any())
<div class="alert alert-danger" id="errorAlert"
  style="position: fixed; top: 10%; right: 10px; max-width: fit-content; z-index: 9999;">
  <ul>
    @foreach ($errors->all() as $item)
    <li>{{ $item }}</li>
    @endforeach
  </ul>
</div>
<script>
setTimeout(function() {
  document.getElementById('errorAlert').style.display = 'none';
}, 5000);
</script>
@endif

@if (Session::get('success'))
<div class="alert alert-success" id="successAlert"
  style="position: fixed; top: 10%; right: 10px; max-width: fit-content; z-index: 9999;">
  {{ Session::get('success') }}
</div>
<script>
setTimeout(function() {
  document.getElementById('successAlert').style.display = 'none';
}, 5000);
</script>
@endif