
@extends('layouts.partials.app')

@section('content')
  <!-- Page Title -->
  <div class="container">
    <div class="page-inner">
      <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
          <h3 class="fw-bold mb-3">Aktivitas</h3>
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
                  <h4 class="card-title">Appoval Aktivitas</h4>
                  <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                    data-bs-target="#addRowModal">
                    <i class="fa fa-plus"></i>
                    Tambah Aktivitas
                  </button>
                </div>
              </div>
              <div class="card-body">

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
                        <p class="small">
                          Create a new row using this form, make sure you
                          fill them all
                        </p>
                        <form>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Jam Mulai</label>
                                <input id="addPosition" type="time" class="form-control" placeholder="" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Jam Selesai</label>
                                <input id="addOffice" type="time" class="form-control" placeholder="" />
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>SKP Acuan</label>
                                <select id="addName" type="" class="form-select" placeholder="Sesuaikan SKP">
                                  <option selected>Open this select menu</option>
                                  <option value="1">One</option>
                                  <option value="2">Two</option>
                                  <option value="3">Three</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label for="">Aktivitas</label>
                                <input id="" type="text" class="form-control"
                                  placeholder="Isi sesuai aktivitas anda" />
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label for="">Deskripsi</label>
                                <textarea id="" type="text" class="form-control"
                                  placeholder="Isi sesuai aktivitas anda"></textarea>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer border-0">
                        <button type="button" id="addRowButton" class="btn btn-primary" action="">
                          Add
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" action="">
                          Close
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Modal -->

                <!-- Tabel Aktivitas -->
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
                      <tr>
                        <td>08 Maret 2025</td>
                        <td>07.00 AM</td>
                        <td>04.00 PM</td>
                        <td>Lorem ipsum</td>
                        <td>Meeting Proyek</td>
                        <td>Lorem ipsum</td>
                        <td>Waktu Selesai</td>
                        <td>
                          <div class="form-button-action">
                            <button type="button" data-bs-toggle="tooltip" title=""
                              class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                              <i class="fa fa-edit"></i>
                            </button>
                            <button type="button" data-bs-toggle="tooltip" title=""
                              class="btn btn-link btn-danger" data-original-title="Remove">
                              <i class="fa fa-times"></i>
                            </button>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>08 Maret 2025</td>
                        <td>07.00 AM</td>
                        <td>04.00 PM</td>
                        <td>Lorem ipsum</td>
                        <td>Meeting Proyek</td>
                        <td>Lorem ipsum</td>
                        <td>Waktu Selesai</td>
                        <td>
                          <div class="form-button-action">
                            <button type="button" data-bs-toggle="tooltip" title=""
                              class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                              <i class="fa fa-edit"></i>
                            </button>
                            <button type="button" data-bs-toggle="tooltip" title=""
                              class="btn btn-link btn-danger" data-original-title="Remove">
                              <i class="fa fa-times"></i>
                            </button>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>08 Maret 2025</td>
                        <td>07.00 AM</td>
                        <td>04.00 PM</td>
                        <td>Lorem ipsum</td>
                        <td>Meeting Proyek</td>
                        <td>Lorem ipsum loros</td>
                        <td>Waktu Selesai</td>
                        <td>
                          <div class="form-button-action">
                            <button type="button" data-bs-toggle="tooltip" title=""
                              class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                              <i class="fa fa-edit"></i>
                            </button>
                            <button type="button" data-bs-toggle="tooltip" title=""
                              class="btn btn-link btn-danger" data-original-title="Remove">
                              <i class="fa fa-times"></i>
                            </button>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
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