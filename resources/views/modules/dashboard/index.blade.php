@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
  <section class="">
    <div class="content p-4">
      <!-- Dashboard Cards -->
      <div class="row">
        <div class="col-lg-3 col-sm-6">
          <div class="card background-blue color-white">
            <div class="content">
              <div class="row">
                <div class="col-md-3 text-center">
                  <img width="42" src="images/icon-asset.png" alt="Asset Icon" />
                </div>
                <div class="col-xs-7 home-detail">
                  <div class="numbers">
                    <p>Total Assets</p>
                    <span class="totalhead totalasset">123</span>
                  </div>
                </div>
              </div>
              <div class="footer">
                <hr />
                <div class="stats">
                  <i class="fa fa-angle-double-right color-white"></i>
                  <span class="color-white"><a class="color-white" href="#">More info</a></span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6">
          <div class="card background-yellow color-white">
            <div class="content">
              <div class="row">
                <div class="col-md-3 text-center">
                  <img width="42" src="images/icon-component.png" alt="Component Icon" />
                </div>
                <div class="col-xs-7 home-detail">
                  <div class="numbers">
                    <p>Total Components</p>
                    <span class="totalhead totalcomponent">45</span>
                  </div>
                </div>
              </div>
              <div class="footer">
                <hr />
                <div class="stats">
                  <i class="fa fa-angle-double-right color-white"></i>
                  <span class="color-white"><a class="color-white" href="#">More info</a></span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6">
          <div class="card background-green color-white">
            <div class="content">
              <div class="row">
                <div class="col-md-3 text-center">
                  <img width="42" src="images/icon-maintenance.png" alt="Maintenance Icon" />
                </div>
                <div class="col-xs-7 home-detail">
                  <div class="numbers">
                    <p>Total Maintenance</p>
                    <span class="totalhead totalmaintenance">8</span>
                  </div>
                </div>
              </div>
              <div class="footer">
                <hr />
                <div class="stats">
                  <i class="fa fa-angle-double-right color-white"></i>
                  <span class="color-white"><a class="color-white" href="#">More info</a></span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6">
          <div class="card background-red color-white">
            <div class="content">
              <div class="row">
                <div class="col-md-3 text-center">
                  <img width="42" src="images/icon-employee.png" alt="Employee Icon" />
                </div>
                <div class="col-xs-7 home-detail">
                  <div class="numbers">
                    <p>Total Employees</p>
                    <span class="totalhead totalemployee">67</span>
                  </div>
                </div>
              </div>
              <div class="footer">
                <hr />
                <div class="stats">
                  <i class="fa fa-angle-double-right color-white"></i>
                  <span class="color-white"><a class="color-white" href="#">More info</a></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Charts -->
      <div class="row pt-4">
        <div class="col-lg-6 col-sm-6">
          <div class="card">
            <div class="header">
              <h5 class="title text-center">Assets by Type</h5>
            </div>
            <div class="content">
              <canvas id="assetbytype" height="100"></canvas>
            </div>
          </div>
        </div>

        <div class="col-lg-6 col-sm-6">
          <div class="card">
            <div class="header">
              <h5 class="title text-center">Assets by Status</h5>
            </div>
            <div class="content">
              <canvas id="assetbystatus" height="100"></canvas>
            </div>
          </div>
        </div>
      </div>

      <!-- Recent Activity Tables -->
      <div class="row pt-4">
        <div class="col-md-6">
          <div class="card">
            <div class="header">
              <h5 class="title text-center">Recent Asset Activity</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Asset</th>
                      <th>Employee</th>
                      <th>Status</th>
                      <th>Location</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Laptop</td>
                      <td>John Doe</td>
                      <td>Active</td>
                      <td>HQ</td>
                      <td>2026-02-11</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Monitor</td>
                      <td>Jane Smith</td>
                      <td>Inactive</td>
                      <td>Branch</td>
                      <td>2026-02-10</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card">
            <div class="header">
              <h5 class="title text-center">Recent Component Activity</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Component</th>
                      <th>Asset</th>
                      <th>Quantity</th>
                      <th>Status</th>
                      <th>Location</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>RAM</td>
                      <td>Laptop</td>
                      <td>2</td>
                      <td>Active</td>
                      <td>HQ</td>
                      <td>2026-02-11</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Keyboard</td>
                      <td>Monitor</td>
                      <td>5</td>
                      <td>Inactive</td>
                      <td>Branch</td>
                      <td>2026-02-10</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- JS: Charts (Dummy example) -->
  <script>
    const dummyColors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'];

    const ctxType = document.getElementById('assetbytype').getContext('2d');
    new Chart(ctxType, {
      type: 'doughnut',
      data: {
        labels: ['Laptop', 'Monitor', 'Printer'],
        datasets: [
          {
            data: [12, 7, 5],
            backgroundColor: dummyColors,
          },
        ],
      },
      options: {
        responsive: true,
        plugins: {
          legend: { position: 'bottom' },
        },
      },
    });

    const ctxStatus = document.getElementById('assetbystatus').getContext('2d');
    new Chart(ctxStatus, {
      type: 'doughnut',
      data: {
        labels: ['Active', 'Inactive', 'Under Repair'],
        datasets: [
          {
            data: [15, 5, 4],
            backgroundColor: dummyColors,
          },
        ],
      },
      options: {
        responsive: true,
        plugins: {
          legend: { position: 'bottom' },
        },
      },
    });
  </script>
@endsection
