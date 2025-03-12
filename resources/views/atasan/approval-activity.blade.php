
@extends('layouts.partials.app')

@section('content')
  <!-- Page Title -->
  <div class="container">
    <div class="page-inner">
      <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
          <h3 class="fw-bold mb-3">Approval Aktivitas</h3>
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
                  {{-- <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                    data-bs-target="#addRowModal">
                    <i class="fa fa-plus"></i>
                    Tambah Aktivitas
                  </button> --}}
                </div>
              </div>
              <div class="card-body">
                @role('atasan')
                <!-- Modal Tambah Aktivitas -->
                <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header border-0">
                        <h5 class="modal-title">
                          <span class="fw-mediumbold"> Tambah</span>
                          <span class="fw-light"> Aktivitas </span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" action="close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="{{ route('atasan.storeActivity') }}" method="POST">
                            @csrf
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Jam Mulai</label>
                                <input id="addPosition" name="start_time" type="time" class="form-control" placeholder="" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Jam Selesai</label>
                                <input id="addOffice" name="end_time" type="time" class="form-control" placeholder="" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>SKP Acuan</label>
                                <select class="btn btn-light dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false" name="skp_id" id="skp_id">
                                    <option value="" class="dropdown-item">Pilih SKP</option>
                                    @foreach($skp as $item => $rowSkp)
                                    <option value="{{ $rowSkp->id }}">
                                      {{ $rowSkp->name_skp }}
                                    </option>
                                  @endforeach
                                  </select>
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label for="">Aktivitas</label>
                                <input id="activity" type="text" name="activity" class="form-control"
                                  placeholder="Isi sesuai aktivitas anda" />
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label for="">Deskripsi</label>
                                <textarea id="description" type="text" name="description" class="form-control"
                                  placeholder="Isi sesuai aktivitas anda"></textarea>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="submit"  class="btn btn-primary">
                                Add
                            </button>
                            {{-- <button type="button" class="btn btn-danger" data-dismiss="modal" action="">
                                Close
                            </button> --}}
                        </div>
                    </form>
                    </div>
                  </div>
                </div>
                @endrole
                <!-- End Modal -->


                <!-- Tabel Aktivitas -->
                @role('atasan')
                <div class="table-responsive">
                  <table id="add-row" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Waktu Mulai</th>
                            <th>Waktu Selesai</th>
                            <th>SKP</th>
                            <th>Aktivitas</th>
                            <th>Deskripsi</th>
                            <th>Approval</th>
                            <th style="width: 5%">Aksi</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($activities as $item => $row)
                      <tr>
                        <td>{{ $row->created_at }}</td>
                        <td>{{ $row->start_time }}</td>
                        <td>{{ $row->end_time }}</td>
                        <td>{{ $row->skp->name_skp }}</td>
                        <td>{{ $row->activity }}</td>
                        <td>{{ $row->description }}</td>
                        @if ($row->status == null || $row->status == '')
                        <td>Menunggu Persetujuan</td>
                        @elseif($row->status == 1)
                        <td>Sudah Approval</td>
                        @else
                        <td>{{ $row->status }}</td>
                        @endif
                        <td>
                            
                            <div class="form-button-action">
                                @if ($row->status == null)
                                <button type="button" 
                                data-bs-toggle="modal" data-bs-target="#editRowModal{{ $row->id }}" title=""
                                  class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                  <i class="fa fa-edit"></i>
                                </button>
                                @else
                                <button type="button" 
                                 onclick="cannotEditWarning()"
                                  class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                  <i class="fa fa-edit"></i>
                                </button>                    
                                @endif
                            </div>
                        </td>
                      </tr>
                        <div class="modal fade" id="editRowModal{{ $row->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header border-0">
                                <h5 class="modal-title">
                                <span class="fw-mediumbold">View</span>
                                <span class="fw-light">Aktivitas</span>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" action="close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            
                            <!-- Body Modal: Form Edit -->
                            <div class="modal-body">
                                <form action="{{ route('atasan.ApproveActivity', $row->id) }}" method="POST">
                                @csrf
                                @method('PUT') 
                                
                                <div class="row">
                                    @if ($row->status == null || $row->status == '')
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <input type="text" name="created_by" class="form-control"
                                                value="Menunggu Approval" readonly/>
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <input type="text" name="created_by" class="form-control"
                                                value="Sudah Approve" readonly/>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>NIP</label>
                                            <input type="text" name="created_by" class="form-control"
                                                value="{{ $row->created_by }}" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" name="created_name" class="form-control"
                                                value="{{ $row->created_name }}" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Tanggal Buat</label>
                                            <input type="text" name="nip" class="form-control"
                                                value="{{ date('d-m-Y', strtotime($row->created_at)); }}" readonly />
                                        </div>
                                    </div>
                                    <!-- Jam Mulai -->
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jam Mulai</label>
                                        <input type="time" name="start_time" class="form-control"
                                            value="{{ $row->start_time }}" readonly/>
                                    </div>
                                    </div>
                                    <!-- Jam Selesai -->
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jam Selesai</label>
                                        <input type="time" name="end_time" class="form-control"
                                            value="{{ $row->end_time }}" readonly/>
                                    </div>
                                    </div>
                                    
                                    <!-- SKP Acuan -->
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label>SKP Acuan</label>
                                        <select name="skp_id" class="btn btn-light dropdown-toggle" disabled>
                                        <option value="">Pilih SKP</option>
                                        @foreach($skp as $skpRow)
                                            <option value="{{ $skpRow->id }}"
                                            {{ $row->skp_id == $skpRow->id ? 'selected' : '' }}>
                                            {{ $skpRow->name_skp }}
                                            </option>
                                        @endforeach
                                        </select>
                                    </div>
                                    </div>
                                    
                                    <!-- Aktivitas -->
                                    <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Aktivitas</label>
                                        <input type="text" name="activity" class="form-control"
                                            value="{{ $row->activity }}" readonly/>
                                    </div>
                                    </div>
                                    
                                    <!-- Deskripsi -->
                                    <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <textarea name="description" class="form-control"
                                        placeholder="Isi sesuai aktivitas anda" readonly>{{ $row->description }}</textarea>
                                    </div>
                                    </div>
                                </div>
                                <!-- End Row -->

                                <!-- Footer Modal -->
                                <div class="modal-footer border-0">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                                        Close
                                        </button>
                                    <button type="submit" class="btn btn-primary">
                                    Approve
                                    </button>
                                    
                                </div>
                                </form>
                                <form id="form-delete-{{ $row->id }}" 
                                    action="{{ route('atasan.softDeleteActivity', $row->id) }}" 
                                    method="POST" 
                                    style="display: none;">
                                @csrf
                                @method('PUT')
                            </div> <!-- modal-body -->
                            </div> <!-- modal-content -->
                        </div> <!-- modal-dialog -->
                        </div> <!-- modal fade -->
                      @endforeach
                    </tbody>
                  </table>
                </div>
                @endrole
                <!-- End Tabel Aktivitas -->

                                <!-- Tabel Aktivitas -->
                                @role('pegawai')
                                <div class="table-responsive">
                                  <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Waktu Mulai</th>
                                            <th>Waktu Selesai</th>
                                            <th>SKP</th>
                                            <th>Aktivitas</th>
                                            <th>Deskripsi</th>
                                            <th>Status Approval</th>
                                            <th style="width: 10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @foreach ($activities as $item => $row)
                                      <tr>
                                        <td>{{ $row->created_at }}</td>
                                        <td>{{ $row->start_time }}</td>
                                        <td>{{ $row->end_time }}</td>
                                        <td>{{ $row->skp->name_skp }}</td>
                                        <td>{{ $row->activity }}</td>
                                        <td>{{ $row->description }}</td>
                                        @if ($row->status == null || $row->status == '')
                                        <td>Menunggu Persetujuan</td>
                                        @elseif($row->status == 1)
                                        <td>Sudah Approval</td>
                                        @else
                                        <td>{{ $row->status }}</td>
                                        @endif
                                        <td>
                                            
                                            <div class="form-button-action">
                                                @if ($row->status == null)
                                                <button type="button" 
                                                data-bs-toggle="modal" data-bs-target="#editRowModal{{ $row->id }}" title=""
                                                  class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                  <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" data-bs-toggle="tooltip" title="" onclick="confirmDelete({{ $row->id }})"
                                                  class="btn btn-link btn-danger" data-original-title="Remove">
                                                  <i class="fa fa-times"></i>
                                                </button>
                                                @else
                                                <button type="button" 
                                                 onclick="cannotEditWarning()"
                                                  class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                  <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" onclick="cannotEditWarning()"
                                                  class="btn btn-link btn-danger" data-original-title="Remove">
                                                  <i class="fa fa-times"></i>
                                                </button>
                                                
                                                @endif
                                            </div>
                                        </td>
                                      </tr>
                                        <div class="modal fade" id="editRowModal{{ $row->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title">
                                                <span class="fw-mediumbold">Edit</span>
                                                <span class="fw-light">Aktivitas</span>
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" action="close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            
                                            <!-- Body Modal: Form Edit -->
                                            <div class="modal-body">
                                                <form action="{{ route('pegawai.updateActivity', $row->id) }}" method="POST">
                                                @csrf
                                                @method('PUT') 
                                                
                                                <div class="row">
                                                    <!-- Jam Mulai -->
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Jam Mulai</label>
                                                        <input type="time" name="start_time" class="form-control"
                                                            value="{{ $row->start_time }}" />
                                                    </div>
                                                    </div>
                                                    <!-- Jam Selesai -->
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Jam Selesai</label>
                                                        <input type="time" name="end_time" class="form-control"
                                                            value="{{ $row->end_time }}" />
                                                    </div>
                                                    </div>
                                                    
                                                    <!-- SKP Acuan -->
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>SKP Acuan</label>
                                                        <select name="skp_id" class="btn btn-light dropdown-toggle">
                                                        <option value="">Pilih SKP</option>
                                                        @foreach($skp as $skpRow)
                                                            <option value="{{ $skpRow->id }}"
                                                            {{ $row->skp_id == $skpRow->id ? 'selected' : '' }}>
                                                            {{ $skpRow->name_skp }}
                                                            </option>
                                                        @endforeach
                                                        </select>
                                                    </div>
                                                    </div>
                                                    
                                                    <!-- Aktivitas -->
                                                    <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Aktivitas</label>
                                                        <input type="text" name="activity" class="form-control"
                                                            value="{{ $row->activity }}" />
                                                    </div>
                                                    </div>
                                                    
                                                    <!-- Deskripsi -->
                                                    <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Deskripsi</label>
                                                        <textarea name="description" class="form-control"
                                                        placeholder="Isi sesuai aktivitas anda">{{ $row->description }}</textarea>
                                                    </div>
                                                    </div>
                                                </div>
                                                <!-- End Row -->
                
                                                <!-- Footer Modal -->
                                                <div class="modal-footer border-0">
                                                    <button type="submit" class="btn btn-primary">
                                                    Save
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                    Close
                                                    </button>
                                                </div>
                                                </form>
                                                <form id="form-delete-{{ $row->id }}" 
                                                    action="{{ route('pegawai.softDeleteActivity', $row->id) }}" 
                                                    method="POST" 
                                                    style="display: none;">
                                                @csrf
                                                @method('PUT')
                                            </div> <!-- modal-body -->
                                            </div> <!-- modal-content -->
                                        </div> <!-- modal-dialog -->
                                        </div> <!-- modal fade -->
                                      @endforeach
                                    </tbody>
                                  </table>
                                </div>
                                      @endrole
                                <!-- End Tabel Aktivitas -->
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

@if ($errors->any())
  <script>
    const errorHtml = `
    <div style="text-align: left;">
      <strong>Terjadi kesalahan:</strong></br>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  `;

    // Panggil SweetAlert
    Swal.fire({
      icon: 'error',
      title: 'Pengisian Gagal!',
        html: errorHtml,
        confirmButtonText: 'OK'
    });
  </script>
@endif

<script>
    function cannotEditWarning() {
      Swal.fire({
        icon: 'warning',
        title: 'Sudah Approve',
        text: 'Aktivitas ini sudah disetujui',
      });
    }
    
    function cannotDeleteWarning() {
      Swal.fire({
        icon: 'warning',
        title: 'Tidak Dapat Dihapus',
        text: 'Data ini sudah disetujui, Anda tidak dapat menghapusnya lagi.',
      });
    }
    </script>

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

!-- Search JS (DataTables init, dsb) -->
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
                select.append(
                  '<option value="' + d + '">' + d + "</option>"
                );
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