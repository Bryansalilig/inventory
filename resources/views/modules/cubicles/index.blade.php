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
        <div class="col-md-6">
          <h3>Cubicle Floor List</h3>
        </div>
        <div class="col-md-6 text-md-right pb-md-0 pb-3">
          <a href="#" class="btn btn-sm btn-fill btn-primary" data-toggle="modal" data-target="#cubicleModal">
            <i class="fa fa-plus"></i>
            Add Cubicle
          </a>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" data-toggle="tab" href="#first_floor">First Floor (1)</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#second_floor">Second Floor (2)</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#third_floor">Third Floor (3)</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#fourth_floor">Fourth Floor (4)</a>
                    </li>
                  </ul>

                  <div class="tab-content">
                    <!-- First Floor TAB -->
                    <div class="tab-pane fade show active" id="first_floor">
                      <div class="table-responsive pt-4">
                        <table class="table table-striped table-bordered" id="firstFloorTable" data-url="{{ route('cubicles.getFirstFloorCubicle', 1) }}">
                          <thead>
                            <tr>
                              <th>Cubicle Name</th>
                              <th>Stutus</th>
                              <th>Assigned To</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th>Cubicle Name</th>
                              <th>Stutus</th>
                              <th>Assigned To</th>
                              <th>Action</th>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <!-- Second Floor TAB -->
                    <div class="tab-pane fade" id="second_floor">
                      <div class="table-responsive pt-4">
                        <table class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th>Cubicle Name</th>
                              <th>Stutus</th>
                              <th>Assigned To</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th>Cubicle Name</th>
                              <th>Stutus</th>
                              <th>Assigned To</th>
                              <th>Action</th>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <!-- Third Floor -->
                    <div class="tab-pane fade" id="third_floor">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="historyTable" data-url="" width="100%">
                          <thead>
                            <tr>
                              <th>Asset Tag</th>
                              <th>Deployed To</th>
                              <th>Quantity</th>
                              <th>Created By</th>
                              <th>Created At</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th>Asset Tag</th>
                              <th>Deployed To</th>
                              <th>Quantity</th>
                              <th>Created By</th>
                              <th>Created At</th>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <!-- Fourth Floor -->
                    <div class="tab-pane fade" id="fourth_floor">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="historyTable" data-url="" width="100%">
                          <thead>
                            <tr>
                              <th>Asset Tag</th>
                              <th>Deployed To</th>
                              <th>Quantity</th>
                              <th>Created By</th>
                              <th>Created At</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th>Asset Tag</th>
                              <th>Deployed To</th>
                              <th>Quantity</th>
                              <th>Created By</th>
                              <th>Created At</th>
                            </tr>
                          </tbody>
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

  {{-- Modals --}}
  @include('modules.cubicles.modals')
@endsection

{{-- Load page specific scripts --}}
@include('modules.cubicles.scripts')
