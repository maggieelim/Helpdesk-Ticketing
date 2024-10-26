@extends('layout/main')
@section('dahsboardContent')
<div class="content-wrapper">
  <div class="content-header custom-margin">
    <div class="row ">
      <div class="col-sm-6">
        <h1>Ticket Task</h1>
      </div>
    </div>
  </div>

  <div class="card custom-margin">
    <div class="card-body">
      <div class="container-fluid">
        <div class="row mb-3 align-items-center">
          <div class=" col-md-12 card card-default collapsed-card">
            <div class="card-header">
              <h3 class="card-title">Filter</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <form method="GET" action="">
                <div class="col">
                  <div class="form-group">
                    <label>Employee</label>
                    <select name="nip" class="form-control select2bs4" style="width: 100%;">
                      <option selected="selected">All</option>

                    </select>
                  </div>
                </div>
                <div class="col-12">
                  <button type="submit" class="btn custom-card-header">Apply Filter</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="row">
          <table class="table mt-3">
            <thead>
              <tr>
                <th class="text-center">Requestor</th>
                <th class="text-center">Title</th>
                <th class="text-center">Priority</th>
                <th class="text-center">Category</th>
                <th class="text-center">Date Request</th>
                <th class="text-center">Status</th>
                <th class="text-center">Last Reply</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $item)
              <tr>
                <td class="text-center">{{ $item->merchant->MID }}</td>
                <td class="text-center">{{ $item->title }}</td>
                <td class="text-center">
                  @if($item->ticketUrgensi)
                  @php
                  $statusClasses = [
                  1 => 'btn-info',
                  2 => 'btn-warning',
                  3 => 'btn-danger',
                  ];
                  $statusClass = $statusClasses[$item->urgency_id] ?? 'btn-danger';
                  @endphp
                  <button type="button" class="btn {{ $statusClass }} btn-sm" style="pointer-events: none;">
                    {{ $item->ticketUrgensi->urgency }}
                  </button>
                  @else
                  <button type="button" class="btn btn-info btn-sm" style="pointer-events: none;">
                    -
                  </button>
                  @endif
                </td>
                <td class="text-center">
                  @if($item->ticketCategory)
                  {{ $item->ticketCategory->category }}
                  @else
                  -
                  @endif
                </td>
                <td class="createdAt text-center">{{ $item->created_at }}</td>
                <td class="text-center">
                  @php
                  $statusClasses = [
                  1 => 'btn-warning',
                  2 => 'btn-info',
                  3 => 'btn-success',
                  ];
                  $statusClass = $statusClasses[$item->status_id] ?? 'btn-danger';
                  @endphp
                  <button type="button" class="btn {{ $statusClass }} btn-sm" style="pointer-events: none;">
                    {{ $item->ticketStatus->status }}
                  </button>
                </td>

                <td hidden class="updatedAt text-center">{{ $item->updated_at }}</td>
                <td class="test text-center"></td>
                <td class="text-center">
                  <div class="d-flex justify-content-center">
                    @if($item->status_id != 3)
                    <form method="post" action="{{'/ticketTask/'.$item->TID}}">
                      @csrf
                      @method('put')
                      <input type="hidden" name="status" value="2">
                      <button type="submit" class="btn btn-info btn-sm mr-1" @if($item->status_id == 2) disabled @endif> <!-- Nonaktifkan jika sudah In Progress -->
                        In Progress</button>

                    </form>
                    <form method="post" action="{{'/ticketTask/'.$item->TID}}">
                      @csrf
                      @method('put')
                      <input type="hidden" name="status" value="3">
                      <button type="submit" class="btn btn-success btn-sm mr-1" @if($item->status_id == 3 || $item->status_id==1) disabled @endif> <!-- Nonaktifkan jika sudah Done -->
                        Done</button>
                    </form>
                    @else
                    <!-- Jika status sudah Done, tampilkan tombol tapi semua dinonaktifkan -->
                    <button class="btn btn-info btn-sm mr-1" disabled>In Progress</button>
                    <button class="btn btn-success btn-sm mr-1" disabled>Done</button>
                    @endif

                    <a class="btn btn-info btn-sm" href='{{url('/ticketTask/'.$item->TID)}}'><i class="fas fa-eye"></i></a>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{ $data->links() }}
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const updateElements = document.querySelectorAll(".updatedAt");
    const testElements = document.querySelectorAll(".test");
    const createdElements = document.querySelectorAll(".createdAt");

    updateElements.forEach((el, index) => {
      const updatedAtText = el.textContent.trim();
      const now = new Date();

      // Menggunakan tanggal dari createdAt jika updatedAt kosong
      let dateToCompare;
      if (updatedAtText === "") {
        dateToCompare = new Date(createdElements[index].textContent.trim());
      } else {
        dateToCompare = new Date(updatedAtText);
      }

      const duration = calculateDuration(dateToCompare, now);
      testElements[index].textContent = duration;
    });
  });

  function calculateDuration(updatedAt, now) {
    const diffMs = now - updatedAt;

    const diffDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));
    const diffHours = Math.floor((diffMs % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const diffMinutes = Math.floor((diffMs % (1000 * 60 * 60)) / (1000 * 60));
    const diffSeconds = Math.floor((diffMs % (1000 * 60)) / 1000);

    if (diffDays > 0) {
      return `${diffDays} days ago`;
    } else if (diffHours > 0) {
      return `${diffHours} hours ago`;
    } else if (diffMinutes > 0) {
      return `${diffMinutes} minutes ago`;
    } else {
      return `${diffSeconds} seconds ago`;
    }
  }
</script>
@endsection