@extends('layouts.partials.app')

@section('content')
  <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
    <div>
      <h3 class="fw-bold mb-3">Dashboard</h3>
    </div>
    <div class="ms-md-auto py-2 py-md-0">
      <label>Senin, 10 Maret 2025</label>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-icon">
              <div class="icon-big text-center icon-primary bubble-shadow-small">
                <i class="fas fa-users"></i>
              </div>
            </div>
            <div class="col col-stats ms-3 ms-sm-0">
              <div class="numbers">
                <p class="card-category">Pegawai</p>
                <h4 class="card-title">831</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Contoh kartu selanjutnya -->
    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-icon">
              <div class="icon-big text-center icon-info bubble-shadow-small">
                <i class="fas fa-user-check"></i>
              </div>
            </div>
            <div class="col col-stats ms-3 ms-sm-0">
              <div class="numbers">
                <p class="card-category">Pekerjaan</p>
                <h4 class="card-title">100</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-icon">
              <div class="icon-big text-center icon-success bubble-shadow-small">
                <i class="fas fa-luggage-cart"></i>
              </div>
            </div>
            <div class="col col-stats ms-3 ms-sm-0">
              <div class="numbers">
                <p class="card-category">lorem</p>
                <h4 class="card-title">000</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-icon">
              <div class="icon-big text-center icon-secondary bubble-shadow-small">
                <i class="far fa-check-circle"></i>
              </div>
            </div>
            <div class="col col-stats ms-3 ms-sm-0">
              <div class="numbers">
                <p class="card-category">lorem</p>
                <h4 class="card-title">0000</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card card-round">
        <div class="card-header">
          <div class="card-head-row">
            <div class="card-title">Statistik Pekerjaan</div>
            <div class="card-tools">
              <a href="#" class="btn btn-label-success btn-round btn-sm me-2">
                <span class="btn-label">
                  <i class="fa fa-pencil"></i>
                </span>
                Export
              </a>
              <a href="#" class="btn btn-label-info btn-round btn-sm">
                <span class="btn-label">
                  <i class="fa fa-print"></i>
                </span>
                Print
              </a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="chart-container" style="min-height: 375px">
            <canvas id="statisticsChart"></canvas>
          </div>
          <div id="myChartLegend"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="card card-round">
      <div class="card-header">
        <div class="card-head-row card-tools-still-right">
          <div class="card-title">Riwayat Pekerjaan</div>
          <div class="card-tools">
            <div class="dropdown">
              <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton"
                      data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h"></i>
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center mb-0">
            <thead class="thead-light">
              <tr>
                <th scope="col">No Pekerjaan</th>
                <th scope="col" class="text-end">Tanggal</th>
                <th scope="col" class="text-end">Jumlah</th>
                <th scope="col" class="text-end">Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">
                  <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                    <i class="fa fa-check"></i>
                  </button>
                  Payment from #10231
                </th>
                <td class="text-end">Mar 19, 2020, 2.45pm</td>
                <td class="text-end">$250.00</td>
                <td class="text-end">
                  <span class="badge badge-success">Completed</span>
                </td>
              </tr>
              <tr>
                <th scope="row">
                  <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                    <i class="fa fa-check"></i>
                  </button>
                  Payment from #10231
                </th>
                <td class="text-end">Mar 19, 2020, 2.45pm</td>
                <td class="text-end">$250.00</td>
                <td class="text-end">
                  <span class="badge badge-success">Completed</span>
                </td>
              </tr>
              <tr>
                <th scope="row">
                  <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                    <i class="fa fa-check"></i>
                  </button>
                  Payment from #10231
                </th>
                <td class="text-end">Mar 19, 2020, 2.45pm</td>
                <td class="text-end">$250.00</td>
                <td class="text-end">
                  <span class="badge badge-success">Completed</span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<script>
    $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
      type: "line",
      height: "70",
      width: "100%",
      lineWidth: "2",
      lineColor: "#177dff",
      fillColor: "rgba(23, 125, 255, 0.14)",
    });

    $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
      type: "line",
      height: "70",
      width: "100%",
      lineWidth: "2",
      lineColor: "#f3545d",
      fillColor: "rgba(243, 84, 93, .14)",
    });

    $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
      type: "line",
      height: "70",
      width: "100%",
      lineWidth: "2",
      lineColor: "#ffa534",
      fillColor: "rgba(255, 165, 52, .14)",
    });
  </script>
@endpush
