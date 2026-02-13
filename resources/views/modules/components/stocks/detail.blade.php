@extends('layouts.main')

@section('title', 'Components')

@push('styles')
  {{-- @include('modules.components.styles') --}}
  <link rel="stylesheet" href="{{ asset('css/components.css') }}" />
@endpush

@section('content')
  <section>
    <div class="content p-4">
      <div class="row pt-3">
        <div class="col-md-8">
          <h3>Asset Detail</h3>
        </div>
        <div class="col-md-4 text-md-right">
          <a href="#" target="_blank" class="btn btn-sm btn-fill btn-primary">
            <i class="ti-info"></i>
            Generate Label
          </a>
          <a href="#" class="btn btn-sm btn-fill btn-warning">
            <i class="ti-info"></i>
            Back to Asset
          </a>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body p-4">
              <div class="row">
                <div class="col-md-9">
                  <p class="title-detail font-bold">
                    Asset Name (
                    <span>Asset Tag</span>
                    )
                  </p>
                  <p class="assetdetail">Asset Type &bull; Asset Status</p>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" data-toggle="tab" href="#details">Details</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#components">Components</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#maintenance">Maintenances</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#history">History</a>
                    </li>
                  </ul>

                  <div class="tab-content">
                    <!-- DETAILS TAB -->
                    <div class="tab-pane fade show active" id="details">
                      <div class="row pt-3">
                        <div class="col-md-9">
                          <table class="table table-hover">
                            <tr>
                              <td width="200" bgcolor="#f2f3f4"><b>Type</b></td>
                              <td>Asset Type</td>
                            </tr>
                            <tr>
                              <td bgcolor="#f2f3f4"><b>Status</b></td>
                              <td>Asset Status</td>
                            </tr>
                            <tr>
                              <td bgcolor="#f2f3f4"><b>Serial</b></td>
                              <td>Serial Number</td>
                            </tr>
                            <tr>
                              <td bgcolor="#f2f3f4"><b>Brand</b></td>
                              <td>Brand Name</td>
                            </tr>
                            <tr>
                              <td bgcolor="#f2f3f4"><b>Purchase Date</b></td>
                              <td>YYYY-MM-DD</td>
                            </tr>
                            <tr>
                              <td bgcolor="#f2f3f4"><b>Cost</b></td>
                              <td>₱0.00</td>
                            </tr>
                            <tr>
                              <td bgcolor="#f2f3f4"><b>Warranty</b></td>
                              <td>Warranty Info</td>
                            </tr>
                            <tr>
                              <td bgcolor="#f2f3f4"><b>Location</b></td>
                              <td>Location Name</td>
                            </tr>
                            <tr>
                              <td bgcolor="#f2f3f4"><b>Supplier</b></td>
                              <td>Supplier Name</td>
                            </tr>
                            <tr>
                              <td bgcolor="#f2f3f4"><b>Updated At</b></td>
                              <td>Date</td>
                            </tr>
                            <tr>
                              <td bgcolor="#f2f3f4"><b>Created At</b></td>
                              <td>Date</td>
                            </tr>
                            <tr>
                              <td bgcolor="#f2f3f4"><b>Description</b></td>
                              <td>Description here</td>
                            </tr>
                          </table>
                        </div>

                        <div class="col-md-3 text-center">
                          <img src="#" width="250" class="img-responsive" alt="Asset Image" />
                          <div class="mt-2 border p-2">Barcode Here</div>
                        </div>
                      </div>
                    </div>

                    <!-- COMPONENTS TAB -->
                    <div class="tab-pane fade" id="components">
                      <div class="table-responsive pt-4">
                        <table class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Picture</th>
                              <th>Name</th>
                              <th>Type</th>
                              <th>Brand</th>
                              <th>Quantity</th>
                              <th>Available Quantity</th>
                            </tr>
                          </thead>
                          <tbody>
                            <!-- Static rows -->
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <!-- MAINTENANCE TAB -->
                    <div class="tab-pane fade" id="maintenance">
                      <div class="table-responsive pt-4">
                        <table class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Asset</th>
                              <th>Supplier</th>
                              <th>Type</th>
                              <th>Start Date</th>
                              <th>End Date</th>
                            </tr>
                          </thead>
                          <tbody></tbody>
                        </table>
                      </div>
                    </div>

                    <!-- HISTORY TAB -->
                    <div class="tab-pane fade" id="history">
                      <div class="table-responsive pt-4">
                        <table class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Date</th>
                              <th>Asset Name</th>
                              <th>Employee</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody></tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Checkout Modal -->
  {{-- @include('modules.components.modals') --}}
@endsection

{{-- Load page specific scripts --}}
{{-- @include('modules.components.scripts') --}}
