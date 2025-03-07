@extends('layouts.partials.app')

@section('content')
<div class="container">
  <h3>Rekap Aktivitas</h3>
  <div class="card">
    <div class="card-body">
      {{-- <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Filter</h5>
        <a href="{{ route('atasan.listRecap') }}" class="text-danger">Reset</a>
      </div>
  
      <!-- Form GET agar filter param muncul di URL -->
      <form action="{{ route('atasan.listRecap') }}" method="GET">
        <div class="mb-3">
          <label for="year" class="form-label">Tahun</label>
          <select name="year" id="year" class="form-select">
            <option value="">Pilih Tahun</option>
            @foreach($availableYears as $yr)
              <option value="{{ $yr }}" 
                {{ request('year') == $yr ? 'selected' : '' }}>
                {{ $yr }}
              </option>
            @endforeach
          </select>
        </div> --}}

        <div class="d-flex justify-content-between align-items-center mb-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
                <i class="fas fa-filter"></i> Filter
            </button>
        </div>
  
        {{-- <button type="submit" class="btn btn-primary w-100">
          Terapkan
        </button>
      </form> --}}
    </div>
  </div>
  <div class="table-responsive">
    <table id="add-row" class="display table table-striped table-hover">
  {{-- <table class="table table-striped"> --}}
    <thead>
      <tr>
        <th>No</th>
        <th>Bulan</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($bulanAktivitas as $index => $item)
      <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $monthNames[$item->month] ?? '-' }}</td>
        <td>
          <a href="{{ route('atasan.ExcelRecap',$item->month) }}" class="btn btn-success btn-sm">Excel</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>

{{-- Modal Filter --}}
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Filter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('atasan.listRecap') }}" method="GET">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tahun" class="form-label">Tahun</label>
                        <select name="year" id="year" class="form-select">
                            <option value="">Pilih Tahun</option>
                            @foreach($availableYears as $yr)
                              <option value="{{ $yr }}" 
                                {{ request('year') == $yr ? 'selected' : '' }}>
                                {{ $yr }}
                              </option>
                            @endforeach
                          </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary">Terapkan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@push('scripts')

<script>
    $(document).ready(function () {
      $("#basic-datatables").DataTable({});

      $("#multi-filter-select").DataTable({
        pageLength: 5,
        initComplete: function () {
          this.api()
            .columns()
            .every(function () {
              var column = this;
              var select = $(
                '<select class="form-select"><option value=""></option></select>'
              )
                .appendTo($(column.footer()).empty())
                .on("change", function () {
                  var val = $.fn.dataTable.util.escapeRegex($(this).val());
                  column
                    .search(val ? "^" + val + "$" : "", true, false)
                    .draw();
                });

              column
                .data()
                .unique()
                .sort()
                .each(function (d, j) {
                  select.append('<option value="' + d + '">' + d + "</option>");
                });
            });
        },
      });

      // Add Row
      $("#add-row").DataTable({
        pageLength: 5,
      });

      var action =
        '<td> <div class="form-button-action">' +
        '<button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">' +
        '<i class="fa fa-edit"></i></button>' +
        '<button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">' +
        '<i class="fa fa-times"></i></button></div></td>';

      $("#addRowButton").click(function () {
        $("#add-row")
          .dataTable()
          .fnAddData([
            $("#addName").val(),
            $("#addPosition").val(),
            $("#addOffice").val(),
            action,
          ]);
        $("#addRowModal").modal("hide");
      });
    });
  </script>
    
@endpush
