@extends('layouts.partials.app')

@section('content')
  <div class="container">
    <div class="page-inner">
      <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
          <h3 class="fw-bold mb-3">SKP</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
          <label>Senin, 10 Maret 2025</label>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div class="d-flex align-items-center">
                  <h4 class="card-title">Daftar SKP</h4>
                  <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                    data-bs-target="#addSKPModal">
                    <i class="fa fa-plus"></i>
                    Tambah SKP
                  </button>
                </div>
              </div>
              <div class="card-body">

                @role('atasan')
                <!-- Modal Tambah SKP -->
                <div class="modal fade" id="addSKPModal" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header border-0">
                        <h5 class="modal-title">
                          <span class="fw-mediumbold"> Tambah</span>
                          <span class="fw-light"> SKP </span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" action="close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="{{ route('atasan.storeSKP') }}" method="POST">
                            @csrf
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Bulan</label>
                                <div class="dropdown">
                                  <select class="btn btn-light dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false" name="month" id="month">
                                    <option value="" class="dropdown-item">Pilih Bulan</option>
                                    @foreach($monthNames as $monthNumber => $monthLabel)
                                    <option value="{{ $monthNumber }}">
                                      {{ $monthLabel }}
                                    </option>
                                  @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Tahun</label>
                                <div class="dropdown">
                                  <select class="btn btn-light dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false" name="year" id="year">
                                    <option value="" class="dropdown-item">Pilih Tahun</option>
                                    <option value="2025" class="dropdown-item">2025</option>
                                    <option value="2026" class="dropdown-item">2026</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label for="">Nama SKP</label>
                                <input id="name_skp" name="name_skp" type="text" class="form-control" placeholder="Isi sesuai SKP anda" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                Batal
                            </button>
                        </div>
                    </form>
                    </div>
                  </div>
                </div>
                <!-- End Modal -->
                @endrole

                @role('pegawai')
                <!-- Modal Tambah SKP -->
                <div class="modal fade" id="addSKPModal" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header border-0">
                        <h5 class="modal-title">
                          <span class="fw-mediumbold"> Tambah</span>
                          <span class="fw-light"> SKP </span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" action="close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="{{ route('pegawai.storeSKP') }}" method="POST">
                            @csrf
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Bulan</label>
                                <div class="dropdown">
                                  <select class="btn btn-light dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false" name="month" id="month">
                                    <option value="" class="dropdown-item">Pilih Bulan</option>
                                    @foreach($monthNames as $monthNumber => $monthLabel)
                                    <option value="{{ $monthNumber }}">
                                      {{ $monthLabel }}
                                    </option>
                                  @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Tahun</label>
                                <div class="dropdown">
                                  <select class="btn btn-light dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false" name="year" id="year">
                                    <option value="" class="dropdown-item">Pilih Tahun</option>
                                    <option value="2025" class="dropdown-item">2025</option>
                                    <option value="2026" class="dropdown-item">2026</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label for="">Nama SKP</label>
                                <input id="name_skp" name="name_skp" type="text" class="form-control" placeholder="Isi sesuai SKP anda" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                Batal
                            </button>
                        </div>
                    </form>
                    </div>
                  </div>
                </div>
                <!-- End Modal -->
                @endrole

                @role('pegawai')
                <!-- Tabel SKP -->
                <div class="table-responsive">
                  <table id="add-row" class="display table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th style="width: 10%">Aksi</th>
                      </tr>
                    </thead>

                    <tbody>
                        @foreach ($skp as $item => $row)
                      <tr>
                        <td>{{ $item + 1 }}</td>
                        <td>{{ $row->name_skp }}</td>
                        <td>{{ $monthNames[$row->month] ?? '-'}}</td>
                        <td>{{ $row->year }}</td>
                        <td>
                          <div class="form-button-action">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#editSKPModal{{ $row->id }}" title=""
                              class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                              <i class="fa fa-edit"></i>
                            </button>
                            {{-- <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editSKPModal{{ $row->id }}"> --}}
                            <button type="button" data-bs-toggle="tooltip" title="" onclick="confirmDelete({{ $row->id }})"
                              class="btn btn-link btn-danger" data-original-title="Remove">
                              <i class="fa fa-times"></i>
                            </button>
                          </div>
                        </td>
                    </tr>

                                <!-- Modal Edit (per baris) -->
                <div class="modal fade" id="editSKPModal{{ $row->id }}" tabindex="-1" aria-labelledby="editSKPModalLabel{{ $row->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        
                        <!-- Header Modal -->
                        <div class="modal-header">
                        <h5 class="modal-title" id="editSKPModalLabel{{ $row->id }}">Edit SKP #{{ $row->id }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                        <!-- Form Edit -->
                        <form action="{{ route('pegawai.updateSKP', $row->id) }}" method="POST">
                        @csrf
                        @method('PUT') 
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="editMonth{{ $row->id }}" class="form-label">Bulan</label>
                                <select name="month" id="editMonth{{ $row->id }}" class="form-select">
                                <option value="">Pilih Bulan</option>
                                @foreach($monthNames as $monthNumber => $monthLabel)
                                    <option value="{{ $monthNumber }}" 
                                    {{ $row->month == $monthNumber ? 'selected' : '' }}>
                                    {{ $monthLabel }}
                                    </option>
                                @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editYear{{ $row->id }}" class="form-label">Tahun</label>
                                <select name="year" id="editYear{{ $row->id }}" class="form-select">
                                <option value="">Pilih Tahun</option>
                                <!-- Contoh statis: 2025, 2026, 2027 -->
                                <option value="2025" {{ $row->year == 2025 ? 'selected' : '' }}>2025</option>
                                <option value="2026" {{ $row->year == 2026 ? 'selected' : '' }}>2026</option>
                                <option value="2027" {{ $row->year == 2027 ? 'selected' : '' }}>2027</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editNameSKP{{ $row->id }}" class="form-label">Nama SKP</label>
                                <input type="text" 
                                    class="form-control" 
                                    id="editNameSKP{{ $row->id }}" 
                                    name="name_skp" 
                                    value="{{ $row->name_skp }}">
                            </div>
                        </div>
                        
                        <!-- Footer Modal -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                            </button>
                            <button type="submit" class="btn btn-primary">
                            Save changes
                            </button>
                        </div>
                        </form>
                        <!-- End Form Edit -->
                        
                        <!-- Form DELETE -->
                    <form id="form-delete-{{ $row->id }}" 
                        action="{{ route('pegawai.softDeleteSKP', $row->id) }}" 
                        method="POST" 
                        style="display: none;">
                    @csrf
                    @method('PUT')
                    </form>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- End Tabel SKP -->
                @endrole

                @role('atasan')
                <!-- Tabel SKP -->
                <div class="table-responsive">
                  <table id="add-row" class="display table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th style="width: 10%">Aksi</th>
                      </tr>
                    </thead>

                    <tbody>
                        @foreach ($skp as $item => $row)
                      <tr>
                         {{-- {{return $item }} --}}
                        <td>{{ $item + 1 }}</td>
                        <td>{{ $row->name_skp }}</td>
                        <td>{{ $monthNames[$row->month] ?? '-'}}</td>
                        <td>{{ $row->year }}</td>
                        <td>
                          <div class="form-button-action">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#editSKPModal{{ $row->id }}" title=""
                              class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                              <i class="fa fa-edit"></i>
                            </button>
                            {{-- <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editSKPModal{{ $row->id }}"> --}}
                            <button type="button"  onclick="confirmDelete({{ $row->id }})"
                              class="btn btn-link btn-danger">
                              <i class="fa fa-times"></i>
                            </button>
                          </div>
                        </td>
                    </tr>

                                <!-- Modal Edit (per baris) -->
                <div class="modal fade" id="editSKPModal{{ $row->id }}" tabindex="-1" aria-labelledby="editSKPModalLabel{{ $row->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        
                        <!-- Header Modal -->
                        <div class="modal-header">
                        <h5 class="modal-title" id="editSKPModalLabel{{ $row->id }}">Edit SKP #{{ $row->id }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                        <!-- Form Edit -->
                        <form action="{{ route('atasan.updateSKP', $row->id) }}" method="POST">
                        @csrf
                        @method('PUT') 
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="editMonth{{ $row->id }}" class="form-label">Bulan</label>
                                <select name="month" id="editMonth{{ $row->id }}" class="form-select">
                                <option value="">Pilih Bulan</option>
                                @foreach($monthNames as $monthNumber => $monthLabel)
                                    <option value="{{ $monthNumber }}" 
                                    {{ $row->month == $monthNumber ? 'selected' : '' }}>
                                    {{ $monthLabel }}
                                    </option>
                                @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editYear{{ $row->id }}" class="form-label">Tahun</label>
                                <select name="year" id="editYear{{ $row->id }}" class="form-select">
                                <option value="">Pilih Tahun</option>
                                <!-- Contoh statis: 2025, 2026, 2027 -->
                                <option value="2025" {{ $row->year == 2025 ? 'selected' : '' }}>2025</option>
                                <option value="2026" {{ $row->year == 2026 ? 'selected' : '' }}>2026</option>
                                <option value="2027" {{ $row->year == 2027 ? 'selected' : '' }}>2027</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editNameSKP{{ $row->id }}" class="form-label">Nama SKP</label>
                                <input type="text" 
                                    class="form-control" 
                                    id="editNameSKP{{ $row->id }}" 
                                    name="name_skp" 
                                    value="{{ $row->name_skp }}">
                            </div>
                        </div>
                        
                        <!-- Footer Modal -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                            </button>
                            <button type="submit" class="btn btn-primary">
                            Save changes
                            </button>
                        </div>
                        </form>
                        <!-- End Form Edit -->

                                            <!-- Form DELETE -->
                    <form id="form-delete-{{ $row->id }}" 
                        action="{{ route('atasan.softDeleteSKP', $row->id) }}" 
                        method="POST" 
                        style="display: none;">
                    @csrf
                    @method('PUT')
                     </form>

                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- End Tabel SKP -->
                @endrole
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        timer: 3000,
        showConfirmButton: false
    })
</script>
@endif

@if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
            })
        </script>
@endif

<script>
    function confirmDelete(id) {
        let form = document.getElementById('form-delete-' + id);
        if (!form) {
            console.error('Form with ID form-delete-' + id + ' not found!');
            return;
        }
      Swal.fire({
        title: 'Apakah Anda yakin?',
        text: 'Data ini akan dihapus secara permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          // Submit form
          document.getElementById('form-delete-' + id).submit();
        }
      })
    }
    </script>
      <!-- Search JS -->
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