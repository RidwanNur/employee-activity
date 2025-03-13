@extends('layouts.partials.app')

@section('content')

    
</style>

      <!-- Page Title -->
      <div class="container">
        <div class="page-inner">
          <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <h3 class="fw-bold mb-3">Profil</h3>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <label>{{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, j F Y') }}</label>
            </div>
          </div>
          @role('atasan')
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <div class="card-title">Profil Pegawai</div>
                </div>
                <div class="card-body">
                  <table>
                    <p class="demo">
                      <tr>
                        <th class="card-body">
                          <div class="avatar avatar-xxl">
                            <img src="{{ asset('assets/img/profile.jpg') }}" alt="..." class="avatar-img rounded">
                          </div>
                        </th>
                        <th>
                        <td class="">
                          <div class="card-title m-4">
                            <h3>{{ $employees->name }}</h3>
                            <p>{{ $employees->nip }}</p>
                          </div>
                        </td>
                        </th>
                      </tr>
                    </p>
                  </table>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Informasi</div>
                  </div>
                  <div class="card-body">
                    <div class="card-category">Jabatan</div>
                    <p class="card-body">{{ $employees->position }}</p>
                    <div class="card-category">Wilayah Kerja</div>
                    <p class="card-body">{{ $employees->region }}</p>
                    <div class="card-category">Atasan</div>
                    <p class="card-body">{{ $employees->nip_atasan }} - {{ $employees->nama_atasan }}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Password</div>
                  </div>
                  <div class="card-body">
                    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')
                        <div class="card-category">Password Lama</div>
                        <div class="card-body col-md-4">
                            <x-text-input id="update_password_current_password" class="form-control" name="current_password" type="password" autocomplete="current-password"/><i fas fa-eye"></i>
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />    
                        </div>
                        <div class="card-category">Password Baru</div>
                        <div class="card-body col-md-4">
                            <x-text-input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password" />
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />   
                        </div>
                        <div class="card-category">Konfirmasi Password</div>
                        <div class="card-body col-md-4">
                            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" />
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                        </div>
                        <div class="card-body">
                        <button class="btn btn-info" type="submit">{{ __('Save') }}</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endrole

          @role('pegawai')
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <div class="card-title">Profil Pegawai</div>
                </div>
                <div class="card-body">
                  <table>
                    <p class="demo">
                      <tr>
                        <th class="card-body">
                          <div class="avatar avatar-xxl">
                            <img src="{{ asset('assets/img/profile.jpg') }}" alt="..." class="avatar-img rounded">
                          </div>
                        </th>
                        <th>
                        <td class="">
                          <div class="card-title m-4">
                            <h3>{{ $employees->name }}</h3>
                            <p>{{ $employees->nip }}</p>
                          </div>
                        </td>
                        </th>
                      </tr>
                    </p>
                  </table>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Informasi</div>
                  </div>
                  <div class="card-body">
                    <div class="card-category">Jabatan</div>
                    <p class="card-body">{{ $employees->position }}</p>
                    <div class="card-category">Wilayah Kerja</div>
                    <p class="card-body">{{ $employees->region }}</p>
                    <div class="card-category">Atasan</div>
                    <p class="card-body">{{ $employees->nip_atasan }} - {{ $employees->nama_atasan }}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Password</div>
                  </div>
                  <div class="card-body">
                    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')
                        <div class="card-category">Password Lama</div>
                        <div class="card-body col-md-4">
                            <x-text-input id="update_password_current_password" class="form-control" name="current_password" type="password" autocomplete="current-password"/><i fas fa-eye"></i>
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />    
                        </div>
                        <div class="card-category">Password Baru</div>
                        <div class="card-body col-md-4">
                            <x-text-input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password" />
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />   
                        </div>
                        <div class="card-category">Konfirmasi Password</div>
                        <div class="card-body col-md-4">
                            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" />
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                        </div>
                        <div class="card-body">
                        <button class="btn btn-info" type="submit">{{ __('Save') }}</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endrole

          @role('admin')
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <div class="card-title">Profil Pegawai</div>
                </div>
                <div class="card-body">
                  <table>
                    <p class="demo">
                      <tr>
                        <th class="card-body">
                          <div class="avatar avatar-xxl">
                            <img src="{{ asset('assets/img/profile.jpg') }}" alt="..." class="avatar-img rounded">
                          </div>
                        </th>
                        <th>
                        <td class="">
                          <div class="card-title m-4">
                            <h3>{{ $employees->name }}</h3>
                            <p>{{ $employees->nip }}</p>
                          </div>
                        </td>
                        </th>
                      </tr>
                    </p>
                  </table>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Informasi</div>
                  </div>
                  <div class="card-body">
                    <div class="card-category">Jabatan</div>
                    <p class="card-body">{{ $employees->position }}</p>
                    <div class="card-category">Wilayah Kerja</div>
                    <p class="card-body">{{ $employees->region }}</p>
                    <div class="card-category">Atasan</div>
                    <p class="card-body">{{ $employees->nip_atasan }} - {{ $employees->nama_atasan }}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Password</div>
                  </div>
                  <div class="card-body">
                    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')
                        <div class="card-category">Password Lama</div>
                        <div class="card-body col-md-4">
                            <x-text-input id="update_password_current_password" class="form-control" name="current_password" type="password" autocomplete="current-password"/><i fas fa-eye"></i>
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />    
                        </div>
                        <div class="card-category">Password Baru</div>
                        <div class="card-body col-md-4">
                            <x-text-input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password" />
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />   
                        </div>
                        <div class="card-category">Konfirmasi Password</div>
                        <div class="card-body col-md-4">
                            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" />
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                        </div>
                        <div class="card-body">
                        <button class="btn btn-info" type="submit">{{ __('Save') }}</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endrole
        </div>
      </div>
    
@endsection

@push('scripts')
  <!-- Search JS -->

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

{{-- 
<script>
    // document.querySelectorAll('.toggle-password').forEach(function(icon) {
    //     icon.addEventListener('click', function() {
    //         const input = this.previousElementSibling;
    //         const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
    //         input.setAttribute('type', type);
            
    //         // Ganti icon
    //         this.classList.toggle('fa-eye-slash');
    //     });
    // });
    function togglePassword() {
    const passwordField = document.getElementById('password');
    const icon = document.querySelector('.toggle-password');
    
    if(passwordField.type === "password") {
        passwordField.type = "text";
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        passwordField.type = "password";
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}
</script> --}}



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
        '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

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
